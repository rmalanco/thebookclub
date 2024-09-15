<?php

use yii\helpers\Html;

?>

<h1>
    Bienvenido a la biblioteca
</h1>

<p>
    <?= Html::a('Ver todos los libros', ['book/all'], ['class' => 'btn btn-primary']) ?>
</p>

<p>
    <?= Html::a('Ver todos los autores', ['author/all'], ['class' => 'btn btn-primary']) ?>
</p>