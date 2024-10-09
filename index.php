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