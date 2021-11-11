<?php
  session_start();
  include("db/conn.php");
  $msg = false;
  $nome_pessoa = $_POST['nome_pessoa'];
  $sexo_pessoa = $_POST['sexo_pessoa'];
  $data_nas_pessoa = $_POST['data_nas_pessoa'];

      if(isset($_FILES['foto'])){
        $extensao = strtolower(substr($_FILES['foto']['name'], -4));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = "img_usuarios/";
        move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novo_nome);
        $sql_inserir = "INSERT INTO pessoa_tb (nome_pessoa,  sexo_pessoa, data_nas_pessoa, foto) 
        VALUES('$nome_pessoa', '$sexo_pessoa', '$data_nas_pessoa', '$novo_nome')";
        if($conecta->query($sql_inserir))
          $msg = "Arquivo enviado com sucesso!";
        else
          $msg = "Falha ao enviar arquivo.";
      }
    ?>
<?php require_once("viewer/cabecalho.php"); ?>
  <p id="para_cabecalho">Rametech</p>
<div class="col-sm-8 sidenav">
  <fieldset>
    <legend>Formulário de cadastro</legend>
      <div class="well">
        <?php if(isset($msg) && $msg != false) echo "<p> $msg </p>"; ?>
          <form action="inserir.php" method="POST" enctype="multipart/form-data">
            <div class="form-group col-xs-6">
              <label for="Nome">Nome:</label>
              <input type="text" name="nome_pessoa" class="form-control" required id="nome_pessoa" aria-describedby="nome" placeholder="Digite o nome">
            </div>
            <div class="form-group  col-xs-2">
              <label for="sexo_pessoa">Sexo:</label>
                  <select name="sexo_pessoa" class="custom-select custom-select-sm">
                    <option value="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="O">Outro</option>
                  </select>
            </div>
            <div class="form-group col-xs-4">
              <label for="data_nas_pessoa">Data nascimento:</label>
              <input type="date" name="data_nas_pessoa" class="form-control" required id="data_nas_pessoa" aria-describedby="kmLitroEstradaHelp">
            </div>

            <div class="form-group">
              <label for="Imagem">Imagem:</label>
              <div class="custom-file">
              <input type="file" required name="foto">
            </div>
                <br>
              <input type="submit" value="Salvar" class="btn btn-primary mb-2">
            </div>
          </form>
      </div>
  </fieldset>
</div>
<?php require_once("viewer/rodape.php"); ?>