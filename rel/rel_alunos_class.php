<?php 

//include('../conexao.php');
require_once('../config_relatorio.php');
//ALIMENTAR OS DADOS NO RELATÓRIO
$html = file_get_contents($url_sistema."rel/rel_alunos.php");

if($relatorio_pdf != 'Sim'){
    echo $html;
    exit();

}

date_default_timezone_set('America/Sao_Paulo');

//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

//INICIALIZAR A CLASSE DO DOMPDF
$pdf = new DOMPDF();

//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait'); //caso queira a folha em floha de paisagem use landscape.

//CARREGAR O CONTEÚDO HTML
$pdf->load_html(utf8_decode($html));

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'relatorio_de_alunos.pdf',
array("Attachment" => false)
);


