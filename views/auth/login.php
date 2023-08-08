<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <!-- Alerta de errores -->
    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error;?>
    </div>
    <?php endforeach;?>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="emial">E-mail</label>
            <input type="email" name="email" placeholder="Tu E-mail" id="email" >
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu Password" id="password" >
        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton-verde">
    </form>
</main>
