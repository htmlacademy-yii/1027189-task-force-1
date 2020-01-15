<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\City;
use frontend\models\User;

class RegistrationForm extends \yii\base\Model
{    
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $city_id;

    /**
     * @var string
     */
    public $password;
    
    public function attributeLabels() : array
    {
        return [
            'email' => 'Электронная почта',
            'name' => 'Ваше имя',
            'city_id' => 'Город проживания',
            'password' => 'Пароль',
        ];
    }

    public function rules() : array
    {
        return [
            [['email', 'name', 'city_id', 'password'], 'safe'],
            [['email', 'name'], 'trim'],
            [['email', 'name', 'password'], 'required', 'message' => 'Это поле надо заполнить!'],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => User::className()],
            ['name', 'string', 'min' => 3, 'max' => 100],
            ['city_id', 'exist', 'targetClass' => City::className(), 'targetAttribute' => 'id', 'allowArray' => true],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function getCityList() : array
    {
        $citiesAll = City::find()->all();
        return ArrayHelper::map($citiesAll, 'id', 'city');
    }
}