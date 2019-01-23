<?php
$conn = new PDO("mysql:dbname=db_CRUD;host=localhost", "root", "");

if (isset($_POST['cadastrar']) && !empty($_POST['nome']) && !empty($_POST['senha'])) {

    $stmt = $conn->prepare("INSERT INTO tb_dados (desnome, dessenha) VALUES (:NAME, :PASSWORD)");

    $stmt->bindParam(":NAME", $_POST['nome']);
    $stmt->bindParam(":PASSWORD", $_POST['senha']);

    $stmt->execute();
}

if (isset($_GET['deletar'])) {

    $stmt = $conn->prepare("DELETE FROM tb_dados WHERE idusuario = :ID");

    $stmt->bindParam(":ID", $_GET['deletar']);

    $stmt->execute();
}