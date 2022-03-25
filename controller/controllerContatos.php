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


            // import do arquivo de modelagem para manipular o BD
            require_once("model/bd/contato.php");

            // Chama a função que fara o insert no BD apartir da camada Model
            if ( insertContato($contato) ) {
                return true;
            } else {
                // retornando mensagem de erro
                return array(
                    "idErro" => 1,
                    "message" => "não foi possivel inserir os dados no banco de dados"
                );
            }
        } else {

            // retornando mensagem de erro de dados incompletos
            return array(
                "idErro"    => 2,
                "message"   => "Impossivel realizar inserção por causa da falta dos dados obrigatorios"
            );
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
function excluirContato($id){
    if ($id != 0 && !empty($id) && is_numeric($id)) {
       
        //import do arquivo de contato
        require_once('model/bd/contato.php');

        //Chama a função da model e valida se o retorno foi verdadeiro ou falso
        if(deleteContato($id)){
            return true;
        } else{
            return array('idErrro' => 3,
                     'message' => 'O banco de dados não pode excluir o registro.');
        }
    } else{
        return array('idErrro' => 4,
        'message' => 'Não é possível excluir um registro sem informar um id válido'   
    );
    }
}

/**
 * Solicita os dados de contato da model e encaminha para a view
 */
function listarContato(){
    require_once("model/bd/contato.php"); // importando model de contatos
    
    $res = selectAllContatos();

    if ( !empty($res) ) {
        return $res;
    } else {
        return false;
    }
}

?>
