<?php
session_start();
include 'conexao.php';

if($_POST){
    $database = new Database();
    $db = $database->getConnection();
    
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    
    try {
        $sql = "SELECT ID, Nome, Senha FROM Cuidador WHERE Nome = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$nome]);
        
        if($stmt->rowCount() == 1){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($senha, $row['Senha'])){
                $_SESSION['cuidador_id'] = $row['ID'];
                $_SESSION['cuidador_nome'] = $row['Nome'];
                header("Location: Tela_Principal.html");
                exit();
            } else {
                echo "<script>alert('Senha incorreta!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Usuário não encontrado!'); window.history.back();</script>";
        }
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>