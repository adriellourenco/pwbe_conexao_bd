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
    
                    
    // executa uma instrução no bd
    mysqli_query($conexao, $sqlQuerry);
}   

/** atualiza um contato no DB */
function updateContato(){
}

/** Lista todos os contatos do DB */
function selectAllContato(){
}

/** Realizar o delete de um contato no DB */
function deleteContato(){
}


?>
