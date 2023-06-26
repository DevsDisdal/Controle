
<!DOCTYPE html>
<html>

<head>
    <title>Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
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
                <h1>Usuários</h1>
                <div class="row">
                    <div class="col">
                        <form method="get" action="" class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Pesquisar..." name="busca"
                                value="<?php echo isset($_GET['busca']) ? $_GET['busca'] : ''; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-auto">
                        <a href="criar_user.php" class="btn btn-primary">Criar</a>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Departamento</th>
                            <th>Ramal</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Inclui o arquivo de conexão
                        include 'conexao.php';

                        // Verifica se foi realizada uma pesquisa
                        $termoPesquisa = '';
                        if (isset($_GET['busca'])) {
                            $termoPesquisa = $_GET['busca'];
                            // Consulta para obter os registros com base no termo de pesquisa
                            $sql = "SELECT * FROM funcionarios WHERE nome LIKE '%$termoPesquisa%' OR departamento LIKE '%$termoPesquisa%'";
                        } else {
                            // Consulta para obter todos os registros
                            $sql = "SELECT * FROM funcionarios";
                        }

                        // Execução da consulta
                        $result = mysqli_query($conn, $sql);

                        // Exibição dos resultados
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['nome'] . " " . $row['sobrenome'] . "</td>";
                                echo "<td>" . $row['departamento'] . "</td>";
                                echo "<td>" . $row['ramal'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>
                                        <a href='editar_user.php?id=" . $row['nome'] . "' class='btn btn-primary'>Editar</a>
                                        <form method='post' action='delete_user.php?id=" . $row['nome'] . "' style='display: inline-block;'>
                                            <button type='submit' class='btn btn-danger' onclick='return confirmDelete();'>Remover</button>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
                        }

                        // Fechamento da conexão
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Deseja realmente excluir este registro?");
        }
    </script>
</body>

</html>
