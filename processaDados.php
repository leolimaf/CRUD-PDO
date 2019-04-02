<?php
session_start();

try 
{
    $conn = new PDO("mysql:dbname=db_CRUD;host=localhost", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $erro) 
{
    $mensagem = $erro->getMessage();
}

$id = 0;
$nome = '';
$senha = '';
$update = false;

if(isset($_POST['cadastrar'])) {
    if((empty($_POST['nome']) || empty($_POST['senha']))){

        $_SESSION['mensagem'] = "Os campos acima devem ser preenchidos corretamente!";
        $_SESSION['msg_tipo'] = "warning";

        header("location: index.php");
    }
}


if (isset($_POST['cadastrar']) && !empty($_POST['nome']) && !empty($_POST['senha'])) {

    $stmt = $conn->prepare("INSERT INTO tb_dados (desnome, dessenha) VALUES (:NAME, :PASSWORD)");

    $stmt->bindParam(":NAME", $_POST['nome']);
    $stmt->bindParam(":PASSWORD", $_POST['senha']);

    $stmt->execute();

    $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
    $_SESSION['msg_tipo'] = "success";

    header("location: index.php");
}

if (isset($_GET['deletar'])) {

    $stmt = $conn->prepare("DELETE FROM tb_dados WHERE idusuario = :ID");

    $stmt->bindParam(":ID", $_GET['deletar']);

    $stmt->execute();

    $_SESSION['mensagem'] = "Usuário removido com sucesso!";
    $_SESSION['msg_tipo'] = "danger";

    header("location: index.php");
}

if (isset($_GET['editar'])) {

    $stmt = $conn->prepare("SELECT * FROM tb_dados WHERE idusuario = :ID");
    $stmt->bindParam(":ID", $id);
    $id = (int) $_GET['editar'];
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $nome = $results[0]["desnome"];
    $senha = $results[0]["dessenha"];
    $update = true;

}

if (isset($_POST['editar'])) {
        
    $stmt = $conn->prepare("UPDATE tb_dados SET desnome = :NAME, dessenha = :PASSWORD WHERE idusuario = :ID");

    $stmt->bindParam(":NAME", $_POST['nome']);
    $stmt->bindParam(":PASSWORD", $_POST['senha']);
    $stmt->bindParam(":ID", $_POST['id']);

    $stmt->execute();

    $_SESSION['mensagem'] = "Os dados do usuário foram alterados com sucesso!";
    $_SESSION['msg_tipo'] = "update";

    header("location: index.php");
}