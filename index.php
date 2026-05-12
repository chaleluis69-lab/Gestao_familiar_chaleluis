<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gestão Familiar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="container py-5">
    <header class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold m-0">EGI<span style="color: var(--primary)"><br>Gestão de Familiar</span></h2>
            <p class="text-secondary small">Aplicacoes WEB</p>
        </div>
        <div class="d-flex gap-2">
            <a href="cadastro.php" class="btn-modern btn-primary-modern text-decoration-none">
                <i class="bi bi-plus-lg"></i> Novo Registo
            </a>
        </div>
    </header>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-glass p-4">
                <i class="bi bi-database-fill-gear fs-3 text-primary"></i>
                <h4 class="mt-3">Famílias Cadastrados</h4>
                <p class="text-secondary small">Visualização de tabela de dados, edição de registos existentes e arvore da familia.</p>
                <a href="listar.php" class="btn-modern btn-ghost w-100 text-decoration-none justify-content-center">Explorar Tabela</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-glass p-4 border-primary">
                <i class="bi bi-heart-fill fs-3 text-danger"></i>
                <h4 class="mt-3">Uniões Civis</h4>
                <p class="text-secondary small">Gestão de vínculos matrimoniais e análise de parentesco.</p>
                <a href="casamento.php" class="btn-modern btn-ghost w-100 text-decoration-none justify-content-center">Gerir Vínculos</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-glass p-4">
                <i class="bi bi-graph-up-arrow fs-3 text-success"></i>
                <h4 class="mt-3">Painel  de Estatistica</h4>
                <p class="text-secondary small">Relatórios estatísticos, media das idades e graficos</p>
                <a href="estatisticas.php" class="btn-modern btn-ghost w-100 text-decoration-none justify-content-center">Ver Estatísticas</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>