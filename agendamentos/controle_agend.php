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
<html lang="en">

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
                        <h4 class="page-title">Controle de Agendamentos</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javaScript:void();">Início</a></li>
                            <li class="breadcrumb-item"><a href="javaScript:void();">Agendamentos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Controle de Agendamentos</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-13 col-xl-13">
                        <div class="card">
                            <div class="card-header">
                                Lista de Agendamentos</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tabela_produtos" class="table table-bordered table-sm table-condensed table-selected table-stripe">
                                        <thead>
                                            <tr>
                                                <th>Ações</th>
                                                <th>Data</th>
                                                <th>Horário</th>
                                                <th>Cliente</th>
                                                <th>Serviço</th>
                                                <th>Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $database = new Database();
                                            $db = $database->conectar();
                                            $sql = "SELECT agendamentos.data, agendamentos.id_horario, substr(cast(horarios.horario as varchar(200)),1,5) horario, agendamentos.id_produto, produtos.descricao, agendamentos.id_usuario, usuarios.nome, 
                                            agendamentos.preco, replace(replace(replace(replace(usuarios.telefone, '(',''),')',''),' ',''),'-','') telefone
                                            FROM agendamentos agendamentos 
                                            LEFT JOIN usuarios usuarios on usuarios.id_usuario = agendamentos.id_usuario
                                            LEFT JOIN produtos produtos on produtos.id_produto = agendamentos.id_produto
                                            LEFT JOIN horarios horarios on horarios.id_horario = agendamentos.id_horario
                                            WHERE 1=1";
                                            $req = $db->prepare($sql);
                                            $req->execute();
                                            $linhas = $req->rowCount();
                                            if ($linhas > 0) {
                                                while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                                                    $html = '
                                                            <td>
                                                            <a href="https://api.whatsapp.com/send?phone=55'.$dados['telefone'].'">
                                                            <button onclick="" data-whatsapp=' . $dados['telefone'] . ' style="padding: .375rem .75rem;" class="btn btn-light btn-whats" title="Whatsapp"><i class="zmdi zmdi-whatsapp"></i></button>
                                                            </a>
                                                            </td>
                                                            <td>' . $dados['data'] . '</td>
                                                            <td>' . $dados['horario'] . '</td>
                                                            <td>' . $dados['nome'] . '</td>
                                                            <td>' . $dados['descricao'] . '</td>
                                                            <td>' . $dados['preco'] . '</td>
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
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <!-- Custom scripts -->
    <script src="../assets/js/app-script.js"></script>
    <script>
        $(document).ready(function() {
            $('.dinheiro').mask('##.##00.00', {
                reverse: true
            });
            //Default data table
            var table = $('#tabela_produtos').DataTable({
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
                },
                columnDefs: [{
                        targets: [5],
                        render: $.fn.dataTable.render.number(',', '.', 2, 'R$')
                    },
                    {
                        targets: [1],
                        render: function(data) {
                            return moment(data).format('DD/MM/YYYY');
                        }
                    }
                ],
            });

            table.buttons().container()
                .appendTo('#tabela_produtos_wrapper .col-md-6:eq(0)');

        });
    </script>

    <!--Form Validatin Script-->
    <script src="../assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>

</body>

</html>