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

    public static function getAllAuthors()
    {
        return Author::find()->orderBy('author_name')->all();
    }

    public static function getAuthorsList()
    {
        $authors = Author::find()->orderBy('author_name')->all();
        $list = [];
        foreach ($authors as $author) {
            $list[$author->author_id] = $author->author_name;
        }
        return $list;
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


    public static function getAverageScore($id)
    {
        $books = Author::find()->where(['author_id' => $id])->one()->getBooks()->all();
        $total = 0;
        $count = 0;
        foreach ($books as $book) {
            $scores = $book->getScores()->all();
            foreach ($scores as $score) {
                $total += $score->getScore();
                $count++;
            }
        }
        return $count > 0 ? $total / $count : 0;
    }

    public static function getAuthorScores($id)
    {
        $books = Author::find()->where(['author_id' => $id])->one()->getBooks()->all();
        $count = 0;
        foreach ($books as $book) {
            $scores = $book->getScores()->all();
            $count += count($scores);
        }
        return $count;
    }

    public static function getAveragesScores()
    {
        $authors = Author::find()->all();
        $list = [];
        foreach ($authors as $author) {
            $list[$author->author_id] = Author::getAverageScore($author->author_id);
        }
        return $list;
    }
}
