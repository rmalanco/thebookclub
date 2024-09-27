<?php

/** @var yii\web\View $this */
$this->title = 'Actualizar libro';

?>

<div class="container">
    <h1 class="text-center">Actualizar libro</h1>
    <div class="row">
        <div class="col-12">
            <?php $form = \yii\widgets\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($book, 'title')->textInput() ?>
            <?= $form->field($book, 'author_id')->dropDownList($authors, ['prompt' => 'Selecciona un autor']) ?>
            <?= $form->field($book, 'genre_id')->dropDownList($genres, ['prompt' => 'Selecciona un género']) ?>
            <?= $form->field($book, 'description')->textarea() ?>
            <?= $form->field($book, 'cover_image')->fileInput() ?>
            <!-- preview image que esta en la carpeta uploads -->
            <div class="form-group">
                <img src="<?= Yii::$app->urlManager->createUrl([$book->cover_image]) ?>" alt="Portada del libro"
                    class="img-thumbnail img-fluid w-25">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
        <div class="col-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['book/all']) ?>" class="btn btn-secondary">Volver al
                listado</a>
        </div>
    </div>
</div>