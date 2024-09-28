<?php

namespace app\models;

use yii\db\ActiveRecord;

class BookScores extends ActiveRecord
{

    public static function tableName()
    {
        return 'book_scores';
    }

    public function getId()
    {
        return $this->book_score_id;
    }

    public function getBook()
    {
        return $this->hasOne(Book::class, ['book_id' => 'book_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['user_id' => 'user_id']);
    }

    public function getScore()
    {
        return $this->score;
    }

    public function toString()
    {
        return sprintf(
            "(%d) -> El libro %s tiene una puntuación de %d",
            $this->book_score_id,
            $this->getBook()->title,
            $this->score
        );
    }

    // función que devuelve la puntuación media de un libro en concreto

    public static function getBookScores($idLibro)
    {
        return BookScores::find()
            ->select(['book_scores.score'])
            ->where(['book_scores.book_id' => $idLibro])
            ->average('score');
    }

    // función para añadir una puntuación a un libro y un usuario y que valide que no se pueda puntuar dos veces el mismo libro por el mismo usuario

    public static function addScore($idLibro, $idUser, $score)
    {
        $bookScore = new BookScores();
        $bookScore->book_id = $idLibro;
        $bookScore->user_id = $idUser;
        $bookScore->score = $score;
        if ($bookScore->validate()) {
            $bookScore->save();
            return true;
        }
        return false;
    }

    public function rules()
    {
        return [
            ['score', 'integer', 'min' => 1, 'max' => 5],
            ['book_id', 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'score' => 'Puntuación',
        ];
    }
}