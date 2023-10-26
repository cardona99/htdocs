<?php
error_reporting(0);
include("../../conexion.php");

$valor = $_POST["campo"];
if(empty($valor)){
    $stm=$conexion->prepare("SELECT * FROM Libros");
    $stm->execute();
    $libros= $stm->fetchAll(PDO::FETCH_ASSOC);
}
else{
    $stm= $conexion->prepare("SELECT * FROM Libros WHERE Titulo LIKE :buscar OR Autor LIKE :buscar OR Año like :buscar OR Genero LIKE :buscar");
    $stm->bindValue(":buscar",'%' . $valor . '%');
    $stm->execute();
    $libros= $stm->fetchAll(PDO::FETCH_ASSOC);

}

if(isset($_GET["id"])){

    $txtid = (isset($_GET["id"])?$_GET["id"]:"");
    $stm=$conexion->prepare("DELETE FROM Libros WHERE id=:txtid");
    $stm->bindparam(":txtid",$txtid);
    $stm->execute();
    header("location:index.php");

}

?>


<?php include("../../template/header.php"); ?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
  Nuevo
</button>

<form action ="<?php $_SERVER["PHP_SELF"];?>" method="POST">
    <b>Busqueda:</b><input type="text" id= "campo" name="campo"/>
    <input type="submit" id= "enviar" name="enviar" value = "Buscar"/>
</form>

<div class="table-responsive">
    <table class="table ">
        <thead class = "table table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titulo</th>
                <th scope="col">Autor</th>
                <th scope="col">Año</th>
                <th scope="col">Genero</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($libros as $libro){  ?>
            <tr class="">
                <td scope="row"><?php echo $libro["id"]; ?></td> 
                <td><?php echo $libro["Titulo"]; ?></td>
                <td><?php echo $libro["Autor"]; ?></td>
                <td><?php echo $libro["Año"]; ?></td>
                <td><?php echo $libro["Genero"]; ?></td>
                <td>
                <a href="edit.php?id=<?php echo $libro["id"]; ?>"class="btn btn-success">Editar</a>
                <a href="index.php?id=<?php echo $libro["id"]; ?>"class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php } ?>    
        </tbody>
    </table>
</div>

<?php if(empty($valor)){
include("create.php");
}?>








<?php include("../../template/footer.php"); ?>