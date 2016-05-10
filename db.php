<?php 

    class DB {

    public static function connection(){
        $dbServer = '127.0.0.1';
        $dbUsuario = 'kae';
        $dbSenha = '123456';
        $dbBanco = 'web2project';
        
        $connection = mysqli_connect($dbServer, $dbUsuario, $dbSenha,$dbBanco);
        
        if(mysqli_connect_errno($connection)){
            echo "Error to connect.";
            die();
        }
        
        return $connection;
        
    }
    
    
   
}

?>

