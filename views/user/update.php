<?php

/** @var yii\web\View $this */
$this->title = 'Actualizar usuario';
?>

<div class="container">
    <h1 class="text-center">Actualizar usuario</h1>
    <div class="row">
        <div class="col-12">
            <?php $form = \yii\widgets\ActiveForm::begin(); ?>
            <?= $form->field($user, 'username')->textInput() ?>
            <?= $form->field($user, 'password')->passwordInput() ?>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
        <div class="col-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['user/index']) ?>" class="btn btn-secondary">Volver al
                listado</a>
        </div>
    </div>
</div>