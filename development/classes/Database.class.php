<?php
namespace Softalist;
class Database
{    
    protected function connect()
    {
        try {
            $hostname = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'softalist_test';

            $pdo = new \PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            return $pdo;
            // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(\PDOException $e) {
            echo "Verbinding met de database is mislukt: " . $e->getMessage() . "<br>";
            die();
        }
    }

    public function insert($query, $arguments, $returnId = null)
    {
        $mydb = $this->connect();
        $statement = $mydb->prepare($query);
 
        if (!$statement->execute($arguments)) {
            $statement = null;
            return "Error: Probleem met statement!";
            exit();
        }
        
        if ($statement->rowCount() == 0) {
            
            $statement = null;
            return "Error: er zijn 0 rijen ingevoegd!";
            exit();
        }
        
        if(isset($returnId)) {
            return $mydb->lastInsertId($returnId);
        }

        $statement = null;
        return true;

    }

    public function select($query, $arguments = null)
    {
        $statement = $this->connect()->prepare($query);

        if (!$statement->execute($arguments)) {
            $statement = null;
            return "Error: Probleem met statement!";
            exit();
        }

        if ($statement->rowCount() == 0) {
                
            $statement = null;
            return "Error: er zijn 0 rijen!";
            exit();
        }
    
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectObject($query, $arguments = null)
    {
        $statement = $this->connect()->prepare($query);

        if (!$statement->execute($arguments)) {
            $statement = null;
            return "Error: Probleem met statement!";
            exit();
        }

        if ($statement->rowCount() == 0) {
                
            $statement = null;
            return "Error: er zijn 0 rijen!";
            exit();
        }
    
        //return $statement->fetchObject('\Softalist\Category',["id","name"]);
        return $statement->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, '\Softalist\Category', ['id', 'name']);
        //return $statement->fetchAll(\PDO::FETCH_ASSOC);


    }

    
}