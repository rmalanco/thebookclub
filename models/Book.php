<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public static function tableName()
    {
        return 'books';
    }

    public function getId()
    {
        return $this->book_id;
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
}
