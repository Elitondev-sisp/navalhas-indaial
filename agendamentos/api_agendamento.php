<?php
require_once('../consts.php');
require_once('../conexao.php');
date_default_timezone_set('America/Sao_Paulo');

$database = new Database();
$db = $database->conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_REQUEST['id_usuario'];
    $id_horario = $_REQUEST['id_horario'];
    $id_servico = $_REQUEST['id_servico'];
    $data = $_REQUEST['data'];
    $total = $_REQUEST['total'];
    
    $sql  = " INSERT INTO agendamentos (data, id_horario, id_usuario, id_produto, preco) VALUES (";
    $sql .= "'$data', '$id_horario', '$id_usuario', '$id_servico', $total";
	$sql .= ");";
    $query = $db->prepare($sql);
    $sth = $query->execute();
    $result = ['ok'];
    echo json_encode($result);
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $database = new Database();
    $data = $_GET['dataAgenda'];
    $db = $database->conectar();
    $sql = "SELECT horarios.id_horario, substr(cast(horarios.horario as char),1,5) horario, 
    CASE WHEN agendamentos.id_agendamento IS NOT NULL THEN 'S' ELSE 'N' END agendado
    FROM horarios horarios
    LEFT JOIN agendamentos agendamentos on agendamentos.data = '" . $data . "' and agendamentos.id_horario = horarios.id_horario
    ORDER BY horarios.id_horario";
    $req = $db->prepare($sql);
    $req->execute();
    echo json_encode($req->fetchALL(PDO::FETCH_ASSOC));
}
