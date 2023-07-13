
// ARQUIVO DE FUNÇÕES DE PARA BOTÕES - direcionando usuário


    // VAI PARA UMA PAG PHP QUE DESTROI AS SESSÕES E DPS PARA PAG DE LOGIN

function open()
{
    var conteudo = document.getElementsByClassName('box-conteudo-hora-extra');
    conteudo.style.display = 'flex';

    var header = document.getElementsByClassName('box-header-hora-extra');
    header.style.borderRadius = '12px 12px 0px 0px';
}

function sair_login() 
{
    window.location.href = "../../php/home/logado-sair.php";
}

    // IR PARA PAG DE BATER O PONTO

function bater_ponto() 
{
    window.location.href = "../home/function/bater-ponto-html.php";
}

    // IR PARA PAG DE MODIFICAR

function escolher_ponto() 
{
    window.location.href = "../home/function/before-modificar-ponto.php";
}

function modificar_ponto()
{
    window.location.href = "../function/modificar-ponto.html";
}

    // IR PARA PAG DE LER A FOLHA DE PONTO

function consultar_folha() 
{
    window.location.href = "../home/function/consultar-folha.php";
}

    // IR PARA PAG DE HORAS EXTRAS

function hora_extra() 
{
    window.location.href = "../home/function/hora-extra.php";
}

    // IR PARA PAG DE HISTORICO DE SALÁRIO

function extrato() 
{
    window.location.href = "../home/function/extrato.php";
}

    // IR PARA PAG DE CONFIGURAÇÕES

function configuracao() 
{
    window.location.href = "../home/function/settings.php";
}

