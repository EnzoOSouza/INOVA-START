<?php
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $conexao = mysqli_connect("localhost:3306", "root", "1234", "formulario-cadastro");

    // Teste de conexão
    if (!$conexao) {
        echo "Falha na conexão com o banco de dados.";
    } else {
        // Recupera os dados do formulário e valida
        $nome = isset($_POST['nome']) ? mysqli_real_escape_string($conexao, $_POST['nome']) : '';
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conexao, $_POST['email']) : '';
        $mensagem = isset($_POST['mensagem']) ? mysqli_real_escape_string($conexao, $_POST['mensagem']) : '';
        
        // Insere os dados no banco de dados
        $sql_startup = "INSERT INTO cadastro_card_startup (nome, email, mensagem) VALUES ('$nome', '$email', '$mensagem')";
        if (mysqli_query($conexao, $sql_startup)) {
            echo "<script>window.location.href='http://localhost/Inova%20Start/PaginaInicial/pagina_inicial.html';</script>";
        } else {
            echo "Erro ao cadastrar: " . mysqli_error($conexao);
        }
    }
} else {
    echo "Formulário não submetido.";
}
?>