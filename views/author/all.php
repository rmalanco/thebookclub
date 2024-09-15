<?php

use yii\helpers\Html;

?>

<h1>
    Lista de todos los autores
</h1>

<ul>
    <?php foreach ($authors as $author): ?>
    <li><?= Html::a($author->getName(), ['author/detail', 'id' => $author->getId()]) ?></li>
    <?php endforeach; ?>
</ul>
<hr>
<?= Html::a('Volver', ['book/index'], ['class' => 'btn btn-primary']) ?>