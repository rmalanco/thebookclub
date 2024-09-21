<?php

/** @var yii\web\View $this */
$this->title = 'Detalle de usuario';
?>

<div class="container">
    <h1 class="text-center">Detalle de usuario</h1>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre de usuario</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de modificación</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $user->username ?></td>
                        <td><?= $user->created_at ?></td>
                        <td><?= $user->modified_at ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['user/update', 'id' => $user->user_id]) ?>"
                class="btn btn-warning">Editar usuario</a>
            <a href="<?= Yii::$app->urlManager->createUrl(['user/delete', 'id' => $user->user_id]) ?>"
                class="btn btn-danger">Eliminar usuario</a>
        </div>
    </div>
</div>