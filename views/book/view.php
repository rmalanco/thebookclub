<?php

use yii\helpers\Html;

?>

<div class="container">
    <h1 class="my-4">
        Detalle de libro: <?= Html::encode($book->title) ?>
    </h1>

    <p class="lead">
        <?= Html::encode($book->toString()) ?>
    </p>

    <h3>Autor</h3>
    <ul class="list-group mb-4">
        <?php foreach ($book->getAuthor()->all() as $author): ?>
        <li class="list-group-item">
            <?= Html::a(Html::encode($author->author_name), ['author/detail', 'id' => $author->getId()]) ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Quién tiene este libro</h3>
    <ul class="list-group mb-4">
        <?php if (count($userBooks) > 0): ?>
        <?php foreach ($userBooks as $userBook): ?>
        <li class="list-group-item">
            <?= Html::a(Html::encode($userBook->username), ['user/details', 'id' => $userBook->user_id]) ?></li>
        <?php endforeach; ?>
        <?php else: ?>
        <li class="list-group-item">Nadie tiene este libro</li>
        <?php endif; ?>

        <?php if (Yii::$app->user->identity->hasBook($book->getId())): ?>
        <li class="list-group-item">Este libro ya está en tu biblioteca</li>
        <?php if (Yii::$app->user->identity->removeBook($book->getId())): ?>
        <li class="list-group-item">
            <?= Html::a('Eliminar de mi biblioteca', ['book/remove-from-library', 'id' => $book->getId()]) ?></li>
        <?php endif; ?>
        <?php else: ?>
        <li class="list-group-item">
            <?= Html::a('Agregar a mi biblioteca', ['book/add-to-library', 'id' => $book->getId()]) ?></li>
        <?php endif; ?>
    </ul>

    <h3>Votaciones</h3>
    <ul class="list-group mb-4">
        <?php if ($averageScore): ?>
        <li class="list-group-item">
            Puntuación media:
            <?= str_repeat('⭐', round($averageScore)) ?>
            (<?= Html::encode(number_format($averageScore, 2)) ?>),
            Total de votos: <?= count($scores) ?>
        </li>
        <li class="list-group-item">
            Tu número de hasta ahora votos: <?= Yii::$app->user->identity->getVotesCount() ?>
        </li>
        <?php else: ?>
        <li class="list-group-item">Este libro no tiene votaciones</li>
        <?php endif; ?>
    </ul>

    <!-- formularios votaciones -->

    <h3>Deja tu voto</h3>
    <?php $form = \yii\widgets\ActiveForm::begin(['action' => ['book/score']]); ?>
    <div class="form-group">
        <label for="score">Puntuación</label>
        <input type="hidden" name="BookScores[book_id]" value="<?= $book->getId() ?>">
        <select id="score" name="BookScores[score]" class="form-control">
            <option value="">Selecciona una puntuación</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
            <option value="<?= $i ?>"><?= str_repeat('⭐', $i) ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Votar</button>
    </div>
    <?php \yii\widgets\ActiveForm::end(); ?>

    <div class="row">
        <div class="col-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['book/all']) ?>" class="btn btn-secondary">Volver al
                listado</a>
        </div>
    </div>
</div>