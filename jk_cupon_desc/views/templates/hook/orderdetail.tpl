<style>
    .carta {
        width: 15cm;
        height: 6cm;
        position: relative;
        box-shadow: 1px 2px 6px rgba(0, 0, 0, 0.2);
        margin: 10px auto;
    }

    .base,
    #scratch {
        cursor: default;
        height: 60px;
        width: 300px;
        position: absolute;
        bottom: 0;
        left: 0;
        cursor: grabbing;
    }

    .base {
        line-height: 60px;
        text-align: center;
    }

    #scratch {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        -webkit-touch-callout: none;
        -webkit-user-select: none;
    }
</style>

<div class="card">
    <div class="container">
        <h3 class="h1 card-title">CUPON DE PREMIO</h3>
        <main>
            <article>
                <div class="carta">
                    <div class="img-win">
                        <img class="imgwin" src="https://drive.google.com/file/d/1NuQL3kSQ5-y_M2b2tCuK8Nu6jcNpd5rA/view?usp=sharing" alt="Error al cargar la imagen">
                    </div>
                    <div class="valido">
                        <p class="porcentaje">{$monto_cupon}{$operacion}</p>
                        <p class="texto">Valido para tu proxima compra</p>
                        <p class="porcentaje2">{$monto_cupon}{$operacion}</p>
                    </div>
                    <div class="base">Coupon Code: {$codigo_cupon}</div>
                    <canvas class="scratchwin" id="scratch" width="300" height="60"></canvas>
                </div>
            </article>
        </main>
    </div>
</div>