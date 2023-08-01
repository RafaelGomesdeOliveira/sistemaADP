<?php
include_once('../conexao.php');

$retorno = $conn->prepare('SELECT * FROM Disciplina');
$retorno->execute();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../style/lista.css">
</head>

<body>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Carga horária</th>
        <th scope="col">Quantidade de alunos</th>
        <th scope="col">Pré-requisito</th>
        <th scope="col">Alterar</th>
        <th scope="col">Excluir</th>
      </tr>
    </thead>
    <?php foreach ($retorno->fetchall() as $value) { ?>
      <tbody>
        <tr>
          <th scope="row">
            <?= $value['idDisciplina'] ?>
          </th>
          <td>
            <?= $value['nomeDisciplina'] ?>
          </td>
          <td>
            <?= $value['ch'] ?>
          </td>
          <td>
            <?= $value['quantAlunos'] ?>
          </td>
          <td>
            <?= $value['preRequisito'] ?>
          </td>
          <td>
            <form action="alterarDis.php" method="post">
              <input type="hidden" name="id" value="<?= $value['idDisciplina'] ?>">
              <button class="btn alterar centro" type="submit" name="alterarDis">Alterar<ion-icon
                  name="construct"></ion-icon></button>
            </form>
          </td>
          <td>
          <form action="cudrDisciplina.php" method="get">
              <input type="hidden" name="id" value="<?= $value['idDisciplina'] ?>">
              <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#exampleModal<?php echo $value['idDisciplina'] ?>">
                Excluir<ion-icon name="trash-sharp"></ion-icon>
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?php echo $value['idDisciplina'] ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel<?php echo $value['idDisciplina'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Você realmente deseja excluir a disciplina
                        <strong>
                          <?php
                          echo $value['nomeDisciplina'];
                          ?>
                        </strong>
                        de id igual a <strong> 
                        <?php 
                        echo $value['idDisciplina'];
                        ?>
                        </strong>
                        ?
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <form action="cudrDisciplina.php" method="get">
                        <input type="hidden" name="id" value="<?= $value['idDisciplina'] ?>">
                        <button class="btn btn-primary" type="submit" name="excluirAluno">Confirmar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <div class="centro">
    <a href="../index.html">Voltar<ion-icon name="home"></ion-icon></a>
  </div>


</body>

</html>