<?php
include 'database/database.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id_producto'])){
        $query="select * from producto where id_producto=".$_GET['id_producto'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="select * from producto";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $nombre=$_POST['nombre'];
    $referencia=$_POST['referencia'];
    $precio=$_POST['precio'];
    $categoria=$_POST['categoria'];
    $stock=$_POST['stock'];
    $peso=$_POST['peso'];
    $venta=$_POST['venta'];
    $query="insert into producto(nombre, referencia, precio, categoria, stock, peso, venta) values ('$nombre', '$referencia', '$precio', '$categoria', '$stock', '$peso', '$venta')";
    $queryAutoIncrement="select MAX(id_producto) as id_producto from producto";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id_producto=$_GET['id_producto'];
    $nombre=$_POST['nombre'];
    $referencia=$_POST['referencia'];
    $precio=$_POST['precio'];
    $categoria=$_POST['categoria'];
    $stock=$_POST['stock'];
    $peso=$_POST['peso'];
    $venta=$_POST['venta'];
    $query="UPDATE producto SET nombre='$nombre', referencia='$referencia', precio='$precio', categoria='$categoria', stock='$stock', peso='$peso', venta='$venta' WHERE id_producto='$id_producto'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}


if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id_producto=$_GET['id_producto'];
    $query="DELETE FROM producto WHERE id_producto='$id_producto'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");


?>