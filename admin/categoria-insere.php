<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Microblog\Services\CategoriaServico;

$servico = new CategoriaServico();

$erro = '';

if (isset($_POST['inserir'])) {
    $nome = trim($_POST['nome'] ?? '');

    if ($nome === '') {
        $erro = 'Informe o nome da categoria.';
    } else {
        $categoria = new \Categoria($nome);

        if ($servico->inserir($categoria)) {
            header('Location: categorias.php');
            exit;
        } else {
            $erro = 'Não foi possível cadastrar a categoria.';
        }
    }
}

require_once __DIR__ . '/../includes/cabecalho-admin.php';

?>

<div class="row">
    <article class="col-12 bg-white rounded shadow my-1 py-4">

        <h2 class="text-center">Inserir nova categoria</h2>

        <?php if ($erro !== ''): ?>
            <div class="alert alert-danger mx-auto w-75">
                <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form class="mx-auto w-75"
              action=""
              method="post"
              id="form-inserir"
              name="form-inserir">

            <div class="mb-3">
                <label class="form-label" for="nome">Nome:</label>

                <input
                    class="form-control"
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($_POST['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    required
                >
            </div>

            <button class="btn btn-primary" id="inserir" name="inserir">
                <i class="bi bi-save"></i>
                Inserir
            </button>
        </form>

    </article>
</div>

<?php require_once __DIR__ . '/../includes/rodape-admin.php'; ?>