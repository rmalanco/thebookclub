<?php

/** @var yii\web\View $this */
$this->title = 'Listado de usuarios';
?>

<div class="container">
    <h1 class="text-center">Listado de usuarios</h1>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre de usuario</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de modificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user->username ?></td>
                        <td><?= $user->created_at ?></td>
                        <td><?= $user->modified_at ?></td>
                        <td>
                            <a href="<?= Yii::$app->urlManager->createUrl(['user/view', 'id' => $user->user_id]) ?>"
                                class="btn btn-info"><i class="fas fa-eye"></i></a>
                            <a href="<?= Yii::$app->urlManager->createUrl(['user/update', 'id' => $user->user_id]) ?>"
                                class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="<?= Yii::$app->urlManager->createUrl(['user/delete', 'id' => $user->user_id]) ?>"
                                class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['user/create']) ?>" class="btn btn-primary">Crear usuario</a>
        </div>
    </div>
</div>