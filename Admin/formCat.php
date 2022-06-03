<?php
include ("plantillas/encabezado.php");
include ("BDD/conexion.php");

    $id = "";
    $nombre = "";

if($_SERVER['REQUEST_METHOD'] === "POST"){  //Si la informacion la trae un emtodo POST

    if(isset($_POST) && $_POST["Enviar"] == "Actualizar"){
        $id = $_POST["id"];             //En una variable almacena lo que contenga el id
        $sql = "select * from categorias where id_categoria = $id";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        //--Categoria
        
        //--Productos
        $id = $row['id_categoria'];
        $nombre = $row['nombre'];
    }
}
?>

<div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6"><br>
                <div class="card">
                    <div class="card-header">
                        Datos de la Categoria
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="BDD/CategoriaCRUD.php">
                        <!--Para traer el ide para editar-->
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <!---->
                        <div class = "form-group">
                            <label for="nombres">Ingrese nombre de la categoria</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese sus nombres" value="<?php echo $nombre ?>">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" name="Enviar" value="Guardar">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>

<?php
include ("plantillas/pie.php");
?>