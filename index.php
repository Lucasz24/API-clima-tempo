<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clima em Bombinhas - SC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 10px; 
            overflow: hidden; 
        }
        th, td {
            padding: 16px; 
            border: 1px solid #ddd;
            text-align: center;
            height: 50px; 
        }
        th {
            background-color: #f4f4f4;
        }
        .imagens {
            display: flex;
            justify-content: space-between; 
            margin-top: 20px;
        }
        .imagens div {
            flex: 1; 
            margin: 0 10px; 
            text-align: center;
        }
        .imagens img {
            width: 70px;
            height: auto;
            transition: transform 0.2s;
        }
        .imagens img:hover {
            transform: scale(1.1);
        }
        .icon {
            width: 20px; /* Aumentar o tamanho do ícone */
            height: auto;
            margin-left: 5px;
            vertical-align: middle; /* Alinhar verticalmente com o texto */
        }
    </style>
</head>
<body>

    <?php
    $url = 'http://apiadvisor.climatempo.com.br/api/v1/forecast/locale/5092/days/15?token=634f6b0951dd66eae8a5e5508484e40b';

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $dadosClima = json_decode($response, true);

    if (isset($dadosClima['data']) && !empty($dadosClima['data'])) {
        $InfoHoje = $dadosClima["data"][0];
        $chuvaPrecipitacao = floatval($InfoHoje["rain"]["precipitation"]);
        $chuvaPorcentagem = $InfoHoje["rain"]["probability"];
        $ventoSentido = $InfoHoje["wind"]["direction"];
        $ventoVelocidade = $InfoHoje["wind"]["velocity_avg"];
        $umidadeMin = $InfoHoje["humidity"]["min"];
        $umidadeMax = $InfoHoje["humidity"]["max"];
        $sunrise = $InfoHoje["sun"]["sunrise"];
        $sunset = $InfoHoje["sun"]["sunset"];
        $dawnImg = $InfoHoje["text_icon"]["icon"]["dawn"];
        $morningImg = $InfoHoje["text_icon"]["icon"]["morning"];
        $afternoonImg = $InfoHoje["text_icon"]["icon"]["afternoon"];
        $nightImg = $InfoHoje["text_icon"]["icon"]["night"];
    } else {
        echo "<p>Erro ao obter dados do clima.</p>";
        exit;
    }
    ?>

    <h1>Previsão do Clima em Bombinhas - SC</h1>

    <div class="imagens">
        <div>
            <img src="/img/realistic/70px/<?= $dawnImg ?>.png" alt="Condições da madrugada">
            <div>Madrugada</div>
        </div>
        <div>
            <img src="/img/realistic/70px/<?= $morningImg ?>.png" alt="Condições da manhã">
            <div>Manhã</div>
        </div>
        <div>
            <img src="/img/realistic/70px/<?= $afternoonImg ?>.png" alt="Condições da tarde">
            <div>Tarde</div>
        </div>
        <div>
            <img src="/img/realistic/70px/<?= $nightImg ?>.png" alt="Condições da noite">
            <div>Noite</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Temp. Min (°C) <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V9.5a.5.5 0 0 1 1 0v1.585A1.5 1.5 0 0 1 5 12.5"/>
                        <path d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1m5 1a.5.5 0 0 1 .5.5v1.293l.646-.647a.5.5 0 0 1 .708.708L9 5.207v1.927l1.669-.963.495-1.85a.5.5 0 1 1 .966.26l-.237.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.884.237a.5.5 0 1 1-.26.966l-1.848-.495L9.5 8l1.669.963 1.849-.495a.5.5 0 1 1 .258.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.237.883a.5.5 0 1 1-.966.258L10.67 9.83 9 8.866v1.927l1.354 1.353a.5.5 0 0 1-.708.708L9 12.207V13.5a.5.5 0 0 1-1 0v-11a.5.5 0 0 1 .5-.5"/>
                    </svg>
                </span></th>
                <th>Temp. Max (°C) <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="28" fill="currentColor" class="icon" viewBox="0 0 16 16">
                        <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V2.5a.5.5 0 0 1 1 0v8.585A1.5 1.5 0 0 1 5 12.5"/>
                        <path d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1m5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5m4.243 1.757a.5.5 0 0 1 0 .707l-.707.708a.5.5 0 1 1-.708-.708l.708-.707a.5.5 0 0 1 .707 0M8 5.5a.5.5 0 0 1 .5-.5 3 3 0 1 1 0 6 .5.5 0 0 1 0-1 2 2 0 0 0 0-4 .5.5 0 0 1-.5-.5M12.5 8a.5.5 0 0 1 .5-.5h1a.5.5 0 1 1 0 1h-1a.5.5 0 0 1-.5-.5m-1.172 2.828a.5.5 0 0 1 .708 0l.707.708a.5.5 0 0 1-.707.707l-.708-.707a.5.5 0 0 1 0-.708M8.5 12a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5"/>
                    </svg>
                    <span style="margin-left: 10px;"></span>
                </span></th>
                <th>Umidade <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="28" fill="currentColor" class="icon" viewBox="0 0 16 16">
                        <path d="M13.5 0a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V7.5h-1.5a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V15h-1.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V.5a.5.5 0 0 0-.5-.5zM7 1.5l.364-.343a.5.5 0 0 0-.728 0l-.002.002-.006.007-.022.023-.08.088a29 29 0 0 0-1.274 1.517c-.769.983-1.714 2.325-2.385 3.727C2.368 7.564 2 8.682 2 9.733 2 12.614 4.212 15 7 15s5-2.386 5-5.267c0-1.05-.368-2.169-.867-3.212-.671-1.402-1.616-2.744-2.385-3.727a29 29 0 0 0-1.354-1.605l-.022-.023-.006-.007-.002-.001zm0 0-.364-.343zm-.016.766L7 2.247l.016.019c.24.274.572.667.944 1.144.611.781 1.32 1.776 1.901 2.827H4.14c.58-1.051 1.29-2.046 1.9-2.827.373-.477.706-.87.945-1.144zM3 9.733c0-.755.244-1.612.638-2.496h6.724c.395.884.638 1.741.638 2.496C11 12.117 9.182 14 7 14s-4-1.883-4-4.267"/>
                    </svg>
                    <span style="margin-left: 10px;"></span>
                </span></th>
                <th>Probailidade de chuva <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="28" fill="currentColor" class="icon" viewBox="0 0 16 16">
                        <path d="M4.158 12.025a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m3 0a.5.5 0 0 1 .316.633l-1 3a.5.5 0 0 1-.948-.316l1-3a.5.5 0 0 1 .632-.317m3 0a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m3 0a.5.5 0 0 1 .316.633l-1 3a.5.5 0 1 1-.948-.316l1-3a.5.5 0 0 1 .632-.317m.247-6.998a5.001 5.001 0 0 0-9.499-1.004A3.5 3.5 0 1 0 3.5 11H13a3 3 0 0 0 .405-5.973M8.5 2a4 4 0 0 1 3.976 3.555.5.5 0 0 0 .5.445H13a2 2 0 0 1 0 4H3.5a2.5 2.5 0 1 1 .605-4.926.5.5 0 0 0 .596-.329A4 4 0 0 1 8.5 2"/>
                    </svg>
                    </svg>
                    <span style="margin-left: 10px;"></span>
                </span></th>
                <th>Condições <span>
        </thead>
        <tbody>
            <?php foreach ($dadosClima['data'] as $dia): ?>
                <tr>
                    <td><?= $dia['date_br'] ?></td>
                    <td><?= $dia['temperature']['min'] ?> °C</td>
                    <td><?= $dia['temperature']['max'] ?></td>
                    <td><?= $dia['humidity']['max'] ?></td>
                    <td><?= $dia['rain']['probability'] ?></td>
                    <td><?= $dia['text_icon']['text']['pt'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>