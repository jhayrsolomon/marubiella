<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
/*if (Yii::$app->controller->action->id === 'login') {
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {*/

$this->registerJsFile(
    '@web/js/oop.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

$this->registerCssFile(
    '@web/css/style.css', 
    ['depends' => [yii\bootstrap\BootstrapAsset::className()]]
);

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/images/flask.png" type="image/x-icon" />
        
    </head>
    <body class="skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'common/header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'administration/left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'common/content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php //} ?>
