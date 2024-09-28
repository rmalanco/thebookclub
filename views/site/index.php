<?php

/** @var yii\web\View $this */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php if (Yii::$app->user->isGuest): ?>
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">¡Bienvenido a nuestra biblioteca!</h1>
        <p class="lead">Regístrate o inicia sesión para poder acceder a todas las funcionalidades.</p>
        <hr class="my-4">
        <p>Explora la aplicación para ver los libros y autores disponibles.</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="<?= Yii::$app->urlManager->createUrl(['site/signup']) ?>"
                role="button">Regístrate</a>
            <a class="btn btn-primary btn-lg" href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>"
                role="button">Inicia sesión</a>
        </p>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Regístrate</h2>
                <p>Regístrate en la aplicación para poder acceder a todas las funcionalidades.</p>
                <p><a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['site/signup']) ?>">Regístrate
                        &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Inicia sesión</h2>
                <p>Inicia sesión en la aplicación para poder acceder a todas las funcionalidades.</p>
                <p><a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>">Inicia
                        sesión &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Explora</h2>
                <p>Explora la aplicación para ver los libros y autores disponibles.</p>
                <p><a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['book/index']) ?>">Explora
                        &raquo;</a></p>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">¡Bienvenido a nuestra biblioteca!</h1>
        <p class="lead">Explora las funcionalidades de la aplicación.</p>
        <hr class="my-4">
        <p>Administra los libros, autores y préstamos de tu biblioteca.</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Libros</h2>
                <p>Administra los libros de tu biblioteca.</p>
                <p><a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['book/index']) ?>">Administrar
                        libros &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Autores</h2>
                <p>Administra los autores de tu biblioteca.</p>
                <p><a class="btn btn-primary"
                        href="<?= Yii::$app->urlManager->createUrl(['author/index']) ?>">Administrar
                        autores &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Préstamos</h2>
                <p>Administra los préstamos de tu biblioteca.</p>
                <p><a class="btn btn-primary" href="<?= Yii::$app->urlManager->createUrl(['loan/index']) ?>">Administrar
                        préstamos &raquo;</a></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>