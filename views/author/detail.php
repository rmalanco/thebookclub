<?php

use yii\helpers\Html;

?>

<h1>
    Detalle de autor: <?= $author->getName() ?>
</h1>

<p>
    <?= $author->toString() ?>
</p>

<h3>Libros</h3>

<ul>
    <?php foreach ($author->getBooks()->all() as $book): ?>
    <li><?= Html::a($book->title, ['book/detail', 'id' => $book->getId()]) ?></li>
    <?php endforeach; ?>
</ul>