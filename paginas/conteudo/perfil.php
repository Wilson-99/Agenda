 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper text-dark">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar perfil</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
  
        <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Editar perfil</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">
              <div class="card-body">
              <div class="form-group">
                  <label for="exampleInputNome1">Nome Completo</label>
                  <input type="text" name="nome" required class="form-control" id="nome" value="<?php echo $nome; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" required class="form-control" id="email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputSenha1">Senha</label>
                  <input type="password" name="senha" required class="form-control" id="senha" value="<?php echo base64_decode($senha); ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Foto do Usuario</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="foto" required class="custom-file-input" id="foto">
                      <label class="custom-file-label" for="exampleInputFile">Arquivo de imagem</label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" name="update" class="btn btn-success">Confirmar</button>
              </div>
            </form>
            <?php 
            if(isset($_POST['update'])){
              $nome = $_POST['nome'];
              $senha = base64_encode($_POST['senha']);
              $email = $_POST['email'];

              if(!empty($_FILES['foto']['name'])){
              $formarP = array("png", "jpg", "jpeg", "JPG", "gif");
              $extensao = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);

              if(in_array($extensao,$formarP)){
                $pasta = "../img/";
                $temporario = $_FILES['foto']['tmp_name'];
                $novoNome = uniqid().".$extensao";

                if(move_uploaded_file($temporario,$pasta.$novoNome)){
                
                }else{
                  echo "Erro, não foi possível fazer carregar o arquivo!";
                }
              }else{
                echo "formato inválido!";
              }
            }else{
              $novoNome = $foto;
            }
            $update = "UPDATE usuario SET nome=:nome,senha=:senha,email=:email,foto=:foto
            WHERE id=:id"; 
           
           try{
             $result = $conecta ->prepare($update);
             $result ->bindParam(':id',$id,PDO::PARAM_INT);
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
               Dados actualizados com sucesso...
             </div>
             </div>'; 
             header('Refresh:3, ?sair');
             }else{
               echo '<div class="container">  
               <div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h5><i class="icon fas fa-check"></i> Erro!</h5>
               Dados não actualizados...
             </div>
             </div>'; 
             }
           }catch(PDOException $e){
             echo "<strong>ERRO DE PDO = </strong>".$e->getMessage();
           }
              /*echo $nome."<br>";
              echo $senha."<br>";
              echo $email."<br>";
              var_dump($_FILES['foto']);*/
            }
            ?>
          </div>
        </div>
          <!-- /.card -->
          <div class="col-md-6">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title card-primary">Dados do perfil</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="margin-bottom: 98px; text-align:center;">
                <img src="../img/<?php echo $foto; ?>" alt="<?php echo $foto; ?>" style="width: 200px; border-radius: 100%; margin-top: 30px;">
                <h1><?php echo $nome; ?></h1>
                <p><?php echo $email; ?></p>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
