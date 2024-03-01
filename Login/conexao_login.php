<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $conexao = mysqli_connect("localhost", "usuario", "1234", "nome_do_banco_de_dados");

    // Verifica se a conexão foi bem-sucedida
    if (!$conexao) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Escapa os dados do formulário para prevenir SQL injection
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // Consulta SQL para verificar se o email e senha existem na tabela de investidores PF
    $sql_investidor_pf = "SELECT * FROM investidor_pf WHERE email_pf = '$email' AND senha_pf = '$senha'";
    $resultado_investidor_pf = mysqli_query($conexao, $sql_investidor_pf);

    // Consulta SQL para verificar se o email e senha existem na tabela de investidores PJ
    $sql_investidor_pj = "SELECT * FROM investidor_pj WHERE email_pj = '$email' AND senha_pj = '$senha'";
    $resultado_investidor_pj = mysqli_query($conexao, $sql_investidor_pj);

    // Consulta SQL para verificar se o email e senha existem na tabela de startups
    $sql_startup = "SELECT * FROM startup WHERE email_startup = '$email' AND senha_startup = '$senha'";
    $resultado_startup = mysqli_query($conexao, $sql_startup);

    // Verifica em qual tabela o email e senha estão registrados
    if (mysqli_num_rows($resultado_investidor_pf) == 1) {
        // Redireciona para a página inicial do investidor PF após o login bem-sucedido
        header("Location: /Inova Start/PaginaInicial/pagina_inicial.html");
        exit;
    } elseif (mysqli_num_rows($resultado_investidor_pj) == 1) {
        // Redireciona para a página inicial do investidor PJ após o login bem-sucedido
        header("Location: /Inova Start/PaginaInicial/pagina_inicial.html");
        exit;
    } elseif (mysqli_num_rows($resultado_startup) == 1) {
        // Redireciona para a página inicial da startup após o login bem-sucedido
        header("Location: /Inova Start/PaginaInicial/pagina_inicial.html");
        exit;
    } else {
        // Caso contrário, exibe uma mensagem de erro
        echo "Login inválido. Por favor, tente novamente.";
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
}
?>