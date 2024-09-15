<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Author;

class AuthorController extends Controller
{
    // url: http://localhost:8080/index.php?r=author/all
    // url: http://localhost:8080/index.php?r=author/all&search=nombre
    public function actionAll($id = null)
    {
        if ($id) {
            $authors = Author::find()->where(['author_id' => $id])->all();
        } else {
            $authors = Author::find()->all();
        }
        return $this->render('all', ['authors' => $authors]);
    }

    // url: http://localhost:8080/index.php?r=author/detail&id=1
    public function actionDetail($id)
    {
        $author = Author::find()->where(['author_id' => $id])->one();
        if (empty($author)) {
            Yii::$app->session->setFlash('error', 'No existe el autor');
            return $this->goHome();
        }
        return $this->render('detail', ['author' => $author]);
    }
}