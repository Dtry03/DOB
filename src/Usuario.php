<?php 

namespace APP\inventario;

class Usuario{
    
    private $id;
    private $nombre;

    public function __construct($id,$nombre){
        $this->id=$id;
        $this->nombre=$nombre;
    }
    
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        return $this->id=$id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        return $this->nombre=$nombre;
    }

}


?>