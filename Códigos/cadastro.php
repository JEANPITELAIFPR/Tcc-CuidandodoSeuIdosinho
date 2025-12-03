<?php
include 'conexao.php';

if($_POST){
    $database = new Database();
    $db = $database->getConnection();
    
    $nome = $_POST['nome'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $formacao = $_POST['formacao'];
    $data_nascimento = $_POST['data_nascimento'];
    
    // Calcular idade a partir da data de nascimento
    $idade = date('Y-m-d', strtotime($data_nascimento));
    
    try {
        $sql = "INSERT INTO Cuidador (Nome, Senha, Formacao, Idade) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        
        if($stmt->execute([$nome, $senha, $formacao, $idade])){
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='Login.html';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar!'); window.history.back();</script>";
        }
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>