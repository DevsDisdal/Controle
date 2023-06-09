<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Usuário</title>
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
                        <a class="nav-link btn btn-danger mb-2" href="login.php">Log Out</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 content">
                <div class="container">
                    <h1>Criar Registro</h1>

                    <?php
                    // Inclui o arquivo de conexão
                    include 'conexao.php';

                    // Verifica se o formulário foi enviado (quando o usuário clica em 'Salvar')
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Verifica se as variáveis nome e email estão definidas antes de usá-las
                        if (isset($_POST['nome']) && isset($_POST['email'])) {
                            // Obtém os valores enviados pelo formulário
                            $nome = $_POST['nome'];
                            $sobrenome = $_POST['sobrenome'];
                            $email = $_POST['email'];
                            $departamento = $_POST['departamento'];
                            $ramal = $_POST['ramal'];
                            $data_nasc = $_POST['data_nasc'];

                            // Insere o registro no banco de dados
                            $sql = "INSERT INTO funcionarios (nome, sobrenome, email, departamento, ramal, data_nasc) VALUES ('$nome', '$sobrenome', '$email', '$departamento', '$ramal', '$data_nasc')";

                            if (mysqli_query($conn, $sql)) {
                                echo "<div class='alert alert-success'>Registro inserido com sucesso.</div>";
                                // Redireciona para a página "usuario.php" após a inserção
                                header("Location: usuario.php");
                                exit(); // Certifica-se de que o script seja encerrado após o redirecionamento
                            } else {
                                echo "<div class='alert alert-danger'>Erro ao inserir o registro: " . mysqli_error($conn) . "</div>";
                            }
                        }
                    }
                    ?>

                    <form method="post" action="">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="sobrenome">Sobrenome:</label>
                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
                        </div>
                        <div class="form-group">
                            <label for="departamento">Departamento:</label>
                            <input type="text" class="form-control" id="departamento" name="departamento" required>
                        </div>
                        <div class="form-group">
                            <label for="ramal">Ramal:</label>
                            <input type="text" class="form-control" id="ramal" name="ramal" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="data_nasc">Data de Nascimento:</label>
                            <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="usuario.php" class="btn btn-secondary">Cancelar</a>
                    </form>

                    <?php
                    // Fechamento da conexão
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
