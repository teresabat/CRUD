<?php
include 'db.php';

$sql = "SELECT id, nome, cpf, nascimento, email, senha FROM pessoa";
$query = $conn->query($sql);
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
  <div class="container mt-5">
    <div class="d-flex justify-content-center mb-3">
      <a href="addpessoa.php" class="btn btn-primary">Adicionar</a>
    </div>
    <div class="d-flex justify-content-center">
      <div class="table-responsive col-md-10">
        <table class="table table-striped table-dark text-center">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">CPF</th>
              <th scope="col">Nascimento</th>
              <th scope="col">Email</th>
              <th scope="col">Senha</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                  echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['cpf']}</td>
                    <td>{$row['nascimento']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['senha']}</td>
                    <td>
                      <a href='update.php?id={$row['id']}' class='btn btn-warning'>Editar</a>
                      <a href='delete.php?id={$row['id']}' class='btn btn-danger'>Excluir</a>
                    </td>
                  </tr>";
                }
            } else {
              echo "<tr><td colspan='7' class='text-center'>Nada encontrado</td></tr>";
            }
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>

