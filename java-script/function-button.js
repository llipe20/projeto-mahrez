
// ARQUIVO DE FUNÇÕES DE PARA BOTÕES - direcionando usuário

// Função de voltar no mês anterior;

function before(mes)
{
    let valor = mes - 1;

    if (valor == 0)
    {
        valor = 12;
    }
console.log(valor); 
return valor;
}
   
    

// Janelas moldais;

function moldal(conteudo, classe) 
{
    let dialog = document.querySelector("dialog");
    let paragrafo = document.getElementById("paragrafo");
    paragrafo.textContent = conteudo;
    dialog.classList.add(classe);
    dialog.showMoldal();

    setTimeout (function() {
        dialog.close();
    }, 2000)
}


    // VAI PARA UMA PAG PHP QUE DESTROI AS SESSÕES E DPS PARA PAG DE LOGIN

function toggleContent(iteracao) 
{
    var conteudo = document.getElementById('conteudo-' + iteracao);
    var header = document.getElementById('header-' + iteracao);
    var icone = document.getElementById(iteracao);

    if (conteudo.style.display == 'flex') 
    {
        conteudo.style.display = 'none';
        header.style.borderRadius = '12px';
        icone.textContent = 'expand_more';
    } 
    else 
    {
        header.style.borderRadius = '12px 12px 0px 0px';
        conteudo.style.height = '450px';
        conteudo.style.display = 'flex';
        icone.textContent = 'expand_less';
    }
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

