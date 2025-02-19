<?php 

namespace APP\inventario;

class Producto{
    
    private $id;
    private $nombre;
    private $descripcion;
    private $rutaImagen;

    public function __construct($id,$rutaImagen,$nombre,$descripcion){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->rutaImagen=$rutaImagen;
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

    public function getRutaImagen(){
        return $this->rutaImagen;
    }

    public function setRutaImagen($rutaImagen){
        return $this->rutaImagen=$rutaImagen;
    }


}



?>