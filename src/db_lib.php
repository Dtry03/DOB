<?php 

namespace APP\inventario;

function openCon($host,$user,$pass,$dbname){
    try {
        
        $dns="mysql:host=$host;dbname=$dbname";

        $conn= new \PDO($dns,$user,$pass, array(\PDO::ATTR_PERSISTENT=>true));

        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    } catch (\PDOException $e) {
        
        echo "error al conectar con la base de datos";
    }

    return $conn;
}


function closeCon($conn){
    try {
        
        if($conn!=null){
            $conn=null;
        }


    } catch (\PDOException $e) {
        
        echo "error al cerrar la conexión con la base de datos";
    }

}


function executeSelectStmtAssoc($conn,$sql, $params){

    try {
        if($conn== null){
            throw new \RuntimeException("Error al establecer la conexión con la base de datos");
        }

        $stmt=$conn->prepare($sql);

        $idx=1;

        foreach ($params as $param) {
            $stmt->bindValue($idx,$param);
            $idx++;
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
    } catch (\PDOException $e) {

        echo "error al obtener los datos";
        throw new \RuntimeException("Error al e la conexión con la base de datos");
    }

}

function executeSelectStmtObj($conn,$sql, $params){

    try {
        if($conn== null){
            throw new \RuntimeException("Error al establecer la conexión con la base de datos");
        }

        $stmt=$conn->prepare($sql);

        $idx=1;

        foreach ($params as $param) {
            $stmt->bindValue($idx,$param);
            $idx++;
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    
    } catch (\PDOException $e) {

        echo "error al obtener los datos";
        throw new \RuntimeException("Error al e la conexión con la base de datos");
    }

}

function executeSelectStmtCLass($conn,$sql, $params,$class,$args){

    try {
        if($conn== null){
            throw new \RuntimeException("Error al establecer la conexión con la base de datos");
        }

        $stmt=$conn->prepare($sql);

        $idx=1;

        foreach ($params as $param) {
            $stmt->bindValue($idx,$param);
            $idx++;
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS,\PDO::FETCH_PROPS_LATE,$class,$args);
    
    } catch (\PDOException $e) {

        echo "error al obtener los datos";
        throw new \RuntimeException("Error al e la conexión con la base de datos");
    }

}

function executeDMLStmt($conn,$sql,$params){

    try {
        if($conn== null){
            throw new \RuntimeException("Error al establecer la conexión con la base de datos");
        }

        $stmt=$conn->prepare($sql);

        $idx=1;

        foreach ($params as $param) {
            $stmt->bindValue($idx,$param);
            $idx++;
        }

        return $stmt->execute();

       
    
    } catch (\PDOException $e) {

        echo "error al actualizar los datos";
        throw new \RuntimeException("Error al e la conexión con la base de datos");
    }

}


?>