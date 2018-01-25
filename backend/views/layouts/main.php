<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use macgyer\yii2materializecss\lib\Html;
use macgyer\yii2materializecss\widgets\Alert;
use macgyer\yii2materializecss\widgets\navigation\Nav;
use macgyer\yii2materializecss\widgets\navigation\NavBar;
use macgyer\yii2materializecss\widgets\navigation\Breadcrumbs;
use macgyer\yii2materializecss\widgetsorm\SubmitButton;
use macgyer\yii2materializecss\assets\MaterializeAsset;

frontend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head class="page-header">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<!-- NAVIGATION BAR -->
<div class="navbar-fixed">
<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="" class="brand-logo blue-text">
            <?= Yii::$app->name?>
            <!--<img class="android-logo-image" src=""> -->
        </a>
      <ul class="right hide-on-med-and-down">

        <!--LOGIN AND LOGOUT-->
        <?php
        if (Yii::$app->user->isGuest) {
            echo '<li><a class=\'waves-effect waves-blue orange btn-flat\' href=' . Url::to(['user/login']) . '>Login</a></li>';
        } else {
            echo '<li>'
                . Html::beginForm(['/user/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-flat orange']
                )
                . Html::endForm()
                . '</li>';
        }
        ?>
    </ul>

    <a href="" data-activates="nav-mobile" class="button-collapse"><i class="material-icons blue-text">menu</i></a>
    </div>
</nav>
</div>

<!--COLLAPSED SIDE NAVIGATION BAR FOR SMALLER SCREENS-->
<ul id="nav-mobile" class="side-nav" >
    <!--LOGIN AND LOGOUT-->
    <?php
    if (Yii::$app->user->isGuest) {
        echo "<li><a class='orange blue-text' href=" . Url::to(['user/login']) . ">Login</a></li>";
    } else {
        echo '<li>'
            . Html::beginForm(['/user/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-flat orange']
            )
            . Html::endForm()
            . '</li>';
    }
    ?>
</ul>

<!-- BODY -->
<main class="content">
    <div class="container"></div>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
