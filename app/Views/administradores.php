<!DOCTYPE html>
<html>
	 <?php include('components/head.inic.php');?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <?php include('components/header.inic.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
     <section class="container">
          
          <section class="container-header">
            <h3>
              Administradores
            </h3>
          </section>

          <?php include('components/message.inic.php');?>

          <div class="box box-primary">
            <div class="box-header with-border">
              <small>Cadastrar novo admnistrador no sistema!</small>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <form role="form" action="/administradores/cadastrar" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email de acesso">
                </div>
                <div class="form-group">
                  <label for="senha">Senha</label>
                  <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha de acesso">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-raised  btn-flat">Salvar</button>
              </div>
            </form>
          </div>

      <div class="box">
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="users" class="table  table-striped">
                <thead>
                  <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Opções</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($usuarios as $value): ?>
                     <tr class="text-center">
                        <td><?=$value['id']?></td>
                        <td><?=$value['email']?></td>
                        <td>
                          <div class="row">
                            <a class="btn btn-sm btn-success btn-raised " href="/administradores/visualizar/<?=$value['id']?>" >Alterar</a>
                            <a  onclick="confirmDialog('Excluir usuário', 'Deseja excluir usuário mesmo?','/administradores/excluir/' + '<?=$value['id']?>')" class="btn btn-sm btn-danger btn-raised  btn-flat">Excluir</a>
                          </div>
                        </td>
                    </tr>
                  <?php endforeach?>
                </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
    </section>
  </div>
</div>
<?php include('components/script.inic.php');?>
</body>
</html>

<script>
    let excluirUsuario = (id)=>{
        if(confirm("Deseja excluir usuário?")){
          window.location.href = "/administradores/excluir/" + id;
        }
    }
</script>

