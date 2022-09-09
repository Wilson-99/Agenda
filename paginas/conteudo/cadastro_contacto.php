 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 text-dark">
          <h1>Cadastro de contactos</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Cadastrar contacto</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="card-body text-dark">
              <div class="form-group">
                  <label for="exampleInputNome1">Nome Completo</label>
                  <input type="text" name="nome" required class="form-control" id="nome" placeholder="nome completo">
                </div>
                <div class="form-group">
                  <label for="exampleInputTelefone1">Telefone</label>
                  <input type="text" name="telefone" class="form-control" id="telefone" placeholder="(+244)">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="email">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Foto</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="foto" class="custom-file-input" id="foto">
                      <label class="custom-file-label" for="exampleInputFile">Arquivo de imagem</label>
                    </div>
                  </div>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" required id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Autorizo o cadastro do contacto</label>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-success">Confirmar</button>
              </div>
            </form>
            <?php 
            if(isset($_POST['submit'])){
              $nome = $_POST['nome'];
              $telefone = $_POST['telefone'];
              $email = $_POST['email'];
              $usuario_id = 1;
              $formarP = array("png", "jpg", "jpeg", "JPG", "gif");
              $extensao = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);

              if(in_array($extensao,$formarP)){
                $pasta = "../img/";
                $temporario = $_FILES['foto']['tmp_name'];
                $novoNome = uniqid().".$extensao";

                if(move_uploaded_file($temporario,$pasta.$novoNome)){
                 $cadastro = "INSERT INTO contactos (nome,telefone,email,foto,usuario_id) 
                 VALUES (:nome,:telefone,:email,:foto,:usuario_id)"; 
                
                try{
                  $result = $conecta ->prepare($cadastro);
                  $result ->bindParam(':nome',$nome,PDO::PARAM_STR);
                  $result ->bindParam(':telefone',$telefone,PDO::PARAM_STR);
                  $result ->bindParam(':email',$email,PDO::PARAM_STR);
                  $result ->bindParam(':foto',$novoNome,PDO::PARAM_STR);
                  $result ->bindParam(':usuario_id',$usuario_id,PDO::PARAM_INT);
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
                  header('Refresh: 3, home.php');
                  }else{
                    echo '<div class="container">  
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Erro!</h5>
                    Dados não cadastrados...
                  </div>
                  </div>'; 
                  header("Refresh: 3, home.php");
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
          </div>
        </div>
          <!-- /.card -->
          <div class="col-md-8">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Contactos Recentes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped text-dark">
                  <thead>
                    <tr>
                      <th style="width: 10px" class="text-center">#</th>
                      <th class="text-center">Nome Completo</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Telefone</th>
                      <th style="width: 40px" class="text-center">Acções</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                
                 $select = "SELECT * FROM contactos ORDER BY id DESC LIMIT 5";
                 try{
                  $result = $conecta ->prepare($select);
                  $cont = 1;
                  $result ->execute();

                  $contar = $result->rowCount();
                  if($contar > 0){
                    while($show = $result->FETCH(PDO::FETCH_OBJ)){
                      
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $cont++; ?></td>
                      <td class="text-center"><?php echo $show->nome; ?></td>
                      <td class="text-center"><?php echo $show->email; ?></td>
                      <td class="text-center"><?php echo $show->telefone; ?></td>
                      <td class="text-center"><div class="btn-group">
                        <a href="home.php?acao=editar&id=<?php echo $show->id; ?>" class="btn btn-warning" title="editar contacto"><i class="fas fa-user-edit"></i></a>&nbsp;
                        <a href="conteudo/delContacto.php?idDel=<?php echo $show->id; ?>" onclick="return confirm('Deseja remover o contacto?')" class="btn btn-danger" title="remover contacto"><i class="fas fa-user-times"></i></a>
                      </div></td>
                    </tr>
                    <?php
                   }

                  }else{
                    echo '<div class="container">  
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Erro!</h5>
                    Dados não cadastrados...
                  </div>
                  </div>'; 
                  }
                 }catch(PDOException $e){
                  echo "<strong>ERRO DE PDO = </strong>".$e->getMessage(); 
                 }
                 ?>
                  </tbody>
                </table>
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
