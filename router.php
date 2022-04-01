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
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    
    // recebendo dados da url para saber quem esta solicitando e qual ação deve ser realizado
    $component = strtoupper($_GET["component"]); 
    $action = strtoupper($_GET["action"]);

    // Estrutura para validar quem esta solicitando algo para o router
    switch ($component) {
        case "CONTATOS":
            require_once("./controller/controllerContatos.php");

            $res = inserirContato($_POST);
            
            // validação para indentificar o tipo de ação que será realizada 
            if ($action == "INSERIR") {
                if ( is_bool($res) && $res == true ) { 
                    echo "<script>
                            alert('Contato inserido com sucesso');
                            window.location.href = 'index.php';
                          </script>";

                } else if ( is_array($res) ) {
                     echo "<script>
                            alert('Erro: " . $res["message"] . "');
                            window.history.back();
                          </script>";                   
                }
            } elseif($action == 'DELETAR'){

                //Recebe o id do item que deverá ser excluído, 
                //que foi enviado pela url no link da imagem
                //de excluir que acionado na index 
                $idcontato = $_GET['id'];

                //chama a função de exclui na controller
                $resposta = excluirContato($idcontato);

                if (is_bool($resposta) && $resposta) {
                        echo ("<script>
                        alert('Registro excluído com sucesso');
                        window.location.href = 'index.php';
                        </script>");
                } elseif (is_array($resposta)) {
                    echo "<script>
                    alert('". $res["message"] . "');
                    window.history.back();
                    </script>";  
                }
            } elseif ($action == 'BUSCAR'){

                //Recebe o id do item que deverá ser editado, 
                //que foi enviado pela url no link da imagem
                //de editar que foi acionado na index 
                $idcontato = $_GET['id'];

                //chama a função de buscar na controller
                $dados = buscarContato($idcontato);

                //Ativa a utilização de variáveis de sessão no servidor 
                session_start();

                //Guarda em uma variável de sessão os dados que o BD retornou para a busca do id
                    //Obs: Essa variável de sessão será utilizada na index para colocar nas caixas de texto
                $_SESSION['dadosContato'] = $dados;

                //header('location: index.php');

                //Utilizando o require iremos apenas importar a tela do index,
                //assim não havendo um novo carrregamento da página 
                require_once("index.php");
            }
            break;

        default:
            echo "ERROR: invalid component";
            break;
    } 
}
