<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
$this->title = 'Lista de libros';

?>

<div class="container">
    <h1 class="text-center">Lista de libros</h1>
    <div class="row">
        <div class="col-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['book/create']) ?>" class="btn btn-primary">Crear libro</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Portada</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Autor</th>
                        <th>Género</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book) : ?>
                        <tr>
                            <td>
                                <?php if (!empty($book->cover_image)) : ?>
                                    <?= Html::img('@web/uploads/' . $book->cover_image, ['alt' => $book->title, 'class' => 'img-thumbnail', 'style' => 'width: 100px; height: 100px;']) ?>
                                <?php else : ?>
                                    <?= Html::img('@web/uploads/no-image.png', ['alt' => $book->title, 'class' => 'img-thumbnail', 'style' => 'width: 100px; height: 100px;']) ?>
                                <?php endif; ?>
                            </td>
                            <td><?= $book->title ?></td>
                            <td><?= substr($book->description, 0, 25) . '...' ?></td>
                            <td><?= $book->author_name ?></td>
                            <td><?= $book->genre_name ?></td>
                            <td>
                                <a href="<?= Yii::$app->urlManager->createUrl(['book/view', 'id' => $book->id]) ?>"
                                    class="btn btn-info">
                                    <i class="fas fa-eye "></i>
                                </a>
                                <a href="<?= Yii::$app->urlManager->createUrl(['book/update', 'id' => $book->id]) ?>"
                                    class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= Yii::$app->urlManager->createUrl(['book/delete', 'id' => $book->id]) ?>"
                                    class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>