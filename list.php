<br />
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Número</th>
            <th scope="col">Data</th>
            <th scope="col">CPF</th>
            <th scope="col">CNPJ</th>
            <th scope="col">Nome</th>
            <th scope="col">Logradouro</th>
            <th scope="col">Nº casa</th>
            <th scope="col">Complemento</th>
            <th scope="col">Bairro</th>
            <th scope="col">Códgio município</th>
            <th scope="col">Município</th>
            <th scope="col">UF</th>
            <th scope="col">CEP</th>
            <th scope="col">Código país</th>
            <th scope="col">Total</th>
            <th scope="col">Arquivo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include("config/conexao.php");

        $sql = "SELECT 
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
                    CAMINHOARQUIVO
                FROM nfe";

        $result = $conn->query($sql);

        $cont = mysqli_num_rows($result);

        if($cont == 0){
            echo "<tr><td colspan='16'>Nenhuma nota fiscal salva.</tr></td>";
        }else{
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["NUMERO"] . "</td>";
                echo "<td>" . $row["DATA"] . "</td>";
                echo "<td>" . $row["CPF"] . "</td>";
                echo "<td>" . $row["CNPJ"] . "</td>";
                echo "<td>" . $row["NOME"] . "</td>";
                echo "<td>" . $row["LOGRADOURO"] . "</td>";
                echo "<td>" . $row["NUMEROCASA"] . "</td>";
                echo "<td>" . $row["COMPLEMENTO"] . "</td>";
                echo "<td>" . $row["BAIRRO"] . "</td>";
                echo "<td>" . $row["CODIGOMUNICIPIO"] . "</td>";
                echo "<td>" . $row["MUNICIPIO"] . "</td>";
                echo "<td>" . $row["UF"] . "</td>";
                echo "<td>" . $row["CEP"] . "</td>";
                echo "<td>" . $row["CODIGOPAIS"] . "</td>";
                echo "<td>" . $row["TOTAL"] . "</td>";
                echo "<td><a href='" . $row["CAMINHOARQUIVO"] . "' download>Baixar</a></td>";
                echo "</tr>";
            }
        }
        $conn->close();
        ?>
    </tbody>
</table>
