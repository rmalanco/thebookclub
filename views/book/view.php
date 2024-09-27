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

<h3>Quién tiene este libro</h3>

<ul>
    <?php if (count($userBooks) > 0): ?>
        <?php foreach ($userBooks as $userBook): ?>
            <li><?= Html::a($userBook->username, ['user/details', 'id' => $userBook->user_id]) ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Nadie tiene este libro</li>
    <?php endif; ?>
</ul>

<h3>Votaciones</h3>

<ul>
    <?php if ($averageScore): ?>
        <li>Puntuación media: <?= $averageScore ?></li>
    <?php else: ?>
        <li>Este libro no tiene votaciones</li>
    <?php endif; ?>
</ul>

<h3>Agregar votación</h3>
<form action="<?= Yii::$app->urlManager->createUrl(['book/add-score', 'id' => $book->getId()]) ?>" method="post">
    <input type="hidden" name="user_id" value="<?= Yii::$app->user->getId() ?>">
    <input type="hidden" name="book_id" value="<?= $book->getId() ?>">
    <div class="form-group">
        <label for="score">Puntuación</label>
        <select id="score" name="score" class="form-control">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Votar</button>
    </div>
</form>

<?= Html::a('test', ['book/add-score', 'id' => $book->getId()], ['class' => 'btn btn-success']) ?>

<hr>
<?= Html::a('Volver', ['book/all'], ['class' => 'btn btn-primary']) ?>
<hr>
<?= Html::a('Agregar a mi biblioteca', ['book/add-to-library', 'id' => $book->getId()], ['class' => 'btn btn-success']) ?>