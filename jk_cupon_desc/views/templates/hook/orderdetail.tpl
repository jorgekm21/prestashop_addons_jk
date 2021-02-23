{if $codigo_cupon > 0}
<div class="card">
    <div class="container">
        <h3 class="h1 card-title">CUPON DE PREMIO</h3>
        <article>
            <p>Orden: {$id_orden}</p>
            <p>Codigo Cupon: {$codigo_cupon}</p>
            <p>Valor de Cupon: {$monto_cupon} <span>{$operacion}</span></p>
        </article>
    </div>
</div>
{/if}