<?php 

namespace APP\inventario;

class Producto{
    
    private $id;
    private $nombre;
    private $descripcion;
    private $ruta_imagen;
    private $id_categoria;

    public function __construct($id,$ruta_imagen,$nombre,$descripcion,$id_categoria){
        $this->id=$id;
        $this->ruta_imagen=$ruta_imagen;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->id_categoria=$id_categoria;
        
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

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        return $this->descripcion=$descripcion;
    }

    public function getruta_imagen(){
        return $this->ruta_imagen;
    }

    public function setruta_imagen($ruta_imagen){
        return $this->ruta_imagen=$ruta_imagen;
    }

    public function getid_categoria(){
        return $this->id_categoria;
    }

    public function setid_categoria($id_categoria){
        return $this->id_categoria=$id_categoria;
    }



}



?>