<?php 

namespace APP\inventario;

class Constantes{
    const LIST_PRODUCTOS="SELECT * FROM producto";
    const CREATE_PRODUCTO="INSERT INTO producto (codigo, nombre, descripcion) VALUES (?, ?, ?)";
    const GET_PRODUCTO_BY_ID="SELECT * from producto where id = ? ";
    const DELETE_PRODUCTO="DELETE FROM producto WHERE id = ?";
}


?>