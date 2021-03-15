<?php
require_once('consts.php');
require_once('conexao.php');
date_default_timezone_set('America/Sao_Paulo');

$database = new Database();
$db = $database->conectar();

if (isset($_POST['edtNome'])) {
	$nome 	  = $_POST['edtNome'];
	$telefone = $_POST['edtTelefone'];
	$senha 	  = sha1($_POST['edtSenha']);
	$dt_nasc  = $_POST['edtDtNasc'];
	list ($dia, $mes, $ano) = explode('/', $dt_nasc);
	$dt_nasc= date('Y/m/d', strtotime($mes."/".$dia."/".$ano));
	$tipo = 0;

	//ver se já não existe o telefone no banco

	$sql = "SELECT *
                FROM usuarios
                WHERE telefone = '$telefone'";
	$req = $db->prepare($sql);
	$req->execute();
	$linhas = $req->rowCount();
	if ($linhas == 1) {
		header('Location: cadastro.php?erro=2');
		die;
	}

	$sql  = "INSERT INTO usuarios (NOME, SENHA, DT_NASC, TELEFONE, TIPO, ATIVO) VALUES (";
	$sql .= "'$nome', '$senha', '$dt_nasc', '$telefone', $tipo, 'S' ";
	$sql .= ");";

	$query = $db->prepare($sql);
	if ($query == false) {
		print_r($db->errorInfo());
		die('Erro ao carregar');
		header('Location: cadastro.php?erro=1');
	}

	$sth = $query->execute();
	if ($sth == false) {
		print_r($query->errorInfo());
		header('Location: cadastro.php?erro=1');
	} else {
		header("Location: login.php?msg=1");
	}
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title><?php echo TITULO_SISTEMA ?></title>
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
	<!-- Bootstrap core CSS-->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<!-- animate CSS-->
	<link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
	<!-- Icons CSS-->
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
	<!-- Custom Style-->
	<link href="assets/css/app-style.css" rel="stylesheet" />
	<style>
		::-webkit-calendar-picker-indicator {
			filter: invert(1);
		}
	</style>
</head>

<body class="bg-theme bg-theme2">

	<!-- Start wrapper-->
	<div id="wrapper">

		<div class="height-100v d-flex align-items-center justify-content-center">
			<div class="card card-authentication1 mb-0">
				<div class="card-body">
					<div class="card-content p-2">
						<div class="text-center">
							<img src="assets/images/logo-icon.png" alt="logo icon">
						</div>
						<div class="card-title text-uppercase text-center py-3">Cadastro</div>
						<form method="post">
							<div class="form-group">
								<label for="edtNome" autocomplete="off" class="sr-only">Nome</label>
								<div class="position-relative has-icon-right">
									<input type="text" id="edtNome" required name="edtNome" class="form-control input-shadow" placeholder="Nome">
									<div class="form-control-position">
										<i class="icon-user"></i>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="edtTelefone" class="sr-only">Telefone</label>
								<div class="position-relative has-icon-right">
									<input type="tel" id="edtTelefone" required name="edtTelefone" class="form-control input-shadow" placeholder="Telefone (XX) XXXXX-XXXX">
									<div class="form-control-position">
										<i class="icon-phone"></i>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="edtDatNasc" class="sr-only">Data de Nascimento</label>
								<div class="position-relative has-icon-right">
									<input type="text" id="edtDatNasc" required name="edtDtNasc" class="form-control input-shadow" placeholder="Data de Nascimento (dia/mes/ano)">
									<div class="form-control-position">
										<i class="icon-calendar"></i>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="edtSenha" class="sr-only">Senha de Acesso</label>
								<div class="position-relative has-icon-right">
									<input type="password" id="edtSenha" required name="edtSenha" class="form-control input-shadow" placeholder="Senha">
									<div class="form-control-position">
										<i id="olho" class="icon-eye"></i>
									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-light btn-block waves-effect waves-light">Cadastrar-se</button>
							<!-- Exibir mensagem de erro no login -->
							<br>
							<?php
							if (isset($_GET['erro']) && $_GET['erro'] == 1) {
								echo "<div style='text-align: center' class=\"alert alert-danger\" role=\"alert\">
								<b>Erro ao cadastrar usuário.</b>
								</div>";
							}
							if (isset($_GET['erro']) && $_GET['erro'] == 2) {
								echo "<div style='text-align: center' class=\"alert alert-danger\" role=\"alert\">
								<b>Telefone já cadastrado.</b>
								</div>";
							}
							?>
						</form>
					</div>
				</div>
				<div class="card-footer text-center py-3">
					<p class="text-warning mb-0">Já tem uma conta? <a href="login.php"> Entrar</a></p>
				</div>
			</div>
		</div>

		<!--Start Back To Top Button-->
		<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
		<!--End Back To Top Button-->

	</div>
	<!--wrapper-->

	<!-- Bootstrap core JavaScript-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Metismenu js -->
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>

	<!-- Custom scripts -->
	<script src="assets/js/app-script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#edtTelefone').mask('(00) 00000-0000');
			// $('#edtDatNasc').mousedown(function(){
			// 	$("#edtDatNasc").attr("type", "number");	
			// });

			// $('#edtDatNasc').mouseup(function(){
			// 	$("#edtDatNasc").attr("type", "text");	
			// });

			$('#edtDatNasc').mask('00/00/0000');
			$("#olho").mousedown(function() {
				$("#edtSenha").attr("type", "text");
			});

			$("#olho").mouseup(function() {
				$("#edtSenha").attr("type", "password");
			});
		});
	</script>
</body>

</html>