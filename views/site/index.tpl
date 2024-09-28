{use class="Yii"}
{use class="yii\helpers\Html"}

<div class="site-index">
     

    {if !Yii::$app->user->isGuest}
    <!-- Sección de Titulo -->
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Bienvenido a la Aplicación de Club de Lectura</h1>
        <p class="lead">Administra tus libros, autores y préstamos de manera eficiente.</p>
    </div>   
    <!-- Sección de contenido -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <h2>Administra tus libros</h2>
                    <p>Registra tus libros favoritos y lleva un control de los libros que has leído.</p>
                    <p>{Html::a('Administrar libros', ['book/all'], ['class' => 'btn btn-primary'])}</p>
                </div>
                <div class="col-md-4">
                    <h2>Administra tus autores</h2>
                    <p>Registra tus autores favoritos y lleva un control de los autores que has leído.</p>
                    <p>{Html::a('Administrar autores', ['author/all'], ['class' => 'btn btn-primary'])}</p>
                </div>
                <div class="col-md-4">
                    <h2>Administra tus préstamos</h2>
                    <p>Registra tus préstamos y lleva un control de los libros que has prestado.</p>
                    <p>{Html::a('Administrar préstamos', ['loan/all'], ['class' => 'btn btn-primary'])}</p>
                </div>
            </div>
        </div>
    {else}
    <!-- Sección de Titulo -->
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Bienvenido a la Aplicación de Club de Lectura</h1>
        <p class="lead">Administra tus libros, autores y préstamos de manera eficiente.</p>
    </div>
    <!-- Sección de contenido -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <h2>Regístrate</h2>
                <p>Regístrate en la aplicación para poder llevar un control de tus libros, autores y préstamos.</p>
                <p>{Html::a('Registrarse', ['site/signup'], ['class' => 'btn btn-primary'])}</p>
            </div>
            <div class="col-md-4">
                <h2>Inicia Sesión</h2>
                <p>Inicia sesión en la aplicación para poder llevar un control de tus libros, autores y préstamos.</p>
                <p>{Html::a('Iniciar Sesión', ['site/login'], ['class' => 'btn btn-primary'])}</p>
            </div>
            <div class="col-md-4">
                <h2>Conoce más</h2>
                <p>Conoce más sobre la aplicación y cómo puedes llevar un control de tus libros, autores y préstamos.</p>
                <p>{Html::a('Acerca de', ['site/about'], ['class' => 'btn btn-primary'])}</p>
            </div>
        </div>
    </div>
    {/if}
</div>


