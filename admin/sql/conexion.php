<?php 
class Database{
	private static $coneccion;
	//funcion para hacer la coneccion
	private static function conectar() {
		$server = 'localhost';
        $database = 'spsystem';
        $username = 'rebeca';
        $password = '123';
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8");
        //metodo de acceso para hacer referencia a un elemento a un objeto statico
        self::$coneccion = null;
        try
        {
            self::$coneccion = new PDO("mysql:host=".$server."; dbname=".$database, $username, $password, $options);
            self::$coneccion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception)
        {
            //detener el programa y mostrar el mensaje
            die($exception->getMessage());
        }
	}
    //funcion para quitar la coneccion
	private static function desconectar() {
		//vaciar la variable, eliminar la coneccion
		self::$coneccion = null;
	}
 	
 	public static function executeRow($query, $values)
    {
        self::conectar();
        $statement = self::$coneccion->prepare($query);
        $statement->execute($values);
        self::desconectar();
    }

    public static function getRow($query, $values)
    {
        self::conectar();
        $statement = self::$coneccion->prepare($query);
        $statement->execute($values);
        self::desconectar();
        return $statement->fetch(PDO::FETCH_BOTH);
    }

    public static function getRows($query, $values)
    {
        self::conectar();
        $statement = self::$coneccion->prepare($query);
        $statement->execute($values);
        self::desconectar();
        //propiedad que sirve para obtener los registros numericos o asociativos
        return $statement->fetchAll(PDO::FETCH_BOTH);
    }
}    
 ?>