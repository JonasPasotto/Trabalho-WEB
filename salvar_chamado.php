<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'chamados_ti';
$username = 'root';
$password = 'Rogamo2305@';

try {
    // Cria uma instância PDO para conectar ao banco de dados
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Configura o modo de erro para exceções
} catch (PDOException $e) {
    // Exibe mensagem de erro caso a conexão falhe
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados enviados pelo formulário
    $nome = $_POST['nome'] ?? null;  // Se o campo não for preenchido, o valor será null
    $setor = $_POST['setor'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $observacoes = $_POST['observacoes'] ?? null;

    // Valida se os campos obrigatórios estão preenchidos
    if (!$nome || !$setor || !$descricao) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;  // Encerra o script caso falte algum dado
    }

    try {
        // Comando SQL para inserir os dados na tabela 'chamados'
        $sql = "INSERT INTO chamados (nome, setor, descricao, observacoes) 
                VALUES (:nome, :setor, :descricao, :observacoes)";
        $stmt = $conn->prepare($sql);  // Prepara a consulta SQL
        $stmt->bindParam(':nome', $nome);  // Associa os valores das variáveis aos parâmetros SQL
        $stmt->bindParam(':setor', $setor);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':observacoes', $observacoes);

        // Executa a consulta no banco de dados
        $stmt->execute();

        // Exibe mensagem de sucesso
        echo "Chamado registrado com sucesso!";
        
        // Redireciona o usuário para a mesma página ou outra, limpando o formulário
        header("Location: software.html");  // Redireciona para a página 'software.html'
        exit();  // Encerra o script após o redirecionamento
    } catch (PDOException $e) {
        // Exibe mensagem de erro caso o registro falhe
        echo "Erro ao salvar o chamado: " . $e->getMessage();
    }
}
?>
