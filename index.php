<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Leonardo Lima">
    <meta name="description" content="CRUD simples em PHP com PHP Data Objects">
    <title>PHP - CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="/res/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
    <link rel="shortcut icon" href="/res/favicon.ico">
</head>
<body>
    <?php require_once "processaDados.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>PHP - CRUD</h1>
                <small>Por: Leonardo Lima</small><hr>
                <form action="processaDados.php" method="POST">
                    <div class="form-group">
                        <label class="control-label">Nome:</label>
                        <input type="text" name="nome" class="form-control" maxlength="70">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Senha:</label>
                        <input type="password" name="senha" class="form-control" maxlength="25">
                    </div>
                    <?php
                        if (isset($_SESSION['mensagem']) && $_SESSION['msg_tipo'] === "success") {
                            echo "<div class='alert alert-success text-center'>$_SESSION[mensagem]</div>";
                            unset($_SESSION['mensagem']);
                        }
                    ?>
                    <div class="form-group text-center">
                        <input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar">
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Senha</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $conn = new PDO("mysql:dbname=db_CRUD;host=localhost", "root", "");
                            $stmt = $conn->prepare("SELECT * FROM tb_dados");
                            $stmt->execute();
                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach($results as $row){
                                echo "<tr>";
                                foreach($row as $value){
                                    echo "<td>$value</td>";
                                }
                                echo "<td>
                                        <a class='btn btn-info'>Editar</a>
                                        <a href='processaDados.php?deletar=$row[idusuario]' class='btn btn-danger'>Deletar</a>
                                    </td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <?php
                    if (isset($_SESSION['mensagem']) && $_SESSION['msg_tipo'] === "danger") {
                        echo "<div class='alert alert-danger text-center'>$_SESSION[mensagem]</div>";
                        unset($_SESSION['mensagem']);
                    } //continuar com a parte de edição aqui
                ?>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>