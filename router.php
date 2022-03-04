<?php 
 ///////////////////////////////////////////////////////////////////
//                                                                //
// Arquivo que recebe as requisições e realiza chamadas na camada // 
// de controller                                                  //
//                                                                //
// Autor:   Leonardo Antunes                                      //
// Data:    04/03/22                                              //
// Versão:  1.0                                                   //
//                                                                //
///////////////////////////////////////////////////////////////////

$action = (string) null; // qual ação deve ser realizada
$component = (string) null; // quem esta fazendo a requisição

// validação para verificar se a requisição é um POST de um formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // recebendo dados da url para saber quem esta solicitando e qual ação deve ser realizado
    $component = strtoupper($_GET["component"]); 
    $action = strtoupper($_GET["action"]);

    switch ($component) {
        case "CONTATOS":
            echo "requisição do component contatos";
            break;

        default:
            echo "ERROR: invalid component";
            break;
    } 
}
