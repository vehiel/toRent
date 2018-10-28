<?php

namespace app\models;

use Yii;

use yii\web\IdentityInterface;

/**
 * This is the model class for table "tr02usu".
 *
 * @property int $nus_02in Número de Usuario
 * @property int $idp_02in Id Persona
 * @property string $con_02vc Contraseña
 * @property int $est_02in Estado
 * @property int $idr_03in Rol
 * @property string $nom_02vc Nombre
 * @property string $ap1_02vc Apellido 1
 * @property string $ap2_02vc Apellido 2
 * @property string $tel_02vc Teléfono
 * @property int $gen_02in Género
 * @property string $ema_02vc Email
 * @property string $dir_02vc Dirección
 * @property string $ncu_02vc Número de Cuenta
 * @property string $fna_02dt Fecha Nacimiento
 * @property string $nac_02vc Nacionalidad
 *
 * @property Tr05usuPri[] $tr05usuPris
 * @property Tr04pri[] $p04ins
 * @property Tr11alq[] $tr11alqs
 */
class Tr02usu extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tr02usu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idp_02in', 'con_02vc', 'nom_02vc', 'ap1_02vc', 'ap2_02vc', 'tel_02vc', 'gen_02in', 'ema_02vc', 'dir_02vc', 'fna_02dt', 'nac_02vc'], 'required'],
            [['idp_02in', 'est_02in', 'idr_03in', 'gen_02in'], 'integer'],
            [['fna_02dt'], 'safe'],
            [['con_02vc'], 'string', 'max' => 250],
            [['nom_02vc', 'ap1_02vc', 'ap2_02vc', 'tel_02vc', 'ema_02vc', 'dir_02vc', 'ncu_02vc', 'nac_02vc'], 'string', 'max' => 50],
            [['ema_02vc'],'email'],
            [['idp_02in'],'unique','message'=>'Este número de cédula ya fue ingresado']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nus_02in' => Yii::t('app', 'Número de Usuario'),
            'idp_02in' => Yii::t('app', 'Cédula'),
            'con_02vc' => Yii::t('app', 'Contraseña'),
            'est_02in' => Yii::t('app', 'Estado'),
            'idr_03in' => Yii::t('app', 'Rol'),
            'nom_02vc' => Yii::t('app', 'Nombre'),
            'ap1_02vc' => Yii::t('app', 'Apellido 1'),
            'ap2_02vc' => Yii::t('app', 'Apellido 2'),
            'tel_02vc' => Yii::t('app', 'Teléfono'),
            'gen_02in' => Yii::t('app', 'Género'),
            'ema_02vc' => Yii::t('app', 'Email'),
            'dir_02vc' => Yii::t('app', 'Dirección'),
            'ncu_02vc' => Yii::t('app', 'Número de Cuenta'),
            'fna_02dt' => Yii::t('app', 'Fecha Nacimiento'),
            'nac_02vc' => Yii::t('app', 'Nacionalidad'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTr05usuPris()
    {
        return $this->hasMany(Tr05usuPri::className(), ['nus_02in' => 'nus_02in']);
    }
    public function getTr11ordaLqs()
    {
        return $this->hasMany(Tr11ordAlq::className(), ['nus_ent_02in' => 'nus_02in']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getTr04pris()
    // {
    //     return $this->hasMany(Tr04pri::className(), ['idp_04in' => 'idp_04in'])->viaTable('tr05usu_pri', ['nus_02in' => 'nus_02in']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getTr11alqs()
    // {
    //     return $this->hasMany(Tr11ordAlq::className(), ['nus_02in' => 'nus_02in']);
    // }

/*creo que no se usa 27/10/2018 - vehiel ************************************************** metodo de IdentityInterface ************************************/

/*se cambias los atributos para que coincidan con los de la base de datos*/
    public static function findIdentity($id)
    {
      $user = $this->findOne(['nus_02in'=>$id]);
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
        return $this->getPrimaryKey();
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
