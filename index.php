<!doctype html>
<html lang="PT-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consumindo Web Service do IBGE</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="#">
</head>

<body>
    <p></p>
    <h3>Resultado do webService IBGE Estados</h3>
    <p></p>
    <div class="container">
        <div id="content">

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Resultado da consulta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="armazenaresultado">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Ok</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    let table = document.createElement('table');
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');
    tbody.setAttribute('id', 'dados_table');

    table.appendChild(thead);
    table.appendChild(tbody);
    document.getElementById('content').appendChild(table);

    let row_1 = document.createElement('tr');
    let heading_1 = document.createElement('th');
    heading_1.innerHTML = "Nome do Estado";
    let heading_2 = document.createElement('th');
    heading_2.innerHTML = "UF";

    row_1.appendChild(heading_1);
    row_1.appendChild(heading_2);
    // row_1.appendChild(heading_3);
    thead.appendChild(row_1);

    $(table).addClass('table table-striped');
    const data = '';
    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados', {})
        .then((response) => response.json())
        .then((data) => {
            let resultado = JSON.stringify(data);
            var tableNew = document.getElementById('dados_table');
            data.forEach(function(data) {
                var tr = document.createElement('tr');
                tr.innerHTML =
                    '<td>' + data.nome + '</td>' +
                    '<td>' + data.sigla + '</td>'
                tableNew.appendChild(tr);
            });
            chamaCidade();
        })
        .catch((error) => {
            console.error('Error:', error);
        });

    function chamaCidade() {
        $('tr').on('click', function() {
            var uf = $(this).find('td:eq(1)').text();
            console.log(uf);
            $.post('http://localhost/TREINAMENTO/WebService/acessaApi.php', {
                    // $.post('http://localhost/WebServiceConsumindoDados/acessaApi.php', {
                    uf: uf
                },
                function(data, textStatus, jqXHR) {
                    var myModal = document.getElementById('exampleModal');
                    myModal.addEventListener('shown.bs.modal', function() {});
                    $(myModal).modal('show');
                    $('.modal-body').append(data);
                }
            );
            $('.modal-body').empty();
            uf = '';
            console.log(uf);
        });
    }
</script>

</html>