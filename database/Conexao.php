<?php 
class Conexao
{
    public static $conection;

    public static function connect()
    {
        try {
            self::$conection = new \PDO('mysql:host=localhost;dbname=contatos', 'gui', 'root');
            self::$conection->exec("set names utf8");
            self::$conection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);    
        } catch (\PDOException $th) {
            echo "Error: " , $th->getMessage();
        }
        
        return self::$conection;
      
    }

}
