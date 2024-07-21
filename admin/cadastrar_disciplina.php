<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adminstração</title>
<link href="css/cadastrar_disciplina.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php require "topo.php"; ?>
<!CADASTRAR DISCIPLINAS>


<div id="box_disciplinas">
<h1>Cadastrar nova disciplina</h1>

<!-- verifica se o botão cadastra foi clidcado, e se foi feito post--> 
<?php if(isset($_POST['cadastra'])){
	
$curso = $_POST['curso'];	
$disciplina = $_POST['disciplina'];	
$professor = $_POST['professor'];	
$sala = $_POST['sala'];	
$turno = $_POST['turno'];	

if($disciplina == ''){
	echo "<script language='javascript'>window.alert('Digite o nome da disciplina');</script>";
}else if($sala == ''){
	echo "<script language='javascript'>window.alert('Digite o nº da sala');</script>";
}else{
$sql_cad_disc = "INSERT INTO disciplinas (curso, disciplina, professor, sala, turno) VALUES ('$curso', '$disciplina', '$professor', '$sala', '$turno')";
$cad_disc = mysqli_query($conexao, $sql_cad_disc);
if($cad_disc == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro!');</script>";
}else{
	echo "<script language='javascript'>window.alert('Disciplina cadastrada com sucesso!');window.location='cadastrar_disciplina.php';</script>";
	echo "<script language='javascript'>window.location='cadastrar_disciplina.php';</script>";
  }
 }
}?>

<form name="form1" method="post" action="">
  <table width="900" border="0">
    <tr>
      <td width="134">Curso:</td>
      <td width="213">Disciplina:</td>
      <td>Professor:</td>
      <td width="128">Sala: <em>Apenas o número</em></td>
      <td width="128">Turno:</td>
      <td width="126">&nbsp;</td>
      <td width="0" colspan="2"></td>
    </tr>
    <tr>
      <td>
      <select name="curso">
      <?php
      $sql_rec_curso = "SELECT * FROM cursos";
	  $result_rec_curso = mysqli_query($conexao, $sql_rec_curso);
    
	  	while($r2 = mysqli_fetch_assoc($result_rec_curso)){
	  ?>
      	<option value="<?php echo $r2['curso']; ?>"><?php echo $r2['curso']; ?></option>
      <?php } ?>
      </select>
      </td>
      <td>
      <input type="text" name="disciplina" id="textfield"></td>
      <td width="143">
      <select name="professor">
      <?php
      $sql_result_prof = "SELECT * FROM professores WHERE nome != ''";
	    $result_rec_prof = mysqli_query($conexao,  $sql_result_prof );
	  	while($r3 = mysqli_fetch_assoc($result_rec_prof)){
	  ?>
       <option value="<?php echo $r3['code']; ?>"><?php echo $r3['nome']; ?></option>
      <?php } ?>
      </select>
      </td>
      <td>
      <input type="text" name="sala" id="textfield"></td>
      <td>
        <select name="turno" size="1" id="turno">
          <option value="Manhã">Manhã</option>
          <option value="Tarde">Tarde</option>
          <option value="Noite">Noite</option>
      </select></td>
      <td width="126"><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
    </tr>    
  </table>
</form>
</div> <!--fim da div box_disciplinas--> 

<div id="visualizar_disciplinas">
<h1>Disciplinas</h1>

<?php
$sql_buscar_disc = "SELECT * FROM disciplinas";
$result_buscar_disc = mysqli_query($conexao,  $sql_buscar_disc );
if(mysqli_num_rows($result_buscar_disc) == ''){
	echo "<h2>No momento não existe nenhuma disciplina cadastrada!</h2><br><br>";
}else{
?> 
    <table width="900" border="0">
      <tr>
        <td><strong>Curso:</strong></td>
        <td><strong>Disciplina:</strong></td>
        <td><strong>Professor:</strong></td>
        <td><strong>Sala:</strong></td>
        <td><strong>Turno:</strong></td>
      </tr>
      <?php while($res_busca = mysqli_fetch_assoc($result_buscar_disc)){ ?>
      <tr>
        <td><h3><?php echo $res_busca['curso']; ?></h3></td>
        <td><h3><?php echo $res_busca['disciplina']; ?></h3></td>
        <td><h3>
		<?php
		$professor = $res_busca['professor'];
		
		$sql_busca_prof = "SELECT * FROM professores WHERE code = '$professor'";
			$result_buscar_prof = mysqli_query($conexao,  $sql_busca_prof);
			while($res_busca2 = mysqli_fetch_assoc($result_buscar_prof)){
				echo $res_busca2['nome']; echo " - "; echo $res_busca['professor'];
			}
				
		?>
        </h3></td>
        <td><h3><?php echo $res_busca['sala']; ?></h3></td>
        <td><h3><?php echo $res_busca['turno']; ?></h3></td>
        <td><a class="a" href="cadastrar_disciplina.php?pg=disciplina&deleta=sim&id=<?php echo $res_busca['id']; ?>"><img title="Excluir Disciplina" src="img/deleta.jpg" width="18" height="18" border="0"></a></td>
      </tr>
      <?php } ?>
    </table>
<?php } ?>

</div>

<!EXCLUSÃO DAS DISCIPLINAS>
<?php if(@$_GET['deleta'] == 'sim'){

$id = $_GET['id'];

$sql_delete_disc = "DELETE FROM disciplinas WHERE id = '$id'";
mysqli_query($conexao,  $sql_delete_disc);

echo "<script language='javascript'>window.location='cadastrar_disciplina.php?pg=disciplina';</script>";

}?> 


</div><!-- box_disciplinas -->


</body>

</html>