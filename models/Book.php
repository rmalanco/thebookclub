<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public $author_name;
    public $genre_name;
    public $user_id;
    public $username;

    public static function tableName()
    {
        return 'books';
    }

    public function getId()
    {
        return $this->book_id;
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['book_id' => 'book_id']);
    }

    public function getBookName($id)
    {
        // hasOne() is used to define a one-to-one relationship
        return $this->hasOne(Book::class, ['book_id' => 'book_id']);
    }

    public function getName()
    {
        return $this->title;
    }

    public function getAuthorName()
    {
        return $this->author_name;
    }

    public function getGenreName()
    {
        return $this->genre_name;
    }

    public static function existeLibro($title)
    {
        return Book::find()->where(['title' => $title])->one();
    }

    public function toString()
    {
        return sprintf(
            "(%d) -> El libro es %s",
            $this->book_id,
            $this->title
        );
    }

    public function getAuthor()
    {
        return $this->hasMany(Author::class, ['author_id' => 'author_id']);
    }

    // creamos consulta que obtiene todos los libros con el nombre del autor y el género
    public static function getAllBooks()
    {
        return self::find()
            ->select(['books.book_id', 'books.title', 'books.cover_image', 'books.description', 'authors.author_name', 'genres.genre_name'])
            ->join('INNER JOIN', 'authors', 'authors.author_id = books.author_id')
            ->join('INNER JOIN', 'genres', 'genres.genre_id = books.genre_id')
            ->orderBy('books.title')
            ->all();
    }


    public function rules()
    {
        return [
            [['title', 'author_id', 'genre_id', 'description'], 'required'],
            [['title', 'description'], 'string'],
            [['author_id', 'genre_id'], 'integer'],
            [['cover_image'], 'file', 'extensions' => 'jpg, png'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Título',
            'author_id' => 'Autor',
            'genre_id' => 'Género',
            'description' => 'Descripción',
            'cover_image' => 'Imagen de portada',
        ];
    }

    public function getScores()
    {
        return $this->hasMany(BookScores::class, ['book_id' => 'book_id']);
    }
}