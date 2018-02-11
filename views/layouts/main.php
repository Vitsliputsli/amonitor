<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems=[
        ['label' => Yii::t('translation', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('translation', 'About'), 'url' => ['/site/about']],
        ['label' => Yii::t('translation', 'Monitoring'), 'url' => ['/site/monitoring']]
    ];
    if ( Yii::$app->user->id==100 ) {
        $menuItems[]=['label' => Yii::t('translation', 'Groups'), 'url' => ['/monitor-groups-editor']];
        $menuItems[]=['label' => Yii::t('translation','Items'), 'url' => ['/monitor-items-editor']];
        $menuItems[]=['label' => Yii::t('translation','Queries'), 'url' => ['/db-queries-editor']];
        $menuItems[]=['label' => Yii::t('translation', 'Emails'), 'url' => ['/alert-emails-editor']];
        $menuItems[]=['label' => Yii::t('translation', 'Log'), 'url' => ['/alert-log']];
    };
    if ( Yii::$app->user->isGuest ) {
        $menuItems[]=['label' => Yii::t('translation','Login'), 'url' => ['/site/login']];
    } else {
        $menuItems[]='<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
                Yii::t('translation','Logout').' (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
    };
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
