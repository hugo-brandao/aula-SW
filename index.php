<?php

    require "bd.php";
    $msg = false;
    if(isset($_FILES["arquivo"])){
        $arquivo = $_FILES["arquivo"]["name"];
        $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
        $novo_nome = md5(time()).".".$extensao;
        $diretorio = "img/";
        move_uploaded_file($_FILES["arquivo"]["tmp_name"], $diretorio . $novo_nome);

//inserir dados na tabela

        $nomecompleto = $diretorio . $novo_nome;
        $sql_code = "insert into tbl_img(urlimg) value ('{$nomecompleto}') ";
        if(mysqli_query($conn, $sql_code)){
            echo"dados inseridos com sucesso";
        }else{
            echo "falha ao inserir os dados";
        }
    };
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=>, initial-scale=1.0">
    <title>Upload de imagem com mysql</title>
</head>
<body>
    <h1 >Upload de imagem</h1>
    <form action="index.php" method="POST" name="foto" enctype="multipart/form-data">
        selecione o arquivo:<br><br>
        <input type="file" name="arquivo"><br>
        <input type="submit" name="sbmt" value="enviar"><br>
        </form>
        <hr>
        <?php
            $sql_busca = "select * from tbl_img";
            $mostrar = mysqli_query($conn, $sql_busca);
            $qnt_arquivos = mysqli_num_rows($mostrar);
                if($qnt_arquivos <= 0){
                    print "não há arquivos<br>";
                }else{
                    print "existem" . $qnt_arquivos . "arquivos no sistema.<br>";
                    while($dados = mysqli_fetch_array($mostrar)){
        ?>
            <img src="<?=$dados["urlimg"];?>">
            <?php
                }
            };

            ?>
    
</body>
</html>