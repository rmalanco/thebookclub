<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Author;

class AuthorController extends Controller
{
    private const LOGIN_URL = 'site/login';
    // url: http://localhost:8080/index.php?r=author/all
    // url: http://localhost:8080/index.php?r=author/all&search=nombre
    public function actionAll($id = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }
        if ($id) {
            $authors = Author::find()->where(['author_id' => $id])->orderBy('author_name')->all();
        } else {
            $authors = Author::find()->orderBy('author_name')->all();
        }
        return $this->render('all', ['authors' => $authors]);
    }

    // url: http://localhost:8080/index.php?r=author/detail&id=1
    public function actionDetail($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect([self::LOGIN_URL]);
        }
        $author = Author::find()->where(['author_id' => $id])->one();
        $averageScore = Author::getAverageScore($id);
        $scores = Author::getAuthorScores($id);
        if (empty($author)) {
            Yii::$app->session->setFlash('error', 'No existe el autor');
            return $this->goHome();
        }
        return $this->render('detail', ['author' => $author, 'averageScore' => $averageScore, 'scores' => $scores]);
    }
}
