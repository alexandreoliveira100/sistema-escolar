

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adminstração</title>
<link href="css/cadastrandocurso.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php require "topo.php"; ?>

<div id="box_curso">
<br /><br />

 <h1>Cadastrar curso</h1>
 
 
<?php if(isset($_POST['cadastra'])){
$curso = $_POST['curso'];
$sql = "INSERT INTO cursos (curso) VALUES ('$curso')";		
	$cad = mysqli_query($conexao, $sql);

	if ($cad == ''){
		echo "<script language='javascript'> window.alert('Erro ao Cadastrar, Curso já Cadastrado!');</script>";
	}
  
  else{
		
	echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
	echo "<script language='javascript'>window.location='cadastrar_cursos.php';</script>";
	}
}?> 

<form name="form1" method="post" action="">
  <table width="900" border="0">
    <tr>
      <td width="134">Curso</td>
    </tr>
    <tr>
      <td><input type="text" name="curso" id="textfield"></td>
      <!-- este button om name cadastra é passado na instrução isset() se foi pressionado e para ver suar existência --> 
      <td><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
    </tr>
  </table>
</form> 
 <br />
</div><!-- box_curso -->

<div id="visualizar_cursos">
<?php
$sql_1 = "SELECT * FROM cursos";
$result = mysqli_query($conexao, $sql_1);
 if(mysqli_num_rows($result) <= 0){
	 echo "<br><br>No momento não existe nenhum curso cadastrado!<br><br>";
 }else{
?>

<br /><br />
 <h1>Cursos</h1>
    <table width="900" border="0">
      <tr>
        <td><strong>Curso:</strong></td>
        <td><strong>Total de disciplinas deste curso:</strong></td>
        <td>&nbsp;</td>
      </tr>
      <?php while($res_1 = mysqli_fetch_assoc($result)){ ?>
      <tr>
        <td><h3><?php echo $curso = $res_1['curso'];?></h3></td>
        <td><h3><?php $sql_2 = "SELECT * FROM disciplinas WHERE curso = '$curso'";
		    
        $result2 = mysqli_query($conexao, $sql_2);
		    echo mysqli_num_rows($result2); ?></h3>
        </td>
        <td><a class="a" href="cadastrar_cursos.php?pg=curso&deleta=cur&id=<?php echo @$res_1['id']; ?>"><img title="Excluir curso" src="img/deleta.jpg" width="18" height="18" border="0"></a></td>
      </tr>
      <?php } ?>
    </table>	 

<?php } ?> 
</div>

<!DELEÇÃO DOS CURSOS>

<?php if(@$_GET['deleta'] == 'cur'){

$id = $_GET['id'];

$sql_3 = "DELETE FROM cursos WHERE id = '$id'";
mysqli_query($conexao, $sql_3);

echo "<script language='javascript'>window.location='cadastrar_cursos.php?pg=curso';</script>";

}?>
</div><!-- box_curso -->


</body>
</html>