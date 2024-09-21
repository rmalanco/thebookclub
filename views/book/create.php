<?php

/** @var yii\web\View $this */
$this->title = 'Crear un libro';

?>

<div class="container">
    <h1 class="text-center">Crear un libro</h1>
    <div class="row">
        <div class="col-12">
            <?php $form = \yii\widgets\ActiveForm::begin(); ?>
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" id="title" name="Book[title]" class="form-control">
            </div>
            <div class="form-group">
                <label for="author_id">Autor</label>
                <select id="author_id" name="Book[author_id]" class="form-control">
                    <option value="">Selecciona un autor</option>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= $author->author_id ?>"><?= $author->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="genre_id">Género</label>
                <select id="genre_id" name="Book[genre_id]" class="form-control">
                    <option value="">Selecciona un género</option>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre->genre_id ?>"><?= $genre->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea id="description" name="Book[description]" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="cover_image">Imagen de portada</label>
                <!-- subir archivo con un input de tipo file -->
                <input type="file" id="cover_image" name="Book[cover_image]" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
        <div class="col-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['book/all']) ?>" class="btn btn-secondary">Volver al
                listado</a>
        </div>
    </div>
</div>