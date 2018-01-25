<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
use yii\helpers\Url;
use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;
use macgyer\yii2materializecss\lib\Html;
use macgyer\yii2materializecss\widgets\Button;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section blue valign-wrapper center">
  <div class="container">

  <div class="valign-wrapper row login-box">

      <div class="card white col hoverable s12 m12 l6 offset-l3">
        <div class="card-title"><h3 class="orange-text">Login</h3></div>
        <div class="card-content black-text">
            <div class="row">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => false,
                'validateOnBlur' => false,
                'validateOnType' => false,
                'validateOnChange' => false,
            ]) ?>

            <?php if ($module->debug): ?>
                <?= $form->field($model, 'login', [
                    'inputOptions' => [
                        'autofocus' => 'autofocus',
                        'class' => 'form-control',
                        'tabindex' => '1']])->dropDownList(LoginForm::loginList());
                ?>
            <?php else: ?>

                <?= $form->field($model, 'login',
                    ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
                );
                ?>
            <?php endif ?>

            <?php if ($module->debug): ?>
                <div class="alert alert-warning">
                    <?= Yii::t('user', 'Password is not necessary because the module is in DEBUG mode.'); ?>
                </div>
            <?php else: ?>
                <?= $form->field(
                    $model,
                    'password',
                    ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])
                    ->passwordInput()
                    ->label(
                        Yii::t('user', 'Password')
                        
                    ) ?>
            <?php endif ?>

            <div class="right-align">
                <?php 
                if($module->enablePasswordRecovery)
                {
                    echo Html::a(Yii::t('user', 'Forgot password?'),
                                ['/user/recovery/request'],
                                ['tabindex' => '5']
                            );
                }
                ?>
            </div>

            <div class="padding-5-around">
            <?= Html::submitButton(
                Yii::t('user', 'Sign in'),
                ['class' => 'btn-flat orange center white-text whole-width btn-large', 'tabindex' => '4']
            ) ?>
            </div>

            <p>
                <input type="checkbox" id="login-form-rememberme" name="login-form-rememberMe" value="1" tabindex="3" />
                <label for="login-form-rememberme">Remember me next time</label>
            </p>


            <?php ActiveForm::end(); ?>
        </div>
        <div class="divider "></div>
            <div class="row padding-5-around ">
                <?php if ($module->enableConfirmation): ?>
                    <div class="col s6 m6 l6 ">
                        <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
                    </div>
                <?php endif ?>

                <?php if ($module->enableRegistration): ?>
                    <div class="col s6 m6 l6 ">
                        <?= Html::a(
                                Yii::t('user', 'Sign up'), 
                                ['/user/registration/register'], 
                                ['class' => 'btn btn-flat btn-large btn-outline-blue ']
                            ) 
                        ?>

                    </div>
                <?php endif ?>
            </div>
            
        </div>
            
      </div>
      
        <?= Connect::widget([
            'baseAuthUrl' => ['/user/security/auth'],
        ]) ?>
        
    </div>

  </div>  


<!--</div> -->