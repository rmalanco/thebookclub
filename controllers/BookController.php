<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Book;
use app\models\Author;
use app\models\BookScores;
use app\models\Genre;
use app\models\UserBooks;

class BookController extends Controller
{
    private const LOGIN_URL = 'site/login';

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }
        return $this->render('index');
    }

    // url: http://localhost:8080/index.php?r=book/all
    public function actionAll()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }
        $books = Book::getAllBooks();
        return $this->render('all', ['books' => $books]);
    }

    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }
        $book = Book::find()->where(['book_id' => $id])->one();
        $userBooks = UserBooks::getLibroLoTiene($id);
        $averageScore = BookScores::getBookScores($id);
        $bookScores = new BookScores();
        $scores = BookScores::find()->where(['book_id' => $id])->all();
        if (empty($book)) {
            Yii::$app->session->setFlash('error', 'No existe el libro');
            return $this->goHome();
        }
        return $this->render('view', ['book' => $book, 'userBooks' => $userBooks, 'averageScore' => $averageScore, 'bookScores' => $bookScores, 'scores' => $scores]);
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }
        $book = new Book();
        $authors = Author::getAllAuthors();
        $genres = Genre::getAllGenres();
        $redirectHome = false;

        if ($book->load(Yii::$app->request->post()) && $book->validate()) {
            $existeLibro = Book::existeLibro($book->title);
            if (!empty($existeLibro)) {
                Yii::$app->session->setFlash('error', 'Ya existe un libro con ese título');
                $redirectHome = true;
            } else {
                if ($book->save()) {
                    Yii::$app->session->setFlash('success', 'Libro creado correctamente');
                    $redirectHome = true;
                } else {
                    Yii::$app->session->setFlash('error', 'Error al crear el libro');
                    $redirectHome = true;
                }
            }
        }

        if ($redirectHome) {
            return $this->goHome();
        }

        return $this->render('create', ['book' => $book, 'authors' => $authors, 'genres' => $genres]);
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }

        $book = Book::find()->where(['book_id' => $id])->one();
        if (empty($book)) {
            Yii::$app->session->setFlash('error', 'No existe el libro');
            $redirect = $this->goHome();
        } else {
            $authors = Author::getAuthorsList();
            $genres = Genre::getGenresList();

            if ($this->processBookUpdate($book)) {
                $redirect = $this->goHome();
            } else {
                $redirect = $this->render('update', ['book' => $book, 'authors' => $authors, 'genres' => $genres]);
            }
        }

        return $redirect;
    }

    private function processBookUpdate($book)
    {
        if ($book->load(Yii::$app->request->post()) && $book->validate()) {
            $book->cover_image = \yii\web\UploadedFile::getInstance($book, 'cover_image');
            $existeLibro = Book::existeLibro($book->title);
            if (!empty($existeLibro) && $existeLibro->book_id != $book->book_id) {
                Yii::$app->session->setFlash('error', 'Ya existe un libro con ese título');
                return true;
            }

            if ($book->cover_image) {
                $this->saveCoverImage($book);
            } else {
                $book->cover_image = $book->getOldAttribute('cover_image');
            }

            if ($book->save()) {
                Yii::$app->session->setFlash('success', 'Libro actualizado correctamente');
            } else {
                Yii::$app->session->setFlash('error', 'Error al actualizar el libro');
            }
            return true;
        }
        return false;
    }

    private function saveCoverImage($book)
    {
        is_dir('uploads') ?: mkdir('uploads');
        $filePath = 'uploads/' . \Yii::$app->security->generateRandomString() . '.' . $book->cover_image->extension;
        if ($book->cover_image->saveAs($filePath)) {
            $book->cover_image = $filePath;
        }
    }

    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }
        $book = Book::find()->where(['book_id' => $id])->one();
        if (empty($book)) {
            Yii::$app->session->setFlash('error', 'No existe el libro');
            return $this->goHome();
        }
        $book->delete();
        Yii::$app->session->setFlash('success', 'Libro eliminado correctamente');
        return $this->goHome();
    }

    public function actionAddToLibrary($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }
        $userBook = UserBooks::find()->where(['user_id' => Yii::$app->user->id, 'book_id' => $id])->one();

        if (empty($userBook)) {
            $userBook = new UserBooks();
            $userBook->user_id = Yii::$app->user->id;
            $userBook->book_id = $id;
            $userBook->save();
            Yii::$app->session->setFlash('success', 'Libro añadido a tu biblioteca');
        } else {
            Yii::$app->session->setFlash('error', 'El libro ya está en tu biblioteca');
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionRemoveFromLibrary($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }
        $userBook = UserBooks::find()->where(['user_id' => Yii::$app->user->id, 'book_id' => $id])->one();

        if (empty($userBook)) {
            Yii::$app->session->setFlash('success', 'Libro eliminado de tu biblioteca');
        } else {
            Yii::$app->session->setFlash('error', 'El libro no estaba en tu biblioteca');
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    // Method Post: http://localhost:8080/book/score
    public function actionScore()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }
        $bookScores = new BookScores();
        if ($bookScores->load(Yii::$app->request->post()) && $bookScores->validate()) {
            $userScore = BookScores::find()->where(['book_id' => $bookScores->book_id, 'user_id' => Yii::$app->user->id])->one();
            if (!empty($userScore)) {
                Yii::$app->session->setFlash('error', 'Ya has puntuado este libro');
                return $this->redirect(['view', 'id' => $bookScores->book_id]);
            }

            if (BookScores::addScore($bookScores->book_id, Yii::$app->user->id, $bookScores->score)) {
                Yii::$app->session->setFlash('success', 'Puntuación añadida correctamente');
            } else {
                Yii::$app->session->setFlash('error', 'Error al añadir la puntuación');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Error al añadir la puntuación');
        }

        return $this->redirect(['view', 'id' => $bookScores->book_id]);
    }
}
