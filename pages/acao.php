<?php

$selecao = "";

if (!isset($_GET['pais'] ))
    {
        echo"selecione";
      
} else {

     $selecao = $_GET['pais'];
       var_dump($selecao);

    
     $url = "https://restcountries.com/v3.1/name/{$selecao}";

      $configuracoes = [
                "http" => [
                        "method" => "GET",
                        "header" => "Content-Type: appllication/json"
                ]
        ];
         $context = stream_context_create($configuracoes); 
         $response = file_get_contents($url, false, $context);

          var_dump($selecao);
        //  var_dump($response);
         if ($response == false) {
                $mensagem = "Erro ao acessar API countries";
        } else {

                $dados = json_decode($response, true);  
                if (isset($dados['not found']) == true) { 
                        $mensagem = "dados não encontrados";}
                }
    
  //var_dump($dados);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultado </title>
</head>
<body>
        <div >
               
                        <label> nome </label>
                        <input type="text" value="<?= isset( $dados [0]['capital'][0]) ? $dados[0]['capital'][0]:""?>" disabled >   
                                                
        </div>
</body>
</html>