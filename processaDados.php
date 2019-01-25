<?php
session_start();

$conn = new PDO("mysql:dbname=db_CRUD;host=localhost", "root", "");

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