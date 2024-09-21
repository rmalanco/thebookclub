<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\User;

class UserController extends Controller
{
    public function actionCreate($username, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->auth_key = \Yii::$app->security->generateRandomString();
        $user->access_token = \Yii::$app->security->generateRandomString();
        $user->save();
        return ExitCode::OK;
    }

    public function actionDelete($username)
    {
        $user = User::find()->where(['username' => $username])->one();
        if ($user) {
            $user->delete();
            return ExitCode::OK;
        }
        return ExitCode::UNAVAILABLE;
    }

    public function actionUpdate($username, $password)
    {
        $user = User::find()->where(['username' => $username])->one();
        if ($user) {
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->save();
            return ExitCode::OK;
        }
        return ExitCode::UNAVAILABLE;
    }

    public function actionList()
    {
        $users = User::find()->all();
        if ($users) {
            foreach ($users as $user) {
                printf("(%d) --> %s\n", $user->user_id, $user->username);
            }
            return ExitCode::OK;
        } else {
            return ExitCode::UNAVAILABLE;
        }
    }

    public function actionView($username)
    {
        $user = User::find()->where(['username' => $username])->one();
        if ($user) {
            printf("(%d) --> %s\n", $user->user_id, $user->username);
            return ExitCode::OK;
        }
        return ExitCode::UNAVAILABLE;
    }

    public function actionValidatePassword($username, $password)
    {
        $user = User::find()->where(['username' => $username])->one();
        if ($user && password_verify($password, $user->password)) {
            printf("Password is valid\n");
            return ExitCode::OK;
        }
        printf("Password is invalid\n");
        return ExitCode::UNAVAILABLE;
    }
}