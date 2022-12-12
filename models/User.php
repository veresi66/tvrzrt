<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $authKey
 * @property string|null $accessToken
 * @property string $fullName
 * @property string $accessFrom
 * @property string $accessTo
 * @property int $permission
 */
class User extends ActiveRecord implements IdentityInterface
{

    public static function tableName() : string
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['username', 'password', 'fullName', 'accessFrom', 'accessTo'], 'required'],
            [['accessFrom', 'accessTo'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['permission'], 'integer'],
            [['username', 'fullName'], 'string', 'max' => 50],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'accessToken' => Yii::t('app', 'Access Token'),
            'fullName' => Yii::t('app', 'Full Name'),
            'accessFrom' => Yii::t('app', 'Access From'),
            'accessTo' => Yii::t('app', 'Access To'),
            'permission' => Yii::t('app', 'Permission'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername(string $username): ?User
    {
        return static::findOne(['username' => $username]);
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
    public function getAuthKey(): ?string
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @param string|null $username
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password, ?string $username = null): bool
    {
        if ($username) {
            return hash('sha256', $password) === self:: findByUsername($username)['password'];
        } else {
            return hash('sha256', $password) === $this->password;
        }
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = hash('sha256', $password);
    }
}
