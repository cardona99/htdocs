

<?php


if($_POST){
    $buscar =(isset($_POST['buscar'])?$_POST['buscar']:"");

    echo $buscar;
    $stm= $conexion->prepare("SELECT * FROM Libros WHERE Titulo LIKE :buscar OR Autor LIKE :buscar OR Año like :buscar OR Genero LIKE :buscar");
    $stm->bindValue(":buscar",'%' . $buscar . '%');
    $stm->execute();

    



}
?>


<div class="modal fade" id="bus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">buscar libro</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <label for="">buscar</label>
        <input type="text" class="from-control" name="buscar" value="" placeholder = "ingresa busqueda">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">buscar</button>
      </div>
      </form>
    </div>
  </div>
</div>
