<?php
require_once('../consts.php');
require_once('../conexao.php');
date_default_timezone_set('America/Sao_Paulo');

$database = new Database();
$db = $database->conectar();

$modulo = $_GET['modulo'];
if ($modulo == 'produtos') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_produto = isset($_GET['id_produto']) ? $_GET['id_produto'] : 0;
        $codigo           = $_POST['edtCodigo'];
        $descricao        = $_POST['edtDescricao'];
        $preco            = $_POST['edtPreco'];

        if ($id_produto == 0) {
            $sql  = "INSERT INTO produtos (CODIGO, DESCRICAO, PRECO, TIPO) VALUES (";
            $sql .= "'$codigo', '$descricao', '$preco', 'P'";
            $sql .= ");";
        } else {
            $sql  = " UPDATE produtos SET CODIGO = '$codigo'";
            $sql .= " , DESCRICAO = '$descricao'";
            $sql .= " , PRECO = '$preco'";
            $sql .= " WHERE ID_PRODUTO = " . $id_produto;
        }

        $query = $db->prepare($sql);
        $sth = $query->execute();
        $result = ['ok'];
        echo json_encode($result);
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id_produto = isset($_GET['id_produto']) ? $_GET['id_produto'] : 0;
        //se tem id retorna só o usuario do id, caso contrário retorna uma lista;
        if ($id_produto <> 0) {
            $sql = "SELECT *
                FROM produtos where id_produto = " . $id_produto;
            $req = $db->prepare($sql);
            $req->execute();
            $linhas = $req->rowCount();
            if ($linhas > 0) {
                while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                    $produto['id'] = $dados['id_produto'];
                    $produto['codigo'] = $dados['codigo'];
                    $produto['descricao'] = $dados['descricao'];
                    $produto['preco'] = $dados['preco'];
                }
            }
            echo json_encode($produto, JSON_UNESCAPED_UNICODE);
        } else {
            //lista
            $lista = array();
            $sql = "SELECT *
                FROM produtos WHERE TIPO = 'P'";
            $req = $db->prepare($sql);
            $req->execute();
            $linhas = $req->rowCount();
            if ($linhas > 0) {
                while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                    $produto['id'] = $dados['id_produto'];
                    $produto['codigo'] = $dados['codigo'];
                    $produto['descricao'] = $dados['descricao'];
                    $produto['preco'] = $dados['preco'];
                    array_push($lista, $produto);
                }
            }
            echo json_encode($lista, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $id_produto = isset($_GET['id_produto']) ? $_GET['id_produto'] : 0;
        $sql  = "DELETE FROM produtos WHERE ID_PRODUTO = ".$id_produto;
        $sql .= ";";

        $query = $db->prepare($sql);
        $sth = $query->execute();
        $result = ['ok'];
        echo json_encode($result);
    }
}
