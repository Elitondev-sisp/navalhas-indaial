<?php
require_once('../consts.php');
require_once('../conexao.php');
if (!isset($_SESSION)) {
    session_start();
}
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
    <link href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <!-- notifications css -->
    <link rel="stylesheet" href="../assets/plugins/notifications/css/lobibox.min.css" />

    <style>
        /*custom font*/
        @import url(https://fonts.googleapis.com/css?family=Montserrat);

        /*basic reset*/
        /* * {
            margin: 0;
            padding: 0;
        } */


        /*form styles*/
        #msform {
            text-align: center;
            position: relative;
            margin-top: 30px;
        }

        #msform fieldset {
            /* background: white; */
            border: 0 none;
            border-radius: 0px;
            /* box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4); */
            padding: 20px 30px;
            box-sizing: border-box;
            width: 100%;
            /* //margin: 0 10%; */

            /*stacking fieldsets above each other*/
            position: relative;
        }

        /*Hide all except first fieldset*/
        #msform fieldset:not(:first-of-type) {
            display: none;
        }

        /*inputs*/
        /* #msform input,
        #msform textarea {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 13px;
        } */

        /* #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #ee0979;
            outline-width: 0;
            transition: All 0.5s ease-in;
            -webkit-transition: All 0.5s ease-in;
            -moz-transition: All 0.5s ease-in;
            -o-transition: All 0.5s ease-in;
        } */

        /*buttons*/
        #msform .action-button {
            width: 100px;
            background: #ee0979;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #ee0979;
        }

        #msform .action-button-previous {
            width: 100px;
            background: #C5C5F1;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #C5C5F1;
        }

        /*headings*/
        .fs-title {
            font-size: 19px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .fs-subtitle {
            font-weight: normal;
            font-size: 17px;
            /* color: #666; */
            margin-bottom: 20px;
        }

        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }

        #progressbar li {
            list-style-type: none;
            color: white;
            text-transform: uppercase;
            font-size: 9px;
            width: 33.33%;
            float: left;
            position: relative;
            letter-spacing: 1px;
        }

        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 24px;
            height: 24px;
            line-height: 26px;
            display: block;
            font-size: 12px;
            color: #333;
            background: white;
            border-radius: 25px;
            margin: 0 auto 10px auto;
        }

        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: white;
            position: absolute;
            left: -50%;
            top: 9px;
            z-index: -1;
            /*put it behind the numbers*/
        }

        #progressbar li:first-child:after {
            /*connector not needed before the first step*/
            content: none;
        }

        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar li.active:before,
        #progressbar li.active:after {
            background: green;
            color: white;
        }


        /* Not relevant to this form */
        .dme_link {
            margin-top: 30px;
            text-align: center;
        }

        .dme_link a {
            background: #FFF;
            font-weight: bold;
            color: #ee0979;
            border: 0 none;
            border-radius: 25px;
            cursor: pointer;
            padding: 5px 25px;
            font-size: 12px;
        }

        .dme_link a:hover,
        .dme_link a:focus {
            background: #C5C5F1;
            text-decoration: none;
        }

        p.selected {
            background-color: green;
            cursor: not-allowed;
        }

        p.agendado {
            background-color: #920d16;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="bg-theme bg-theme2">
    <div id="wrappezr">
        <div class="content-wrappers">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active">Horário</li>
                                <li>Serviços</li>
                                <li>Concluir</li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <h2 class="fs-title">Horário</h2>
                                <h3 class="fs-subtitle">Escolha Data e Horário para seu agendamento</h3>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="" style="text-align:center;">
                                            <label>Data</label>
                                            <input id="dataAgenda" name="dataAgenda" value="<?php echo date('Y-m-d') ?>" style="margin-left:auto;margin-right:auto;width:220px" type="date" id="autoclose-datepicker" class="form-control">
                                        </div>
                                        <label>Horários</label>
                                        <div class="row" id="div-horarios">
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="float-sm-right">
                                                    <button type="button" id="btn-confirmar-data" style="width:150px" class="next btn btn-success m-1"><i class="fa fa-check"></i> Confirmar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <h2 class="fs-title">Serviços</h2>
                                <h3 class="fs-subtitle">Selecione o serviço que deseja utilizar</h3>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                            $database = new Database();
                                            $data = date('Y-m-d');
                                            $db = $database->conectar();
                                            $sql = "SELECT id_produto, descricao, preco from produtos where tipo='S'";
                                            $req = $db->prepare($sql);
                                            $req->execute();
                                            $linhas = $req->rowCount();
                                            $html = '';
                                            if ($linhas > 0) {
                                                $i = 0;
                                                while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                                                    $i++;
                                                    $html .= '<div class="col-12">
                                                        <a data-id-servico="' . $dados["id_produto"] . '" data-desc-servico="' . $dados["descricao"] . '" class="servico" onclick="">
                                                            <p style="width:100%;" class="lightbox-thumb img-thumbnail">' . $dados["descricao"] . '<br>R$: ' . $dados["preco"] . '</p>
                                                        </a>
                                                    </div>';
                                                }
                                                echo $html;
                                            }
                                            ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="float-sm-right">
                                                    <button type="button" style="width:150px" name="previous" class="previous btn btn-danger m-1"><i class="fa fa-close"></i> Voltar</button>
                                                    <button type="button" id="btn-confirmar-servico" style="width:150px" class="next btn btn-success m-1"><i class="fa fa-check"></i> Confirmar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <h2 class="fs-title">Concluir</h2>
                                <h3 class="fs-subtitle">Confirme os dados abaixo para realizar o agendamento</h3>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th>Nome:</th>
                                                                <td id="tdNome"></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:50%">Data:</th>
                                                                <td id="tdData"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Horário</th>
                                                                <td id="tdHorario"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Serviço:</th>
                                                                <td id="tdServico"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total:</th>
                                                                <td id="tdTotal"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- /.col -->
                                        </div><!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-12">
                                                <div class="float-sm-right">
                                                    <button type="button" style="width:150px" name="previous" class="previous btn btn-danger m-1"><i class="fa fa-close"></i> Voltar</button>
                                                    <button style="width:150px" type="button" id="btn-confirmar-geral" class="btn btn-success m-1"><i class="fa fa-check"></i> Confirmar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <!-- /.link to designify.me code snippets -->
                    </div>
                </div>

                <!--start overlay-->
                <!-- <div class="overlay"></div> -->
                <!--end overlay-->
            </div>
            <!-- End container-fluid-->

        </div>
        <!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->


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
    <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script src="../assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="../assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="../assets/plugins/notifications/js/notifications.min.js"></script>
    <script src="../assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script>
        async function msgErro(sMensagem) {
            Lobibox.notify('error', {
                pauseDelayOnHover: true,
                sound: false,
                continueDelayOnInactiveTab: false,
                icon: 'fa fa-times-circle',
                position: 'center top',
                showClass: 'lightSpeedIn',
                hideClass: 'lightSpeedOut',
                width: 600,
                msg: sMensagem,
                title: 'Erro',
            });
        }
    </script>
    <!-- Custom scripts -->
    <script src="../assets/js/app-script.js"></script>
    <script>
        $(document).ready(function() {

            function buscarAgendamentos(sData) {
                var agendamentos = [];
                var html = '';
                var jqxhr = $.get(`api_agendamento.php?dataAgenda=${sData}`, function(data) {
                        agendamentos = JSON.parse(data);
                    })
                    .done(function() {
                        for (let i = 0; i < agendamentos.length; i++) {
                            const agendamento = agendamentos[i];
                            var hora = agendamento.horario;
                            var classe = agendamento.agendado == 'S' ? 'agendado' : '';
                            html += `<div class="col-4 col-md-6 col-lg-2 col-xl-2">
                            <a data-id-horario="${agendamento.id_horario}" data-desc-horario="${agendamento.horario}" class="horario">
                                <p style="width:100%;height:95%;" class="lightbox-thumb img-thumbnail ${classe}">${hora}</p>
                            </a>
                        </div>`;

                        }
                        $('#div-horarios').html(html);
                        $('.horario').on('click', function() {
                            event.preventDefault();

                            if ($('.horario p.selected').length > 0) {
                                $('.horario p.selected').removeClass('selected');
                            }
                            if ($(this).children(`:first`).hasClass('agendado')) {return;}
                            $(this).children(`:first`).addClass(`selected`);
                        });

                    })
                    .fail(function() {
                        alert("erro ao consultar agendamentos.");
                    });
            }

            var data = new Date();
            buscarAgendamentos(data.toISOString().substring(0, 10));

            $('#dataAgenda').on('change', function() {
                buscarAgendamentos($(this).val());
            });

            $('.servico').on('click', function() {
                event.preventDefault();

                if ($('.servico p.selected').length > 0) {
                    $('.servico p.selected').removeClass('selected');
                }
                $(this).children(`:first`).addClass(`selected`);
            });

            $('#autoclose-datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                dateFormat: 'dd/mm/yy',
                closeText: "Fechar",
                prevText: "&#x3C;Anterior",
                nextText: "Próximo&#x3E;",
                currentText: "Hoje",
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                nextText: 'Proximo',
                prevText: 'Anterior'
            });

            async function gravaAgenda() {
                var data = $('#dataAgenda').val();
                var idHorario = $('p.selected').closest('a.horario').attr('data-id-horario');
                var descHorario = $('p.selected').closest('a.horario p').html();
                var idServico = $('p.selected').closest('a.servico').attr('data-id-servico');
                var descServico = $('p.selected').closest('a.servico p').html().substr(0, $('p.selected').closest('a.servico p').html().indexOf('<br>'));
                var total = $('p.selected').closest('a.servico p').html().substr($('p.selected').closest('a.servico p').html().indexOf('<br>') + 8, 100);
                var nome = "<?php echo $_SESSION['nomeUsuario']; ?>";
                var idUsuario = <?php echo $_SESSION['idUsuario']; ?>;

                var agendamentos = [];
                var jqxhr = $.get(`api_agendamento.php?dataAgenda=${data}`, function(data) {
                        agendamentos = JSON.parse(data);
                    })
                    .done(function() {
                        for (let i = 0; i < agendamentos.length; i++) {
                            const agendamento = agendamentos[i];
                            if ((agendamento.id_horario == idHorario) && (agendamento.agendado == 'S')) {
                                swal("Horário indisponível, agende outro horário!", {
                                    icon: "error",
                                });
                                buscarAgendamentos(data);
                                setTimeout(function(){ $($('.previous')[$('.previous').length-1]).trigger('click'); }, 0);
                                setTimeout(function(){ $($('.previous')[$('.previous').length-2]).trigger('click'); }, 1000);
                                return;
                            }
                        }
                        $.ajax({
                            url: 'api_agendamento.php?' + jQuery.param({
                                id_usuario: idUsuario,
                                id_horario: idHorario,
                                id_servico: idServico,
                                data: data,
                                total: total
                            }),
                            type: 'POST',
                            contentType: 'application/json; charset=utf-8',
                            success: function(response) {
                                swal("Agendado com sucesso, nos vemos em breve !", {
                                    icon: "success",
                                });
                            },
                            error: function() {
                                alert("erro ao gravar agendamento");
                                return false;
                            }
                        });
                    })
                    .fail(function() {
                        swal("Horário indisponível, agende outro horário!", {
                            icon: "error",
                        });
                    });
            }
            $('#btn-confirmar-geral').on('click', async function() {
                swal({
                        title: "Tem Certeza?",
                        text: "Após confirmar, seu horário estará agendado conosco.",
                        buttons: true,
                        dangerMode: true
                    })
                    .then(async (willDelete) => {
                        if (willDelete) {
                            await gravaAgenda();
                        } else {
                            swal("Agendamento cancelado!");
                        }
                    });
            });
            //jQuery time
            var current_fs, next_fs, previous_fs; //fieldsets
            var left, opacity, scale; //fieldset properties which we will animate
            var animating; //flag to prevent quick multi-click glitches

            $(".next").on('click', async function() {
                if (animating) return false;
                animating = true;

                if ($(this).attr('id') == 'btn-confirmar-data') {
                    //valida data/horario
                    bSelecionouHorario = $('p.selected').closest('a.horario').length > 0;
                    if (!bSelecionouHorario) {
                        await msgErro('Selecione uma data e um horário para continuar.');
                        animating = false;
                        return;
                    }
                } else
                if ($(this).attr('id') == 'btn-confirmar-servico') {
                    //valida servico
                    bSelecionouServico = $('p.selected').closest('a.servico').length > 0;
                    if (!bSelecionouServico) {
                        await msgErro('Selecione um serviço para continuar.');
                        animating = false;
                        return;
                    }
                    var data = moment($('#dataAgenda').val()).format('D/MM/yyyy');
                    var descHorario = $('p.selected').closest('a.horario p').html();
                    var descServico = $('p.selected').closest('a.servico p').html().substr(0, $('p.selected').closest('a.servico p').html().indexOf('<br>'));
                    var total = $('p.selected').closest('a.servico p').html().substr($('p.selected').closest('a.servico p').html().indexOf('<br>') + 8, 100);
                    var nome = "<?php echo $_SESSION['nomeUsuario']; ?>";
                    $('#tdData').html(data);
                    $('#tdHorario').html(descHorario);
                    $('#tdServico').html(descServico);
                    $('#tdTotal').html(total);
                    $('#tdNome').html(nome);

                }

                current_fs = $(this).parent().parent().parent().parent().parent().parent();
                next_fs = $(this).parent().parent().parent().parent().parent().parent().next();

                //activate next step on progressbar using the index of next_fs
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale current_fs down to 80%
                        scale = 1 - (1 - now) * 0.2;
                        //2. bring next_fs from the right(50%)
                        left = (now * 50) + "%";
                        //3. increase opacity of next_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({
                            'transform': 'scale(' + scale + ')',
                            'position': 'absolute'
                        });
                        next_fs.css({
                            'left': left,
                            'opacity': opacity
                        });
                    },
                    duration: 500,
                    complete: function() {
                        current_fs.hide();
                        animating = false;
                    },
                    //this comes from the custom easing plugin
                    easing: 'easeInOutBack'
                });
            });

            $(".previous").click(function() {
                if (animating) return false;
                animating = true;

                current_fs = $(this).parent().parent().parent().parent().parent().parent();
                previous_fs = $(this).parent().parent().parent().parent().parent().parent().prev();

                //de-activate current step on progressbar
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                //show the previous fieldset
                previous_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale previous_fs from 80% to 100%
                        scale = 0.8 + (1 - now) * 0.2;
                        //2. take current_fs to the right(50%) - from 0%
                        left = ((1 - now) * 50) + "%";
                        //3. increase opacity of previous_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({
                            'left': left
                        });
                        previous_fs.css({
                            'transform': 'scale(' + scale + ')',
                            'opacity': opacity
                        });
                    },
                    duration: 800,
                    complete: function() {
                        current_fs.hide();
                        animating = false;
                    },
                    //this comes from the custom easing plugin
                    easing: 'easeInOutBack'
                });
            });

            $(".submit").click(function() {
                return false;
            })
            
            $('#dataAgenda').trigger('change');
        });
    </script>

</body>

</html>