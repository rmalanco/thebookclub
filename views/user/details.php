<?php

/** @var yii\web\View $this */
$this->title = 'Detalle de usuario';
?>

<div class="container">
    <h1 class="text-center">Detalle de usuario</h1>
    <div class="row">
        <div class="col-12">
            <h3>Nombre de usuario</h3>
            <p><?= $user->username ?></p>
        </div>
        <div class="col-12">
            <h3>Fecha de creación</h3>
            <p><?= $user->created_at ?></p>
        </div>
        <div class="col-12">
            <h3>Fecha de modificación</h3>
            <p><?= $user->modified_at ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['user/index']) ?>" class="btn btn-secondary">Volver al
                listado</a>
        </div>
    </div>
</div>