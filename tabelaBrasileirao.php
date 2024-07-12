
<html>

<head>
    <meta charset="utf-8">
    <title>Primeira página</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: green;
            padding: 20px;
            color: white;
            text-align: center;
            position: relative;
        }

        .header h1 {
            font-family: Arial, sans-serif;
            font-weight: normal;
            font-size: 2em;
            font-weight: 300;
            margin-bottom: 10px;
        }

        .buttons {
            position: absolute;
            top: 70px;
            left: 20px;
            margin: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid white;
            text-align: left;
        }

        .buttons a {
            margin: 0 10px;
            text-decoration: none;
            color: gray;
            font-weight: bold;
            font-size: 1.2em;
            transition: color 0.3s, border-bottom 0.3s;
        }

        .buttons a:hover {
            color: white;
        }

        .buttons a:active {
            border-bottom: 2px solid white;
        }

        .espaco {
            margin: 8px;
            padding: 0;
            width: 40%; /* Ajuste da largura da tabela para 40% */
            margin-left: 30%; /* Centralizando a tabela */
            border-collapse: collapse;
            margin-top: 10px;
        }

        .espaco:hover {
            background-color: #f5f5f5; /* Cor de cinza fraco ao passar o mouse */
        }

        .espaco th,
        .espaco td {
            border-bottom: 2px solid #ddd;
            padding: 4px; /* Ajuste do padding */
            text-align: center;
            font-size: 12px; /* Ajuste do tamanho da fonte para 12px */
        }

        .imagem img {
            width: 18px; /* Ajuste do tamanho da imagem */
            height: 18px; /* Ajuste do tamanho da imagem */
        }

        .cinza-claro {
            color: #aaa;
        }

    </style>
</head>

<?php
$ch = curl_init();

$urlApi = 'https://jsuol.com.br/c/monaco/utils/gestor/commons.js?file=commons.uol.com.br/sistemas/esporte/modalidades/futebol/campeonatos/dados/2023/30/dados.json';

curl_setopt($ch, CURLOPT_URL, $urlApi);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);




$resultApi = curl_exec($ch);

$arrayJsonApi = json_decode($resultApi,true);



//EQUIPES>  Start
$arrayEquipes = $arrayJsonApi['equipes'];

//EQUIPES>  End


//Fases - Start
$Fases = $arrayJsonApi['ordem-fases'][0];
//Fases - End

//Classificacao - Start
$arrayClassificacao = $arrayJsonApi['fases'][$Fases]['classificacao']['grupo']['Único'];
//Classificacao - End

//Pontos - Start
$equipes = $arrayJsonApi['fases'][$Fases]['classificacao']['equipe'];

$arrayPontos = $arrayJsonApi['fases'][$Fases]['classificacao']['equipe'];

//Pontos - End

?>

<body>
    <div class="header">
        <h1>BRASILEIRAO SERIE A</h1>
        <div class="buttons">
            <a href="#">Classificação</a>
            <a href="#">Simulador</a>
            <a href="#">Vídeos</a>
            <a href="#">VAR</a>
        </div>
    </div>

    <table class="espaco">
        <tr>
            <th class="posicao">Posição</th>
            <th class="imagem">Brasão</th>
            <th class="equipes">Equipes</th>
            <th class="pontos cinza-claro">P</th>
            <th class="jogos">J</th>
            <th class="vitoria cinza-claro">V</th>
            <th class="escanteio">E</th>
            <th class="der cinza-claro">D</th>
            <th class="golsMarcados">GP</th>
            <th class="GolsContra cinza-claro">GC</th>
            <th class="saldoGols">SG</th>
        </tr>

        <?php
        foreach ($arrayClassificacao as $keyClassificacao => $valueClassificacao) {
            $equipe = $equipes[$valueClassificacao];
            $totalPontos = $equipe['pg']['total'];
            $totalPartidas = $equipe['j']['total'];
            $totalVitorias = $equipe['v']['total'];
            $totalEscanteio = $equipe['e']['total'];
            $totalDer = $equipe['d']['total'];
            $totalGolsMarcados = $equipe['gp']['total'];
            $totalGolsContra = $equipe['gc']['total'];
            $totalSaldoGols = $equipe['sg']['total'];
        ?>

            <tr>
                <td class="posicao"><?= $equipe['pos'] ?></td>
                <td class="imagem"><img src="<?= $arrayEquipes[$valueClassificacao]['brasao'] ?>"></td>
                <td class="equipes"><?= $arrayEquipes[$valueClassificacao]['nome-comum'] ?></td>
                <td class="pontos cinza-claro"><?= $totalPontos ?></td>
                <td class="jogos"><?= $totalPartidas ?></td>
                <td class="vitoria cinza-claro"><?= $totalVitorias ?></td>
                <td class="escanteio verde"><?= $totalEscanteio ?></td>
                <td class="der cinza-claro"><?= $totalDer ?></td>
                <td class="golsMarcados"><?= $totalGolsMarcados ?></td>
                <td class="GolsContra cinza-claro"><?= $totalGolsContra ?></td>
                <td class="saldoGols"><?= $totalSaldoGols ?></td>
            </tr>

        <?php
        }
        ?>

    </table>
</body>

</html>
