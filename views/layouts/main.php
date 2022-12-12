<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

//dd(Yii::$app->user->isGuest, Yii::$app->getUser());
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Font Awesome -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
            rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />
    <style>
        .navbar-dark {
            background: -webkit-linear-gradient(top, rgba(31, 63, 70, 0.07) 0, rgba(77, 158, 176, 0.09) 40%, rgba(82, 161, 179, 0.09) 50%, rgba(82, 161, 179, 0.09) 100%) no-repeat, url(/img/nav.png), -webkit-linear-gradient(top, #274F59 0, #468FA0 40%, #4892A3 50%, #4892A3 100%) no-repeat;
        }
        .tvrzrt-logo {
            width: 40px;
            height: 40px;
        }
        .et-social-icons {
            float: right;
            list-style: none;
        }
        .et-social-icons li {
            display: inline-block;
            margin-left: 20px;
        }
        .et-social-icons a {
            color: #666 !important;
        }
        .fab  {
            /*width: 25px;*/
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="/img/logo.png" alt="TVR Zrt" class="tvrzrt-logo">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item"><a class="nav-link" href="/workers">' . Yii::t('app', 'Workers') . '</a></li>' .
                '<li class="nav-item dropdown">' .
                    '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . Yii::t('app', 'Evaluation') . '</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/kpi">' . Yii::t('app', 'Record KPIs') . '</a>
                        <a class="dropdown-item" href="/evaluation/create">' . Yii::t('app', 'Record Evaluations') . '</a>
                        <a class="dropdown-item" href="/evaluation">' . Yii::t('app', 'List Evaluations') . '</a>
                    </div>' .
                '<li class="nav-item"><a class="nav-link" href="/user">' . Yii::t('app', 'Users') . '</a></li>' .
                '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-black">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">Tiszamenti Regionális Vízművek Zrt.</div>
            <div class="col-md-6 text-center text-md-end">
                <ul class="et-social-icons">
                    <li class="et-social-icon et-social-facebook">
                        <a href="https://www.facebook.com/trvzrt" class="icon" role="link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="et-social-icon et-social-instagram">
                        <a href="https://www.instagram.com/tiszamenti_regionalis_vizmuvek/" class="icon" role="link">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
                <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
