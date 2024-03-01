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
        $nome_startup = isset($_POST['nome_startup']) ? mysqli_real_escape_string($conexao, $_POST['nome_startup']) : '';
        $cnpj_startup = isset($_POST['cnpj_startup']) ? mysqli_real_escape_string($conexao, $_POST['cnpj_startup']) : '';
        $ramo = isset($_POST['ramo']) ? mysqli_real_escape_string($conexao, $_POST['ramo']) : '';
        $telefone_startup = isset($_POST['telefone_startup']) ? mysqli_real_escape_string($conexao, $_POST['telefone_startup']) : '';
        $qt_funcionarios = isset($_POST['qt_funcionarios']) ? mysqli_real_escape_string($conexao, $_POST['qt_funcionarios']) : '';
        $ds_startup = isset($_POST['ds_startup']) ? mysqli_real_escape_string($conexao, $_POST['ds_startup']) : '';
        $email_startup = isset($_POST['email_startup']) ? mysqli_real_escape_string($conexao, $_POST['email_startup']) : '';
        $senha_startup = isset($_POST['senha_startup']) ? mysqli_real_escape_string($conexao, $_POST['senha_startup']) : '';

        // Verifica se o CPF já está cadastrado
        $sql_startup = "SELECT cnpj_startup FROM startup WHERE cnpj_startup='$cnpj_startup'";
        $retorno_startup = mysqli_query($conexao, $sql_startup);

        if (mysqli_num_rows($retorno_startup) > 0) {
            echo "CNPJ já cadastrado.";
        } else {
            // Insere os dados no banco de dados
            $sql_startup = "INSERT INTO startup(nome_startup, cnpj_startup, ramo, telefone_startup, qt_funcionarios, ds_startup, email_startup, senha_startup) VALUES ('$nome_startup', '$cnpj_startup', '$ramo', '$telefone_startup', '$qt_funcionarios', '$ds_startup', '$email_startup', '$senha_startup')";
            if (mysqli_query($conexao, $sql_startup)) {
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