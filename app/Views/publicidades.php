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
          Publicidades
        </h3>
      </section>

       <?php include('components/message.inic.php');?>
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <small>Cadastrar nova publicidade no sistema</small>
            </div>
           
              <div class="box-body">
                  <form role="form" action="/publicidades/cadastrar" method="post" enctype="multipart/form-data" >
                  <div class="form-group">
                    <label for="cliente">Nome empresa/cliente:</label>
                    <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nome do cliente ou empresa">
                  </div>
                  <div class="form-group">
                    <label for="link">Link de redirecionamento:</label>
                    <input type="text" class="form-control" name="link" id="link" placeholder="Link de redirecionamento publicidade:">
                  </div>
                  <div class="form-group">
                    <label for="duracao">Duração de publicidade:</label>
                    <input type="time" class="form-control" name="duracao" id="duracao" placeholder="Tempo de duração">
                  </div>
                  <div class='input'>
                    <label class='upload' for='file'><img id="blah" width="40"/> <b id="imagem"> Selecionar imagem para publicidade</b></label>
                    <input class='v-input' type="file" id='file'  onchange="readURL(this);" name="imagem" />
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
              <table id="publicidades" class="table  table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">URL/Site</th>
                      <th class="text-center">Cliente/Empresa</th>
                      <th class="text-center">Tempo</th>
                      <th class="text-center">imagem</th>
                      <th class="text-center">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($publicidades as $value): ?>
                       <tr class="text-center">
                          <td><?=$value['id']?></td>
                          <td>
                            <a href="<?=$value['link']?>" class="btn btn-sm btn-success btn-raised  btn-flat">Acessar</button>
                          </td>
                          <td><?=$value['cliente']?></td>
                          <td><?=$value['duracao']?></td>
                           <td>
                            <img width="40" src="<?=$value['imagem']?>"/>
                          </td>
                          <td>
                            <div class="row">
                              <a class="btn btn-sm btn-success btn-raised " href="/publicidades/visualizar/<?=$value['id']?>" >Alterar</a>
                              <a  onclick="confirmDialog('Excluir publicidade', 'Deseja excluir publicidade mesmo?','/publicidades/excluir/' + '<?=$value['id']?>')" class="btn btn-sm btn-danger btn-raised  btn-flat">Excluir</a>
                            </div>
                          </td>
                      </tr>
                    <?php endforeach?>
                  </tbody>
              </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
  </div>
</div>
<?php include('components/script.inic.php');?>
</body>
</html>