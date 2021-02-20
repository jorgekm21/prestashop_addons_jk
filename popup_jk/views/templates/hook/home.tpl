<style>
*{
    margin: 0;
    padding:0;
    box-sizing: border-box;
    text-decoration: none;
}
.container-bienvenido{
    border-style:dashed;
    background-color: #000;
    width: 100%;
    height: 120px;
    background-image: url(https://images.pexels.com/photos/4427816/pexels-photo-4427816.jpeg?crop=entropy&cs=srgb&dl=pexels-august-de-richelieu-4427816.jpg&fit=crop&fm=jpg&h=120&w=1100);
    background-size: cover;
    position: relative;
}


.bienvenido{
    background-color:rgba(255, 255, 255, 0.644);
    text-align: center;
    font-size: 26px;
    font-weight: 900;
    color: #000;
    font-variant:small-caps;
    z-index: 100;
}
.ofertas{
    text-align:center;
    color: #fff;
    font-weight: 900;
    position: absolute;
    bottom: 0;
    right: 45%;
}

.ofertas p{
    display: inline;
    background-color: rgba(0, 0, 0, 0.678);

}

</style>

<div class="card">
    <div class="container-bienvenido">
        <div class="bienvenido">
            <p>{$titulo_header}</p>
        </div>
        <div class="ofertas">
            <p>{$texto_header}</p>
        </div>
    </div>
</div>