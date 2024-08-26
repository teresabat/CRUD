<?php

include 'db.php'; // Corrigi a extensão do arquivo incluído

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $nome = $_POST['nome'];
  $cpf = $_POST['cpf'];
  $nascimento = $_POST['nascimento'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $sql = "INSERT INTO pessoa (nome, cpf, nascimento, email, senha)
          VALUES ('$nome', '$cpf', '$nascimento', '$email', '$senha')";

  // Executa a query e verifica se a inserção foi bem-sucedida
  if ($conn->query($sql) === TRUE) {
    echo "Novo registro criado com sucesso!";
  } else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
  }

  $conn->close(); // Fecha a conexão com o banco de dados
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5 d-flex justify-content-center">
    <div class="col-md-6">
      <form method="post">
        <div class="form-group">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="cpf" class="form-label">CPF</label>
          <input type="text" name="cpf" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="nascimento" class="form-label">Nascimento</label>
          <input type="date" name="nascimento" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success" style="margin-top: 1rem;">Salvar</button>
        <a href="index.php" class="btn btn-secondary" style="margin-top: 1rem;">Voltar</a>
      </form>
    </div>
  </div>
</body>
</html>
