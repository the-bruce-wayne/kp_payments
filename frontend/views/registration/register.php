<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use macgyer\yii2materializecss\lib\Html;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section blue valign-wrapper center">
  <div class="container">
    <div class="valign-wrapper row login-box">
        <div class="card white col hoverable s12 m12 l6 offset-l3">
            
                <div class="card-title"><h3 class="orange-text">Sign Up</h3></div>
                <div class="card-content black-text">
                    <div class="row">
                        <?php $form = ActiveForm::begin([
                            'id' => 'registration-form',
                            'enableAjaxValidation' => true,
                            'enableClientValidation' => false,
                        ]); ?>

                        <?= $form->field($model, 'username') ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'msisdn') ?>

                        <?php if ($module->enableGeneratingPassword == false): ?>
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        <?php endif ?>

                        <div class="padding-5-around">
                        <?= Html::submitButton(
                            Yii::t('user', 'Sign up'),
                            ['class' => 'btn-flat orange center white-text whole-width btn-large']
                        ) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
            </p>
        </div>
    </div>
</div>
</div>