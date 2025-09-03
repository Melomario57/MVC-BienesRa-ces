 <fieldset>
     <legend>Información General</legend>

     <label for=" titulo">Nombre:</label>
     <input type="text" id="nombre" name="vendedor[nombre]" maxlength="18" placeholder="Nombre Vendedor(a)" value="<?php echo s($vendedor->nombre); ?>" />

     <label for=" titulo">Apellido:</label>
     <input type="text" id="apellido" name="vendedor[apellido]" maxlength="18" placeholder="Apellido Vendedor(a)" value="<?php echo s($vendedor->apellido); ?>" />

 </fieldset>

 <fieldset>
     <legend>Información Extra</legend>

     <label for=" telefono">Teléfono:</label>
     <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Teléfono Vendedor(a)" value="<?php echo s($vendedor->telefono); ?>" />

 </fieldset>