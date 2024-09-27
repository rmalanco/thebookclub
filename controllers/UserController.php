<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class UserController extends Controller
{
    private const USUARIO_NO_ENCONTRADO = 'No existe el usuario';

    // url: http://localhost:8080/user/index
    public function actionIndex()
    {
        $users = User::find()->all();
        return $this->render('index', ['users' => $users]);
    }

    // url: http://localhost:8080/user/view/1
    public function actionView($id)
    {
        $user = User::find()->where(['user_id' => $id])->one();
        if (empty($user)) {
            Yii::$app->session->setFlash('error', self::USUARIO_NO_ENCONTRADO);
            return $this->goHome();
        }
        return $this->render('view', ['user' => $user]);
    }

    // url: http://localhost:8080/user/update/1
    public function actionUpdate($id)
    {
        $user = User::find()->where(['user_id' => $id])->one();
        $user->password = '';

        // Si no existe el usuario, redirigimos a la página principal
        if (empty($user)) {
            Yii::$app->session->setFlash('error', self::USUARIO_NO_ENCONTRADO);
            return $this->goHome();
        }

        // recibe los datos del formulario que son usuario y contraseña nueva
        $data = Yii::$app->request->post();

        if (!empty($data)) {
            $user->username = $data['User']['username'];
            $user->password = password_hash($data['User']['password'], PASSWORD_DEFAULT);
            $user->save();
            Yii::$app->session->setFlash('success', 'Usuario actualizado correctamente');
            return $this->redirect(['view', 'id' => $user->user_id]);
        }

        // Si no se ha enviado el formulario, mostramos la vista
        return $this->render('update', ['user' => $user]);
    }

    // url: http://localhost:8080/user/delete/1
    public function actionDelete($id)
    {
        $user = User::find()->where(['user_id' => $id])->one();
        if (empty($user)) {
            Yii::$app->session->setFlash('error', self::USUARIO_NO_ENCONTRADO);
            return $this->goHome();
        }
        $user->delete();
        Yii::$app->session->setFlash('success', 'Usuario eliminado correctamente');
        return $this->goHome();
    }

    public function actionCreate()
    {
        $user = new User();

        if ($user->load(Yii::$app->request->post()) && $user->validate()) {
            if ($this->isUsernameTaken($user->username)) {
                Yii::$app->session->setFlash('error', 'El nombre de usuario ya existe. Por favor, elige otro.');
            } else {
                if ($this->createUser($user)) {
                    Yii::$app->session->setFlash('success', 'Usuario creado correctamente');
                    return $this->redirect(['view', 'id' => $user->user_id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Hubo un error al crear el usuario.');
                }
            }
        }

        return $this->render('create', ['user' => $user]);
    }

    public function actionDetails($id)
    {
        $user = User::find()->where(['user_id' => $id])->one();
        if (empty($user)) {
            Yii::$app->session->setFlash('error', self::USUARIO_NO_ENCONTRADO);
            return $this->goHome();
        }
        return $this->render('details', ['user' => $user]);
    }

    protected function isUsernameTaken($username)
    {
        return User::findOne(['username' => $username]) !== null;
    }

    protected function createUser($user)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            // Hash de la contraseña y generación de claves
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
            $user->auth_key = \Yii::$app->security->generateRandomString();
            $user->access_token = \Yii::$app->security->generateRandomString();

            if ($user->save()) {
                $transaction->commit();
                return true;
            } else {
                $transaction->rollBack();
                return false;
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
