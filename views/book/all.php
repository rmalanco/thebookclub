<?php

use yii\helpers\Html;

?>

<h1>
    Lista de todos los libros
</h1>

<ul>
    <?php foreach ($books as $book): ?>
    <li><?= Html::a($book->title, ['book/detail', 'id' => $book->getId()]) ?></li>
    <?php endforeach; ?>
</ul>

<hr>
<?= Html::a('Volver', ['book/index'], ['class' => 'btn btn-primary']) ?>