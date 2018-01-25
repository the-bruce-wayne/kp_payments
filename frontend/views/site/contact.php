<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

//use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use macgyer\yii2materializecss\lib\Html;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section white no-pad-bot valign-wrapper">
<div class="container">

  <div class="row">

    <div class="col s12 m4">
      <div class="card large blue valign-wrapper">
        <div class="card-content white-text ">
          <span class="card-title center">Contact Details</span>
          <p>I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.</p>
        </div>
        
      </div>
    </div>

    <div class="col s12 m8">
      <div class="card  white">
        <div class="card-content blue-text">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col s12 m12">{image}</div><div class="col s12 m12">{input}</div></div>',
                ]) ?>

                <div class="center">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary blue', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        
      </div>
    </div>

  </div>  
</div>
</div>