<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="/" class="navbar-brand"><b>SOS</b> Máquinas</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="/">Painel Geral</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">Cadastros <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li >
                <a href="/categorias">
                  <i class="fa  fa-picture-o"></i> <span>Categorias</span>
                </a>
              </li>
              <li class="divider"></li>
              <li >
                <a href="/administradores">
                  <i class="fa fa-users"></i> <span>Administradores</span>
                </a>
              </li>
              <li class="divider"></li>
              <li >
                <a href="/publicidades">
                  <i class="fa  fa-flag"></i> <span>Publicidades</span>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="/simbolos">
                  <i class="fa fa-wrench"></i> <span>Simbolos</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"> <i class="fa fa-user"></i><b> Sessão iniciada</b></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <h4>SOS Máquinas</h4>
                <p>
                  <?=$session->get('login')['user'][0]['email'];?>
                  <small>Usuário Logado</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/sair" class="btn btn-sm btn-success btn-flat ">Sair</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-sm btn-danger btn-flat" onclick="resetDatabase()">Limpar banco de dados</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>