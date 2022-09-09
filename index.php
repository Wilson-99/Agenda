<?php
ob_start();//armazena os dados em cash
session_start();//inicia a secção
if(isset($_SESSION['email']) && (isset($_SESSION['senha']))){
  header('Location: paginas/home.php');
}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Eletrônica</title>
      <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="fontawesome/css/all.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/signin.css">
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.css">
</head>
<body class="text-center bg-secondary">
<main class="form-signin bg-white" style="border-radius: 10px;">
  <form method="POST">
    <h1 class="h2 mb-3 fw-normal text-danger">Inicie secção</h1>

    <div class="form-floating">
        <div class="input-group-text">
          <input type="email" class="form-control" name="email" id="email" placeholder="nome@examplo.com">
            <div class="input-group-append">
            &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-envelope"></i>
            </div>
        </div>      
    <br>
      <div class="form-floating">
          <div class="input-group-text">
            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
              <div class="input-group-append">
                &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-lock"></i>
            </div>
        </div>         
    </div><br>
    <button class="w-100 btn btn-lg btn-success" name="login" type="submit">Entrar</button><br><br>
    </div>
  </form>
  <?php
        include_once ('conexao/conexao.php');
        //método de acção negado!
        if(isset($_GET['acao'])){
          $acao = $_GET['acao'];
          if($acao == 'negado'){
            echo '<div class="container">  
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> 
            ERRO! Efectue o login para acessar o sistema.
            </h5>
          </div>
          </div>';
          header("Refresh: 3, index.php");
          }else if($acao == 'sair'){
            echo '<div class="container">  
            <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> 
            Você saiu da agenda. Volte em breve!
            </h5>
          </div>
          </div>';
          header("Refresh: 3, index.php");
          }
        }
        //Criação da secção de login
        if(isset($_POST['login'])){
          $login = filter_input(INPUT_POST,'email',FILTER_DEFAULT);
          $senha = base64_encode(filter_input(INPUT_POST,'senha',FILTER_DEFAULT));
          
          
          $select = "SELECT * FROM usuario WHERE email=:email AND senha=:senha";
          try{
            $resultLogin = $conecta->prepare($select);
            $resultLogin ->bindParam(':email',$login,PDO::PARAM_STR);
            $resultLogin ->bindParam(':senha',$senha,PDO::PARAM_STR);
            $resultLogin ->execute();

            $contar = $resultLogin ->rowCount();
            if($contar>0){
              $login = $_POST['email'];
              $senha = $_POST['senha'];
             
              //inicio de seccção
              $_SESSION['email'] = $login;
              $_SESSION['senha'] = $senha;
              
              echo '<div class="container">  
              <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-check"></i> 
              OK! Você será redirecionado para a agenda.
            </h5>
            </div>
            </div>';
            header("Refresh: 3, paginas/home.php?acao=bemvindo");
            }else{
              echo '<div class="container">  
              <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-check"></i> 
              ERRO! Não existe um usuário com esses dados. Faça um cadastro!
              </h5>
            </div>
            </div>';
            header("Refresh: 3, index.php");
            }
          }catch(PDOException $e){
            echo "<strong>ERRO DE PDO = </strong>".$e->getMessage();
          }

        }
      ?>
  <p class="mb-0 text-center">
      Ainda não tem um cadastro? <a href="cadUser.php" class="text-center" style="text-decoration: none;"><b>Registar!</b></a>
      </p>
      <p class="mt-5 mb-3" style="font-size: 18px;"><b>&copy;Agenda Eletrônica 2022</b></p>
</main>

<!-- jQuery -->
<script src="dist/js/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
    <script src="dist/js/bootstrap.js"></script>  
</body>
</html>