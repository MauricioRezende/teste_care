<br />
<form action="" method="post" enctype="multipart/form-data">
    <div class="input-group">
        <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="arquivo">
        <button class="btn btn-outline-secondary" type="submit" name="carregar" id="inputGroupFileAddon04">Carregar</button>
    </div>
</form>
<?php

if(isset($_POST["carregar"])){

    $error = array();

    $arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;
    $ex = strrchr($arquivo["name"], '.');
    $nome_arquivo = $arquivo["name"] . "-" . md5(uniqid(time())) . $ex;
    $arquivo_dir = "files/" . $nome_arquivo;

    if($arquivo["size"] == 0){
        array_push($error, "Informe um arquivo.");
    }

    if($ex != ".xml"){
        array_push($error, "Extensão diferente de .xml");
    }

    if(sizeof($error) > 0){
        echo "<br />";
        echo "<ul>";
        for ($i=0; $i < sizeof($error); $i++) { 
            echo "<li>" . $error[$i] . "</li>";
        }  
        echo "</ul>";
    }else{
        if(!move_uploaded_file($arquivo["tmp_name"], $arquivo_dir)){
            echo "Erro ao copiar arquivo.";
        }

        $xml = simplexml_load_file($arquivo_dir);
    
        $json = json_encode($xml);
        
        $newArr = json_decode($json, true);
      
        if(isset($newArr["NFe"]["infNFe"]["emit"]["CNPJ"])){
            if($newArr["NFe"]["infNFe"]["emit"]["CNPJ"] == "09066241000884"){
                if($newArr["protNFe"]["infProt"]["nProt"] != ""){
                    echo "<br />";
                    echo "<br />";
                    echo "Número da nota Fiscal: " . $newArr["NFe"]["infNFe"]["ide"]["nNF"];
                    echo "<br />";
                    echo "Data da nota Fiscal: " . $newArr["NFe"]["infNFe"]["ide"]["dhEmi"];
                    echo "<br />";
                    echo "<br />";
                    echo "<b>Dados do destinatário</b>";
                    echo "<br />";

                    if(isset($newArr["NFe"]["infNFe"]["dest"]["CNPJ"])){
                        echo "CNPJ: " . $newArr["NFe"]["infNFe"]["dest"]["CNPJ"];
                    }elseif(isset($newArr["NFe"]["infNFe"]["dest"]["CPF"])){
                        echo "CPF: " . $newArr["NFe"]["infNFe"]["dest"]["CPF"];
                    }

                    echo "<br />";
                    echo "Nome: " . $newArr["NFe"]["infNFe"]["dest"]["xNome"];
                    echo "<br />";
                    echo "<br />";
                    echo "<b>Endereço</b>";
                    echo "<br />";

                    foreach($newArr["NFe"]["infNFe"]["dest"]["enderDest"] as $tag => $val){
                        echo $tag . ': ' . $val . '<br>';
                    }

                    echo "<br />";
                    echo "Valor total: " . $newArr["NFe"]["infNFe"]["total"]["ICMSTot"]["vNF"];
                    ?>
                    
                    <form action="save.php" method="post">
                        <input type="hidden" name="numero"  value="<?php echo $newArr["NFe"]["infNFe"]["ide"]["nNF"]; ?>">
                        <input type="hidden" name="data"    value="<?php echo $newArr["NFe"]["infNFe"]["ide"]["dhEmi"]; ?>">
                        <?php
                        if(isset($newArr["NFe"]["infNFe"]["dest"]["CNPJ"])){
                            ?><input type="hidden" name="cnpj"    value="<?php echo $newArr["NFe"]["infNFe"]["dest"]["CNPJ"]; ?>"><?php
                        }elseif(isset($newArr["NFe"]["infNFe"]["dest"]["CPF"])){
                            ?><input type="hidden" name="cpf"     value="<?php echo $newArr["NFe"]["infNFe"]["dest"]["CPF"]; ?>"><?php
                        }
                        ?>
                          
                        <input type="hidden" name="nome"    value="<?php echo $newArr["NFe"]["infNFe"]["dest"]["xNome"]; ?>">

                        <?php
                        foreach($newArr["NFe"]["infNFe"]["dest"]["enderDest"] as $tag => $val){?>
                            <input type="hidden" name="<?php echo $tag; ?>" value="<?php echo $val; ?>">
                        <?php
                        }
                        ?>

                        <input type="hidden" name="total" value="<?php echo $newArr["NFe"]["infNFe"]["total"]["ICMSTot"]["vNF"]; ?>">
                        <input type="hidden" name="caminhoarquivo" value="<?php echo $arquivo_dir; ?>">
                        <br />
                        <button class="btn btn-primary" type="submit" name="salvar">Salvar</button>
                    </form>
                    <?php
                }else{
                    echo "<br />Não possui protocolo de autorização.";
                }
            }else{
                echo "<br />Arquivo XML incorreto (CNPJ diferente de \"09066241000884\").";
            }
        }else{
            echo "<br />Arquivo XML inválido (Não possui campo CNPJ).";
        }
    }
}
?>      