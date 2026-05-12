<?php 
include 'conexao.php';
$id = (int)$_GET['id'];
$pessoa = $conn->query("SELECT * FROM pessoas WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-glass">
                <h3 class="fw-bold mb-4">Atualizar <span style="color: var(--primary)">Registo</span></h3>
                <form action="atualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="mb-3">
                        <label class="form-label text-secondary small">Nome Completo</label>
                        <input type="text" name="nome" class="form-control" value="<?= $pessoa['nome'] ?>" required>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-secondary small">Apelido Familiar</label>
                            <input type="text" name="apelido_familiar" class="form-control" value="<?= $pessoa['apelido_familiar'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-secondary small">Sexo</label>
                            <select name="sexo" class="form-select">
                                <option value="M" <?= $pessoa['sexo']=='M'?'selected':'' ?>>Masculino</option>
                                <option value="F" <?= $pessoa['sexo']=='F'?'selected':'' ?>>Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-modern btn-primary-modern w-100 justify-content-center">Guardar Alterações</button>
                        <a href="listar.php" class="btn-modern btn-outline-modern">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>