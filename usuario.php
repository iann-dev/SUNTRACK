<!-- Codigo em PHP -->
<?php
$usuario = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';

$conn = new mysqli(
    $host,
    $usuario,
    $senha,
    $database
);

if ($conn->connect_error) {
    die('Falha ao conectar ao banco de dados: ' . $conn->connect_error);
}

$id = isset($_POST['id']) ? $_POST['id'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buscar'])) {
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $query = "SELECT * FROM usuarios WHERE id = $id";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $usuario = $result->fetch_assoc();
                $email = $usuario['email'];
                $senha = $usuario['senha'];
            } else {
                echo "Nenhum usuário encontrado com o ID fornecido.";
            }
        } else {
            echo "ID não fornecido.";
        }
    }

    if (isset($_POST['salvar_mudancas'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $senha = $conn->real_escape_string($_POST['senha']);

        $update_query = "UPDATE usuarios SET email = '$email', senha = '$senha' WHERE id = '$id' ";

        if ($conn->query($update_query) === TRUE) {
            echo "Mudanças salvas com sucesso!";
        } else {
            echo "Erro ao salvar mudanças: " . $conn->error;
        }
    }
}

$conn->close();
?>
<!-- Codigo do HTML -->
        
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="./components/css/geral/style.css">
            <link rel="stylesheet" href="components/css/reset/reset.css">
            <link rel="styçesheet" href="./components/css/usuario/style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>SUNTRACK - User</title>
        </head>
        <body>
            <div class="cabecalho">
                <header>
                    <a href="./home.php">
                        <img src="./components/img/index/suntrack.png" alt="SUNTRACK">
                    </a>
                    <nav>
                        <a href="./index.php">
                            <button>ENTRAR</button>
                        </a>
                        <a href="formCadastro.php">
                            <button>CADASTRAR</button>
                        </a>
                    </nav>
                </header>
            </div>

            <form action="" method="post">
                <div class="container light-style flex-grow-1 container-p-y">
                    <h4 class="text-color-danger py-3 mb-4">
                        Configurações da conta
                    </h4>
                    <div class="card overflow-hidden">
                        <div class="row no-gutters row-bordered row-border-light">
                            <div class="col-md-3 pt-0">
                                <div class="list-group list-group-flush account-settings-links">
                                    <a class="list-group-item-danger list-group-item-action active" data-toggle="list"
                                        href="#account-general">Coloque seu ID</a>
                                    <a class="list-group-item-danger list-group-item-action" data-toggle="list"
                                        href="#account-change-password">Mude seu perfil</a>
                                </div>
                            </div>

                            

                            <div class="col-md-9">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="account-general">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-label">ID</label>
                                                <input id-type="text" class="form-control mb-1" id="id" name="id" value="" placeholder="Digite seu ID" required>
                                                <input type="submit" class="btn btn-warning" name="buscar" value="Buscar">&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-change-password">
                                        <div class="card-body pb-2">
                                            
                                            <div class="form-group">
                                                <label class="form-label">E-mail</label>
                                                <input type="text" class="form-control mb-1" id="email" name="email" value="<?php echo $email; ?>" placeholder="Digite seu email" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Nova senha</label>
                                                <input type="password" name="senha" class="form-control" value="<?php echo $senha; ?>" placeholder="Digite sua senha">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="text-right mt-3">
                    <input type="submit" class="btn btn-warning" name="salvar_mudancas" value="Salvar mudanças">&nbsp;

                </div>
            </div>
            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script> 
        </body>
        </html>
