<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Certificado PDF</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        html{
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body{
            background-image: url({{public_path('storage/'.$curso->certificado)}});
            height: 100vh;
            width: 100vh;
            background-size: cover;
            background-cover: center;
        }
        .containers{
            margin: 0px 15% 0px 15%;
        }
        .cont{
            text-align: center;
        }
        .im{
            border-radius: 50%;
        }
        table, th{
            margin: auto;
            padding: 0px 8px 0px 8px;
        }
        .qr{
            background-color: #ffffff;
            position:absolute;
            bottom:0; 
            left:0;
            margin: 10px 10px 100px 10px;
            padding: 10px;
            border: solid black;
        } 
        .qrdate{
            position: absolute;
            z-index: -2;
            top: 0;
            left: 0;
        }
        p{
            font-family: 'Anton', sans-serif;
            font-family: 'Oswald', sans-serif;
            text-shadow: 2px 2px #FFFFFF;
            font-family: sans-serif;
            /* font-size: 150%; */
            font-style: oblique;
            font-family: 'Pinyon Script', cursive;
        }
        h3 {
            font-family: 'Anton', sans-serif;
            font-family: 'Oswald', sans-serif;
            text-shadow: 2px 2px #FFFFFF;
            font-family: sans-serif;
            font-style: oblique;
            font-family: 'Pinyon Script', cursive;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .info{
            margin: 10px;
            margin-left:auto; margin-right: 0;
            text-align: justify;
            padding-right: 5%; 
        }
        .m{
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <br><br><br><br><br><br><br><br><br><br><br>
            <div class="cont" style="margin: 0px 15px">
                <h2 class="containers" style="font-size: 32px">Otorgado a:</h2>
                <h3 class="containers" style="text-decoration: underline; font-size: 22px">{{$individuo->nombres}} {{$individuo->paterno}} {{$individuo->materno}}</h3><br>
                <h3 class="containers">En calidad de @if ($matricula->rol=="0")
                    Asistente.
                @else
                    Ponente.
                @endif</h3>
            </div>
        </div>
        <div class="<?= ($curso->encabezado=="0") ? 'info' : 'm';?>" style="text-align:center; width: 60%; text-align: justify">
            <div style="font-size: 20px;">
                @if ($curso->descripcioncertificado)
                <p style=>{{$curso->descripcioncertificado}}</p>
                @else
                    <p>En reconocimiento por su participación en el curso de {{$curso->nombre}}, módulo organizado por el Capítulo de  Ingeniería de {{$capitulo}}."</p>
                @endif
            </div>
        </div>
        <div class="<?= ($curso->encabezado=="0") ? 'info' : 'm';?>" style="text-align: center; width: 50%;">
            <p>Llevado a cabo desde el {{$di}} de {{$mesi}} hasta el {{$d}} de {{$mes}} del año {{$y}}, con una duración de 
                @if ($curso->horas)
                    {{$curso->horas}} horas académicas.
                @else
                    {{$curso->duracion}} días.
                @endif
            </p>
        </div>
    </div>
    <div class="containers">
        <div style="text-align: right">
            Puno,
            <?php
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            echo $meses[date('n')-1];
            ?>
            de {{$fecha=date('Y')}}
        </div>
    </div>
    <div style="bottom: 10px; width: <?= ($curso->footer=="2") ? '100%' : 'none'?>; position:absolute; height: 190px; float: <?= ($curso->footer=="0") ? 'right' : 'none';?>;">
        <table style="">
            <tr>
                <th>
                    @if ($curso->footer!="3")
                    <p>______________________________</p>
                    <p style="font-size: 13px;">Ing. Jhomar Marcelino Tonconi Quispe<br>DECANO<br><br>COLEGIO DE INGENIEROS DEL PERÚ<br>CD PUNO</p>
                    @endif
                </th>
                <th>
                    <div>
                        <img src="https://chart.googleapis.com/chart?chs=170x170&amp;cht=qr&amp;chl={{$url}}&amp;choe=UTF-8"/>
                    </div>
                    <div>
                        Codigo: {{$matricula->codigo}}
                    </div>
                </th>
                <th>
                    @if ($curso->footer!="3")
                    @if ($oficina=='Capitulo')
                    <p>______________________________</p>
                    <p style="font-size: 13px;">Ing. {{$cap->decano}}<br>DIRECTOR DE ESTUDIOS<br><br>CAPITULO<br>{{$capitulo}}</P>
                    @else
                    <p>______________________________</p>
                    <p style="font-size: 13px;">Ing. {{$cap->decano}}<br>JEFE DE OFICINA<br><br><span>{{$cap->nombre}}</span><p> </p></P>
                    @endif                        
                    @endif
                </th>
            </tr>
        </table>
    </div>
</body>
</html>