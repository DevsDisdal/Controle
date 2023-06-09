
<!DOCTYPE html>
<html>
<head>
    <title>Excluir Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script>
        function redirecionar() {
            window.location.href = 'usuario.php';
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Excluir Registro</h1>

        <?php
        // Inclui o arquivo de conexão
        include 'conexao.php';

        // Verifica se o parâmetro 'id' foi fornecido na URL
        if (isset($_GET['id'])) {
            // Obtém o ID do registro a ser excluído
            $id = $_GET['id'];

            // Verifica se o formulário foi enviado (quando o usuário clica em 'Excluir')
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Exclui o registro do banco de dados
                $sql = "DELETE FROM funcionarios WHERE nome='$id'";

                if (mysqli_query($conn, $sql)) {
                    echo "<div class='alert alert-success'>Registro excluído com sucesso.</div>";
                    echo "<script>redirecionar();</script>";
                    exit(); // Certifica-se de que o script seja encerrado após o redirecionamento
                } else {
                    echo "<div class='alert alert-danger'>Erro ao excluir o registro: " . mysqli_error($conn) . "</div>";
                }
            }
        } else {
            echo "<div class='alert alert-danger'>ID do registro não fornecido.</div>";
            exit();
        }
        ?>

        <p>Você está prestes a excluir o registro com ID: <?php echo $id; ?></p>
        <p>Deseja realmente excluir este registro?</p>

        <form method="post" action="">
            <button type="submit" class="btn btn-danger">Excluir</button>
            <a href="usuario.php" class="btn btn-secondary">Cancelar</a>
        </form>

        <?php
        // Fechamento da conexão
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
