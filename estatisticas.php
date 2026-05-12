<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>SGF | Estatísticas BI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body class="container py-5">
    <div class="mb-5">
        <h2 class="fw-bold">Business <span style="color: var(--primary)">Intelligence</span></h2>
        <a href="index.php" class="btn-modern btn-outline-modern mt-2">Voltar ao Dashboard</a>
    </div>

    <div class="row g-4 mb-4">
        <?php
        $total = $conn->query("SELECT COUNT(*) as t FROM pessoas")->fetch_assoc()['t'];
        $media = $conn->query("SELECT AVG(TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE())) as m FROM pessoas")->fetch_assoc()['m'];
        ?>
        <div class="col-md-6">
            <div class="card-glass text-center">
                <p class="text-secondary mb-1">Total de Membros</p>
                <h1 class="fw-bold" style="color: var(--primary)"><?= $total ?></h1>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-glass text-center">
                <p class="text-secondary mb-1">Média de Idades</p>
                <h1 class="fw-bold" style="color: var(--primary)"><?= round($media, 1) ?> <small class="fs-6 text-white">anos</small></h1>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-12">
            <div class="card-glass">
                <h5 class="mb-4 text-secondary">Distribuição por Gênero</h5>
                <div id="chart_sexo" style="width: 100%; height: 300px;"></div>
            </div>
        </div>
    </div>

    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Sexo', 'Quantidade'],
                <?php
                $res = $conn->query("SELECT sexo, COUNT(*) as qtd FROM pessoas GROUP BY sexo");
                while($r = $res->fetch_assoc()) echo "['".($r['sexo']=='M'?'Homens':'Mulheres')."', {$r['qtd']}],";
                ?>
            ]);
            var options = {
                backgroundColor: 'transparent',
                colors: ['#38bdf8', '#fb7185'],
                legend: {textStyle: {color: '#94a3b8'}},
                pieHole: 0.4,
                pieSliceBorderColor: 'none'
            };
            var chart = new google.visualization.PieChart(document.getElementById('chart_sexo'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>