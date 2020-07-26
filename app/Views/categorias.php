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
              Categorias
            </h3>
          </section>

          <?php include('components/message.inic.php');?>
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <small>Cadastrar nova categoria no sistema</small>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <form role="form" action="/categorias/cadastrar" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="categoria">Categoria:</label>
                  <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Nome ou descrição da categoria.">
                </div>
                 <div class='input'>
                  <label class='upload' for='file'><img id="blah" width="40"/> <b id="imagem"> Selecionar imagem para categoria</b></label>
                  <input class='v-input' type="file" id='file'  onchange="readURL(this);"    name="file" />
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-raised  btn-flat">Salvar</button>
              </div>
            </form>
          </div>

      <div class="search">
        <form action="/categorias/pesquisar" method="post">
           <div class="container-input">
            <input type="search" name="search" placeholder="Digite o nome da categoria para buscar...">
          </div>
          <div class="container-btn">
            <button type="submit">Pesquisar</button>
          </div>
        </form>
      </div>

       <div class="box">
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="categorias" class="table  table-striped">
                <thead>
                  <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Opções</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($categorias as $value): ?>
                     <tr class="text-center">
                        <td><?=$value['id']?></td>
                        <td><?=$value['categoria']?></td>
                        <td>
                          <img width="40" src="<?=$value['imagem']?>"/>
                        </td>
                        <td>
                          <div class="row">
                            <a class="btn btn-sm btn-success btn-raised " href="/categorias/visualizar/<?=$value['id']?>" >Alterar</a>
                            <a  onclick="confirmDialog('Excluir categoria', 'Deseja excluir categoira mesmo?','/categorias/excluir/' + '<?=$value['id']?>')" class="btn btn-sm btn-danger btn-raised  btn-flat">Excluir</a>
                          </div>
                        </td>
                    </tr>
                  <?php endforeach?>
                </tbody>
            </table>
            
            <div> 
              <?php if(count($categorias) > 15): ?>
                <?= $pager->links() ?>
              <?php endif?>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
    </section>
  </div>
</div>
<?php include('components/script.inic.php');?>
</body>
</html>