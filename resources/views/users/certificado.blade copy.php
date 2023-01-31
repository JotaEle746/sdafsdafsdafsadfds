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
            margin: 30px 15% 30px 15%;
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
    </style>
</head>

<body>
    <div class="containers">
        <div class="tables">
            {{-- @if ($curso->encabezado=="1")
            <table class="navi">
                <tr class="">
                  <th class="cont"><img src="{{public_path('favicon.ico')}}" alt="" width="120" class="im"></th>
                  <th class="cont">
                    <h2>COLEGIO DE INGENIEROS DEL PERÚ CD - PUNO</h2>
                    <h1>CERTIFICADO</h1>
                  </th>
                  <th class="cont"><img src="{{public_path('favicon.ico')}}" alt="" width="120" class="im"></th>
                </tr>
            </table>
            @else
            <br><br><br><br><br><br><br><br>
            @endif --}}
            <br><br><br><br><br><br><br>
        </div>
        <div>
            <div class="cont" style="margin: 0px 15px">
                <h2 style="font-size: 32px">Otorgado a:</h2>
                <h3 style="text-decoration: underline; font-size: 21px">{{$individuo->nombres}} {{$individuo->paterno}} {{$individuo->materno}}</h3>
                <h3>En calidad de @if ($matricula->rol=="0")
                    Asistente.
                @else
                    Ponente.
                @endif</h3>
                <div>
                    @if ($curso->descripcioncertificado)
                        <p style="font-size: 20px; text-align: justify">{{$curso->descripcioncertificado}}</p>
                    @else
                        <p style="font-size: 20px">En reconocimiento por su participación en el curso de {{$curso->nombre}}, módulo organizado por el Capítulo de  Ingeniería de {{$capitulo}}."</p>
                    @endif
                    <p>Llevado a cabo desde el {{$di}} de {{$mesi}} hasta el {{$d}} de {{$mes}} del año {{$y}}, con una duración de 
                    @if ($curso->horas)
                    {{$curso->horas}} horas académicas.
                    @else
                    {{$curso->duracion}} días.
                    @endif<span class="font-weight-bold text-uppercas"></span>
                    </p>
                </div>
                {{-- <img class="mb-4 w-full" src="{{asset('storage/'. $curso->certificado)}}" alt=""> --}}
                
            </div>
            <div style="text-align: right">
                Puno,
            <?php
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            echo $meses[date('n')-1];
            ?>
            de {{$fecha=date('Y')}}
            </div>
        </div>
    </div>
    <div style="float: <?= ($curso->encabezado=="0") ? 'right' : 'none';?>">
        <table>
            <tr>
                <th>
                    <p>______________________________</p>
                    <p style="font-size: 13px;">Ing. Jhomar Marcelino Tonconi Quispe<br>DECANO<br><br>COLEGIO DE INGENIEROS DEL PERÚ<br>CD PUNO</p>
                </th>
                <th>
                    <div>
                        {{-- <img src="https://chart.googleapis.com/chart?chs=200x200&amp;cht=qr&amp;chl=https://developers.google.com/chart/infographics/docs/qr_codes&amp;choe=UTF-8" /> --}}
                        <img src="https://chart.googleapis.com/chart?chs=170x170&amp;cht=qr&amp;chl={{$url}}&amp;choe=UTF-8"/>
                    </div>
                    <div>
                        {{$matricula->codigo}}
                    </div>
                </th>
                <th>
                    @if ($oficina=='Capitulo')
                    <p>______________________________</p>
                    <p style="font-size: 13px;">Ing. {{$cap->decano}}<br>DIRECTOR DE ESTUDIOS<br><br>CAPITULO<br>{{$capitulo}}</P>
                    @else
                    <p>______________________________</p>
                    <p style="font-size: 13px;">Ing. {{$cap->decano}}<br>JEFE DE OFICINA<br><br>OFICINA DE<br>TECNOLOGIA Y SISTEMAS</P>
                    @endif
                </th>
            </tr>
        </table>
    </div>
        {{-- <img style="width: 200px;" src="data:image/svg+xml;base64,{{$p}}" alt=""> --}}
        {{-- <img src="https://chart.googleapis.com/chart?chs=200x200&amp;cht=qr&amp;chl=https://puerto53.com&amp;choe=UTF-8" /> --}}
        {{-- <img src="{{public_path('Certificadopre.png')}}" alt="" width="1200px" height="100%"> --}}
        {{-- <img src="https://chart.googleapis.com/chart?chs=200x200&amp;cht=qr&amp;chl=https://developers.google.com/chart/infographics/docs/qr_codes&amp;choe=UTF-8" /> --}}
        {{-- <img src="http://127.0.0.1:8000/storage/posts/h1Tw0R7lTCztWT4oN3M6ei2BxhRW5Y9lAL7bldIa.png" alt=""> --}}
    {{-- <img src="{{public_path('storage/'.$curso->certificado)}}" alt=""> --}}
</body>
</html>