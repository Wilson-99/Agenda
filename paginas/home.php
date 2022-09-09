<?php

include_once('../includes/header.php');
if(isset($_GET['acao'])){
    $acao = $_GET['acao'];
    if($acao == 'bemvindo'){
      include_once('conteudo/cadastro_contacto.php');
    }elseif($acao == 'editar'){
      include_once('conteudo/update_contacto.php');
    }elseif($acao == 'perfil'){
      include_once('conteudo/perfil.php');
    }elseif($acao == 'relatorio'){
      include_once('conteudo/relatorio.php');
    }
  }else{
    include_once('conteudo/cadastro_contacto.php');
  }
include_once('../includes/footer.php');


  