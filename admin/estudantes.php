<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudantes</title>
    <link href="css/estudantes.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php require "topo.php"; ?>

    <div id="selecionar_estudantes">
    <h1>Alunos que estão cadastrados</h1>
<?php
$sql_1 = "SELECT * FROM estudantes WHERE nome != ''";
$consulta = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($consulta) == ''){
	echo "<h2>Não exisite nenhum aluno cadastrado no momento</h2>";
}else{
?>

    <table width="900" border="0">
      <tr>
        <td><strong>Status:</strong></td>
        <td><strong>Código:</strong></td>
        <td><strong>Nome:</strong></td>
        <td><strong>Série(ano):</strong></td>
        <td><strong>Mensalidade:</strong></td>
        <td></td>
      </tr>
      <?php while($res_1 = mysqli_fetch_assoc($consulta)){ ?>
      <tr>
        <td><h3><?php echo $res_1['status']; ?></h3></td>
        <td><h3><?php echo $res_1['code']; ?></h3></td>
        <td><h3><?php echo $res_1['nome']; ?></h3></td>
        <td><h3><?php echo $res_1['serie']; ?></h3></td>
        <td><h3>R$ <?php echo $res_1['mensalidade']; ?></h3></td>
        <td></td>
        <td>
        <a class="a" href="estudantes.php?pg=todos&func=deleta&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Excluir Aluno(a)" src="img/deleta.jpg" width="18" height="18" border="0"></a>
        <?php if($res_1['status'] == 'Inativo'){ ?>
        <a class="a" href="estudantes.php?pg=todos&func=ativa&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Ativar novamente Aluno(a)" src="../img/correto.jpg" width="20" height="20" border="0"></a>
        <?php } ?>
        <?php if($res_1['status'] == 'Ativo'){?>
        <a class="a" href="estudantes.php?pg=todos&func=inativa&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Inativar Aluno(a)" src="../img/ico_bloqueado.png" width="18" height="18" border="0"></a>
        <?php } ?>
        <a class="a" rel='superbox[iframe][800x600]' href="mostrar_resultado.php?q=<?php echo $res_1['code']; ?>&s=aluno&curso=<?php echo $res_1['serie']; ?>"><img title="Informações detalhada deste aluno(a)" src="../img/visualizar16.gif" width="18" height="18" border="0"></a>
        </td>
      </tr>
      <?php } ?>
    </table>
    <br /> 
<?php } // aqui fecha a consulta ?>
</div>
<! Exclusão, ativação e Desativação>

<?php if(@$_GET['func'] == 'deleta'){

$id = $_GET['id'];
$code = $_GET['code'];

$sql_del = "DELETE FROM estudantes WHERE id = '$id'";
$sql_del2 = "DELETE FROM login WHERE code = '$code'";
mysqli_query($conexao, $sql_del);
mysqli_query($conexao, $sql_del2);

echo "<script language='javascript'>
window.location='estudantes.php?pg=todos';</script>";
}?>


<!-- ativação dos alunos-->
<?php if(@$_GET['func'] == 'ativa'){

$id = $_GET['id'];
$code = $_GET['code'];

$sql_editar = "UPDATE estudantes SET status = 'Ativo' WHERE id = '$id'";
$sql_editar2 = "UPDATE login SET status = 'Ativo' WHERE code = '$code'";
mysqli_query($conexao, $sql_editar);
mysqli_query($conexao,$sql_editar2);

echo "<script language='javascript'>window.location='estudantes.php?pg=todos';</script>";
}?>

<!-- inativação dos alunos --> 
<?php if(@$_GET['func'] == 'inativa'){

$id = $_GET['id'];
$code = $_GET['code'];

$sql_editar = "UPDATE estudantes SET status = 'Inativo' WHERE id = '$id'";
$sql_editar2 = "UPDATE login SET status = 'Inativo' WHERE code = '$code'";
mysqli_query($conexao, $sql_editar);
mysqli_query($conexao,$sql_editar2);

echo "<script language='javascript'>window.location='estudantes.php?pg=todos';</script>";
}?>

<div id="cadastrar_alunos">

 <h1>1º Passo - Cadastre os dados pessoais</h1>

