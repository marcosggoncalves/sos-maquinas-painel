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
        Painel geral
        <small>Dados WebService</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

       <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box navbar">
              <div class="inner">
                <h3><?=$countUsuarios?></h3>
                <p>Usuários</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <a href="/usuarios" class="small-box-footer">Cadastrado no app</a>
            </div>
          </div>
        <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box navbar">
              <div class="inner">
                <h3><?=$countCategorias?></h3>
                <p>Categorias</p>
              </div>
              <div class="icon">
                <i class="fa fa-square-o"></i>
              </div>
              <a href="/categorias" class="small-box-footer">Cadastrado no app</a>
            </div>
          </div>
        <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box navbar">
              <div class="inner">
                <h3><?=$countPublicidades ?></h3>
                <p>Anúncios</p>
              </div>
              <div class="icon">
                <i class="fa fa-picture-o"></i>
              </div>
              <a href="/anuncios" class="small-box-footer">Cadastrado no app</a>
            </div>
          </div>
        <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box navbar">
              <div class="inner">
                <h3><?=$countSimbolos?></h3>
                <p>Simbolos</p>
              </div>
              <div class="icon">
                <i class="fa fa-wrench"></i>
              </div>
              <a href="/simbolos" class="small-box-footer">Cadastrado no app</a>
            </div>
          </div>
        <!-- ./col -->
      </div>
      
      <div class="row">
        <div class="col-lg-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Últimos cadastros no aplicativo</h3>
            </div>
          <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="usuarios" class="table  table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Empresa</th>
                        <th class="text-center">CPF</th>
                        <th class="text-center">Nome Completo</th>
                        <th class="text-center">Marca Veiculo</th>
                        <th class="text-center">Tipo Veiculo</th>
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
                            <td><?=$value['nome']?></td>
                            <td><?=$value['marca_veiculo']?></td>
                            <td><?=$value['tipo_veiculo']?></td>
                            <td><?=$value['email']?></td>
                            <td><?=$value['telefone']?></td>
                        </tr>
                       <?php endforeach?>
                    </tbody>
                </table>
              </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- USERS LIST -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Publicidades</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
                <?php foreach ($publicidades as $value): ?>
                 <li>
                    <img src="<?=$value['imagem']?>" alt="<?=$value['cliente']?>">
                    <a class="users-list-name" href="/anuncios/visualizar/<?=$value['id']?>"><?=$value['cliente']?></a>
                    <span class="users-list-date">Tempo: <?=$value['duracao']?></span>
                  </li>
               <?php endforeach?>
              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="/anuncios" class="uppercase">Mais</a>
            </div>
            <!-- /.box-footer -->
          </div>

          <div>
            <?php if(isset($status) && !$status): ?>
              <div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Aplicativo precisa de atenção!</h4>
                <?=$message?>
              </div>
            <?php endif ?>

            <?php if(isset($status) && $status): ?>
               <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Sincronização Agendada!</h4>
                <?=$message?>
              </div>
            <?php endif ?>

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
