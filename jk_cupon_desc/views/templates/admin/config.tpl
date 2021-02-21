<div class="panel row">
    <div class="panel-heading">Cupones Otorgados</div>
    <div class="container col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Email</th>
                    <th scope="col">Codigo Cupon</th>
                    <th scope="col">Fecha Creacion</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$cupones item=cupon}

                <tr>
                    <th scope="row">{$cupon.user_id}</th>
                    <td>{$cupon.nombre}</td>
                    <td>{$cupon.apellido}</td>
                    <td>{$cupon.correo}</td>
                    <td>{$cupon.cupon}</td>
                    <td>{$cupon.fecha}</td>
                </tr>

                {/foreach}
            </tbody>
        </table>
    </div>
</div>