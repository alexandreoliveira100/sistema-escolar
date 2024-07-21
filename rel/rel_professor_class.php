<?php 

include('../conexao.php');
require_once('../config_relatorio.php');
//ALIMENTAR OS DADOS NO RELATÓRIO
$html = file_get_contents($url_sistema."rel/rel_professor.php");

if($relatorio_pdf != 'Sim'){
    echo $html;
    exit();

}

date_default_timezone_set('America/Sao_Paulo');

//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;


//INICIALIZAR A CLASSE DO DOMPDF
$options = new options();
$options->set('isRemoteEnabled',true);

$pdf = new DOMPDF($options);

//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', $orientation ='portrait'); //caso queira a folha em floha de paisagem use landscape.

//CARREGAR O CONTEÚDO HTML
$pdf->load_html(($html));

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'relatorio_de_professores.pdf',
array("Attachment" => false)
);


