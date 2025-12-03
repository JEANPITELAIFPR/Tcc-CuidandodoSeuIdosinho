<?php
session_start();
include 'conexao.php';

if($_POST && isset($_SESSION['cuidador_id'])){
    $database = new Database();
    $db = $database->getConnection();
    
    $nome = $_POST['nome'];
    $peso = $_POST['peso'];
    $tamanho = $_POST['tamanho'];
    $data_nascimento = $_POST['data_nascimento'];
    $contato_emergencia = $_POST['contato_emergencia'];
    $fk_crm_medico = $_POST['FK_CRM_medico'];
    $fk_cuidador = $_SESSION['cuidador_id'];
    
    try {
        $sql = "INSERT INTO Cad_idoso (Nome, Datanascimento, Peso, Tamanho, Contatos_emergencia, FK_CRM_medico, FK_Cuidador) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        
        if($stmt->execute([$nome, $data_nascimento, $peso, $tamanho, $contato_emergencia, $fk_crm_medico, $fk_cuidador])){
            echo "<script>alert('Idoso cadastrado com sucesso!'); window.location.href='Tela_Principal.html';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar idoso!'); window.history.back();</script>";
        }
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "<script>alert('Acesso negado! Faça login primeiro.'); window.location.href='Login.html';</script>";
}
?>