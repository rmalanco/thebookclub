<?php

namespace app\commands;

use app\models\Author;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Book;

class PruebaController extends Controller
{
    private const FORMAT = "%d: %s\n";
    private const ERROR_LIBRO = "Error: Libro no encontrado\n";
    private const ERROR_AUTOR = "Error: Autor no encontrado\n";
    /**
     * Suma dos números y muestra el resultado.
     *
     * Este método toma dos parámetros, los suma y muestra el resultado en la salida estándar.
     * Luego, retorna un código de salida indicando que la operación fue exitosa.
     *
     * @param int $a El primer número a sumar.
     * @param int $b El segundo número a sumar.
     * @return int El código de salida indicando que la operación fue exitosa.
     */
    public function actionSumar($a, $b)
    {
        $resultado = $a + $b;
        printf("El resultado de sumar %d y %d es %d\n", $a, $b, $resultado);
        return ExitCode::OK;
    }

    public function actionBooks($file)
    {
        $f = fopen($file, "r");
        while (!feof($f)) {
            $data = fgetcsv($f);
            if (!empty($data[1]) && !empty($data[2])) {
                $author = null;
                if (empty($author)) {
                    $book   = new Book();
                    $book->title = $data[1];
                    $book->author_id = Author::find()->where(['author_name' => $data[2]])->one()->author_id;
                    $book->genre_id = 1;
                    $book->description = "Descripción de " . $data[1];
                    $book->cover_image = strtolower(str_replace(" ", "_", $data[1])) . ".jpg";
                    $book->save();
                }
            } else {
                printf("Error: Faltan datos\n");
            }
        }
        fclose($f);
        return ExitCode::OK;
    }

    public function actionAuthors($file)
    {
        $f = fopen($file, "r");
        while (!feof($f)) {
            $data = fgetcsv($f);
            if (!empty($data[1]) && !empty($data[2])) {
                $author = Author::find()->where(['author_name' => $data[2]])->one();
                if (empty($author)) {
                    $author = new Author();
                    $author->author_name = $data[2];
                    $author->nationality = "pendiente";
                    $author->save();
                }
            } else {
                printf("Error: Faltan datos\n");
            }
        }
        fclose($f);
        return ExitCode::OK;
    }

    public function actionListAuthors()
    {
        $authors = Author::find()->all();
        $format = self::FORMAT;
        foreach ($authors as $author) {
            printf($format, $author->author_id, $author->author_name);
        }
        return ExitCode::OK;
    }

    public function actionListBooks()
    {
        $books = Book::find()->all();
        foreach ($books as $book) {
            printf(self::FORMAT, $book->book_id, $book->title);
        }
        return ExitCode::OK;
    }

    public function actionBookAndAuthor($id)
    {
        $book = Book::find()->where(['book_id' => $id])->one();
        if ($book) {
            $author = $book->getAuthor()->one();
            printf("%s: %s\n", $book->title, $author->author_name);
        } else {
            printf(self::ERROR_LIBRO);
        }
        return ExitCode::OK;
    }

    public function actionGetAuthor($id)
    {
        $author = Author::find()->where(['author_id' => $id])->one();
        if ($author) {
            printf(self::FORMAT, $author->author_id, $author->author_name);
        } else {
            printf(self::ERROR_AUTOR);
        }
        return ExitCode::OK;
    }

    public function actionGetBook($id)
    {
        $book = Book::find()->where(['book_id' => $id])->one();
        if ($book) {
            printf(self::FORMAT, $book->book_id, $book->title);
        } else {
            printf(self::ERROR_LIBRO);
        }
        return ExitCode::OK;
    }

    public function actionGetAuthorBooks($id)
    {
        $author = Author::find()->where(['author_id' => $id])->one();
        if ($author) {
            $books = $author->getBooks()->all();
            foreach ($books as $book) {
                printf(self::FORMAT, $book->book_id, $book->title);
            }
        } else {
            printf(self::ERROR_AUTOR);
        }
        return ExitCode::OK;
    }

    public function actionGetBookAuthor($id)
    {
        $book = Book::find()->where(['book_id' => $id])->one();
        if ($book) {
            $author = $book->getAuthor()->one();
            printf(self::FORMAT, $author->author_id, $author->author_name);
        } else {
            printf(self::ERROR_LIBRO);
        }
        return ExitCode::OK;
    }

    public function actionGetAuthorName($id)
    {
        $author = Author::find()->where(['author_id' => $id])->one();
        if ($author) {
            printf("%s\n", $author->toString());
        } else {
            printf(self::ERROR_AUTOR);
        }
        return ExitCode::OK;
    }

    // creamos consulta que obtiene todos los libros con el nombre del autor y el género
    public function actionAllBooks()
    {
        $books = Book::find()
            ->select(['books.title', 'books.cover_image', 'books.description', 'authors.author_name', 'genres.genre_name'])
            ->join('INNER JOIN', 'authors', 'authors.author_id = books.author_id')
            ->join('INNER JOIN', 'genres', 'genres.genre_id = books.genre_id')
            ->asArray()
            ->all();
        foreach ($books as $book) {
            printf(
                "(%s) -> El libro es %s, el autor es %s y el género es %s\n",
                $book['title'],
                $book['title'],
                $book['author_name'],
                $book['genre_name']
            );
        }
        return ExitCode::OK;
    }

    public function actionSaberQuienTieneElLibro($id)
    {
        //         SELECT books.title, user.username
        // FROM books
        //     INNER JOIN user_books ON books.book_id = user_books.book_id
        //     INNER JOIN user ON user_books.user_id = user.user_id
        // WHERE
        //     user_books.book_id = 16;

        $query = Book::find()
            ->select(['books.title', 'user.username'])
            ->join('INNER JOIN', 'user_books', 'books.book_id = user_books.book_id')
            ->join('INNER JOIN', 'user', 'user_books.user_id = user.user_id')
            ->where(['user_books.book_id' => $id])
            ->asArray()
            ->all();

        foreach ($query as $row) {
            printf(
                "El libro %s lo tiene el usuario %s\n",
                $row['title'],
                $row['username']
            );
        }

        return ExitCode::OK;
    }
}
