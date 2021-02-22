<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Marubiella | Signin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" style="background-color: white;">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 center">
            <div class="login-logo">
                <img src="<?= Yii::$app->request->baseUrl; ?>/images/marubiella.png" width="100%" alt="MARUBIELLA Logo"/>
            </div>
            <div class="login-box">
                <h3>Sign in</h3>
                <p>Please fill out the following fields to login:</p>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <!--?= $form->field($model, 'rememberMe')->checkbox() ?>-->

                    <!--<div style="color:#999;margin:1em 0">
                        If you forgot your password you can ?= Html::a('reset it', ['site/request-password-reset']) ?>.
                        <br>
                        Need new verification email? ?= Html::a('Resend', ['site/resend-verification-email']) ?>
                    </div>-->

                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>
