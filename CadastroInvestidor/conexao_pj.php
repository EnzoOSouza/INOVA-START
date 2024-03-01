<?php
//CADASTRO INVESTIDOR PF
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $conexao = mysqli_connect("localhost:3306", "root", "1234", "formulario-cadastro");

    // Teste de conexão
    if (!$conexao) {
        echo "Falha na conexão com o banco de dados.";
    } else {
        // Recupera os dados do formulário e valida
        $cnpj_investidor = isset($_POST['cnpj_investidor']) ? mysqli_real_escape_string($conexao, $_POST['cnpj_investidor']) : '';
        $nome_pj = isset($_POST['nome_pj']) ? mysqli_real_escape_string($conexao, $_POST['nome_pj']) : '';
        $telefone_pj = isset($_POST['telefone_pj']) ? mysqli_real_escape_string($conexao, $_POST['telefone_pj']) : '';
        $email_pj = isset($_POST['email_pj']) ? mysqli_real_escape_string($conexao, $_POST['email_pj']) : '';
        $senha_pj = isset($_POST['senha_pj']) ? mysqli_real_escape_string($conexao, $_POST['senha_pj']) : '';

        $sql_pj = "SELECT cnpj_investidor FROM investidor_pj WHERE cnpj_investidor='$cnpj_investidor'";
        $retorno_pj = mysqli_query($conexao, $sql_pj);

        if (mysqli_num_rows($retorno_pj) > 0) {
            echo "CPF já cadastrado.";
        } else {
            // Insere os dados no banco de dados
            $sql_pj = "INSERT INTO investidor_pj(nome_pj, cnpj_investidor, telefone_pj, email_pj, senha_pj) VALUES ('$nome_pj', '$cnpj_investidor', '$telefone_pj', '$email_pj', '$senha_pj')";
            if (mysqli_query($conexao, $sql_pj)) {
                echo "<script>window.location.href='http://localhost/Inova%20Start/Login/login.html';</script>";
            } else {
                echo "Erro ao cadastrar: " . mysqli_error($conexao);
            }
        }
    }
} else {
    echo "Formulário não submetido.";
}

?>