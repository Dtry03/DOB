<?php 

namespace APP\inventario;

class Constantes{
    const LIST_PRODUCTOS="SELECT * FROM producto";
    const CREATE_PRODUCTO="INSERT INTO producto (ruta_imagen, nombre, descripcion,id_categoria) VALUES (?, ?, ?,?)";
    const GET_PRODUCTO_BY_ID="SELECT * from producto where id = ? ";
    const DELETE_PRODUCTO="DELETE FROM producto WHERE id = ?";
    const LIST_CATEGORIAS="SELECT * FROM categoria";
    const UPDATE_PRODUCTO="UPDATE producto SET nombre = ?, descripcion = ?, ruta_imagen = ?, id_categoria=? WHERE id = ?";
    const CREATE_CATEGORIA="INSERT INTO categoria (nombre) VALUES (?)";
    const GET_CATEGORIA_BY_ID="SELECT * from categoria where id = ? ";
    const DELETE_CATEGORIA="DELETE FROM categoria WHERE id = ?";
}


?>