<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;


class UserCliente extends \yii\db\ActiveRecord implements IdentityInterface
{
    // public $id;
    // public $username;
    // public $password;
    // public $authKey;
    // public $accessToken;

    /*se pone el % porque usa un prefix*/
        public static function tableName()
        {
            return 'tr06cli';
        }
        /*se agregan las reglas que se ocupen, puede ser direntes a el modelo Tr06cli que tambien usa la misma tabla*/
        public function rules()
        {
            return [
            ];
        }


    /*se cambias los atributos para que coincidan con los de la base de datos*/
        public static function findIdentity($id)
        {
          $user = UserCliente::findOne(['ncl_06in'=>$id]);
          // return isset($user)? $r ='<script>console.log("si existe el usuario con este id: '.$id.'");</script>':'<script>console.log("NO existe id: '.$id.'");</script>');
          return isset($user)? new static($user):null;
        }

        /**
         * {@inheritdoc}
         */
        public static function findIdentityByAccessToken($token, $type = null)
        {
            throw new NotSupportedException();
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
             return static::findOne(['idp_06in' => $username]);
        }

        /**
         * {@inheritdoc}
         */
        public function getId()
        {
            return $this->ncl_06in;
        }

        /**
         * {@inheritdoc}
         */
        public function getAuthKey()
        {
            throw new NotSupportedException();
        }

        /**
         * {@inheritdoc}
         */
        public function validateAuthKey($authKey)
        {
            throw new NotSupportedException();
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
            return Yii::$app->security->validatePassword($password, $this->con_06vc);
        }
    }
