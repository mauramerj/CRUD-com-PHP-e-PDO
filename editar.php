<?php
  session_start();
  include("db/conn.php");

if(isset($_POST['dados'])){
$nome_pessoa = strip_tags(trim($_POST['nome_pessoa']));
$sexo_pessoa = strip_tags(trim($_POST['sexo_pessoa']));
$data_nas_pessoa = strip_tags(trim($_POST['data_nas_pessoa']));

$id_atual = strip_tags(trim($_POST['id_pessoa']));

$sql_alterar = 'UPDATE pessoa_tb SET nome_pessoa = :nome_pessoa, sexo_pessoa = :sexo_pessoa, data_nas_pessoa = :data_nas_pessoa WHERE id_pessoa = :id_atual';

try{
  $query_alterar = $conecta->prepare($sql_alterar);
  $query_alterar->bindValue(':nome_pessoa',$nome_pessoa,PDO::PARAM_STR);
  $query_alterar->bindValue(':sexo_pessoa',$sexo_pessoa,PDO::PARAM_STR);
  $query_alterar->bindValue(':data_nas_pessoa',$data_nas_pessoa,PDO::PARAM_STR);

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
<div id="vermelho" class="col-sm-6 col-xs-12">
  <fieldset>
    <legend>Formulário de edição</legend>
      <?php
        $id_pessoa = $_GET['id_pessoa'];
        $query_selecionados = "SELECT * FROM pessoa_tb WHERE id_pessoa = '$id_pessoa'";
          try{
            $query_seleciona = $conecta->prepare($query_selecionados);
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
      <a href="editar_imagem.php?id_pessoa=<?php echo $id_pessoa;?>">
        <img src="img_usuarios/<?php echo $linha['foto']; ?>"  width="70px" height="70px"/><br>Alterar foto
      </a>
          <form name="dados" action="" enctype="multipart/form-data" method="post">
            <legend>Alterar informação de: <b><?php echo $nome_pessoa;?></b></legend>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="Codigo">Código</label>
                <?php echo $id_pessoa;?>
              </div>
            </div>
              <div class="form-row">
              <div class="form-group col-md-6">
                <label for="Nome">Nome</label>
                <input type="hidden" name="id_pessoa" value="<?php echo $id_atual;?>" />
                <input type="text" class="form-control" name="nome_pessoa" id="nome_pessoa" value="<?php echo $nome_pessoa;?>">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="Nascimento">Nascimento</label>
                <input type="text" class="form-control" name="data_nas_pessoa" id="data_nas_pessoa" value="<?php echo $data_nas_pessoa;?>">
              </div>
              <div class="form-group col-md-4">
                <label for="Sexo">Sexo</label>
                <select name="sexo_pessoa" id="sexo_pessoa" class="form-control">
                  <option selected><?php echo $sexo_pessoa;?></option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outro</option>
                </select>
              </div>
            </div>
              <div class="form-row">
                <div class="form-group col-md-10">
                  <input type="submit" class="btn btn-danger" name="dados" value="Atualizar" />
                </div>
              </div>
        <?php
          }
        }
        ?>
        </form>
</fieldset>
</div>
 <!-- Todo cabeçalho e menus de navegação do sistema -->
<?php require_once("viewer/rodape.php"); ?>