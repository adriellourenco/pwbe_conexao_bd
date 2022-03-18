<?php 
/*==================================================*\                                                 
 *
 * Arquivo responsavel por manipular os dados       
 * dentro do bd (insert, update, select e delete)   
 *                                                  
 * Autor    :   Leonardo                            
 * Data     :   11/03/22                            
 * Versão   :   1.0                                 
 *                                                 
\*==================================================*/

require_once("conexaoMysql.php");


/** Realiza o insert de um contato no DB */
function insertContato($dadosContato) {
    $conexao = abrirConexaoMysql();

    // montando instrução sql que será executada para inserir um contato no DB
    $sqlQuerry = "insert into tbl_contato (nome, telefone, celular, email, obs) 
	                values ('". $dadosContato["nome"] ."', 
                        '". $dadosContato["telefone"] ."', 
                        '". $dadosContato["celular"] ."', 
                        '". $dadosContato["email"] ."', 
                        '". $dadosContato["obs"] ."');";
    
                    
    // executa uma instrução no bd verificando se ela esta correta
    if ( mysqli_query($conexao, $sqlQuerry) ) {
        if ( mysqli_affected_rows($conexao) ) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    } 
}   

/** atualiza um contato no DB */
function updateContato(){
}

/** Lista todos os contatos do DB */
function selectAllContatos(){
    $conexao = abrirConexaoMysql();

    $sqlQuerry = "select * from tbl_contato";

    $res = mysqli_query($conexao, $sqlQuerry);

    if ( $res ) {
        $cont = 0;
        // convertendo a resposta do BD para array
        while ( $resData = mysqli_fetch_assoc($res) ) {
            $resArray[$cont] = array(
                "nome"       => $resData["nome"],
                "telefone"   => $resData["telefone"],
                "celular"    => $resData["celular"],
                "email"      => $resData["email"],
                "obs"        => $resData["obs"]
            );

            $cont++;
        }       

        return $resArray;
    }   

    
}

/** Realizar o delete de um contato no DB */
function deleteContato(){
}


?>
