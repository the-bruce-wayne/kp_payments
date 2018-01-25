<?php

namespace backend\models;

use Yii;
use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
	public static $msisdnRegex = '/^(002637|2637|07|7)[1378][0-9]{7}$/';

    public function rules()
    {
        $rules = parent::rules();
        // msisdn rules
        $rules['msisdnTrim']     = ['msisdn', 'trim'];
        $rules['msisdnRequired'] = ['msisdn', 'required', 'on' => ['register', 'connect', 'create', 'update']];
        $rules['msisdnPattern']  = ['msisdn', 'match', 'pattern' => static::$msisdnRegex];
        $rules['msisdnLength']   = ['msisdn', 'string', 'max' => 15];
        $rules['msisdnUnique']   = [
            'msisdn',
            'unique',
            //'targetClass' => $user,
            'message' => \Yii::t('user', 'This mobile number has already been used')
        ];
        
        return $rules;
    }


	public function scenarios()
    {
        $scenarios = parent::scenarios();
        // add field to scenarios
        $scenarios['create'][]   = 'msisdn';
        $scenarios['update'][]   = 'msisdn';
        $scenarios['register'][] = 'msisdn';
        $scenarios['settings'][] = 'msisdn';
        //$scenarios['connect'][] = 'msisdn';

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributes = parent::attributeLabels();

        $attributes['msisdn'] = Yii::t('user', 'Mobile Number');

        return $attributes;
    }
}