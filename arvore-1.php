<?php 
include 'conexao.php';

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit;
}

$id = (int)$_GET['id'];

// Consulta complexa para buscar a pessoa, pais e avós
$sql = "SELECT p.*, 
        pai.nome as npai, mae.nome as nmae,
        avo_paterno.nome as navo_p, avo_paterna.nome as navo_pa,
        avo_materno.nome as navo_m, avo_materna.nome as navo_ma
        FROM pessoas p 
        LEFT JOIN pessoas pai ON p.id_pai = pai.id 
        LEFT JOIN pessoas mae ON p.id_mae = mae.id 
        LEFT JOIN pessoas avo_paterno ON pai.id_pai = avo_paterno.id
        LEFT JOIN pessoas avo_paterna ON pai.id_mae = avo_paterna.id
        LEFT JOIN pessoas avo_materno ON mae.id_pai = avo_materno.id
        LEFT JOIN pessoas avo_materna ON mae.id_mae = avo_materna.id
        WHERE p.id=$id";

$pessoa = $conn->query($sql)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Linhagem Completa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
    <style>
        .generation-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: var(--secondary); }
        .card-avo { background: rgba(255, 255, 255, 0.9); border: 1px solid var(--border); padding: 10px; border-radius: 12px; margin-bottom: 10px; }
        .connector-v { width: 2px; height: 20px; background: var(--border); margin: 0 auto; }
    </style>
</head>
<body class="container py-5 text-center">
    <div class="mb-5">
        <h2 class="fw-bold text-white-custom">Árvore Genealógica</h2>
        <p class="text-white-custom">Visualização de três gerações</p>
    </div>

    <div class="d-inline-block text-center w-100" style="max-width: 1000px;">
        
        <div class="row g-2 mb-2">
            <div class="col-3">
                <div class="card-avo">
                    <small class="generation-label">Avô Paterno</small>
                    <div class="fw-bold small"><?= $pessoa['navo_p'] ?? '---' ?></div>
                </div>
            </div>
            <div class="col-3">
                <div class="card-avo">
                    <small class="generation-label">Avó Paterna</small>
                    <div class="fw-bold small"><?= $pessoa['navo_pa'] ?? '---' ?></div>
                </div>
            </div>
            <div class="col-3">
                <div class="card-avo">
                    <small class="generation-label">Avô Materno</small>
                    <div class="fw-bold small"><?= $pessoa['navo_m'] ?? '---' ?></div>
                </div>
            </div>
            <div class="col-3">
                <div class="card-avo">
                    <small class="generation-label">Avó Materna</small>
                    <div class="fw-bold small"><?= $pessoa['navo_ma'] ?? '---' ?></div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6"><div class="connector-v"></div></div>
            <div class="col-6"><div class="connector-v"></div></div>
        </div>

        <div class="row g-4 mb-3">
            <div class="col-6">
                <div class="card-glass py-3">
                    <small class="generation-label">Pai</small>
                    <div class="fw-bold"><?= $pessoa['npai'] ?? 'Desconhecido' ?></div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-glass py-3">
                    <small class="generation-label">Mãe</small>
                    <div class="fw-bold"><?= $pessoa['nmae'] ?? 'Desconhecida' ?></div>
                </div>
            </div>
        </div>

        <div class="connector-v mb-3"></div>

        <div class="card-glass border-primary mb-5" style="border-width: 3px !important; background: #fff;">
            <small class="generation-label">Membro Atual</small>
            <h4 class="fw-bold m-0" style="color: #000"><?= $pessoa['nome'] ?></h4>
            <span class="badge bg-primary mt-2"><?= $pessoa['apelido_familiar'] ?></span>
        </div>

        <div class="mt-4">
            <h5 class="text-white-custom mb-3">Filhos / Descendentes</h5>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <?php
                $filhos = $conn->query("SELECT nome FROM pessoas WHERE id_pai=$id OR id_mae=$id");
                if($filhos->num_rows > 0){
                    while($f = $filhos->fetch_assoc()){
                        echo "<div class='badge p-3 border' style='background: rgba(255,255,255,0.1)'>{$f['nome']}</div>";
                    }
                } else {
                    echo "<p class='text-white-custom small italic'>Sem descendentes registados.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <a href="listar.php" class="btn-modern btn-outline-modern" style="border-color: #fff; color: #fff;">Voltar à Lista</a>
    </div>
</body>
</html>