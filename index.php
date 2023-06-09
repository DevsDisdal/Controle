<!DOCTYPE html>
<html>

<head>
    <title>IntraAdmin</title>
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
        }

        .sidebar ul.nav {
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
            margin-left: 200px;
            padding: 20px;
        }

        .welcome-message {
            margin-top: 100px;
            text-align: center;
            font-size: 24px;
            color: #007bff;
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
                    <h1 class="text-center">Bem-Vindo ao Intra Admin</h1>
                    <p class="welcome-message">Seja bem-vindo à nossa plataforma de administração interna.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
