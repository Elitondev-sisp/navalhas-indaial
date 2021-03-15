<?php
if (!isset($_SESSION)) {
	session_start();
}
include('conexao.php');
require_once('consts.php');
$database = new Database();
$db = $database->conectar();

if (isset($_POST) && (!empty($_POST))) {
	$telefone = $_POST['edtTelefone'];
	$senha = $_POST['edtSenha'];
	$sql = "SELECT *
                FROM usuarios
                WHERE telefone = '$telefone' AND senha = sha1('$senha') AND ATIVO = 'S'";
	$req = $db->prepare($sql);
	$req->execute();
	$linhas = $req->rowCount();
	if ($linhas == 1) {
		while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
			$id_usuario = $dados['id_usuario'];
			$nome_usuario = $dados['nome'];
			$telefone_usuario = $dados['telefone'];
			$tipo_usuario = $dados['tipo'];
			$_SESSION['idUsuario'] = $id_usuario;
			$_SESSION['nomeUsuario'] = $nome_usuario;
			$_SESSION['telefoneUsuario'] = $telefone_usuario;
			$_SESSION['tipoUsuario'] = $tipo_usuario;
		}
		$destino = $tipo_usuario == 0 ? 'agendamentos/novo_agend.php' : 'index.php';
		header('Location: '.$destino);
	} else {
		//Mensagem de erro no Login
		header('Location: login.php?erro=1');
	}
}
?>

<!DOCTYPE html>

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
						<div class="card-title text-uppercase text-center py-3">Autenticar</div>
						<form role="form" method="post">
							<div class="form-group">
								<label for="edtTelefone" class="sr-only">Telefone</label>
								<div class="position-relative has-icon-right">
									<input type="tel" autocomplete="off" id="edtTelefone" required name="edtTelefone" class="form-control input-shadow" placeholder="Telefone">
									<div class="form-control-position">
										<i class="icon-phone"></i>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="edtSenha" class="sr-only">Senha</label>
								<div class="position-relative has-icon-right">
									<input type="password" id="edtSenha" required name="edtSenha" class="form-control input-shadow" placeholder="Senha">
									<div class="form-control-position">
										<i class="icon-lock"></i>
									</div>
								</div>
							</div>
							<div class="form-group py-2">
								<div class="icheck-material-white">
									<input type="checkbox" id="cbLembrar" checked="">
									<label for="cbLembrar">Lembrar-me</label>
								</div>
							</div>
							<button id="btn-entrar" type="button" class="btn btn-light btn-block">Entrar</button>
						</form>
					</div>
				</div>
				<div class="card-footer text-center py-3">
					<!-- Exibir mensagem de erro no login -->
					<?php
					if (isset($_GET['erro']) && $_GET['erro'] == 1) {
						echo "<div style='text-align: center' class=\"alert alert-danger\" role=\"alert\">
                        <b>Usuario ou senha Incorretos!</b>
                      </div>";
					}
					if (isset($_GET['msg']) && $_GET['msg'] == 1) {
						echo "<div style='text-align: center' class=\"alert alert-success\" role=\"alert\">
                        <b>Cadastro efetuado com sucesso!</b>
                      </div>";
					}
					?>
					<p class="text-warning mb-0">Não tem uma conta? <a href="cadastro.php"> Cadastrar-se</a></p>
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
	<script src="assets/js/index.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Metismenu js -->
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>

	<!-- Custom scripts -->
	<script src="assets/js/app-script.js"></script>
	<script src="assets/js/jquery.mask.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#edtTelefone').mask('(00) 00000-0000');
			$('#edtTelefone').val(getCookie('telefone'));
			$('#edtSenha').val(getCookie('senha'));

			$('#btn-entrar').on('click', function() {
				if ($('#cbLembrar').prop('checked') == true) {
					setCookie('telefone', $('#edtTelefone').val(), 365);
					setCookie('senha', $('#edtSenha').val(), 365);
				} else {
					eraseCookie('telefone');
					eraseCookie('senha');
				}
				var form = document.forms[0];
				form.submit();
			});
		});
	</script>
</body>

</html>