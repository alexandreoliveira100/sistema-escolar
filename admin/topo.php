<? $painel_atual = "admin";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require "../config.php"; ?>
<link href="css/topo.css" rel="stylesheet" type="text/css" />  
  </head>

<body>
<div id="box_menu"> 
 <div id="menu_topo"> 
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">            
           <li><a href="index.php">INÍCIO</a></li>       
           <li><a href="cadastrar_cursos.php">CADASTRAR CURSOS</a></li>        
           <li><a href="cadastrar_disciplina.php">CADASTRAR DISCIPLINAS</a></li>           
           <li><a href="professores.php">PROFESSORES</a></li>       
           <li><a href="estudantes.php?pg=todos">ESTUDANTES</a></li>   
           <li><a href="../rel/rel_alunos_class.php" target="_blank">RELATÓRIOS DE ALUNOS</a>  
           <li><a href="../rel/rel_professor_class.php" target="_blank">RELATÓRIOS DE PROFESSORES</a>   
        </ul>
      </div>
  
 </div><!-- menu_topo -->

</div><!-- box_menu -->
<div id="box_topo">
 
 <div id="mostra_login">
  <h1><strong>Seja Bem Vindo - Seu código de acesso é: <? echo @$code; ?></strong> 
  <strong><a class="top" href="../config.php?pg=sair">Sair</a></strong></h1>
  
 </div><!-- mostra_login -->

 <div id="campo_busca">
  <label>Buscar aluno</label>

  <form  method="GET" action="" enctype="multipart/form-data">

   <input type="text" name="pesquisa" />
   
   <input class="input" type="submit" name="pesquisar" value="" />
  </form>
 </div><!-- campo_busca --> 
</div><!-- box_topo -->
