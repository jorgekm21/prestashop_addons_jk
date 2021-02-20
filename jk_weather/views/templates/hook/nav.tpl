<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

<style>
    *{
    margin: 0;
    padding:0;
    box-sizing: border-box;
    text-decoration: none;
}
.container_climatico{
    display: flex;
    flex-wrap: wrap;
}
.containerclima{
    margin-top: 5px;
    max-width: 1000px;
    height: 31px;
}
.container_climatico div{
    display: flex;
    flex-wrap: wrap;
    margin-right: 70px;
}
.constante{
    font-weight: 900;
}

.variable{
    margin-left: 10px;

}
.icono{
    margin-right: 10px;
    color: #2fb5d2;
}

</style>

<div class="containerclima">
        <div class="container_climatico">
            <div class="ciudad">
                <i class="fas fa-city icono"></i>
                <p class="constante">City:</p>
                <p class="variable">{$name}</p>
            </div>
            <div class="temperatura">
                <i class="fas fa-thermometer-half icono"></i>
                <p class="constante">Temperature:</p>
                <p class="variable">{$temp} °C</p>
            </div>
            <div class="presion">
                <i class="fas fa-tachometer-alt icono"></i>
                <p class="constante">Pressure Atmospheric:</p>
                <p class="variable">{$pressure} bar</p>
            </div>
            <div class="humedad">
                <i class="fas fa-tint icono"></i>
                <p class="constante">Humedity:</p>
                <p class="variable">{$humidity} %</p>
            </div>
    </div>
    </div>