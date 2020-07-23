<!DOCTYPE html>
<html>
  <?php include('components/head.inic.php');?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"> <b>SOS</b> Máquinas</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form action="/entrar" method="post" >
      <div class="form-group has-feedback">
        <input type="email" name="email" id="email" class="form-control" placeholder="Digite email de acesso">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="senha" id="senha"  class="form-control" placeholder="Digite senha de acesso">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-7">
        
        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          <button type="submit" class="btn btn-primary btn-raised btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <?php include('components/message.inic.php');?>
  
  <?php include('components/script.inic.php');?>
  <!-- /.login-box-body -->
</body>
</html>
