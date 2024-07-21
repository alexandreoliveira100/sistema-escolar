<?php

//VARIÁVEIS GLOBAIS
$nome_sistema = "SISTEMA ESCOLAR";

$url_sistema = "http://localhost/sistema_completo_alex/"; 
 
$telefone_sistema = "+55(xx) xxxxxxxxx";
$endereco_sistema = "Rua: Conselheiro Gomes de Freitas Nº 5155, Bairro: Sapiranga - Fortaleza - Ce";
$rodape_relatorio = "Sistema Desenvolvido por alexandre de Oliveira";

//VARIÁVEIS PARA O BANCO DE DADOS LOCAL
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bd = "sistema_escolar";

//VARIÁVEIS DE CONFIGURAÇÃO
//Se você usar sim, ele vai gerar os relatórios usando a biblioteca do dompdf configurada para o php 8.0
//se você usar outra versão do php ou do dompdf, pode ser que não gere da forma correta. Caso você utilize não,
//ele vai gerar relatório html.
$relatorio_pdf = "";

?>
