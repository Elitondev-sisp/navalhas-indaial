<?php
require_once('../consts.php');
require_once('../conexao.php');
date_default_timezone_set('America/Sao_Paulo');

$database = new Database();
$db = $database->conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : 0;
    $nome           = $_POST['edtNome'];
    $telefone       = $_POST['edtTelefone'];
    $dt_nasc        = $_POST['edtDtNasc'];
    $ativo          = $_POST['cbAtivo'] == 1 ? 'S' : 'N';

    $sql  = " UPDATE usuarios SET NOME = '$nome'";
    $sql .= " , TELEFONE = '$telefone'";
    $sql .= " , DT_NASC = '$dt_nasc'";
    $sql .= " , ATIVO = '$ativo'";
    $sql .= " WHERE ID_USUARIO = " . $id_usuario;

    $query = $db->prepare($sql);
    $sth = $query->execute();
    $result = ['ok'];
    echo json_encode($result);
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : 0;
    //se tem id retorna só o usuario do id, caso contrário retorna uma lista;
    if ($id_usuario <> 0) {
        $sql = "SELECT *
                FROM usuarios where id_usuario = " . $id_usuario;
        $req = $db->prepare($sql);
        $req->execute();
        $linhas = $req->rowCount();
        if ($linhas > 0) {
            while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                $usuario['id']       = $dados['id_usuario'];
                $usuario['nome']     = $dados['nome'];
                $usuario['telefone'] = $dados['telefone'];
                $usuario['dt_nasc']  = $dados['dt_nasc'];
                $usuario['ativo']    = $dados['ativo'];
            }
        }
        echo json_encode($usuario, JSON_UNESCAPED_UNICODE);
    } else {
        //lista
        $lista = array();
        $sql = "SELECT *
                FROM usuarios";
        $req = $db->prepare($sql);
        $req->execute();
        $linhas = $req->rowCount();
        if ($linhas > 0) {
            while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                $usuario['id']       = $dados['id_usuario'];
                $usuario['nome']     = $dados['nome'];
                $usuario['telefone'] = $dados['telefone'];
                $usuario['dt_nasc']  = $dados['dt_nasc'];
                $usuario['ativo']    = $dados['ativo'];
                array_push($lista, $usuario);
            }
        }
        echo json_encode($lista, JSON_UNESCAPED_UNICODE);
    }
} else {
    $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : 0;
    $sql  = "DELETE FROM usuarios WHERE ID_USUARIO = " . $id_usuario;
    $sql .= ";";

    $query = $db->prepare($sql);
    $sth = $query->execute();
    $result = ['ok'];
    echo json_encode($result);
}
