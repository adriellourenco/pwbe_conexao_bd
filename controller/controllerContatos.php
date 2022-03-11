<?php
 /////////////////////////////////////////////////////
//                                                  //
// Arquivo responsavel pela manipulação de dados de //
// contato                                          //
// Obs: este arquivo fará a ponte entre a view e a  //
//   model                                          //
//                                                  //
// Autor  :  Leonardo Antunes                       //
// Data   :  04/03/22                               //
// Versão :  1.0                                    //
/////////////////////////////////////////////////////

require_once("model/bd/contato.php");

/**
 * Inserir novos contatos atravez dos dados recebidos pela view
 */
function inserirContato( $dadosContato ){
    
    // impede a execução desta função quando $dadosContato for vazio
    if ( !empty($dadosContato) ) {

        // verifica se os campos obrigatorios foram preenchidos, não permitindo a execução caso não foram
        if ( !empty($dadosContato["txtNome"]) && !empty($dadosContato["txtCelular"]) && !empty($dadosContato["txtEmail"]) ) {
            // array que sera encaminhado para a model para ser inserido no DB.
            $contato = array(
                "nome"      => $dadosContato["txtNome"],
                "telefone"  => $dadosContato["txtTelefone"],
                "celular"   => $dadosContato["txtCelular"],
                "email"     => $dadosContato["txtEmail"],
                "obs"       => $dadosContato["txtObs"] 
            );



            insertContato($contato);
        } else {
            echo "ERRO: dados obrigatorios não encontrados";
        }
    }
}

/**
 * Atualizar os contatos atravez dos dados recebidos pela view
 */
function atualizarContato(){
}

/**
 * Excluir contatos atravez dos dados recebidos pela view
 */
function excluirContato(){
}

/**
 * Solicita os dados de contato da model e encaminha para a view
 */
function listarContato(){
}

?>
