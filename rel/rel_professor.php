<?php 
require_once("../conexao.php"); 
require_once("../config_relatorio.php"); 


setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

?>
<!DOCTYPE html>
<html>
<head>
	<title>Relatório de Professores</title>
	<style>

		@page {
			margin: 0px;

		}

		.footer {
			margin-top:20px;
			width:100%;
			background-color: #ebebeb;
			padding:10px;
			position:relative;
			bottom:0;
		}

		.cabecalho {    
			background-color: #ebebeb;
			padding:10px;
			margin-bottom:30px;
			width:100%;
			height:100px;
		}

		.titulo{
			margin:10px;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.subtitulo{
			margin:10px;
			font-size:12px;
			font-family:Arial, Helvetica, sans-serif;
		}

		.areaTotais{
			border : 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right:25px;
			margin-left:25px;
			position:absolute;
			right:20;
		}

		.areaTotal{
			border : 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right:25px;
			margin-left:25px;
			background-color: #f9f9f9;
			margin-top:2px;
		}

		.pgto{
			margin:1px;
		}

		.fonte13{
			font-size:13px;
		}

		.esquerda{
			display:inline;
			width:50%;
			float:left;
		}

		.direita{
			display:inline;
			width:50%;
			float:right;
		}

		.table{
			padding:15px;
			font-family:Verdana, sans-serif;
			margin-top:20px;
		}

		.texto-tabela{
			font-size:12px;
		}


		.esquerda_float{

			margin-bottom:10px;
			float:left;
			display:inline;
		}


		.titulos{
			margin-top:10px;
		}

		.image{
			margin-top:-10px;
		}

		.margem-direita{
			margin-right: 80px;
		}

		.margem-direita50{
			margin-right: 50px;
		}

		hr{
			margin:8px;
			padding:1px;
		}


		.titulorel{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.margem-superior{
			margin-top:30px;
		}

		.areaSubTituloCab{
			margin-top: 15px;
			margin-bottom: 15px;
		}
	</style>


</head>
<body>
	<div class="cabecalho">		
			<div class="row titulos">
				<div class="col-sm-2 esquerda_float image">	
					<img src="<?php echo  $url_sistema ?>img/logo_escola.jpg" width="130px">
				</div>
				<div class="col-sm-10 esquerda_float">	
					<h2 class="titulo"><b><?php echo strtoupper($nome_sistema) ?></b></h2>
					<div class="areaSubTituloCab">
					<h6 class="subtitulo"><?php echo $endereco_sistema . ' Tel: '.$telefone_sistema  ?></h6>
					<h6 class="subtitulo"><?php echo $data_hoje ?></h6>
					</div>	
				</div>
			</div>
	</div>

	<div class="container">		
			<div class="" align="center">	
				<span class="titulorel">Relátorio de Professores</span>
			</div>		
		</div>
		<hr>
		
<table class='table' width='100%'  cellspacing='5' cellpadding='3'>
			<tr>
				<th>Nome</th>
				<th>Formação</th>
				<th>Graduação</th>
				<th>Pós_graduação</th>
				<th>Mestrado</th>
				<th>Doutorado</th>
				<th>Salário</th>
			</tr>
			<?php		
		
        $sql = "SELECT * FROM professores";       
        $rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta!" .mysqli_connect_error($conexao)); 
        while($dados = mysqli_fetch_assoc($rs)){?>   
        
        <td><?=$dados["code"]?></td>
        <td><?=$dados["nome"]?></td>
        <td><?=$dados["formacao"]?></td>
        <td><?=$dados["pos_graduacao"]?></td>
        <td><?=$dados["mestrado"]?></td>
        <td><?=$dados["doutorado"]?></td>
		<td><?=$dados["salario"]?></td>		
    </tr>
	<?php
	}?>
	</table>
		<hr>
		<hr>
	</div>
	<div class="footer">
	<p style="font-size:14px" align="center">
	<?php echo $rodape_relatorio ?>
	</p>
	</div>
</body>
</html>
