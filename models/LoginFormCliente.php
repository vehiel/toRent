<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginFormCliente extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            /*el usuario es el numero de cedula, entonces es integer*/
            ['username','integer'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
{
    return [
        'username' => Yii::t('app', 'Usuario'),
        'password' => Yii::t('app', 'Contraseña'),
    ];
}
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                $this->addError($attribute, 'Usuario o contraseña incorrectos (clientes).');
            }elseif (!$user->validatePassword($this->password)) {
                $this->addError($attribute, 'pinche usuario'.$user['ncl_06in']);
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->userCliente->login($this->getUser(), $this->rememberMe ? 0*0*0 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
          /*usa el modelo de usuario que tiene el acceso a la base de datos para validar el usuario y la contraseña, esta clase debe inplementar IdentityInterface*/

            $this->_user = UserCliente::findByUsername($this->username);
            // echo "<script>console.log('si encontro un UserCliente')</script>";
        }
        return $this->_user;
    }
}