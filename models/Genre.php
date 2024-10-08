<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Genre extends ActiveRecord
{
    public static function tableName()
    {
        return 'genres';
    }

    public function getId()
    {
        return $this->genre_id;
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['genre_id' => 'genre_id']);
    }

    public static function getAllGenres()
    {
        return Genre::find()->orderBy('genre_name')->all();
    }

    public static function getGenresList()
    {
        $genres = Genre::find()->orderBy('genre_name')->all();
        $list = [];
        foreach ($genres as $genre) {
            $list[$genre->genre_id] = $genre->genre_name;
        }
        return $list;
    }

    public function getGenreName($id)
    {
        // hasOne() is used to define a one-to-one relationship
        return $this->hasOne(Genre::class, ['genre_id' => 'genre_id']);
    }

    public function getName()
    {
        return $this->genre_name;
    }

    public function toString()
    {
        return sprintf(
            "(%d) -> El género es %s tiene el un total de %d libros",
            $this->genre_id,
            $this->genre_name,
            $this->getBooks()->count()
        );
    }
}
