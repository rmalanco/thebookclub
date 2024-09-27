<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class UserBooks extends ActiveRecord
{
    public static function tableName()
    {
        return 'user_books';
    }

    public function getId()
    {
        return $this->user_book_id;
    }

    public static function getLibroLoTiene($idLibro)
    {
        return Book::find()
            ->select(['books.title', 'user.username', 'user.user_id'])
            ->join('INNER JOIN', 'user_books', 'books.book_id = user_books.book_id')
            ->join('INNER JOIN', 'user', 'user_books.user_id = user.user_id')
            ->where(['user_books.book_id' => $idLibro])
            ->all();
    }

    public static function getMiBiblioteca($idUsuario)
    {
        return Book::find()
            ->select(['books.title', 'user.username', 'user.user_id'])
            ->join('INNER JOIN', 'user_books', 'books.book_id = user_books.book_id')
            ->join('INNER JOIN', 'user', 'user_books.user_id = user.user_id')
            ->where(['user_books.user_id' => $idUsuario])
            ->all();
    }
}