<?php  if(isset($_POST['button'])){

$code = $_POST['code'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$nascimento = $_POST['nascimento'];
$mae = $_POST['mae'];
$pai = $_POST['pai'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$complemento = $_POST['complemento'];
$tel_residencial = $_POST['tel_residencial'];
$cep = $_POST['cep'];
$celular = $_POST['celular'];
$tel_amigo = $_POST['tel_amigo'];

$sql_2 = "INSERT INTO estudantes (code, status, nome, cpf, rg, nascimento, mae, pai, estado, cidade, bairro, endereco, complemento, cep, tel_residencial, celular, tel_amigo) VALUES ('$code', 'Ativo', '$nome', '$cpf', '$rg', '$nascimento', '$mae', '$pai', '$estado', '$cidade', '$bairro', '$endereco', '$complemento', '$cep', '$tel_residencial', '$celular', '$tel_amigo')";

$sql_login = "INSERT INTO login (status, code, senha, nome, painel) VALUES ('Ativo', '$code', '$cpf', '$nome', 'Aluno')";

$cadastra = mysqli_query($conexao, $sql_2);
$cadastra_login = mysqli_query($conexao, $sql_login);

echo "<script language='javascript'>window.alert('Dados cadastrados com sucesso! Click em OK para avançar');window.location='estudantes.php?pg=cadastra&bloco=2&code=$code';</script>";

}?> 
 
<form name="form1" method="post" action="">
  <table width="900" border="0">
	<tr>
     <td></td>
     <td colspan="2"><strong>Foi criado um código único para este aluno</strong></td>
     <td></td>
    </tr>
    <tr>
     <td></td>
     <?php 
	 $sql_1 = "SELECT * FROM estudantes ORDER BY id DESC LIMIT 1";
	 $con_est = mysqli_query($conexao, $sql_1);
	 if(mysqli_num_rows($con_est) == ''){
		 $novo_code = "587418";
	?>
      <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_code; ?>"></td>
      <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />    
    <?php
		 }else{
	 
	 	while($res_1 = mysqli_fetch_assoc($con_est)){
			$novo_code = $res_1['code']+741+$res_1['id'];
	 ?>
      <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_code; ?>"></td>
      <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />
     <?php } } ?>
     <td></td>
    </tr>    
    <tr>
      <td>Nome:</td>
      <td>CPF:</td>
      <td>RG:</td>
    </tr>
      <td><label for="celular"></label>
      <input type="text" name="nome" id="textfield2"></td>
      <td><label for="tel_amigo"></label>
      <input type="text" name="cpf" id="textfield3"></td>
      <td><label for="tel_amigo"></label>
      <input type="text" name="rg" id="textfield3"></td>
    </tr>
    <tr>
      <td>Data de nascimento:</td>
      <td>Nome da mãe:</td>
      <td>Nome do Pai:</td>
    </tr>
    <tr>
      <td><label for="nascimento"></label>
      <input type="text" name="nascimento" id="textfield4"></td>
      <td><label for="select"></label>
      <input type="text" name="mae" id="textfield12"></td>
      <td><input type="text" name="pai" id="textfield5"></td>
    </tr>
    <tr>
      <td>Estado:</td>
      <td>Cidade:</td>
      <td>Bairro:</td>
    </tr>
    <tr>
      <td><input type="text" name="estado" id="textfield6"></td>
      <td><input type="text" name="cidade" id="textfield7"></td>
      <td><input type="text" name="bairro" id="textfield8"></td>
    </tr>
    <tr>
      <td>Endereço:</td>
      <td>Complemento:</td>
      <td>Cep:</td>
    </tr>
    <tr>
      <td><input type="text" name="endereco" id="textfield8"></td>
      <td><input type="text" name="complemento" id="textfield8"></td>
      <td><input type="text" name="cep" id="textfield8"></td>
    </tr>
    <tr>
      <td>Telefone residencial:</td>
      <td>Telefone Celular:</td>
      <td>Telefone de um amigo:</td>
    </tr>
    <tr>
      <td><input type="text" name="tel_residencial" id="textfield9"></td>
      <td><input type="text" name="celular" id="textfield10"></td>
      <td><input type="text" name="tel_amigo" id="textfield11"></td>
    </tr>
    <tr>
      <td><input class="input" type="submit" name="button" id="button" value="Avançar"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div>



</body>
</html>