 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper text-dark">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title text-dark" style="font-size: 30px;"><strong>Lista de contactos</strong></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered able-striped">
                  <thead>
                  <tr>
                  <th style="width: 10px" class="text-center text-dark">#</th>
                  <th class="text-center text-dark">Imagem</th>
                      <th class="text-center text-dark">Nome Completo</th>
                      <th class="text-center text-dark">Email</th>
                      <th class="text-center text-dark">Telefone</th>
                      <th style="width: 40px" class="text-center text-dark">Acções</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  include('../conexao/conexao.php');
                 $select = "SELECT * FROM contactos";
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
                      <td class="text-center"><img src="../img/<?php echo $show->foto; ?>" style="width: 50px; border-radius: 100%;"></td>
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
            <!-- /.card -->
          </div>
          <!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>
