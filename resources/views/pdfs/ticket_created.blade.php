<style>
    body {
        font-family: Arial, sans-serif;
        background: #ffffff;
        font-family: 'Gill Sans', sans-serif;
    }

    .wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
    }

    .ticket {
        width: 400px;
        margin: 0 auto;
        background-size: cover;
        border-radius: 25px;
        padding: 20px;
        text-align: center;
        box-sizing: border-box;
        border: 4px solid #ccc;
    }

    /* Imagen Titulo */
    .img-title {
        width: 100%;
        margin-bottom: 10px;
    }

    /* LOGO */
    .logo {
        width: 100%;
        margin-bottom: 15px;
    }

    /* TITULO */
    .title {
        font-size: 28px;
        letter-spacing: 1px;
        margin-bottom: 10px;
        color: #fff;
    }

    /* SUBTITULO */
    .subtitle {
        font-size: 20px;
        margin-bottom: 25px;
    }

    /* NOMBRE */
    .name {
        font-size: 22px;
        font-weight: bold;
        color: #000;
        margin-bottom: 5px;
        line-height: 1.2;
    }

    /* CEDULA */
    .cc {
        font-size: 22px;
        color: #000;
        margin-bottom: 5px;
    }

    /* BARRAS */
    .barcode {
        width: 95%;
        background: #fff;
        padding: 10px;
        border-radius: 10px;
    }
    .barcode img {
        width: 100%;
        height: 130px;
    }

    /* FECHA */
    .date {
        font-size: 16px;
        color: #000;
        margin-top: 25px;
        letter-spacing: 1px;
    }
</style>
<div class='wrapper'>
    <div class='ticket'>
        <img class='logo' src="data:image/png;base64,{{$logoBase64}}" />
        <strong class='subtitle'>{{strtoupper($data->event_description)}}</strong>
        <div class='title'>TICKET DE ACCESO</div>

        <div class='name'>{{$data->name}}</div>

        <div class='cc'>C.C. {{$data->nid}}</div>
        <strong class='subtitle'> {{strtoupper($data->team_name)}} </strong>
        <div class='barcode'>
            <img src="data:image/png;base64,{{$barcode}}">
        </div>

        <div class='date'>
            {{ $date }}
        </div>

    </div>
</div>
