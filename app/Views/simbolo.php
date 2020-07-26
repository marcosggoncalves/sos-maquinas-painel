<!DOCTYPE html>
<html>
<?php include('components/head.inic.php');?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <?php include('components/header.inic.php');?>

    <div class="content-wrapper">
      <section class="container">
        <section class="container-header">
            <h3>
              Simbolo:
              <small><?=$simbolo['titulo']?></small>
            </h3>
          </section>

          <?php include('components/message.inic.php');?>

          <div class="box box-primary">
            <div class="row">
              <div class="col-lg-6">
                <div class="box-body">
                  <form role="form" action="/simbolos/alterar/<?=$simbolo['id']?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="titulo">Titulo:</label>
                      <input type="text" class="form-control" name="titulo" id="titulo" value="<?=$simbolo['titulo']?>">
                    </div>
                    <div class="form-group">
                      <label for="categoria_id">Categoria:</label>
                      <select class="form-control" name="categoria_id" id="categoria_id">
                        <option value="" type="hidden">Selecione uma opção caso queira alterar</option>
                        <?php foreach ($categorias as $value): ?>
                          <?php if($simbolo['categoria_id'] === $value['id']): ?>
                              <option selected value="<?=$value['id']?>"><?=$value['categoria']?></option>  
                          <?php else: ?>
                            <option value="<?=$value['id']?>"><?=$value['categoria']?></option>  
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Descrição:</label>
                      <textarea class="form-control" name="descricao" id="descricao"><?=$simbolo['descricao']?></textarea>
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
              <div class="col-lg-6">
                <div class="box-body">
                  <form role="form" action="/simbolos/item-cadastrar/<?=$simbolo['id']?>" method="post">
                    <div class="form-group">
                      <label for="categoria_simbolo_id">Simbolo</label>
                      <input type="text" class="form-control" value="<?=$simbolo['titulo']?>" disabled>
                      <input type="hidden" class="form-control" name="categoria_simbolo_id" id="categoria_simbolo_id" value="<?=$simbolo['id']?>">
                    </div>
                    <div class="form-group">
                      <label for="tipo">Tipo</label>
                      <select class="form-control" name="tipo" id="tipo">
                        <option value="">Selecione tipo: </option>
                        <option value="Solução">Solução</option>
                        <option value="Causa">Causa</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Descrição</label>
                      <textarea rows="5" cols="30"  class="form-control" name="descricao" id="descricao" ></textarea>
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success btn-raised  btn-flat">Cadastrar Causa/Solução</button>
                  </div>
                </form>  
                </div>
              </div>
            </div>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="listaSimbolos" class="table  table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">Descrição</th>
                      <th class="text-center">Opções</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($itens as $value) :?>
                        <tr class="text-center">
                          <td><?=$value['id']?></td>
                          <td>
                            <details>
                              <summary><?=$value['tipo']?></summary>
                                <?=$value['descricao']?>
                            </details>
                          </td>
                          <td>
                            <div class="row">
                              <a class="btn btn-sm btn-success btn-raised" onclick="alterarDescricaoSimbolo(`<?=$value['id']?>'`,`<?=$value['descricao']?>`,`<?=$value['tipo']?>`)" >Alterar</a>
                              <a  onclick="confirmDialog('Excluir causa/solução', 'Deseja excluir descrição do simbolo?','/simbolos/item-excluir/' + '<?=$value['id']?>/<?=$value['categoria_simbolo_id']?>')" class="btn btn-sm btn-danger btn-raised  btn-flat">Excluir</a>
                            
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                  </tbody>
              </table>

              <div> 
                <?php if(count($itens) > 15): ?>
                  <?= $pager->links() ?>
                <?php endif?>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="simbolo" tabindex="-1" role="dialog"  aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Alterar causa/solução</h5>
                  </div>
                  <div class="modal-body">
                    <form role="form" id="editlistsimbolo"  method="post">
                      <div class="form-group">
                        <label for="idSimbolo">Simbolo</label>
                        <input type="text" class="form-control"  value="<?=$simbolo['titulo']?>" disabled>
                        <input type="hidden" class="form-control" name="idSimbolo" id="idSimbolo"  value="<?=$simbolo['id']?>">
                      </div> 
                      <div class="form-group">
                        <label for="tipoList">Tipo</label>
                        <select class="form-control" name="tipoList" id="tipoList">
                          <option id="tipoListedit"></option>
                          <option value="Solução">Solução</option>
                          <option value="Causa">Causa</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Descrição</label>
                        <textarea rows="8" cols="30" class="form-control" name="descSimbolo" id="descSimboloEdir" ></textarea>
                      </div>    
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger " data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn  btn-success  btn-raised">Salvar</button>
                        </div>
                    </div>
                  </form>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /.col -->
      </section>
    </div>
  </div>
<?php include('components/script.inic.php');?>
</body>
</html>
