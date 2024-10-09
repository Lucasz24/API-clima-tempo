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
        return("Erro ao obter dados do clima.");
    }
    ?>

    <h1>Previsão do Clima em Bombinhas - SC</h1>

    <div class="imagens">
        <div>
            <img src="/img/realistic/70px/<?= $dawnImg ?>.png" alt="dawn">
            <div>Madrugada</div>
        </div>
        <div>
            <img src="/img/realistic/70px/<?= $morningImg ?>.png" alt="morning">
            <div>Manhã</div>
        </div>
        <div>
            <img src="/img/realistic/70px/<?= $afternoonImg ?>.png" alt="afternoon">
            <div>Tarde</div>
        </div>
        <div>
            <img src="/img/realistic/70px/<?= $nightImg ?>.png" alt="night">
            <div>Noite</div>
        </div>
    </div class>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-thermometer-snow" viewBox="0 0 16 16">
        <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V9.5a.5.5 0 0 1 1 0v1.585A1.5 1.5 0 0 1 5 12.5"/>
        <path d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1m5 1a.5.5 0 0 1 .5.5v1.293l.646-.647a.5.5 0 0 1 .708.708L9 5.207v1.927l1.669-.963.495-1.85a.5.5 0 1 1 .966.26l-.237.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.884.237a.5.5 0 1 1-.26.966l-1.848-.495L9.5 8l1.669.963 1.849-.495a.5.5 0 1 1 .258.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.237.883a.5.5 0 1 1-.966.258L10.67 9.83 9 8.866v1.927l1.354 1.353a.5.5 0 0 1-.708.708L9 12.207V13.5a.5.5 0 0 1-1 0v-11a.5.5 0 0 1 .5-.5"/>
</svg>
    <div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Temp. Min (°C)</th>
                <th>Temp. Max (°C)</th>
                <th>Umidade (%)</th>
                <th>Prob. de Chuva (%)</th>
                <th>Condições</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dadosClima['data'] as $dia): ?>
                <tr>
                    <td><?= $dia['date_br'] ?></td>
                    <td><?= $dia['temperature']['min'] ?></td>
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