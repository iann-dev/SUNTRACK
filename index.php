<!-- Codigo em PHP -->
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "login";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(empty($_POST['email'])) {
        echo "Preencha seu e-mail";
    } else if(empty($_POST['senha'])) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: usuario.php");

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}

// Close the database connection when you're done with it
$mysqli->close();
?>

<!-- Codigo do HTML -->
  
    <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="./components/css/entrar/style.css">
            <link rel="stylesheet" href="./components/css/reset/reset.css">
            <link rel="stylesheet" href="./components/css/geral/style.css">
            <title>Document</title>
        </head>
        <body>
          <div class="cabecalho">
              <header>
                  <a href="home.php">
                      <img src="./components/img/index/suntrack.png" alt="SUNTRACK">
                  </a>
                <nav>
                      <a href="./index.php">
                        <button>ENTRAR</button>
                      </a>
                      <a href="./formCadastro.php">
                          <button>CADASTRAR</button>
                      </a>            
                  </nav>
              </header>
          </div>

          <div class="titulo">
            <h1>
                Bem <span style="color:#FFA800;">vindo(a) </span> de volta!
            </h1>
            <p>Não perca seus produtos de vista, acompanhe transportadoras e receba notificações de envio e recebimento sem sair de casa. É gratuito!</p>
          </div>

          <div class="conteudo">
            <div class="caminhao">
              <img src="./components/img/entrar/caminhao2.png" alt="">
            </div>
              <div class="formulario">
                <form action="" method="post">
                    
                    <div class="form">
                      <label for="email">E-mail:</label>
                      <input type="email" id="email" name="email" placeholder="Digite o seu email">
                    </div>
          
                    <div class="form">
                      <label for="senha">Senha:</label>
                      <input type="password" name="senha" placeholder="Digite sua Senha">
                    </div>
                    <div class="formButton">
                      <input type="submit" value="ENTRAR NA SUA CONTA">
                    </div>
                </form>

              </div>
          </div>
        </body>
        </html>