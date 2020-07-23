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
            Categoria:
            <small><?=$categoria['categoria']?></small>
          </h3>
          <?php include('components/message.inic.php');?>
        </section>
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/categorias/alterar/<?=$categoria['id']?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="categoria">Categoria</label>
                  <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Descrição da categoria" value="<?=$categoria['categoria']?>">
                </div>
                <div class='input'>
                  <label class='upload' for='file'><img id="blah" width="40"/> <b id="imagem"> Selecionar imagem para categoria</b></label>
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
                  <h3 class="box-title">Imagem(icone) da categoria:</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion">
                      <div class="box-body">
                          <img class="img-responsive pad" src="<?=$categoria['imagem']?>" alt="<?=$categoria['categoria']?>" width="100%">
                      </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
        <!-- /.col -->
      </section>
    </div>
  </div>
<?php include('components/script.inic.php');?>
</body>
</html>

<script>
  let  readURL = (input) =>{
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#blah').attr('src', e.target.result);
              document.getElementById('imagem').innerHTML = input.files[0]['name'];
          };
          reader.readAsDataURL(input.files[0]);
      }
    }
</script>