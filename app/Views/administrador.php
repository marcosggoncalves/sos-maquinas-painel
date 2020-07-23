<!DOCTYPE html>
<html>
   <?php include('components/head.inic.php');?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <?php include('components/header.inic.php');?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="container">
         <section class="container-header">
          <h3>
            Administrador: <?= $administrador['email']?>
          </h3>
        </section>

          <?php include('components/message.inic.php');?>

          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/administradores/alterar/<?= $administrador['id']?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email de acesso" value="<?= $administrador['email']?>">
                </div>
                <div class="form-group">
                  <label for="senha">Nova senha:</label>
                  <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha de acesso">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-raised  btn-flat">Salvar</button>
              </div>
            </form>
          </div>
      </section>
    </div>
  </div>
  <?php include('components/script.inic.php');?>
</body>

</html>