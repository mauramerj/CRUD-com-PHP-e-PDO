<?php 
  session_start();
  include("db/conn.php");
  if (!isset($_GET['nome_pessoa'])) {
    header("Location: index.php");
    exit;
  }
  $nome_pessoa = "%".trim($_GET['nome_pessoa'])."%";
  $resp_sql = $conecta->prepare('SELECT * FROM pessoa_tb WHERE nome_pessoa LIKE :nome_pessoa LIMIT 5');
  $resp_sql->bindParam(':nome_pessoa', $nome_pessoa, PDO::PARAM_STR);
  $resp_sql->execute();
  $result_consulta = $resp_sql->fetchall(PDO::FETCH_ASSOC);
?>
<!-- Todo cabeçalho e menus de navegação do sistema -->
<?php require_once("viewer/cabecalho.php"); ?>
      <!-- Formatar com CSS na folha de estilo -->
      <p id="para_cabecalho">Rametech</p>
    <div id="corpo" class="col-sm-12 col-xs-12">
    <table class="table table-striped table-hover" align="center">
       <legend>Resultado da busca</legend>
      <?php
        if (count($result_consulta)) {?>
      <thead>
        <tr class="table-dark">
          <th>Código</th>
          <th>Imagem</th>
          <th>Nome</th>
          <th>Sexo</th>
          <th>Nascimento</th>
        </tr>
      </thead>
        <?php
          foreach ($result_consulta as $linha) {
      ?>
      <tbody>
            <tr>
              <td><?php echo $linha['id_pessoa'];?></td>
              <td><img src="img_usuarios/<?php echo $linha['foto']; ?>"  width="40px" height="40px"/></td>
              <td><?php echo $linha['nome_pessoa'];?></td>
              <td><?php echo $linha['sexo_pessoa'];?></td>
              <td><?php echo $linha['data_nas_pessoa'];?></td>            
            </tr>
            <?php
          }
        }else{
          ?>
          <label>Não foi encontrado resultado com a sua busca</label>
        <?php
        }
      ?>
       </tbody>
     </table>
    </div>
 <!-- Todo cabeçalho e menus de navegação do sistema -->
<?php require_once("viewer/rodape.php"); ?>