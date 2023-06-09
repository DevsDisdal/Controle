<!DOCTYPE html>
<html>

<head>
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .sidebar {
            background-color: #343a40;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            padding-top: 20px;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 10px;
        }

        .sidebar .nav-link:hover {
            background-color: #6c757d;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link btn btn-dark mb-2" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-dark mb-2" href="usuario.php">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-dark mb-2" href="#">Documentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger mb-2" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 content">
                <div class="container">
                    <h1>Editar Registro</h1>

                    <?php
                    // Inclui o arquivo de conexão
                    include 'conexao.php';

                    // Verifica se o parâmetro 'id' foi fornecido na URL
                    if (isset($_GET['id'])) {
                        // Obtém o ID do usuário a ser editado
                        $id = $_GET['id'];

                        // Consulta para obter os dados do usuário pelo ID
                        $sql = "SELECT * FROM funcionarios WHERE email='$id' OR nome='$id'";
                        $result = mysqli_query($conn, $sql);

                        // Verifica se o registro existe
                        if (mysqli_num_rows($result) > 0) {
                            $dados = mysqli_fetch_assoc($result);

                            // Verifica se o formulário foi enviado (quando o usuário clica em 'Atualizar')
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Verifica se a variável $nome está definida antes de usá-la
                                if (isset($_POST['nome'])) {
                                    // Obtém os novos valores enviados pelo formulário
                                    $nome = $_POST['nome'];
                                    $sobrenome = $_POST['sobrenome'];
                                    $email = $_POST['email'];
                                    $departamento = $_POST['departamento'];
                                    $ramal = $_POST['ramal'];
                                    $data_nasc = $_POST['data_nasc'];

                                    // Atualiza o registro no banco de dados
                                    $sql = "UPDATE funcionarios SET nome='$nome', sobrenome='$sobrenome', departamento='$departamento', ramal='$ramal', email='$email', data_nasc='$data_nasc' WHERE nome='$nome'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<div class='alert alert-success'>Registro atualizado com sucesso.</div>";
                                        // Redireciona para a página "usuario.php" após a atualização
                                        header("Location: usuario.php");
                                        exit(); // Certifica-se de que o script seja encerrado após o redirecionamento
                                    } else {
                                        echo "<div class='alert alert-danger'>Erro ao atualizar o registro: " . mysqli_error($conn) . "</div>";
                                    }
                                }
                            }
                            ?>

                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="nome">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                        value="<?php echo $dados['nome']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="sobrenome">Sobrenome:</label>
                                    <input type="text" class="form-control" id="sobrenome" name="sobrenome"
                                        value="<?php echo $dados['sobrenome']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="departamento">Departamento:</label>
                                    <input type="text" class="form-control" id="departamento" name="departamento"
                                        value="<?php echo $dados['departamento']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="ramal">Ramal:</label>
                                    <input type="text" class="form-control" id="ramal" name="ramal"
                                        value="<?php echo $dados['ramal']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="<?php echo $dados['email']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="data_nasc">Data de nascimento:</label>
                                    <input type="date" class="form-control" id="data_nasc" name="data_nasc"
                                        value="<?php echo $dados['data_nasc']; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                                <a href="usuario.php" class="btn btn-secondary">Cancelar</a>
                            </form>

                            <?php
                        } else {
                            echo "<div class='alert alert-danger'>Registro não encontrado.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>ID do registro não fornecido.</div>";
                    }

                    // Fechamento da conexão
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
