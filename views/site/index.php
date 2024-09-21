<?php

/** @var yii\web\View $this */
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Bienvenido a la Aplicación de Club de Lectura</h1>
        <p class="lead">Administra tus libros, autores y préstamos de manera eficiente.</p>
    </div>

    <!-- Carrusel -->
    <div id="carouselExampleFade" class="carousel slide carousel-fade mb-5" data-ride="carousel" data-interval="3000"
        data-pause="hover" data-wrap="true" data-keyboard="true">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleFade" data-slide-to="1"></li>
            <li data-target="#carouselExampleFade" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/image/book-slide1.jpg" alt="First slide">
                <div class="overlay"></div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Gestiona tus libros</h5>
                    <p>Administra todos los libros de tu club de lectura en un solo lugar.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/image/book-slide1.jpg" alt="Second slide">
                <div class="overlay"></div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Conoce a los autores</h5>
                    <p>Encuentra información detallada sobre los autores de tus libros favoritos.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/image/book-slide1.jpg" alt="Third slide">
                <div class="overlay"></div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Gestiona los préstamos</h5>
                    <p>Controla los préstamos de libros de manera fácil y rápida.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Libros</h2>
                <p>Administra los libros de tu club de lectura.</p>
                <p><a class="btn btn-primary" href="book/all">Ver libros &raquo;</a></p>
            </div>

            <div class="col-lg-4">
                <h2>Autores</h2>
                <p>Administra los autores de tu club de lectura.</p>
                <p><a class="btn btn-primary" href="author/all">Ver autores &raquo;</a></p>
            </div>

            <div class="col-lg-4">
                <h2>Préstamos</h2>
                <p>Administra los préstamos de tu club de lectura.</p>
                <p><a class="btn btn-primary" href="loan/all">Ver préstamos &raquo;</a></p>
            </div>
        </div>
    </div>
</div>



<!-- Agregar los scripts de Bootstrap -->
<?php
$this->registerJsFile('https://code.jquery.com/jquery-3.3.1.slim.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', ['position' => \yii\web\View::POS_END]);
?>

<!-- Agregar el estilo CSS para la superposición -->
<style>
.carousel-item {
    position: relative;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    /* Ajusta la opacidad según sea necesario */
    z-index: 1;
}

.carousel-caption {
    z-index: 2;
    color: white;
    /* Asegúrate de que el texto sea blanco */
}
</style>