<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;


class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    // public $id;
    // public $username;
    // public $password;
    // public $authKey;
    // public $accessToken;

    /*se pone el % porque usa un prefix*/
        public static function tableName()
        {
            return 'tr02usu';
        }
        /*se agregan las reglas que se ocupen, puede ser direntes a el modelo Usuario que tambien usa la misma tabla*/
        public function rules()
        {
            return [
            ];
        }


    /*se cambias los atributos para que coincidan con los de la base de datos*/
        public static function findIdentity($id)
        {
          $user = User::findOne(['nus_02in'=>$id]);
          // return isset($user)? $r ='<script>console.log("si existe el usuario con este id: '.$id.'");</script>':'<script>console.log("NO existe id: '.$id.'");</script>');
          return isset($user)? new static($user):null;
        }

        /**
         * {@inheritdoc}
         */
        public static function findIdentityByAccessToken($token, $type = null)
        {
            foreach (self::$users as $user) {
                if ($user['accessToken'] === $token) {
                    return new static($user);
                }
            }

            return null;
        }

        /**
         * Finds user by username
         *
         * @param string $username
         * @return static|null
         */
         /*el username es la cedula*/
        public static function findByUsername($username)
        {
             return static::findOne(['idp_02in' => $username]);
        }

        /**
         * {@inheritdoc}
         */
        public function getId()
        {
            return $this->nus_02in;
        }

        /**
         * {@inheritdoc}
         */
        public function getAuthKey()
        {
            return $this->authKey;
        }

        /**
         * {@inheritdoc}
         */
        public function validateAuthKey($authKey)
        {
            return $this->authKey === $authKey;
        }

        /**
         * Validates password
         *
         * @param string $password password to validate
         * @return bool if password provided is valid for current user
         */
         /*se modifica para que coincida con los atributos de la base de datos*/
        public function validatePassword($password)
        {
            return Yii::$app->security->validatePassword($password, $this->con_02vc);
        }
    }
