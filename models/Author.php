<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Author extends ActiveRecord
{
    public static function tableName()
    {
        return 'authors';
    }

    public function getId()
    {
        return $this->author_id;
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['author_id' => 'author_id']);
    }

    public function getAuthorName($id)
    {
        // hasOne() is used to define a one-to-one relationship
        return $this->hasOne(Author::class, ['author_id' => 'author_id']);
    }

    public function getName()
    {
        return $this->author_name;
    }

    public function toString()
    {
        return sprintf(
            "(%d) -> El autor es %s tiene el un total de %d libros",
            $this->author_id,
            $this->author_name,
            $this->getBooks()->count()
        );
    }
}