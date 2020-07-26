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
        Sincronizações
        <small>Dados no aplicativo</small>
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
                        <th class="text-center">Agendado em</th>
                        <th class="text-center">Usuário</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Realizado</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($atualizacoes as $value): ?>
                         <tr class="text-center">
                            <td><?=$value['id']?></td>
                            <td><?=date_format(date_create($value['atualizacao']), "d/m/Y H:i:s");?></td>
                            <td><?=$value['email']?></td>
                            <?php if($value['status'] === 'Concluido'): ?>
                              <td><span class="label label-success"><?=$value['status']?> </span></td>
                            <?php else: ?>
                              <td><span class="label label-warning"><?=$value['status']?> </span></td>
                            <?php endif; ?>
                            <?php if(empty($value['realizado'])): ?>
                              <td>Atualização não realizada</td>
                            <?php else: ?>
                             <td><?=date_format(date_create($value['realizado']), "d/m/Y H:i:s");?></td>
                            <?php endif; ?>
                        </tr>
                       <?php endforeach?>
                    </tbody>
                </table>

                <div> 
                   <?php if(count($atualizacoes) > 15): ?>
                      <?= $pager->links() ?>
                    <?php endif?>
                </div>
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
