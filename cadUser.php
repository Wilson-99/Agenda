<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agenda Electrônica</title>

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
  <form method="POST" enctype="multipart/form-data">
    <h1 class="h3 mb-3 fw-normal text-danger">Regista-te para aceder a agenda!</h1>

    <div class="form-floating">
    <div class="input-group-text">
          <input type="text" class="form-control" name="nome"  id="nome" placeholder="exemplo de nome" required>
            <div class="input-group-append">
            &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-user"></i>
            </div>
        </div><br>  
        <div class="input-group-text">
          <input type="email" class="form-control" name="email" id="email" placeholder="nome@examplo.com" required>
            <div class="input-group-append">
            &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-envelope"></i>
            </div>
        </div>      
      <br>
          <div class="input-group-text">
            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
              <div class="input-group-append">
                &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-lock"></i>
            </div>         
    </div><br>
    <div class="form-floating">
                  <div class="input-group-text">
                    <div class="custom-file">
                      <input type="file" name="foto" class="custom-file-input" id="foto" required>
                      <label class="custom-file-label text-left" for="exampleInputFile">Arquivo de imagem</label>
                    </div>
                    <div class="input-group-append">
                &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-image"></i>
            </div>
                  </div>
                </div><br>
                </div>

    <button class="w-100 btn btn-lg btn-success" type="submit" name="submit">Registar</button><br><br>
  </form>
  <?php 
            include('conexao/conexao.php');
            if(isset($_POST['submit'])){
              $nome = $_POST['nome'];
              $senha = base64_encode($_POST['senha']);
              $email = $_POST['email'];
              $formarP = array("png", "jpg", "jpeg", "JPG", "gif");
              $extensao = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);

              if(in_array($extensao,$formarP)){
                $pasta = "img/";
                $temporario = $_FILES['foto']['tmp_name'];
                $novoNome = uniqid().".$extensao";
              
                if(move_uploaded_file($temporario,$pasta.$novoNome)){
                 $cadastro = "INSERT INTO usuario (nome,senha,email,foto) 
                 VALUES (:nome,:senha,:email,:foto)"; 
                try{
                  $result = $conecta ->prepare($cadastro);
                  $result ->bindParam(':nome',$nome,PDO::PARAM_STR);
                  $result ->bindParam(':senha',$senha,PDO::PARAM_STR);
                  $result ->bindParam(':email',$email,PDO::PARAM_STR);
                  $result ->bindParam(':foto',$novoNome,PDO::PARAM_STR);
                  $result ->execute();
                  $contar = $result ->rowCount();
                  if($contar > 0){
                    echo '<div class="container">  
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Ok!</h5>
                    Dados cadastrados com sucesso...
                  </div>
                  </div>'; 
                  header('Refresh: 3, index.php');
                  }else{
                    echo '<div class="container">  
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Erro!</h5>
                    Dados não cadastrados...
                  </div>
                  </div>'; 
                  header('Refresh: 3, cadUser.php');
                  }
                }catch(PDOException $e){
                  echo "<strong>ERRO DE PDO = </strong>".$e->getMessage();
                }
                }else{
                  echo "Erro, não foi possível carregar o arquivo!";
                }
              }else{
                echo "formato inválido!";
              }
            }
            ?>
  <p class="mb-0 text-center">
      Já tem um cadastro? <a href="index.php" style="text-decoration: none;"><b>Inicie secção!</b></a>
      </p>
      <p class="mt-5 mb-3" style="font-size: 18px;"><b>&copy;Agenda Eletrônica 2022</b></p>
</main>

<!-- jQuery -->
<script src="dist/js/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
    <script src="dist/js/bootstrap.js"></script>
</body>
</html>
