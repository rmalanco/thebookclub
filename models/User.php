<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $user = self::findOne($id);
        return isset($user) ? new static($user) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = self::find()->where(['access_token' => $token])->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = self::find()->where(['username' => $username])->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Nombre de usuario',
            'password' => 'Contraseña',
        ];
    }

    public function attributeHints()
    {
        return [
            'username' => 'Introduce tu nombre de usuario',
            'password' => 'Introduce tu contraseña',
        ];
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'string', 'max' => 255],
            ['password', 'string', 'min' => 6],
        ];
    }
}
