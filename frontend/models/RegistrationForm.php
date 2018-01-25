<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
    /**
     * @var string
     */
    public $msisdn;

    public static $msisdnRegex = '/^(002637|2637|07|7)[1378][0-9]{7}$/';

    /** @inheritdoc */
    public function scenarios()
    {
        
        $scenarios = parent::scenarios();

        // add field to scenarios
        $scenarios['create'][]   = 'msisdn';
        $scenarios['update'][]   = 'msisdn';
        $scenarios['register'][] = 'msisdn';
        return $scenarios;
    
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {   
        // use User model for validation
        $user = $this->module->modelMap['User'];

        $rules = parent::rules();
        // msisdn rules
        $rules['msisdnTrim']     = ['msisdn', 'trim'];
        $rules['msisdnRequired'] = ['msisdn', 'required'];
        $rules['msisdnPattern']  = ['msisdn', 'match', 'pattern' => static::$msisdnRegex];
        $rules['msisdnLength']   = ['msisdn', 'string', 'max' => 15];
        $rules['msisdnUnique']   = [
            'msisdn',
            'unique',
            'targetClass' => $user,
            'message' => \Yii::t('user', 'This mobile number has already been used')
        ];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $lables = parent::attributeLabels();

        $lables['msisdn'] = Yii::t('user', 'Mobile Numbers');

        return $lables;
    }




}