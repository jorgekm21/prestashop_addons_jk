<!DOCTYPE html>
<html>
<head>
</head>

<div class="container">

<div class="table-responsive table-hover"  style="margin-bottom: 3rem">
    <form action="" method="POST" id="boton">
    <table class="table" style="width:100%">
  <tr>
    <th><center>Nombre</th>
    <th><center>Apellido</th> 
    <th><center>Cédula</th>
    <th><center>Correo Eléctronico</th>
    <th><center>Activo/Inactivo</th>
    <th><center>Seleccionar</th>
  </tr>
  
  {foreach from=$comments item=comment}
    
    <tr>
    <td> <center>{$comment.nombre}</td>
    <td> <center>{$comment.apellido}</td> 
    <td> <center>{$comment.cedula}</td>
    <td> <center>{$comment.email}</td>
    <td> <center> {$comment.activo}</td>
    <td> <center> 
    <div class="checkbox"> 
    <label><input type="checkbox" value="{$comment.id_lista_clientes}" name="checkbox[]" id=""></label>
    </div> 
    </td>
    </tr>

    {/foreach}

   
</table>
</div>
<center><button type="submit" class="btn btn-success" name ="borrar">Borrar</button></center>
</form>
<hr>
<h3 style="margin-bottom: 2rem; text-align: center; margin-top: 1rem"> AGREGA A UN NUEVO CLIENTE </h3>


        <form action="" method="POST" id="clientes-form">
                        
            <div class="form-group">
            <label for="">Nombre</label>
                <input 
                    type="text"
                    name="nombre" 
                    class="form-control" 
                    id="nombre" 
                    placeholder="Introduzca su Nombre"
                    required>
            </div>

             <div class="form-group">
            <label for="">Apellido</label>
                <input 
                    type="text"
                    name="apellido" 
                    class="form-control" 
                    id="apellido" 
                    placeholder="Introduzca su Apellido">
            </div>

             <div class="form-group">
            <label for="">Cédula</label>
                <input 
                    type="text"
                    name="cedula" 
                    class="form-control" 
                    id="cedula" 
                    placeholder="Introduzca su Cédula">
            </div>
            
            <div class="form-group">
            <label for="exampleInputEmail1">Correo Eletrónico</label>
                <input 
                    type="email"
                    name="email" 
                    class="form-control" 
                    id="email" 
                    placeholder="Email">
            </div>

            <div class="form-group">
            <label for="activo">Activo/Inactivo</label>
                    <select class="custom-select form-control"
                            id= "activo"
                            name= "activo">
                        <option selected> Activo/Inactivo</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>    
                </div>
      
    <center><button type="submit" class="btn btn-success" name ="mymod_PC_submmit_content">Agregar</button>
    <button type="reset" class="btn btn-danger">Volver</button>
        
        </form>

        {if $error eq "Debe Ingresar Los Campos Solicitados y al menos 1 producto"}
        {/if}

</div>
 
</body>

</html>