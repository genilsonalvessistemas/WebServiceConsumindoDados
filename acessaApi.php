<!doctype html>
<html lang="PT-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consumindo Web Service do IBGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="#">
</head>

<body>

    <legend>Api </legend>
    <p></p>

    <p></p>
    <h4>Resultado do consumo da API de endereço: 'https://servicodados.ibge.gov.br/api/v1/localidades/distritos'</h4>
    <div class="container">
        <?php
        $uf = $_POST['uf'];

        echo $uf;
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://servicodados.ibge.gov.br/api/v1/localidades/estados/" . $uf . "/municipios?view=nivelado");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($ch);
        curl_close($ch);


        // function removeBOM($retorno)
        // {
        //     if (0 === strpos(bin2hex($retorno), 'efbbbf')) {
        //         return substr($retorno, 3);
        //     }
        //     return $retorno;
        // }

        $retorno2 = json_decode($retorno, true);
        ?>
        <table class="table table-striped">
            <caption>Resultado do consumo de dados do Web Service</caption>
            <thead>
                <tr>
                    <th>Código do Municipio</th>
                    <th>Nome da cidade</th>
                    <th>UF-sigla</th>
                    <th>UF-nome</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($retorno2 as $objeto) {
                    echo "<tr'>";
                    echo "<td>" . $objeto['municipio-id'] . "</td>";
                    echo "<td>" . $objeto['municipio-nome'] . "</td>";
                    echo "<td>" . $objeto['UF-sigla'] . "</td>";
                    echo "<td>" . $objeto['UF-nome'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button> -->


</body>

<script>

</script>

</html>