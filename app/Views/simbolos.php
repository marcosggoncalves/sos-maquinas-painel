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
              Simbolos
            </h3>
          </section>

          <?php include('components/message.inic.php');?>
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <small>Cadastrar novos simbolos</small>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <form role="form" action="/simbolos/cadastrar" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="titulo">Titulo</label>
                  <input type="text" class="form-control" name="titulo" id="titulo">
                </div>
                <div class="form-group">
                  <label for="idCategoria">Categoria</label>
                  <select class="form-control" name="categoria_id" id="categoria_id" required>
                    <option value="">Selecione categoria</option>
                    <?php foreach ($categorias as $value): ?>
                      <option value="<?=$value['id']?>"><?=$value['categoria']?></option>  
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Descrição</label>
                  <textarea class="form-control" name="descricao" id="descricao" rows="3"  ></textarea>
                </div>
                <div class='input'>
                  <label class='upload' for='file'><img id="blah" width="40"/> <b id="imagem"> Selecionar imagem para simbolo</b></label>
                  <input class='v-input' type="file" id='file'  onchange="readURL(this);" accept="image/png, image/jpeg,  image/jpg"   name="imagem" />
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-raised  btn-flat">Salvar</button>
              </div>
            </form>
          </div>
      
      <div class="search">
        <form action="/simbolos/pesquisar" method="post">
           <div class="container-input">
            <input type="search" name="search" placeholder="Digite o nome do simbolo para pesquisar...">
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
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Titulo</th>
                    <th class="text-center">Imagem</th>
                    <th class="text-center">Opções</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($simbolos as $value): ?>
                     <tr class="text-center">
                        <td><?=$value['id']?></td>
                        <td>
                          <details>
                            <summary>Descrição</summary>
                              <?=$value['descricao']?>
                          </details>
                        </td>
                        <td>
                           <?=$value['categoria']?>
                        </td>
                        <td>
                           <?=$value['titulo']?>
                        </td>
                        <td>
                          <img width="40" src="<?=$value['imagem']?>"/>
                        </td>
                        <td>
                          <div class="row">
                          <a class="btn btn-sm btn-success btn-raised " href="/simbolos/visualizar/<?=$value['id']?>" >Alterar</a>
                          <a  onclick="confirmDialog('Excluir simbolo', 'Deseja excluir simbolo mesmo? todos os itens relacionado há ele será apagado.','/simbolos/excluir/' + '<?=$value['id']?>')" class="btn btn-sm btn-danger btn-raised  btn-flat">Excluir</a>
                        </div>
                        </td>
                    </tr>
                  <?php endforeach?>
                </tbody>
            </table>

            <div> 
              <?= $pager->links() ?>
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
