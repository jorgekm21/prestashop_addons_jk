<!DOCTYPE html>
<html>
<head>
</head>

<div class="container">

    <form action="" method="POST" id="clientes-form">

        <div class="form-group">
        <label for="">Nombre</label>
        <input 
            type="text"
            name="nombre" 
            class="form-control" 
            id="nombre" 
            placeholder="Introduzca su nombre"
        </div>

        <div class="form-group">
        <label for="">Apellido</label>
        <input 
            type="text"
            name="apellido" 
            class="form-control" 
            id="apellido" 
            placeholder="Introduzca su apellido"
        </div>

        <div class="form-group">
        <label for="">teléfono</label>
        <input 
            type="text"
            name="telefono" 
            class="form-control" 
            id="telefono" 
            placeholder="Introduzca su número de teléfono"
        </div>

        <div class="form-group">
        <label for="">Dirección</label>
        <input 
            type="text"
            name="direccion" 
            class="form-control" 
            id="direccion" 
            placeholder="Introduzca su direccion"
        </div>

        <div class="form-group">
        <label for="">Estado</label>
        <input 
            type="text"
            name="estado" 
            class="form-control" 
            id="estado" 
            placeholder="Introduzca su estado"
        </div>

        <div class="form-group">
        <label for="">Ciudad</label>
        <input 
            type="text"
            name="ciudad" 
            class="form-control" 
            id="ciudad" 
            placeholder="Introduzca su ciudad"
        </div>

        <div class="form-group">
        <label for="">Fecha</label>
        <input 
            type="date"
            name="fecha" 
            class="form-control" 
            id="fecha" 
            placeholder="Introduzca su fecha"
        </div>

        <div class="form-group">
        <label for="">Premio</label>
        <input 
            type="text"
            name="premio" 
            class="form-control" 
            id="premio" 
            placeholder="Introduzca su Premio"
            
        </div>

        <br><center><h1>  Datos del Representante </h1></center><br>

        <div class="form-group">
        <label for="">Nombre de la Representante </label>
        {foreach from=$amiga item=rowamiga}
        <p>{$rowamiga.firstname} {$rowamiga.lastname}</p>
        {/foreach}
        </div>
        
        <div class="form-group">
        <label for="">Cédula de la Representante </label>
        {foreach from=$amiga item=rowamiga}
        <p>{$rowamiga.siret}</p>
        {/foreach}
        </div>

        <div class="form-group">
        <label for="">Zona </label>
        {foreach from=$amiga item=rowamiga}
        <p>{$rowamiga.CODIGOZONA}</p>
        {/foreach}
        </div>

        <center><button type="reset" 
                        class="btn btn-danger"
                        name= "volver">Volver</button>
                <button type="submit" 
                        class="btn btn-success" 
                        name ="agregar">Enviar</button>
                
        </center>         
        </div>

    </form>

</div>

</section>
 
</body>

</html>
