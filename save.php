<?php
    include("config/conexao.php");

    $sql = "INSERT INTO nfe(
                        NUMERO,
                        DATA,
                        CPF,
                        CNPJ,
                        NOME,
                        LOGRADOURO,
                        NUMEROCASA,
                        COMPLEMENTO,
                        BAIRRO,
                        CODIGOMUNICIPIO,
                        MUNICIPIO,
                        UF,
                        CEP,
                        CODIGOPAIS,
                        TOTAL,
                        CAMINHOARQUIVO)
            VALUES (
                    " . $_POST["numero"] . ",
                    '" . $_POST["data"] . "',";
    isset($_POST["cpf"]) ? $sql .= "'" . $_POST["cpf"] . "'," : $sql .= "'',";
    isset($_POST["cnpj"]) ? $sql .= "'" . $_POST["cnpj"] . "'," : $sql .= "'',";

    $sql .=     "'" . $_POST["nome"] . "',
                '" . $_POST["xLgr"] . "',
                " . $_POST["nro"] . ",";

    isset($_POST["xCpl"]) ? $sql .= "'" . $_POST["xCpl"] . "'," : $sql .= "'',";

    $sql .=     "'" . $_POST["xBairro"] . "',
                " . $_POST["cMun"] . ",
                '" . $_POST["xMun"] . "',
                '" . $_POST["UF"] . "',
                '" . $_POST["CEP"] . "',
                " . $_POST["cPais"] . ",
                '" . $_POST["total"] . "',
                '" . $_POST["caminhoarquivo"] . "')";
    echo $sql;

    $result = $conn->query($sql);
    $conn->close();

    header('Location: http://localhost/teste-care');
?>
