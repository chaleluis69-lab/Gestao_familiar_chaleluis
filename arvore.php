<?php 
include 'conexao.php';
$id = (int)$_GET['id'];
$pessoa = $conn->query("SELECT p.*, pai.nome as npai, mae.nome as nmae FROM pessoas p 
                        LEFT JOIN pessoas pai ON p.id_pai = pai.id 
                        LEFT JOIN pessoas mae ON p.id_mae = mae.id WHERE p.id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>SGF | Linhagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
    <style>
        .node { border-left: 3px solid var(--primary); padding-left: 15px; margin-bottom: 20px; }
        .connector { border-left: 2px dashed var(--border); margin-left: 10px; padding-left: 20px; }
    </style>
</head>
<body class="container py-5 text-center">
    <div class="mb-5">
        <h2 class="fw-bold">Árvore de <span style="color: var(--primary)">Linhagem</span></h2>
        <p class="text-secondary">Conexões biológicas e familiares</p>
    </div>

    <div class="d-inline-block text-start">
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card-glass py-2">
                    <small class="text-secondary d-block">Pai</small>
                    <span class="fw-bold"><?= $pessoa['npai'] ?? 'Desconhecido' ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-glass py-2">
                    <small class="text-secondary d-block">Mãe</small>
                    <span class="fw-bold"><?= $pessoa['nmae'] ?? 'Desconhecido' ?></span>
                </div>
            </div>
        </div>

        <div class="card-glass border-primary mb-4" style="border-width: 2px !important">
            <h4 class="fw-bold m-0" style="color: var(--primary)"><?= $pessoa['nome'] ?></h4>
            <small class="text-secondary"><?= $pessoa['apelido_familiar'] ?></small>
        </div>

        <div class="connector">
            <p class="text-secondary small mb-3">Descendentes Diretos</p>
            <?php
            $filhos = $conn->query("SELECT nome FROM pessoas WHERE id_pai=$id OR id_mae=$id");
            if($filhos->num_rows > 0){
                while($f = $filhos->fetch_assoc()){
                    echo "<div class='card-glass py-2 mb-2 text-start'>{$f['nome']}</div>";
                }
            } else {
                echo "<p class='text-muted italic small'>Sem filhos registados.</p>";
            }
            ?>
        </div>
    </div>

    <div class="mt-5">
        <a href="listar.php" class="btn-modern btn-outline-modern">Voltar à Lista</a>
    </div>
</body>
</html>