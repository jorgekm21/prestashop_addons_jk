<style>

*{
    margin:0;
    padding:0;
    box-sizing: border-box;
    text-decoration: none;
}
.cuadropromocion{
    border: solid #000;
    width: 273px;
    height: 115px;
    background-image: url(https://images.pexels.com/photos/3662770/pexels-photo-3662770.jpeg?crop=entropy&cs=srgb&dl=pexels-katie-e-3662770.jpg&fit=crop&fm=jpg&h=173&w=115);
    position: relative;
}
.text1{
    font-size: 20px;
    color: #fff;
    text-shadow:
    -1px -1px 0 #fff,
    1px 1px 0 #000;   
    margin-top: 5px;
}
.text1 p{
    background-color: transparent;
    display: inline;
    padding: 6px;
    border-radius: 50%;
    border: 2px solid red;
    background: rgba(0, 0, 0, 0.5);
}
.text2{
    font-size: 20px;
    color: rgba(255, 208, 0, 0.767);
    font-weight: bolder;
    text-shadow:
    -1px -1px 0 rgb(255, 0, 0.767),
    1px 1px 0 #fff;
    position: absolute;
    top: 0;
    right: 0;
}
.text22{
    font-size: 25px;
    color: rgba(115, 255, 0, 0.911);
    font-weight: bolder;
    text-shadow:
    -1px -1px 0 #fff,
    1px 1px 0 rgb(255, 0, 0);
    position: absolute;
}
.text23{
    font-size: 30px;
    color: rgb(255, 0, 0);
    font-weight: bolder;
    text-shadow:
    -1px -1px 0 rgb(255, 0, 0),
    1px 1px 0 #fff;
    position: absolute;
    bottom:12px;
    right: 0;
}
.text3{
    font-size: 15px;
    text-shadow:
    -1px -1px 0 #fff,
    1px 1px 0 #000;
    font-weight:900;
    color: #000;
    position: absolute;
    bottom: 0;
}

</style>

<div class="cuadropromocion">
        <div class="text1">
            <p>{$titulo_footer}</p>
        </div>
        <div class="text2">
            <p>10%</p>
        </div>
        <div class="text22">
            <p>15%</p>
        </div>
        <div class="text23">
            <p>20%</p>
        </div>
        <div class="text3">
            <p>{$texto_footer}</p>
        </div>
    </div>