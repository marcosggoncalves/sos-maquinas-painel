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
            Publicidade : <?=$publicidade['link'] ?>
          </h3>
        </section>
          <?php include('components/message.inic.php');?>
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/publicidades/alterar/<?=$publicidade['id'] ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="cliente">Nome empresa/cliente:</label>
                  <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nome do cliente ou empresa" value="<?=$publicidade['cliente']?>">
                </div>
                <div class="form-group">
                  <label for="link">Link de redirecionamento:</label>
                  <input type="text" class="form-control" name="link" id="link" placeholder="Link de redirecionamento publicidade:" value="<?=$publicidade['link']?>">
                </div>
                <div class="form-group">
                  <label for="duracao">Duração de publicidade:</label>
                  <input type="time" class="form-control" name="duracao" id="duracao" placeholder="Tempo de duração" value="<?=$publicidade['duracao']?>">
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
          <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Cliente: <?=$publicidade['cliente'] ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion">
                      <div class="box-body">
                          <img class="img-responsive pad" src="<?=$publicidade['imagem'] ?>" alt="<?=$publicidade['link'] ?>" width="100%">
                      </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          <!-- /.box -->
        </div>
    </section>
  </div>
</div>
<?php include('components/script.inic.php');?>
</body>
</html>