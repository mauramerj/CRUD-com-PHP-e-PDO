<?php 
  session_start();
  include("db/conn.php");
?>
<!-- Todo cabeçalho e menus de navegação do sistema -->
<?php require_once("viewer/cabecalho.php"); ?>

      <!-- Formatar com CSS na folha de estilo -->
      <p id="para_cabecalho">Rametech</p>
    <div id="vermelho" class="col-sm-12 col-xs-12">
      <?php
      $stmt = $conecta->prepare("SELECT * FROM pessoa_tb ORDER BY id_pessoa DESC LIMIT 5");
      $stmt->execute();
      $selecao_pessoa = $stmt->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <table class="table table-striped table-hover" align="center">
      	<legend>Últimos usuários inseridos no sistema</legend>
      	<thead>
      		<tr class="table-dark">
      			<th>Código</th>
      			<th>Imagem</th>
      			<th>Nome</th>
      			<th>Sexo</th>
      			<th>Nascimento</th>
      		</tr>
      	</thead>
      	<tbody>
        <?php foreach($selecao_pessoa as $mostra_pessoa): ?>
        	<tr>
          <?php
          $i++;
          if($i==1){echo '<tr>';}
          ?>
          <td><?php echo $mostra_pessoa['id_pessoa'];?></td>
          <td>
          <a href="perfil.php?id_pessoa=<?php echo $mostra_pessoa['id_pessoa']; ?>">
            <div class="img-responsive max-width: 10%">
              <img src="img_usuarios/<?php echo $mostra_pessoa['foto']; ?>"  width="40px" height="40px"/>
            </div>
          </a>
          </td>
          <td><?php echo $mostra_pessoa['nome_pessoa'];?></td>
          <td><?php echo $mostra_pessoa['sexo_pessoa'];?></td>
          <td><?php echo $mostra_pessoa['data_nas_pessoa'];?></td>
          <?php
          if($i==6){echo '</tr>';$i=0;}
          ?>
          </tr>
        <?php endforeach;?>
      	</tbody>
      </table>
    </div>
 <!-- Todo cabeçalho e menus de navegação do sistema -->
<?php require_once("viewer/rodape.php"); ?>