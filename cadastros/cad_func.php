<?php
require_once('../consts.php');
require_once('../conexao.php');
date_default_timezone_set('America/Sao_Paulo');
if (!isset($_SESSION)) {
    session_start();
}

$id_user = $_SESSION['idUsuario'];

if (!isset($_SESSION['idUsuario'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo TITULO_SISTEMA ?></title>
    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <!-- simplebar CSS-->
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Metismenu CSS-->
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet" />
    <!--Data Tables -->
    <link href="../assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <style>

    </style>
</head>

<body class="bg-theme bg-theme2">
    <div id="wrapper">

        <?php
        include_once('../menu.php');
        ?>
        <div class="clearfix"></div>

        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">Cadastro de Funcionários</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javaScript:void();">Início</a></li>
                            <li class="breadcrumb-item"><a href="javaScript:void();">Cadastros</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cadastros de Funcionários</li>
                        </ol>
                    </div>
                </div>
                <!-- End Breadcrumb-->
                <button type="button" class="btn btn-light waves-effect waves-light" data-toggle="modal" data-target="#modal-animation-14">+ Novo</button>
                <hr>
                <div class="row">
                    <div class="col-12 col-lg-13 col-xl-13">
                        <div class="card">
                            <div class="card-header">
                                Lista de Funcionários</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tabela_funcionarios" class="table table-bordered table-sm table-condensed table-selected table-stripe">
                                        <thead>
                                            <tr>
                                                <th>Ações</th>
                                                <th>Nome</th>
                                                <th>Sobrenome</th>
                                                <th>CEP</th>
                                                <th>Rua</th>
                                                <th>Bairro</th>
                                                <th>Cidade</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $database = new Database();
                                            $db = $database->conectar();
                                            $sql = "SELECT * FROM funcionarios ";
                                            $req = $db->prepare($sql);
                                            $req->execute();
                                            $linhas = $req->rowCount();
                                            if ($linhas > 0) {
                                                while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                                                    $html = '<td>
                                                            <button data-id-func=' . $dados['id_funcionario'] . ' style="padding: .375rem .75rem;" class="btn btn-light btn-editar" title="Editar"><i class="zmdi zmdi-border-color"></i></button>
                                                            <button data-id-func=' . $dados['id_funcionario'] . ' style="padding: .375rem .75rem;" class="btn btn-light btn-excluir" title="Remover"><i class="zmdi zmdi-delete"></i></button>
                                                            </td>
                                                            <td>' . $dados['nome'] . '</td>
                                                            <td>' . $dados['sobrenome'] . '</td>
                                                            <td>' . $dados['cep'] . '</td>
                                                            <td>' . $dados['rua'] . '</td>
                                                            <td>' . $dados['bairro'] . '</td>
                                                            <td>' . $dados['cidade'] . '</td>
                                                            <td>' . $dados['estado'] . '</td>
                                                            </tr>';
                                                    echo $html;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="modal fade" id="modal-animation-14">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content animated fadeInUp">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="titulo-modal">Novo Funcionário</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="d-none" id="edtID">
                                        <form id="form_func" class="needs-validation" novalidate>
                                            <div class="form-group row">
                                                <label for="edtNome" class="col-sm-2 col-form-label">Nome</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="edtNome" id="edtNome" required>
                                                    <div class="invalid-feedback">
                                                        Preencha um nome válido.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="edtSobrenome" class="col-sm-2 col-form-label">Sobrenome</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="edtSobrenome" id="edtSobrenome" required>
                                                    <div class="invalid-feedback">
                                                        Preencha um sobrenome válido.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="edtCEP" class="col-sm-2 col-form-label">CEP</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="edtCep" id="edtCEP" size="10" maxlength="9" onblur="pesquisacep(this.value);" required>
                                                    <div class="invalid-feedback">
                                                        Informe um CEP válido.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="edtRua" class="col-sm-2 col-form-label">Endereco</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="edtRua" id="edtRua" required>
                                                    <div class="invalid-feedback">
                                                        Informe uma Cidade válida.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="edtBairro" class="col-sm-2 col-form-label">Bairro</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="edtBairro" id="edtBairro" required>
                                                    <div class="invalid-feedback">
                                                        Informe um Bairro válido.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="edtCidade" class="col-sm-2 col-form-label">Cidade</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="edtCidade" id="edtCidade" required>
                                                    <div class="invalid-feedback">
                                                        Informe uma cidade válida.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="edtEstado" class="col-sm-2 col-form-label">Estado</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="edtEstado" id="edtEstado" required>
                                                    <div class="invalid-feedback">
                                                        Informe um estado válido.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="validationCustom07" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <button id="btn-cadastrar" class="d-none btn btn-light" type="submit">Cadastrar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="btnDesistir" type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i> Desistir</button>
                                        <button name="btnCadastrar" type="button" onclick="$('#btn-cadastrar').trigger('click');" class="btn btn-white"><i class="fa fa-check-square-o"></i> Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--start overlay-->
                <div class="overlay"></div>
                <!--end overlay-->
            </div>
            <!-- End container-fluid-->

        </div>
        <!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <?php
        include_once('../footer.php');
        ?>

    </div>
    <!--End wrapper-->


    <!-- Bootstrap core JavaScript-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- simplebar js -->
    <script src="../assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- Metismenu js -->
    <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <!--Data Tables js-->
    <script src="../assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
    <script src="../assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
    <script src="../assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
    <script src="../assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

    <!-- Custom scripts -->
    <script src="../assets/js/app-script.js"></script>
    <script>
        $(document).ready(function() {
            //Default data table
            var table = $('#tabela_funcionarios').DataTable({
                lengthChange: false,
                buttons: ['excel', 'pdf', 'print'],
                language: {
                    buttons: {
                        excel: 'Gerar EXCEL',
                        pdf: 'Gerar PDF',
                        print: 'Imprimir'
                    },
                    "emptyTable": "Nenhum registro encontrado",
                    "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "infoFiltered": "(Filtrados de _MAX_ registros)",
                    "infoThousands": ".",
                    "loadingRecords": "Carregando...",
                    "processing": "Processando...",
                    "zeroRecords": "Nenhum registro encontrado",
                    "search": "Pesquisar",
                    "paginate": {
                        "next": "Próximo",
                        "previous": "Anterior",
                        "first": "Primeiro",
                        "last": "Último"
                    },
                }
            });

            table.buttons().container()
                .appendTo('#tabela_funcionarios_wrapper .col-md-6:eq(0)');

        });
    </script>

    <script>
        // this is the id of the form
        $("#form_func").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var form = $('#form_func')[0];
            // Loop over them and prevent submission
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                form.classList.add('was-validated');
                var urlpost = 'api_func.php?modulo=funcionarios';
                var id = $('#edtID').val();
                if (id != '') {
                    urlpost = 'api_func.php?modulo=funcionarios&id_funcionario=' + id;
                }
                var forme = $(this);
                $.ajax({
                    type: "POST",
                    url: urlpost,
                    data: forme.serialize(), // serializes the form's elements.
                    success: function(data) {
                        location.href = "";
                    }
                });
            }
        });

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {

            $('.btn-editar').on('click', function() {
                $recNo = this.closest('tr').rowIndex - 1;
                $id_func = $($('#tabela_funcionarios').DataTable().data()[$recNo][0]).data()['idFunc'];
                $('#modal-animation-14').modal('show');
                $('#titulo-modal').html('Editar Funcionário: ');
                $.get("api_func.php?modulo=funcionarios&id_funcionario=" + $id_func, function(data) {
                    var obj = JSON.parse(data);
                    $('#edtID').val(obj.id);
                    $('#edtNome').val(obj.nome);
                    $('#edtSobrenome').val(obj.sobrenome);
                    $('#edtCEP').val(obj.cep);
                    $('#edtRua').val(obj.rua);
                    $('#edtBairro').val(obj.bairro);
                    $('#edtCidade').val(obj.cidade);
                    $('#edtEstado').val(obj.estado);
                });
            });

            $('.btn-excluir').on('click', function() {
                $recNo = this.closest('tr').rowIndex - 1;
                $id_func = $($('#tabela_funcionarios').DataTable().data()[$recNo][0]).data()['idFunc'];
                $.ajax({
                    type: "DELETE",
                    url: "api_func.php?modulo=funcionarios&id_funcionario=" + $id_func,
                    success: function(data) {
                        location.href = "";
                    }
                });
            });

            $('#modal-animation-14').on('hidden.bs.modal', function() {
                $('#titulo-modal').html('Novo Funcionário: ');
                $('#edtID').val('');
                $('#edtCEP').val('');
                $('#edtNome').val('');
                $('#edtSobrenome').val('');
                limpa_formulário_cep();
            })

            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <!--Form Validatin Script-->
    <script src="../assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
    <script>
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('edtRua').value = ("");
            document.getElementById('edtBairro').value = ("");
            document.getElementById('edtCidade').value = ("");
            document.getElementById('edtEstado').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('edtRua').value = (conteudo.logradouro);
                document.getElementById('edtBairro').value = (conteudo.bairro);
                document.getElementById('edtCidade').value = (conteudo.localidade);
                document.getElementById('edtEstado').value = (conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('edtRua').value = "...";
                    document.getElementById('edtBairro').value = "...";
                    document.getElementById('edtCidade').value = "...";
                    document.getElementById('edtEstado').value = "...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>

</body>

</html>