<?php
include 'layouts/header.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['data_nascimento'])) {
    header('Location: index.php');
    exit;
}

$data_nascimento = $_POST['data_nascimento'];
$data = new DateTime($data_nascimento);

$mes = (int) $data->format('m');
$dia = (int) $data->format('d');

// Carrega o XML com os signos
$xml = simplexml_load_file('signos.xml');

$signo_encontrado = null;

foreach ($xml->signo as $signo) {
    list($mes_ini, $dia_ini) = explode('-', (string) $signo->inicio);
    list($mes_fim, $dia_fim) = explode('-', (string) $signo->fim);

    $mes_ini = (int) $mes_ini;
    $dia_ini = (int) $dia_ini;
    $mes_fim = (int) $mes_fim;
    $dia_fim = (int) $dia_fim;

    // Trata Capricórnio (cruza o ano: dez → jan)
    if ($mes_ini > $mes_fim) {
        if (
            ($mes == $mes_ini && $dia >= $dia_ini) ||
            ($mes == $mes_fim && $dia <= $dia_fim)
        ) {
            $signo_encontrado = $signo;
            break;
        }
    } else {
        if (
            ($mes == $mes_ini && $dia >= $dia_ini) ||
            ($mes > $mes_ini && $mes < $mes_fim) ||
            ($mes == $mes_fim && $dia <= $dia_fim)
        ) {
            $signo_encontrado = $signo;
            break;
        }
    }
}

// Cor por elemento
$cores_elemento = [
    'Fogo'  => ['bg' => '#fff1f0', 'badge' => '#ff4d4f', 'icone' => '🔥'],
    'Terra' => ['bg' => '#f6ffed', 'badge' => '#52c41a', 'icone' => '🌍'],
    'Ar'    => ['bg' => '#e6f7ff', 'badge' => '#1890ff', 'icone' => '💨'],
    'Água'  => ['bg' => '#f0f5ff', 'badge' => '#2f54eb', 'icone' => '💧'],
];
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <?php if ($signo_encontrado): ?>
                <?php
                    $elemento = (string) $signo_encontrado->elemento;
                    $cor = $cores_elemento[$elemento] ?? ['bg' => '#f9f9f9', 'badge' => '#888', 'icone' => '⭐'];
                ?>

                <div class="card shadow-lg border-0 rounded-4 text-center"
                     style="background-color: <?= $cor['bg'] ?>;">
                    <div class="card-body p-5">

                        <div style="font-size: 5rem; line-height: 1;">
                            <?= $signo_encontrado->simbolo ?>
                        </div>

                        <h1 class="fw-bold mt-3" style="font-size: 2.5rem;">
                            <?= $signo_encontrado->nome ?>
                        </h1>

                        <span class="badge rounded-pill px-3 py-2 mb-4"
                              style="background-color: <?= $cor['badge'] ?>; font-size: 0.95rem;">
                            <?= $cor['icone'] ?> Elemento <?= $elemento ?>
                        </span>

                        <p class="text-muted mb-1">
                            <small>
                                📅 <?= $signo_encontrado->inicio ?> até <?= $signo_encontrado->fim ?>
                            </small>
                        </p>

                        <hr class="my-4"/>

                        <p class="lead text-secondary">
                            <?= $signo_encontrado->descricao ?>
                        </p>

                        <a href="index.php" class="btn btn-outline-secondary mt-3 rounded-3">
                            🔄 Consultar outro signo
                        </a>

                    </div>
                </div>

            <?php else: ?>

                <div class="alert alert-warning rounded-4 text-center p-5" role="alert">
                    <span style="font-size: 3rem;">😕</span>
                    <h4 class="mt-3">Signo não encontrado.</h4>
                    <p>Verifique a data informada e tente novamente.</p>
                    <a href="index.php" class="btn btn-warning rounded-3 mt-2">Voltar</a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
