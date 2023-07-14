<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LINKS CSS -->

    <link rel="stylesheet" href="../../css/style-mobile/all.css" media="all">
    <link rel="stylesheet" href="../../css/style-mobile/home.css" media="screen and (max-width: 800px)">
    <link rel="stylesheet" href="../../css/style-desktop/home.css" media="screen and (min-width: 801px)">
    <title>Página principal - Mahrez</title>

    <!-- LINKS JAVASCRIPT -->
    <script src="../../java-script/function-button.js"></script>
</head>
<body>
    <?php include_once 'function/data.php'; verificar_home();?>

    <header class="cabecalho">
        <section class="box-title">
            <h1>Mahrez</h1>
            <h3>Marcador de Ponto</h3>
        </section>

        <button class="box-button" type="button" onclick="sair_login()">Sair</button>
    </header>
    <main>
        <section id="box-title-section">
            <h2>Olá, <?php echo $_SESSION['usuario'];?>!</h2>
        </section>

        <nav class="box-function">
            <button class="function" onclick="bater_ponto()">
                <img class="photo-function" src="../imagem/bater-ponto.png" alt="bater-ponto">
                <p class="title-function">Bater ponto</p>
            </button>

            <button class="function" onclick="escolher_ponto()">
                <img class="photo-function" src="../imagem/moficar-ponto.png" alt="moficar-ponto">
                <p class="title-function">Modificar ponto</p>
            </button>

            <button class="function" onclick="consultar_folha()">
                <img class="photo-function" src="../imagem/consultar-folha.png" alt="consultar-folha">
                <p class="title-function">Consultar folha</p>
            </button>

            <button class="function" onclick="hora_extra()">
                <img class="photo-function" src="../imagem/hora-extra.png" alt="hora-extra">
                <p class="title-function">Horas extras</p>
            </button>

            <button class="function" onclick="extrato()">
                <img class="photo-function" src="../imagem/extrato.png" alt="extrato">
                <p class="title-function">Extrato</p>
            </button>

            <button class="function" onclick="configuracao()">
                <img class="photo-function" src="../imagem/settings.png" alt="settings">
                <p class="title-function">Configurações</p>
            </button>
        </nav>
    </main>
    <footer class="box-rodape">
        <h2 class="title-rodape">POWERED BY LLPE</h2>

        <div class="box-link">
            <a class="link-rodape" href="https://instagram.com/https_llpe" target="_blank">
            <img class="photo-rodape" src="../imagem/instagram.png" alt="instagram">
            </a>

            <a class="link-rodape" href="https://github.com/llipe20" target="_blank">
                <img class="photo-rodape" src="../imagem/github.png" alt="github">
            </a>

            <a class="link-rodape" href="https://www.youtube.com/@orochidois1692" target="_blank">
                <img class="photo-rodape" src="../imagem/youtube.png" alt="youtube">
            </a>
        </div>
    </footer>
</body>
</html>