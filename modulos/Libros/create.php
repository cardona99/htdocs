<?php

if($_POST){
    $Titulo =(isset($_POST['Titulo'])?$_POST['Titulo']:"");
    $Autor =(isset($_POST["Autor"])?$_POST["Autor"]:"");
    $fecha =(isset($_POST["fecha"])?$_POST["fecha"]:"");
    $Genero =(isset($_POST["Genero"])?$_POST["Genero"]:"");

    if (empty($Titulo) || empty($Autor) || empty($fecha) || empty($Genero)) {
      echo "Por favor, complete todos los campos.";
  } else {
    $stm= $conexion->prepare("INSERT INTO Libros(id,Titulo,Autor,fecha,Genero)
    VALUES(null,:Titulo,:Autor,:fecha,:Genero)");
    $stm->bindparam(":Titulo",$Titulo);
    $stm->bindparam(":Autor",$Autor);
    $stm->bindparam(":fecha",$fecha);
    $stm->bindparam(":Genero",$Genero);
    $stm->execute();

    header("location:index.php");
  }

}
?>
<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">agregar libro</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <label for="">Titulo</label>
        <input type="text" class="from-control" name="Titulo" value="" placeholder = "ingresa titulo">
        <br>
        <br>
        <label for="">Autor</label>
        <input type="text" class="from-control" name="Autor" value="" placeholder = "ingresa Autor">
        <br>
        <br>
        <label for="">fecha</label>
        <input type="date" class="from-control" name="fecha" value=""placeholder = "ingresa fecha publicacion">
        <br>
        <br>
        <label for="">Genero</label>
        <input type="text" class="from-control" name="Genero" value="" placeholder = "ingresa Genero">
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>


