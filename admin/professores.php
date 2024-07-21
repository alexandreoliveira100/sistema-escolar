<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/professor.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php require "topo.php"; ?>

<div id="box_professor">

<h1>Professores</h1>
<?php
$sql = "SELECT * FROM professores WHERE nome != ''";
$con = mysqli_query($conexao, $sql);
if(mysqli_num_rows($con) == '')
{
	echo "No momento não existe professores cadastrados!";
}
else{
?>

<table width="900" border="0">
      <tr>
        <td><strong>Código:</strong></td>
        <td><strong>Nome:</strong></td>
        <td><strong>Nº disciplina(s):</strong></td>
        <td><strong>Remuneração:</strong></td>
        <td><strong>Status:</strong></td>
        <td></td>
      </tr>

      <?php while($res_1 = mysqli_fetch_assoc($con)){ ?>
      <tr>
        <td><h3><?php echo $code = $res_1['code']; ?></h3></td>
        <td><h3><?php echo $res_1['nome']; ?></h3></td>
        <td><h3><?php 
		$sql2 = "SELECT * FROM disciplinas WHERE professor = '$code'";
		echo mysqli_num_rows(mysqli_query($conexao, $sql2)); ?></h3></td>
        <td><h3>R$ <?php echo $res_1['salario']; ?></h3></td>
        <td><h3><?php echo $res_1['status']; ?></h3></td>
        <td></td>
        <td>

        <a class="a" href="professores.php?pg=todos&func=deleta&id=<?php echo $res_1['id']; ?>"><img title="Excluir Professor" src="img/deleta.jpg" width="18" height="18" border="0"></a>
        <?php if($res_1['status'] == 'Inativo'){?>
        <a class="a" href="professores.php?pg=todos&func=ativa&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Ativar novamente professor" src="../img/correto.jpg" width="20" height="20" border="0"></a>
        <?php } ?>
        <?php if($res_1['status'] == 'Ativo'){?>
        <a class="a" href="professores.php?pg=todos&func=inativa&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Inativar Professor(a)" src="../img/ico_bloqueado.png" width="18" height="18" border="0"></a>
        <?php } ?>
        <a class="a" href="professores.php?pg=todos&func=edita&id=<?php echo $res_1['id']; ?>"><img title="Editar Dados Cadastrais" src="../img/ico-editar.png" width="18" height="18" border="0"></a>
        <a class="a" rel="superbox[iframe][930x500]" href="historico_professor.php?id=<?php echo $res_1['id']; ?>"><img title="Histórico deste professor" src="../img/visualizar16.gif" width="18" height="18" border="0"></a></td>
      </tr>
      <?php } ?>
    </table>
    <?php  }?>
</div><!--div box_professor--> 

<div id="cadastrar_professor">
<h1>Cadastrar novo professor</h1>

<?php if(isset($_POST['button'])){
	
$code = $_POST['code'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$nascimento = $_POST['nascimento'];
$formacao = $_POST['formacao'];
$graduacao = $_POST['graduacao'];
$pos_graduacao = $_POST['pos_graduacao'];
$mestrado = $_POST['mestrado'];
$doutorado = $_POST['doutorado'];
$salario = $_POST['salario'];

$sql_2 = "INSERT INTO professores (code, status, nome, cpf, nascimento, formacao, graduacao, pos_graduacao, mestrado, doutorado, salario) VALUES ('$code', 'Ativo', '$nome', '$cpf', '$nascimento', '$formacao', '$graduacao', '$pos_graduacao', '$mestrado', '$doutorado', '$salario')";
$cadastra = mysqli_query($conexao, $sql_2);
if($cadastra == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro ao cadastrar!');</script>";
}else{
	
$sql_3 = "INSERT INTO login (status, code, senha, nome, painel) VALUES ('Ativo', '$code', '$cpf', '$nome', 'professor')";
$cadastra_login = mysqli_query($conexao, $sql_3);

	echo "<script language='javascript'>window.alert('Professor cadastrado com sucesso!');window.location='professores.php';</script>";
 }
}?>


<form name="form1" method="post" action="">
  <table width="900" border="0">
    <tr>
      <td>Código:</td>
      <td>Nome:</td>
      <td>CPF:</td>
    </tr>
    <tr>
      <td>
      <?php
      $sql_4 = "SELECT * FROM professores ORDER BY id DESC LIMIT 1";
	  $buscar_prof = mysqli_query($conexao, $sql_4);
	  if(mysqli_num_rows($buscar_prof) == ''){
		  $new_code = "87415978";
	  ?>
        <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $new_code;  ?>">
        <input type="hidden" name="code" value="<?php echo $new_code;  ?>" />
        </td>      
      <?php
	  }else{
	  	while($res_1 = mysqli_fetch_assoc($buscar_prof)){
			
			$new_code = $res_1['code']+$res_1['id']+741;
	  ?>
        <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $new_code;  ?>">
        <input type="hidden" name="code" value="<?php echo $new_code;  ?>" />
        </td>
      <?php }} ?>
      <td>
      <input type="text" name="nome" id="textfield2"></td>
      <td>
      <input type="text" name="cpf" id="textfield3"></td>
    </tr>
    <tr>
      <td>Data de nascimento:</td>
      <td>Formação Acadêmica</td>
      <td>Graduação(ões):</td>
    </tr>
    <tr>
      <td><label for="textfield4"></label>
      <input type="text" name="nascimento" id="textfield4"></td>
      <td><label for="select"></label>
        <select name="formacao" size="1" id="select">
          <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
          <option value="Ensino Médio Completo">Ensino Médio Completo</option>
          <option value="Superior Incompleto">Superior Incompleto</option>
          <option value="Superior Completo">Superior Completo</option>
      </select></td>
      <td><input type="text" name="graduacao" id="textfield5"></td>
    </tr>
    <tr>
      <td>Pos-graduação(ões):</td>
      <td>Mestrado(s):</td>
      <td>Doutorado(s):</td>
    </tr>
    <tr>
      <td><input type="text" name="pos_graduacao" id="textfield6"></td>
      <td><input type="text" name="mestrado" id="textfield7"></td>
      <td><input type="text" name="doutorado" id="textfield8"></td>
    </tr>
    <tr>
      <td>Salário:</td>
    </tr>
    <tr>
      <td><input type="text" name="salario" id="textfield8"></td>
    </tr>
    <tr>
      <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

<!DELETAR O PROFESSOR>

<?php if(@$_GET['func'] == 'deleta'){

$id = $_GET['id'];

$sql_del = "DELETE FROM professores WHERE id = '$id'";
mysqli_query($conexao, $sql_del);
echo "<script language='javascript'>window.location='professores.php?pg=todos';</script>";

}?>

</div>
</body>
</html>