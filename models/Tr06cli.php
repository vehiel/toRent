<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tr06cli".
 *
 * @property int $idp_06in Id Persona
 * @property string $con_06vc Contraseña
 * @property int $ncl_06in Número de Cliente
 * @property int $emo_06in Estado de Morosidad
 * @property string $obs_06vc Observaciones
 * @property string $nom_06vc Nombre
 * @property string $ap1_06vc Apellido 1
 * @property string $ap2_06vc Apellido 2
 * @property string $tel_06vc Teléfono
 * @property int $gen_06in Género
 * @property string $ema_06vc Email
 * @property string $dir_06vc Dirección
 * @property string $ncu_06vc Número de Cuenta
 * @property string $fna_06dt Fecha Nacimiento
 * @property string $nac_06vc Nacionalidad
 *
 * @property Tr11alq[] $tr11alqs
 */
class Tr06cli extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tr06cli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idp_06in', 'con_06vc', 'emo_06in', 'nom_06vc', 'ap1_06vc', 'ap2_06vc', 'tel_06vc', 'gen_06in', 'ema_06vc', 'dir_06vc', 'ncu_06vc', 'fna_06dt', 'nac_06vc'], 'required'],
            [['idp_06in', 'emo_06in', 'gen_06in'], 'integer'],
            [['fna_06dt'], 'safe'],
            [['con_06vc'], 'string', 'max' => 250],
            [['obs_06vc', 'nom_06vc', 'ap1_06vc', 'ap2_06vc', 'tel_06vc', 'ema_06vc', 'dir_06vc', 'ncu_06vc', 'nac_06vc'], 'string', 'max' => 50],
            [['idp_06in'],'unique','message'=>'Esta cédula ya fue ingresada'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idp_06in' => Yii::t('app', 'Cédula'),
            'con_06vc' => Yii::t('app', 'Contraseña'),
            'ncl_06in' => Yii::t('app', 'Número de Cliente'),
            'emo_06in' => Yii::t('app', 'Estado de Morosidad'),
            'obs_06vc' => Yii::t('app', 'Observaciones'),
            'nom_06vc' => Yii::t('app', 'Nombre'),
            'ap1_06vc' => Yii::t('app', 'Apellido 1'),
            'ap2_06vc' => Yii::t('app', 'Apellido 2'),
            'tel_06vc' => Yii::t('app', 'Teléfono'),
            'gen_06in' => Yii::t('app', 'Género'),
            'ema_06vc' => Yii::t('app', 'Email'),
            'dir_06vc' => Yii::t('app', 'Dirección'),
            'ncu_06vc' => Yii::t('app', 'Número de Cuenta'),
            'fna_06dt' => Yii::t('app', 'Fecha Nacimiento'),
            'nac_06vc' => Yii::t('app', 'Nacionalidad'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTr11alqs()
    {
        return $this->hasMany(Tr11alq::className(), ['ncl_06in' => 'ncl_06in']);
    }


/**************************************************** metodo de IdentityInterface ************************************/
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
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
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
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
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
