<!DOCTYPE html>
<html>
<head>
</head>

<div class="container">

<div class="table-responsive table-hover">
    <table class="table">
  <tr>
    <th><center>Fecha</th>
    <th><center>Banco</th> 
    <th><center>Tipo</th>
    <th><center>Número Op.</th>
    <th><center>Monto</th>
  </tr>
  
  {foreach from=$xpagos item=pago}
    
    <tr>
    <td> <center>{$pago.fecha}</td>
    <td> <center>{$pago.nombre_banco}</td> 
    <td> <center>{$pago.tipo_operacion}</td>
    <td> <center>{$pago.num_operacion}</td>
    <td> <center>Bs. {$pago.monto}</td>
    </tr>

    {/foreach}
   
</table>
</div>

    <form action="" method="POST" id="clientes-form">

        <div class="form-group">
        <label for="">Fecha</label>
        <input 
            type="date"
            name="fecha" 
            class="form-control" 
            id="fecha" 
            placeholder="Introduzca la Fecha"
        </div> 

        <label class="radio-inline">
        <input 
            type="radio" 
            name="tipo"
            value="POP">
            POP</label>

        <label class="radio-inline">
        <input 
            type="radio" 
            name="tipo"
            value="Deposito">
            Depósito</label>

        <div class="form-group">
        <label for="">Banco Depósito:</label>
        <select class="form-control" id="" name="nombredelbanco">
            {foreach from=$consiliado item=cons}
           <option value="{$cons.id_banco}">{$cons.nombre_banco}</option> 
           {/foreach}
        </select>
        </div>

        <div class="form-group">
            <label for="">Banco POP:</label>
            <select class="form-control" id="" name="nombredelbancod">
                {foreach from=$pop item=pops}
                <option value="{$pops.id_banco}">{$pops.nombre_banco}</option>
                {/foreach}
            </select>
        </div>

        <form action="/action_page.php">
        <div class="form-group">
        <label for="">Número de la Planilla:</label>
        <input 
            type="text" 
            class="form-control" 
            id="planilla"
            name="planilla"
            placeholder="introduzca el numero dela planilla">
        </div

        <form action="/action_page.php">
        <div class="form-group">
        <label for="">Monto</label>
        <input 
            type="text" 
            class="form-control" 
            id="monto"
            name="monto"
            placeholder="introduzca el Monto">
        </div
                    
        <div class="form-group">
        <label for="ejemplo_archivo_1">Adjuntar un archivo</label>
        <input 
            type="file" 
            id="ejemplo_archivo_1">
        </div>

        <center><button type="submit" class="btn btn-success" name ="agregar">Agregar</button>
    <button type="reset" class="btn btn-danger">Volver</button></center>         
        </div>

    </form>

    {if $error eq "Debe Ingresar Los Campos Solicitados y al menos 1 producto"}
    {/if}

</div>

</section>
 
</body>

</html>
