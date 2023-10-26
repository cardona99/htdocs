<?php

include("../../conexion.php");

if(isset($_GET["id"])){

    $txtid = (isset($_GET["id"])?$_GET["id"]:"");
    $stm=$conexion->prepare("SELECT * FROM Libros WHERE id=:txtid");
    $stm->bindparam(":txtid",$txtid);
    $stm->execute();
    $registro = $stm->fetch(PDO::FETCH_LAZY);
    $Titulo = $registro["Titulo"];
    $Autor = $registro["Autor"];
    $fecha = $registro["Año"];
    $Genero = $registro["Genero"];


}

if($_POST){
    $txtid =(isset($_POST['txtid'])?$_POST['txtid']:"");
    $Titulo =(isset($_POST['Titulo'])?$_POST['Titulo']:"");
    $Autor =(isset($_POST["Autor"])?$_POST["Autor"]:"");
    $fecha =(isset($_POST["fecha"])?$_POST["fecha"]:"");
    $Genero =(isset($_POST["Genero"])?$_POST["Genero"]:"");

    if (empty($Titulo) || empty($Autor) || empty($fecha) || empty($Genero)) {
        $message = "Por favor, complete todos los campos.";
    } else {

    $stm= $conexion->prepare( "UPDATE Libros SET Titulo=:Titulo,Autor=:Autor,Año=:fecha,Genero=:Genero WHERE id=:txtid");
    $stm->bindparam(":Titulo",$Titulo);
    $stm->bindparam(":Autor",$Autor);
    $stm->bindparam(":fecha",$fecha);
    $stm->bindparam(":Genero",$Genero);
    $stm->bindparam(":txtid",$txtid);
    $stm->execute();

    header("location:index.php");
    }

}
?>

<?php include("../../template/header.php"); ?>



<form action="" method="post">

         <div class="message">
          <?php
             if (isset($message)) {
                 echo '<p>' . $message . '</p>';
                     }
            ?>
         </div>
        
        <input type="hidden" class="from-control" name="txtid" value="<?php echo $txtid;?>" placeholder = "ingresa titulo">

        <label for="">Titulo</label>
        <input type="text" class="from-control" name="Titulo" value="<?php echo $Titulo;?>" placeholder = "ingresa titulo">

        <label for="">Autor</label>
        <input type="text" class="from-control" name="Autor" value="<?php echo $Autor;?>" placeholder = "ingresa Autor">

        <label for="">fecha</label>
        <input type="date" class="from-control" name="fecha" value="<?php echo $fecha;?>"placeholder = "ingresa año publicacion">


        <label for="">Genero</label>
        <input type="text" class="from-control" name="Genero" value="<?php echo $Genero;?>" placeholder = "ingresa Genero">

      </div>
      <div class="modal-footer">
        <a href="index.php" class="btn btn-danger">cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      </form>
      <?php include("../../template/footer.php");?>