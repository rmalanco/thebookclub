<?php

use yii\helpers\Html;

?>

<div class="container">
    <h1 class="my-4">
        Detalle de autor: <?= Html::encode($author->getName()) ?>
    </h1>

    <p class="lead">
        <?= Html::encode($author->toString()) ?>
    </p>

    <h3>Libros</h3>
    <ul class="list-group mb-4">
        <?php foreach ($author->getBooks()->all() as $book): ?>
        <li class="list-group-item">
            <?= Html::a(Html::encode($book->title), ['book/view', 'id' => $book->getId()]) ?>
        </li>
        <?php endforeach; ?>
    </ul>

    <h3>Promedio de puntuaciones</h3>
    <p class="lead">
        <?php if ($averageScore): ?>
        Puntuación media:
        <?= str_repeat('⭐', round($averageScore)) ?>
        (<?= Html::encode(number_format($averageScore, 2)) ?>),
        Total de votos: <?= $scores ?>
        <?php else: ?>
        Este autor no tiene libros con votaciones
        <?php endif; ?>
    </p>

    <a href="<?= Yii::$app->urlManager->createUrl(['author/all']) ?>" class="btn btn-primary">Volver</a>

</div>