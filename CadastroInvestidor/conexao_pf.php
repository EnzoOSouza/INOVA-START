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
        $cpf_pf = isset($_POST['cpf_pf']) ? mysqli_real_escape_string($conexao, $_POST['cpf_pf']) : '';
        $nome_pf = isset($_POST['nome_pf']) ? mysqli_real_escape_string($conexao, $_POST['nome_pf']) : '';
        $dataNasc_pf = isset($_POST['dataNascimento_pf']) ? mysqli_real_escape_string($conexao, $_POST['dataNascimento_pf']) : '';
        $endereco_pf = isset($_POST['endereco_pf']) ? mysqli_real_escape_string($conexao, $_POST['endereco_pf']) : '';
        $telefone_pf = isset($_POST['telefone_pf']) ? mysqli_real_escape_string($conexao, $_POST['telefone_pf']) : '';
        $email_pf = isset($_POST['email_pf']) ? mysqli_real_escape_string($conexao, $_POST['email_pf']) : '';
        $senha_pf = isset($_POST['senha_pf']) ? mysqli_real_escape_string($conexao, $_POST['senha_pf']) : '';

        // Verifica se o CPF já está cadastrado
        $sql_pf = "SELECT cpf_pf FROM investidor_pf WHERE cpf_pf='$cpf_pf'";
        $retorno_pf = mysqli_query($conexao, $sql_pf);

        if (mysqli_num_rows($retorno_pf) > 0) {
            echo "CPF já cadastrado.";
        } else {
            // Insere os dados no banco de dados
            $sql_pf = "INSERT INTO investidor_pf(nome_pf, cpf_pf, dt_nascimento_pf, endereco_pf, telefone_pf, email_pf, senha_pf) VALUES ('$nome_pf', '$cpf_pf', '$dataNasc_pf', '$endereco_pf', '$telefone_pf', '$email_pf', '$senha_pf')";
            if (mysqli_query($conexao, $sql_pf)) {
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