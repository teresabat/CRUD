<?php
include 'db.php';

// Verifica se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepara a consulta para buscar o registro com o ID fornecido
    $stmt = $conn->prepare("SELECT nome, cpf, nascimento, email, senha FROM pessoa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se um registro foi encontrado
    if ($result->num_rows > 0) {
        // Recupera os dados do registro
        $row = $result->fetch_assoc();
    } else {
        // Redireciona ou exibe uma mensagem de erro se o registro não for encontrado
        echo "Registro não encontrado.";
        exit;
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $nascimento = $_POST['nascimento'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Prepara a consulta de atualização
        $sql = "UPDATE pessoa SET nome = ?, cpf = ?, nascimento = ?, email = ?, senha = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nome, $cpf, $nascimento, $email, $senha, $id);
        $stmt->execute();

        // Redireciona ou exibe uma mensagem de sucesso após a atualização
        header("Location: index.php");
        exit;
    }
} else {
    echo "ID não fornecido.";
    exit;
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atualizar Pessoa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5 d-flex justify-content-center">
    <div class="col-md-6">
      <form method="post">
        <div class="form-group">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($row['nome']); ?>" required>
        </div>
        <div class="form-group">
          <label for="cpf" class="form-label">CPF</label>
          <input type="text" name="cpf" class="form-control" value="<?php echo htmlspecialchars($row['cpf']); ?>" required>
        </div>
        <div class="form-group">
          <label for="nascimento" class="form-label">Nascimento</label>
          <input type="date" name="nascimento" class="form-control" value="<?php echo htmlspecialchars($row['nascimento']); ?>" required>
        </div>
        <div class="form-group">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>" required>
        </div>
        <div class="form-group">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" name="senha" class="form-control" value="<?php echo htmlspecialchars($row['senha']); ?>" required>
        </div>
        <button type="submit" class="btn btn-success" style="margin-top: 1rem;">Salvar</button>
        <a href="index.php" class="btn btn-secondary" style="margin-top: 1rem;">Voltar</a>
      </form>
    </div>
  </div>
</body>
</html>

