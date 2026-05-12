<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>SGF | Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card-glass">
                <h3 class="fw-bold mb-4">Adicionar <span style="color: var(--primary)">Membro</span></h3>
                <form action="salvar.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-secondary">Nome Completo</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-secondary">Nascimento</label>
                            <input type="date" name="data_nascimento" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-secondary">Sexo</label>
                            <select name="sexo" class="form-select">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-secondary">Apelido da Família</label>
                        <input type="text" name="apelido_familiar" class="form-control" placeholder="Ex: Família Mateus">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-modern btn-primary-modern w-100 justify-content-center">Salvar Registo</button>
                        <a href="listar.php" class="btn-modern btn-outline-modern">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>