<?php


$selecao=$_GET["pais"];

if (isset($_GET['pais']))
    {
    
     $url = "https://restcountries.com/v3.1/name/{$selecao}";

      $configuracoes = [
                "http" => [
                        "method" => "GET",
                        "header" => "Content-Type: appllication/json"
                ]
        ];
         $context = stream_context_create($configuracoes); 
        $response = file_get_contents($url, false, $context);
         if ($response == false) {
                $mensagem = "Erro ao acessar API ViaCEP";
        } else {

                $dados = json_decode($response, true);  
                if (isset($dados['erro']) == true) { 
                        $mensagem = "cep não encontrado";}
                }
    
} else {

    echo"selecione";
  
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Resultado </title>
</head>
<body>
        <div >
                <span id="error"><?= $mensagem ?></span>
                <div>
                        <label> Logradouro: </label>
                        <input type="text" value="<?= isset( $dados ['logradouro']) ? $dados['logradouro']:""?>" disabel>   
                      
                </div>
               
               
              
                
        </div>
</body>
</html>