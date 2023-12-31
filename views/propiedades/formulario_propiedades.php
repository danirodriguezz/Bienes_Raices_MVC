<fieldset>
    <legend>Infomación General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titutlo Propiedad" value="<?php echo sanitizar($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo sanitizar($propiedad->precio); ?>">
    
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
    <?php if($propiedad->imagen):?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="Imagen de propiedad" class="imagen-small">
    <?php endif ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input 
    type="number" 
    id="habitaciones" 
    name="propiedad[habitaciones]" 
    value="<?php echo sanitizar($propiedad->habitaciones); ?>" 
    placeholder="Número Habitaciones" 
    min="1" 
    max="10">

    <label for="wc">Baños:</label>
    <input 
    type="number" 
    id="wc" 
    name="propiedad[wc]" 
    placeholder="Número Baños" 
    value="<?php echo sanitizar($propiedad->wc); ?>" 
    min="1" 
    max="10">

    <label for="estacionamiento">Estacionamiento:</label>
    <input 
    type="number" 
    id="estacionamiento" 
    name="propiedad[estacionamiento]" 
    value="<?php echo sanitizar($propiedad->estacionamiento); ?>" 
    placeholder="Número Estacionamiento" 
    min="1" 
    max="10">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedor_id]" id="vendedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor) :?>
            <option 
            <?php echo $propiedad->vendedor_id === $vendedor->id ? "selected" : "";?>
            value="<?php echo sanitizar($vendedor->id) ?>"><?php echo sanitizar($vendedor->nombre) . " " . sanitizar($vendedor->apellido) ; ?></option>
        <?php endforeach ?>
    </select>
</fieldset>
