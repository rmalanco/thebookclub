<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Book;
use app\models\Author;
use app\models\Genre;

class BookController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    // url: http://localhost:8080/index.php?r=book/all
    public function actionAll()
    {
        $books = Book::getAllBooks();
        return $this->render('all', ['books' => $books]);
    }

    // url: http://localhost:8080/index.php?r=book/detail&id=1
    // url: http://localhost:8080/book/detail/11 -> esto se logra con la configuración de urlManager en config/web.php
    public function actionDetail($id)
    {
        $book = Book::find()->where(['book_id' => $id])->one();
        if (empty($book)) {
            Yii::$app->session->setFlash('error', 'No existe el libro');
            return $this->goHome();
        }
        return $this->render('detail', ['book' => $book]);
    }

    public function actionCreate()
    {
        $book = new Book();
        $authors = Author::find()->all();
        $genres = Genre::find()->all();
        if ($book->load(Yii::$app->request->post()) && $book->validate()) {
            $existeLibro = Book::find()->where(['title' => $book->title])->one();
            if (!empty($existeLibro)) {
                Yii::$app->session->setFlash('error', 'Ya existe un libro con ese título');
                return $this->goHome();
            } else {
                if ($book->save()) {
                    Yii::$app->session->setFlash('success', 'Libro creado correctamente');
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('error', 'Error al crear el libro');
                    return $this->goHome();
                }
            }
        }
        return $this->render('create', ['book' => $book, 'authors' => $authors, 'genres' => $genres]);
    }

    public function actionUpdate($id)
    {
        $book = Book::find()->where(['book_id' => $id])->one();
        $authors = Author::find()->all();
        $genres = Genre::find()->all();
        if ($book->load(Yii::$app->request->post())) {
            $book->save();
            Yii::$app->session->setFlash('success', 'Libro actualizado correctamente');
            return $this->goHome();
        }
        return $this->render('update', ['book' => $book, 'authors' => $authors, 'genres' => $genres]);
    }

    public function actionDelete($id)
    {
        $book = Book::find()->where(['book_id' => $id])->one();
        if (empty($book)) {
            Yii::$app->session->setFlash('error', 'No existe el libro');
            return $this->goHome();
        }
        $book->delete();
        Yii::$app->session->setFlash('success', 'Libro eliminado correctamente');
        return $this->goHome();
    }
}
