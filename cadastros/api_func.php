<?php
require_once('../consts.php');
require_once('../conexao.php');
date_default_timezone_set('America/Sao_Paulo');

$database = new Database();
$db = $database->conectar();

$modulo = $_GET['modulo'];
if ($modulo == 'funcionarios') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_funcionario = isset($_GET['id_funcionario']) ? $_GET['id_funcionario'] : 0;
        $nome           = $_POST['edtNome'];
        $sobrenome      = $_POST['edtSobrenome'];
        $cep            = $_POST['edtCep'];
        $rua            = $_POST['edtRua'];
        $bairro         = $_POST['edtBairro'];
        $cidade         = $_POST['edtCidade'];
        $estado         = $_POST['edtEstado'];

        if ($id_funcionario == 0) {
            $sql  = "INSERT INTO funcionarios (NOME, SOBRENOME, CEP, RUA, BAIRRO, CIDADE, ESTADO) VALUES (";
            $sql .= "'$nome', '$sobrenome', '$cep', '$rua', '$bairro',  '$cidade', '$estado' ";
            $sql .= ");";
        } else {
            $sql  = " UPDATE funcionarios SET NOME = '$nome'";
            $sql .= " , SOBRENOME = '$sobrenome'";
            $sql .= " , CEP = '$cep'";
            $sql .= " , RUA = '$rua'";
            $sql .= " , BAIRRO = '$bairro'";
            $sql .= " , CIDADE = '$cidade'";
            $sql .= " , ESTADO = '$estado'";
            $sql .= " WHERE ID_FUNCIONARIO = " . $id_funcionario;
        }

        $query = $db->prepare($sql);
        $sth = $query->execute();
        $result = ['ok'];
        echo json_encode($result);
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id_funcionario = isset($_GET['id_funcionario']) ? $_GET['id_funcionario'] : 0;
        //se tem id retorna só o usuario do id, caso contrário retorna uma lista;
        if ($id_funcionario <> 0) {
            $sql = "SELECT *
                FROM funcionarios where id_funcionario = " . $id_funcionario;
            $req = $db->prepare($sql);
            $req->execute();
            $linhas = $req->rowCount();
            if ($linhas > 0) {
                while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                    $funcionario['id'] = $dados['id_funcionario'];
                    $funcionario['nome'] = $dados['nome'];
                    $funcionario['sobrenome'] = $dados['sobrenome'];
                    $funcionario['cep'] = $dados['cep'];
                    $funcionario['rua'] = $dados['rua'];
                    $funcionario['bairro'] = $dados['bairro'];
                    $funcionario['cidade'] = $dados['cidade'];
                    $funcionario['estado'] = $dados['estado'];
                }
            }
            echo json_encode($funcionario, JSON_UNESCAPED_UNICODE);
        } else {
            //lista
            $lista = array();
            $sql = "SELECT *
                FROM funcionarios";
            $req = $db->prepare($sql);
            $req->execute();
            $linhas = $req->rowCount();
            if ($linhas > 0) {
                while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
                    $funcionario['id'] = $dados['id_funcionario'];
                    $funcionario['nome'] = $dados['nome'];
                    $funcionario['sobrenome'] = $dados['sobrenome'];
                    $funcionario['cep'] = $dados['cep'];
                    $funcionario['rua'] = $dados['rua'];
                    $funcionario['bairro'] = $dados['bairro'];
                    $funcionario['cidade'] = $dados['cidade'];
                    $funcionario['estado'] = $dados['estado'];
                    array_push($lista, $funcionario);
                }
            }
            echo json_encode($lista, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $id_funcionario = isset($_GET['id_funcionario']) ? $_GET['id_funcionario'] : 0;
        $sql  = "DELETE FROM funcionarios WHERE ID_FUNCIONARIO = ".$id_funcionario;
        $sql .= ";";

        $query = $db->prepare($sql);
        $sth = $query->execute();
        $result = ['ok'];
        echo json_encode($result);
    }
}
