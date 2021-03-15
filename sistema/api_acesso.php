<?php
require_once('../consts.php');
require_once('../conexao.php');
date_default_timezone_set('America/Sao_Paulo');

$database = new Database();
$db = $database->conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_acesso = isset($_GET['id_acesso']) ? $_GET['id_acesso'] : 0;

    if ($id_acesso != 0) {
        // $nome           = $_POST['edtNome'];
        // $telefone       = $_POST['edtTelefone'];
        // $dt_nasc        = $_POST['edtDtNasc'];
        // $ativo          = $_POST['cbAtivo'] == 1 ? 'S' : 'N';

        // $sql  = " UPDATE acesso_usuarios SET CONSULTA = '$consulta'";
        // $sql .= " WHERE ID_ACESSO = " . $id_acesso;

        $query = $db->prepare($sql);
        $sth = $query->execute();
        $result = ['ok'];
        echo json_encode($result);
    } else {
        $id_menu    = $_POST['id_menu'];
        $id_usuario = $_POST['id_usuario'];
        $consulta   = $_POST['consulta'];

        $query = $db->prepare($sql);
        $sth = $query->execute();
        $result = ['ok'];
        echo json_encode($result);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_acesso = isset($_GET['id_acesso']) ? $_GET['id_acesso'] : 0;
    //se tem id retorna só o acesso do id, caso contrário retorna uma lista;
    if ($id_acesso <> 0) {
        $sql = "SELECT acesso_usuarios.id_acesso, usuarios.id_usuario, menus.id_menu, usuarios.nome, menus.nome nome_menu, acesso_usuarios.consulta 
                FROM usuarios 
                LEFT JOIN menus menus on 1=1 
                LEFT JOin acesso_usuarios acesso_usuarios on acesso_usuarios.id_menu = menus.id_menu and acesso_usuarios.id_usuario = usuarios.id_usuario 
                WHERE usuarios.ativo = 'S' and acesso_usuarios.id_acesso = $id_acesso
                ORDER BY id_usuario, id_menu";
        $req = $db->prepare($sql);
        $req->execute();
        $linhas = $req->rowCount();
        if ($linhas > 0) {
            while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                $usuario['id_acesso']    = $dados['id_acesso'];
                $usuario['id_usuario']   = $dados['id_usuario'];
                $usuario['id_menu']      = $dados['id_menu'];
                $usuario['nome']         = $dados['nome'];
                $usuario['nome_menu']    = $dados['nome_menu'];
                $usuario['consulta']     = $dados['consulta'];
            }
        }
        echo json_encode($usuario, JSON_UNESCAPED_UNICODE);
    } else {
        //lista
        $lista = array();
        $sql = "SELECT acesso_usuarios.id_acesso, usuarios.id_usuario, menus.id_menu, usuarios.nome, menus.nome nome_menu, acesso_usuarios.consulta 
                FROM usuarios 
                LEFT JOIN menus menus on 1=1 
                LEFT JOin acesso_usuarios acesso_usuarios on acesso_usuarios.id_menu = menus.id_menu and acesso_usuarios.id_usuario = usuarios.id_usuario 
                WHERE usuarios.ativo = 'S' 
                ORDER BY id_usuario, id_menu";
        $req = $db->prepare($sql);
        $req->execute();
        $linhas = $req->rowCount();
        if ($linhas > 0) {
            while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                $usuario['id_acesso']    = $dados['id_acesso'];
                $usuario['id_usuario']   = $dados['id_usuario'];
                $usuario['id_menu']      = $dados['id_menu'];
                $usuario['nome']         = $dados['nome'];
                $usuario['nome_menu']    = $dados['nome_menu'];
                $usuario['consulta']     = $dados['consulta'];
                array_push($lista, $usuario);
            }
        }
        echo json_encode($lista, JSON_UNESCAPED_UNICODE);
    }
}
