<!DOCTYPE html>
<html>
<head>
    <title>Login e Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div id="loginForm">
                <div class="user-icon">
                    <i class="bi bi-person-circle" style="font-size: 48px;"></i>
                </div>
                <h2 class="text-center">Login</h2>
                <form method="post" action="login.php">
                    <div class="form-group">
                        <label for="login_usuario">Usuário:</label>
                        <input type="text" class="form-control" id="login_usuario" name="login_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="login_senha">Senha:</label>
                        <input type="password" class="form-control" id="login_senha" name="login_senha" required>
                    </div><br>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
                <hr>
                <p class="text-center">Não possui uma conta? <button id="cadastroBtn" class="btn btn-link">Cadastre-se</button></p>
            </div>

            <?php
            // Inclui o arquivo de conexão
            include 'conexao.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Obtém os valores enviados pelo formulário
                $login_usuario = $_POST['login_usuario'];
                $login_senha = $_POST['login_senha'];

                // Consulta o banco de dados para validar o usuário e a senha
                $sql = "SELECT * FROM user_adm WHERE usuario='$login_usuario'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['senha'] === $login_senha) {
                        // Autenticação bem-sucedida, redireciona para a página usuario.php
                        header("Location: usuario.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Senha incorreta.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Usuário não encontrado.</div>";
                }
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastro_usuario'])) {
                // Obtém os valores enviados pelo formulário
                $cadastro_usuario = $_POST['cadastro_usuario'];
                $cadastro_senha = $_POST['cadastro_senha'];
                $confirmacao_senha = $_POST['confirmacao_senha'];

                // Verifica se a senha e a confirmação de senha são iguais
                if ($cadastro_senha !== $confirmacao_senha) {
                    echo "<div class='alert alert-danger'>A senha e a confirmação de senha não coincidem.</div>";
                } else {
                    // Insere o novo usuário no banco de dados
                    $sql = "INSERT INTO user_adm (usuario, senha) VALUES ('$cadastro_usuario', '$cadastro_senha')";
                    if (mysqli_query($conn, $sql)) {
                        echo "<div class='alert alert-success'>Usuário cadastrado com sucesso.</div>";
                        echo "<script>setTimeout(function() { window.location.href = 'login.php'; }, 3000);</script>";
                    } else {
                        echo "<div class='alert alert-danger'>Erro ao cadastrar usuário: " . mysqli_error($conn) . "</div>";
                    }
                }
            }
            ?>

            <div id="cadastroForm" style="display: none;">
                <div class="user-icon">
                    <i class="bi bi-person-circle" style="font-size: 48px;"></i>
                </div>
                <h2 class="text-center">Cadastro de Usuário</h2>
                <form method="post" action="login.php">
                    <div class="form-group">
                        <label for="cadastro_usuario">Usuário:</label>
                        <input type="text" class="form-control" id="cadastro_usuario" name="cadastro_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="cadastro_senha">Senha:</label>
                        <input type="password" class="form-control" id="cadastro_senha" name="cadastro_senha" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmacao_senha">Confirmação de Senha:</label>
                        <input type="password" class="form-control" id="confirmacao_senha" name="confirmacao_senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <button type="button" class="btn btn-danger back-button" onclick="voltarParaLogin()">Voltar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("cadastroBtn").addEventListener("click", function() {
            document.getElementById("loginForm").style.display = "none";
            document.getElementById("cadastroForm").style.display = "block";
        });

        function voltarParaLogin() {
            document.getElementById("loginForm").style.display = "block";
            document.getElementById("cadastroForm").style.display = "none";
        }
    </script>
</body>
</html>
