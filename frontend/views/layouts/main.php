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
        <a id="logo-container" href="" class=" blue-text">
            <img class="navbar-brand" src="<?= Yii\helpers\Url::to('@web/images/logo.jpg')?>" alt="<?=Yii::$app->name?>" >
        </a>
      <ul class="right hide-on-med-and-down">
        <li><a class='blue-text' href= <?= Url::to('site/index', true)?> >Home</a></li>
        <li><a class='blue-text' href= <?= Url::to('site/about', true)?> >About</a></li>
        <li><a class='blue-text' href= <?= Url::to('site/contact', true)?> >Contact</a></li>

        <!--LOGIN AND LOGOUT-->
        <?php
        if (!Yii::$app->user->isGuest) {
            $roles = array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()));
            // user customer type individual
            if(in_array(CUSTOMER_REGULAR, $roles)){
                echo "<li>
                        <a class='orange btn-flat dropdown-button white-text' data-activates='dropdown1' data-beloworigin='true' data-hover='true' data-outDuration='900' href=''>".
                                Yii::$app->user->identity->username 
                            ."<i class='material-icons left'>contact_mail</i></a>
                     </li>'";
                echo '
                    <ul id=\'dropdown1\' class=\'dropdown-content\'  >
                        <li class="collection-item avatar blue-text">
                            <span class=\'title blue-text\'>My Account</span>
                        </li>
                        <li class="divider"></li>
                        <li><a class=\'blue-text\' href=\'#\'>Orders</a></li>
                        <li class="divider"></li>
                        <li><a class=\'blue-text\'href=\'#\'>Payments</a></li>
                        <li class="divider"></li>
                        <li><a class=\'blue-text\'href=\'#\'>Lists</a></li>
                        <li class="divider"></li>
                        <li>'.
                        Html::beginForm(['/user/logout'], 'post')
                        . Html::submitButton(
                            'Logout',
                            ['class' => 'btn btn-flat btn-primary white blue-text whole-width btn-large']
                        )
                        . Html::endForm()
                        .'</li>
                    </ul>';
            } else{
                echo "<li><a class=\'waves-effect waves-white orange btn-flat\' href=''>no group</a></li>'";
            }
        } else {
            
            echo '<li><a class=\'waves-effect waves-white orange btn-flat white-text\' href=' . Url::to(['user/login']) . '>Login</a></li>';
        }
        ?>
    </ul>

    <a href="" data-activates="nav-mobile" class="button-collapse"><i class="material-icons blue-text">menu</i></a>
    </div>
</nav>
</div>

<!--COLLAPSED SIDE NAVIGATION BAR FOR SMALLER SCREENS-->
<ul id="nav-mobile" class="side-nav" >
    <li><a class='blue-text' href= <?= Url::to('site/index', true)?> >Home</a></li>
    <li><a class='blue-text' href= <?= Url::to('site/about', true)?> >About</a></li>
    <li><a class='blue-text' href= <?= Url::to('site/contact', true)?> >Contact</a></li>
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

<footer class="page-footer grey lighten-1">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="white-text text-lighten-3" href="">Freeman</a>
      </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
