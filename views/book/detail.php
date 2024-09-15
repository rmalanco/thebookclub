<?php

use yii\helpers\Html;

?>

<h1>
    Detalle de libro: <?= $book->title ?>
</h1>

<p>
    <?= $book->toString() ?>
</p>

<h3>Autor</h3>

<ul>
    <?php foreach ($book->getAuthor()->all() as $author): ?>
        <li><?= Html::a($author->author_name, ['author/detail', 'id' => $author->getId()]) ?></li>
    <?php endforeach; ?>
</ul>
<hr>
<?= Html::a('Volver', ['book/all'], ['class' => 'btn btn-primary']) ?>