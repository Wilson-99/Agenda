<?php
ob_start();//armazena os dados em cash
session_start();//inicia a secção
if(!isset($_SESSION['email']) && (!isset($_SESSION['senha']))){
  header('Location: ../index.php?acao=negado');
  exit;
}
include_once('sair.php');
//$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Electrônica</title>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="../fontawesome/css/all.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../dist/css/adminlte.css">
    <link rel="stylesheet" href="../dist/css/bootstrap.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper badge-dark">
<?php
  include_once('../conexao/conexao.php');
  $usuarioLogado = $_SESSION['email'];
  $senhaLogado = base64_encode($_SESSION['senha']);
  $selectUsuario = "SELECT * FROM usuario WHERE email=:email AND senha=:senha";
  try{
    $resultadoUsuario = $conecta ->prepare($selectUsuario); 
    $resultadoUsuario ->bindParam(':email',$usuarioLogado, PDO::PARAM_STR);
    $resultadoUsuario ->bindParam(':senha',$senhaLogado, PDO::PARAM_STR);
    $resultadoUsuario ->execute();
    
    $contar = $resultadoUsuario ->rowCount();
    if($contar>0){
      while($show = $resultadoUsuario ->FETCH(PDO::FETCH_OBJ)){
        $id = $show ->id;
        $nome = $show ->nome;
        $email = $show ->email;
        $senha = $show ->senha;
        $foto = $show ->foto;
      }
    }else{
      
      echo '<div class="container">
      <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
           &times;</button>Nenhum dado de perfil!</div>
           </div>';
    }

  }catch(PDOException $e){
    echo "<strong>ERRO DE PDO = </strong>".$e->getMessage();
  }
?>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       <!-- Sidebar user panel (optional) -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="Pefil & Sair">
        <div class="user-panel d-flex" style="margin-right:2rem;">
        <div class="info text-cyan">
          <strong></strong>
        </div>
        <div class="info text-cyan">
          <strong><?php echo $nome; ?></strong>
        </div>
        <div class="image">
          <img src="../img/<?php echo $foto; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
      </div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="home.php?acao=perfil" class="dropdown-item">
          <i class="fas fa-edit"></i> Alterar perfil
          </a>
          <div class="dropdown-divider"></div>
          <a href="?sair" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Sair
          </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../paginas/home.php?acao=bemvindo" class="brand-link">
    <i class="nav-icon fas fa-book" style="width: 50px; margin-left:20px;"></i>
      <span class="brand-text font-weight-light">Agenda Electrônica</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

     <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="home.php?acao=bemvindo" class="nav-link">
            <i class="fa-solid fa-house"></i>
              <p>
                Principal
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="home.php?acao=relatorio" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               Relatórios
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>