<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= esc($titulo) ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Favicon -->
  <link rel="icon" href="<?= base_url('logo.jpeg') ?>" />

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Ionicons (opcional, AdminLTE 2 recomenda) -->
  <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- AdminLTE main -->
  <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.18/css/AdminLTE.min.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.18/css/skins/_all-skins.min.css">

  <!-- jQuery Confirm -->
  <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

  <!-- Seu CSS -->
  <link rel="stylesheet" href="<?= base_url('estilo.css') ?>">
</head>

<?php
 $session = \Config\Services::session();
?>
