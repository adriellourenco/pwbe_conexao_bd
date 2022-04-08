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

    //Declaração de variável para usar nos retuns desta função 
    $statusResposta = (boolean) false; 

    //Abre a conexão com o BD
    $conexao = abrirConexaoMysql();

    // montando instrução sql que será executada para inserir um contato no DB
    $sqlQuerry = "insert into tblcontatos (nome, telefone, celular, email, observacao) 
	                values ('". $dadosContato["nome"] ."', 
                        '". $dadosContato["telefone"] ."', 
                        '". $dadosContato["celular"] ."', 
                        '". $dadosContato["email"] ."', 
                        '". $dadosContato["obs"] ."');";
    
                    
    // executa uma instrução no bd verificando se ela esta correta
    if ( mysqli_query($conexao, $sqlQuerry) ) {
        if ( mysqli_affected_rows($conexao) ) {
            $statusResposta = true;
        }
    }

    fecharConexaoMySQL($conexao);

    return $statusResposta;

}   

/** atualiza um contato no DB */
function updateContato($dadosContato){

    //Declaração de variável para usar nos retuns desta função 
    $statusResposta = (boolean) false; 

    //Abre a conexão com o BD
    $conexao = abrirConexaoMysql();

    // montando instrução sql que será executada para inserir um contato no DB
    $sqlQuery = "update tblcontatos set 
                        nome = '". $dadosContato["nome"] ."',
                        telefone = '". $dadosContato["telefone"] ."', 
                        celular = '". $dadosContato["celular"] ."', 
                        email = '". $dadosContato["email"] ."', 
                        observacao = '". $dadosContato["obs"] ."'
                        where idcontato =".$dadosContato["id"];
                    // NÃO PODE ESQUECER DO WHERE!!!
                    
    // executa uma instrução no bd verificando se ela esta correta
    if ( mysqli_query($conexao, $sqlQuery) ) {
        if ( mysqli_affected_rows($conexao) ) {
            $statusResposta = true;
        }
    }

    //Fecha a conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;

}

/** Lista todos os contatos do DB */
function selectAllContatos(){

    //Abre a conecao com o BD
    $conexao = abrirConexaoMysql();

    //script para listar todos os dados no BD por ordem de inserção
    // SEMPRE QUE VOCÊ PUDER, DELEGUE AS TAREFAS PARA O BANCO! NÃO PARA O BACK-END OU PARA O FRONT-END! 
    $sqlQuerry = "select * from tblcontatos order by idcontato desc"; //desc - descendente(decrescente) e asc - ascendente(crescente)

    //$res = result
    $res = mysqli_query($conexao, $sqlQuerry);

    if ( $res ) {
        $cont = 0;
        // convertendo a resposta do BD para array
        while ( $resData = mysqli_fetch_assoc($res) ) {
            $resArray[$cont] = array(
                "id"         => $resData['idcontato'],
                "nome"       => $resData["nome"],
                "telefone"   => $resData["telefone"],
                "celular"    => $resData["celular"],
                "email"      => $resData["email"],
                "obs"        => $resData["observacao"]
            );

            $cont++;
        }       

        //Solicita o fechamento da conexao com o BD
        fecharConexaoMySQL($conexao);

        return $resArray;
    }   
}

/************************
 * Ordem: Model 
 *        Controller
 *         View
 ***********************/

/** Realizar o delete de um contato no DB */
function deleteContato($idcontato){
    
    //Declaração de variável para usar nos retuns desta função 
    $statusResposta = (boolean) false; 

    //Abre conexao com o BD
    $conexao = abrirConexaoMysql();

    //Comando de execução no banco para a exclusão de um contato 
    $sql = "delete from tblcontatos where idcontato=".$idcontato;

    //Tentando executar o comando no BD
    $bdRes = mysqli_query($conexao, $sql);

    //Valida se o script esta correto, sem erro de sintaxe e executa no BD
    if ($bdRes) {
        
        //Valida se o BD teve sucesso na execução de um script
        if (mysqli_affected_rows($conexao)) {
           $statusResposta = true;
        }
    }

    fecharConexaoMySQL($conexao);
    return $statusResposta;

}

//Função para buscar um contato no BD atraves do id do registro
function selectByIdContato($idcontato){

    //Abre a conecao com o BD
    $conexao = abrirConexaoMysql();

    //script para selecionar um contato no BD 
    $sqlQuery = "select * from tblcontatos where idcontato=".$idcontato;

    //$res = result
    $res = mysqli_query($conexao, $sqlQuery);

    //valida se o BD retornou registros 
    if ( $res ) {

        // convertendo a resposta do BD para array
        if ( $resData = mysqli_fetch_assoc($res) ) {
            $resArray = array(
                "id"         => $resData['idcontato'],
                "nome"       => $resData["nome"],
                "telefone"   => $resData["telefone"],
                "celular"    => $resData["celular"],
                "email"      => $resData["email"],
                "obs"        => $resData["observacao"]
            );
        }       

        //Solicita o fechamento da conexao com o BD
        fecharConexaoMySQL($conexao);

        
        return $resArray;
    }

}

?>
