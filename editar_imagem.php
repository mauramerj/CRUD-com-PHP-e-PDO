<?php
  session_start();
  include("db/conn.php");

if(isset($_POST['dados'])){
  $foto = $_FILES['foto'];
  $id_atual = strip_tags(trim($_POST['id_pessoa']));
  $extensao = strtolower(substr($_FILES['foto']['name'], -4));
  $novo_nome = md5(time()) . $extensao;
  $diretorio = "img_usuarios/";
    move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novo_nome);
      $sql_atualiza = 'UPDATE pessoa_tb SET foto = :novo_nome WHERE id_pessoa = :id_atual';
try{
  $query_alterar = $conecta->prepare($sql_atualiza);
  $query_alterar->bindValue(':novo_nome',$novo_nome,PDO::PARAM_STR);

  $query_alterar->bindValue(':id_atual',$id_atual,PDO::PARAM_STR);
  $query_alterar->execute();

}catch (PDOexception $error_update){
    echo 'Erro ao atualizar '.$error_update->getMessage();
}
}
?>
<!-- Todo cabeçalho e menus de navegação do sistema -->
<?php require_once("viewer/cabecalho.php"); ?>
<!-- Formatar com CSS na folha de estilo -->
  <p id="para_cabecalho">Rametech</p>
    <div id="vermelho" class="col-sm-12 col-xs-8">
      <?php
    $id_pessoa = $_GET['id_pessoa'];
    $sql_select = "SELECT * FROM pessoa_tb WHERE id_pessoa = '$id_pessoa'";
      try{
        $query_seleciona = $conecta->prepare($sql_select);
        $query_seleciona->execute();
        $resultado_query = $query_seleciona->fetchAll(PDO::FETCH_ASSOC);
        $count = $query_seleciona->rowCount(PDO::FETCH_ASSOC);
      }catch (PDOexception $error_select){
            header('location: index.php');
      }
      if($count == '0'){
            header('location: index.php');
      }else{
        foreach($resultado_query as $linha){
          $id_atual = $linha['id_pessoa'];
          $nome_pessoa = $linha['nome_pessoa'];
          $sexo_pessoa = $linha['sexo_pessoa'];
          $data_nas_pessoa = $linha['data_nas_pessoa'];
?>
<a href="editar_imagem.php"> <img src="img_usuarios/<?php echo $linha['foto']; ?>"  width="70px" height="70px"/></a>
    <form name="dados" action="" enctype="multipart/form-data" method="post">
        <legend>Alterar imagem <b><?php echo $nome_pessoa;?></b></legend>
          <div class="form-group">
            <label>Código: <?php echo $id_pessoa;?></label>
          <input type="hidden" name="id_pessoa" value="<?php echo $id_atual;?>" />
          </div>
          <div class="form-group">
          <label for="Nome">Nome: </label>
          <?php echo $nome_pessoa;?>
        </div>
          <div class="form-group">
            <label for="Sexo">Sexo: </label>
          <?php echo $sexo_pessoa;?>
          </div>
          <div class="form-group">
            <label for="Nascimento">Nascimento: </label>
          <?php echo $data_nas_pessoa;?>
          </div>
      <div class="form-group">
        <label for="Imagem">Imagem:</label>
        <div class="custom-file">
        <input type="file" required name="foto">
      </div> <br>
          <input type="submit" class="btn btn-danger" name="dados" value="Atualizar" />
    </form>
    <?php

        }
      }
    ?>
  </div>
</div>
 <!-- Todo cabeçalho e menus de navegação do sistema -->
<?php require_once("viewer/rodape.php"); ?>