<!--Start sidebar-wrapper-->
<?php
include_once('consts.php');
?>
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">

	<div class="brand-logo">
		<img src="<?php echo CAMINHO_LOGO ?>" class="logo-icon" alt="logo icon">
		<h5 class="logo-text"><?php echo NOME_SISTEMA; ?></h5>
		<div class="close-btn"><i class="zmdi zmdi-close"></i></div>
	</div>

	<ul class="metismenu" id="menu">
		<li><a href="<?php echo URL?>index.php">
				<div class="parent-icon"><i class='zmdi zmdi-home'></i></div>
				<div class="menu-title">Início</div>
			</a></li>
		<!-- <li>
		  <a class="has-arrow" href="javascript:void();">
			<div class="parent-icon"><i class="zmdi zmdi-view-dashboard"></i></div>
			<div class="menu-title">Dashboard</div>
		  </a>
		  <ul class="">
			<li><a href="index.html"><i class="zmdi zmdi-dot-circle-alt"></i> Painel de Vendas</a></li>
		    <li><a href="dashboard-eCommerce-v2.html"><i class="zmdi zmdi-dot-circle-alt"></i> eCommerce v2</a></li>
		    <li><a href="dashboard-human-resources.html"><i class="zmdi zmdi-dot-circle-alt"></i> Human Resources</a></li>
		    <li><a href="dashboard-digital-marketing.html"><i class="zmdi zmdi-dot-circle-alt"></i> Digital Marketing</a></li>
            <li><a href="dashboard-property-listing.html"><i class="zmdi zmdi-dot-circle-alt"></i> Property Listings</a></li>
		    <li><a href="dashboard-service-support.html"><i class="zmdi zmdi-dot-circle-alt"></i> Services & Support</a></li>
		    <li><a href="dashboard-healthcare.html"><i class="zmdi zmdi-dot-circle-alt"></i> Healthcare</a></li>
		    <li><a href="dashboard-logistics.html"><i class="zmdi zmdi-dot-circle-alt"></i> Logistics</a></li>
		  </ul> -->
		</li>

		<li>
			<a class="has-arrow" href="javascript:void();">
				<div class="parent-icon"> <i class='zmdi zmdi-layers'></i></div>
				<div class="menu-title">Cadastros</div>
			</a>
			<ul>
				<li><a href="<?PHP echo URL?>cadastros/cad_func.php"><i class="zmdi zmdi-dot-circle-alt"></i> Cadastro de Funcionários</a></li>
				<li><a href="<?PHP echo URL?>cadastros/cad_prod.php"><i class="zmdi zmdi-dot-circle-alt"></i> Cadastro de Produto</a></li>
				<li><a href="<?PHP echo URL?>cadastros/cad_serv.php"><i class="zmdi zmdi-dot-circle-alt"></i> Cadastro de Serviço</a></li>
			</ul>
		</li>

		<li>
			<a class="has-arrow" href="javascript:void();">
				<div class="parent-icon"> <i class='zmdi zmdi-calendar-check'></i></div>
				<div class="menu-title">Agendamentos</div>
			</a>
			<ul>
				<li><a href="<?PHP echo URL?>agendamentos/controle_agend.php""><i class="zmdi zmdi-dot-circle-alt"></i> Controle de Agendamentos</a></li>
			</ul>
		</li>


		<li>
			<a class="has-arrow" href="javascript:void();">
				<div class="parent-icon"> <i class='zmdi zmdi-assignment'></i></div>
				<div class="menu-title">Caixa</div>
			</a>
			<ul>
				<li><a href="#"><i class="zmdi zmdi-dot-circle-alt"></i> Controle de Caixa</a></li>
			</ul>
		</li>

		<!-- <li>
			<a class="has-arrow" href="javascript:void();">
				<div class="parent-icon"> <i class='zmdi zmdi-chart'></i></div>
				<div class="menu-title">Relatórios</div>
			</a>
			<ul>
				<li><a href="#"><i class="zmdi zmdi-dot-circle-alt"></i> Relatório de Clientes</a></li>
				<li><a href="#"><i class="zmdi zmdi-dot-circle-alt"></i> Relatório de Atendimentos</a></li>
				<li><a href="#"><i class="zmdi zmdi-dot-circle-alt"></i> Relatório de Vendas</a></li>
			</ul>
		</li> -->

		<li>
			<a class="has-arrow" href="javascript:void();">
				<div class="parent-icon"> <i class='zmdi zmdi-accounts'></i></div>
				<div class="menu-title">Usuários</div>
			</a>
			<ul>
				<li><a href="<?PHP echo URL?>sistema/cad_usuario.php"><i class="zmdi zmdi-dot-circle-alt"></i> Cadastro de Usuários</a></li>
				<li><a href="<?PHP echo URL?>sistema/cad_acesso.php"><i class="zmdi zmdi-dot-circle-alt"></i> Cadastro de Acessos</a></li>
			</ul>
		</li>
	</ul>

</div>
<!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
      <nav class="navbar navbar-expand fixed-top">

        <div class="toggle-menu">
          <i class="zmdi zmdi-menu"></i>
        </div>

        <ul class="navbar-nav align-items-center right-nav-link ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" data-toggle="dropdown" href="javascript:void();">
              <span class="user-profile"><img src="<?php echo URL?>assets/images/avatar.png" class="img-circle" alt="user avatar"><small> Usuário</small></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
              <li class="dropdown-item user-details">
                <a href="javaScript:void();">
                  <div class="media">
                    <div class="avatar"><img class="align-self-start mr-3" src="<?php echo URL?>assets/images/avatar.png" alt="user avatar"></div>
                    <div class="media-body">
                      <h6 class="mt-2 user-title"> <?php echo $_SESSION['nomeUsuario'] ?> </h6>
                      <p class="user-subtitle"><?php echo $_SESSION['telefoneUsuario'] ?> </p>
                    </div>
                  </div>
                </a>
              </li>
              <a href="<?php echo URL?>logout.php">
                <li class="dropdown-item"><i class="zmdi zmdi-power mr-3"></i>Sair</li>
              </a>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <!--End topbar header-->