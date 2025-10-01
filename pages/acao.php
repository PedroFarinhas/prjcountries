<?php

$selecao = "";

if (!isset($_GET['pais'])) {
        echo "selecione";
} else {

        $selecao = $_GET['pais'];

        // var_dump($selecao);


        $url = "https://restcountries.com/v3.1/name/{$selecao}";

        $configuracoes = [
                "http" => [
                        "method" => "GET",
                        "header" => "Content-Type: appllication/json"
                ]
        ];
        $context = stream_context_create($configuracoes);
        $response = file_get_contents($url, false, $context);

        // var_dump($selecao);
        //  var_dump($response);
        if ($response == false) {
                $mensagem = "Erro ao acessar API countries";
        } else {

                $dados = json_decode($response, true);
                if (isset($dados['not found']) == true) {
                        $mensagem = "dados não encontrados";
                }
        }
        // pre é uma tag html que organiza o vardump
        //var_dump($dados);
        //selection e option
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta commom="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultado </title>
</head>

<body>

        <div>

                <label> Extenção do país </label> <br>
                <input type="text" value="<?= isset($dados[0]['tld'][0]) ? $dados[0]['tld'][0] : "correspondência não encontrada " ?>" disabled> <br>

                <label> Capital </label> <br>
                <input type="text" value="<?= isset($dados[0]['capital'][0]) ? $dados[0]['capital'][0] : "correspondência não encontrada" ?>" disabled> <br>

                <label> nome comum no mundo </label> <br>
                <input type="text" value="<?= isset($dados[0]['name']['common']) ? $dados[0]['name']['common'] : "correspondência não encontrada" ?>" disabled> <br> <br>


                <label> Fronteiras </label>
                <ul>
                        <?php foreach ($dados[0]['borders'] as $border): ?>
                                <li><?= $border ?></li>
                        <?php endforeach; ?>
                </ul>

                <!-- nos dois casos não temos validação do erro, australia da erro pois nao tem fronteiras
                 porque é necessário o endforeach? -->

                <select name="borders">
                        <?php foreach ($dados[0]['borders'] as $border): ?>
                                <option value="<?= $border ?>"><?= $border ?></option>
                        <?php endforeach; ?>
                </select> <br><br>


                <label> Bandeiras </label> <br>
                <img src="<?= isset($dados[0]['flags']['png']) ? $dados[0]['flags']['png'] : "caminho/para/imagem_padrao.png" ?>" alt="Bandeira" width="50" height="30">
                <br>


        </div>

</body>

</html>