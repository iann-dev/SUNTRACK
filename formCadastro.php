<!-- codigo php -->

<?php

include('./conexao.php');

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro no cadastro: " . $conn->error;
    }
}

$conn->close();
?>


<!-- codigo html -->
<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./components/css/cadastro/style.css">
        <link rel="stylesheet" href="./components/css/reset/reset.css">
        <link rel="stylesheet" href="./components/css/geral/style.css">
        <title>Document</title>
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
                  <a href="./formCadastro.php">
                      <button>CADASTRAR</button>
                  </a>            
              </nav>
          </header>
      </div>

      <div class="titulo">
        <h1>
            Faça seu <span style="color:#FFA800;">cadastro </span> já!
        </h1>
        <p>Não perca seus produtos de vista, acompanhe transportadoras e receba notificações de envio e recebimento sem sair de casa. É gratuito!</p>
      </div>

      <div class="conteudo">
        <div class="caminhao">
          <img src="./components/img/cadastro/caminhão.png" alt="">
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
                  <input type="submit" value="FINALIZAR CADASTRO">
                </div>
            </form>

          </div>
      </div>
    </body>
    </html>