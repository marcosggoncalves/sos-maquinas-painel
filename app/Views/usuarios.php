<!DOCTYPE html>
<html>
	<?php include('components/head.inic.php');?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <?php include('components/header.inic.php');?>
  <div class="content-wrapper">
    <div class="container">
      
      <?php include('components/message.inic.php');?>
    <!-- Content Header (Page header) -->
    <section class="content-header padding">
      <h1>
        Usuários
        <small>Cadastros do aplicativo</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <div class="box-body table-responsive">
                <table id="usuarios" class="table  table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Empresa</th>
                        <th class="text-center">CPF</th>
                        <th class="text-center">Nome Completo</th>
                        <th class="text-center">Marca Veiculo</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Telefone</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($usuarios as $value): ?>
                         <tr class="text-center">
                            <td><?=$value['id']?></td>
                            <td><?=$value['empresa']?></td>
                            <td><?=$value['cpf']?></td>
                            <td><?=$value['nomeCompleto']?></td>
                            <td><?=$value['marcaVeiculo']?></td>
                            <td><?=$value['email']?></td>
                            <td><?=$value['telefone']?></td>
                        </tr>
                       <?php endforeach?>
                    </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    <!-- /.content -->
  </div>
</div>
<?php include('components/script.inic.php');?>
</body>
</html>
