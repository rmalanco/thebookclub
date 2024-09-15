<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Book;

class BookController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    // url: http://localhost:8080/index.php?r=book/all
    public function actionAll()
    {
        $books = Book::find()->all();
        // return $this->render('all', ['books' => $books]);
        // con smarty
        return $this->render('all.tpl', ['books' => $books, 'titulo' => 3]);
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
}
