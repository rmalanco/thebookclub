<?php

use yii\helpers\Html;
use app\models\Author;

?>

<div class="container">
    <h1 class="my-4">
        Lista de todos los autores
    </h1>

    <ul class="list-group mb-4">
        <?php
        $averageScores = Author::getAveragesScores();
        foreach ($authors as $author): ?>
        <li class="list-group-item">
            <?php
                $authorId = $author->author_id;
                $averageScore = isset($averageScores[$authorId]) ? round($averageScores[$authorId]) : 0;
                if ($averageScore > 0) {
                    $stars = str_repeat('⭐', $averageScore);
                } else {
                    $stars = 'Sin votos';
                }
                ?>
            <?= Html::a(Html::encode($author->getName()) . " ({$stars})", ['author/detail', 'id' => $author->getId()]) ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <hr>
    <?= Html::a('Volver', ['book/index'], ['class' => 'btn btn-primary']) ?>
</div>