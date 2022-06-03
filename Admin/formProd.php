<?php
include ("plantillas/encabezado.php");
include ("BDD/conexion.php");

    $id = "";
    $nombre = "";
    $detalle = "";
    $precio = "";
    $stock = "";
    $foto = "";
    $categoria = "";

if($_SERVER['REQUEST_METHOD'] === "POST"){  //Si la informacion la trae un emtodo POST

    if(isset($_POST) && $_POST["Enviar"] == "Actualizar"){
        $id = $_POST["id"];             //En una variable almacena lo que contenga el id
        $sql = "select * from productos where id_prod = $id";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        //--Categoria
        
        //--Productos
        $id = $row['id_prod'];
        $nombre = $row['nombre'];
        $detalle = $row['detalle'];
        $precio = $row['precio'];
        $stock = $row['stock'];
        $foto = $row['foto'];
        $categoria = $row['id_categoria'];
    }
}
?>

<div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6"><br>
                <div class="card">
                    <div class="card-header">
                        Datos del Producto
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="BDD/ProductosCRUD.php">
                        <!--Para traer el ide para editar-->
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <!---->
                        <div class = "form-group">
                            <label for="nombres">Ingrese nombre del producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese sus nombres" value="<?php echo $nombre ?>">
                        </div>
                        <br>
                        <div class = "form-group">
                            <label for="apellidos">Ingrese detalles del producto</label>
                            <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Ingrese sus apellidos" value="<?php echo $detalle ?>">
                        </div>
                        <br>
                        <div class = "form-group">
                            <label for="apellidos">Ingrese precio del producto</label>
                            <input type="text" class="form-control" id="precio" name="precio" placeholder="Ingrese sus apellidos" value="<?php echo $precio ?>">
                        </div>
                        <br>
                        <div class = "form-group">
                            <label for="apellidos">Ingrese stock del producto</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Ingrese sus apellidos" value="<?php echo $stock ?>">
                        </div>
                        <br>
                        <div class = "form-group">
                            <label for="foto">Seleccione el archivo</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/" placeholder="Seleccione el archivo" value="<?php echo $foto ?>">
                        </div>
                        <br>
                        <h3><?php echo $foto ?></h3>

                            <label for="descripcon">Categoria</label>
                            <select class="form-select" id="cbx" name="cbx">
                            <?php
                                if(empty($Ncategoria)){
                                    echo "<option selected> Seleccione </option>";
                                }else{
                                    echo "<option value=$idCat selected> $Ncategoria </option>";
                                }
                            ?>
                            <?php 
                                $sqlCat = "select * from categorias";
                                $res = $conn->query($sqlCat);

                                while($row = mysqli_fetch_array($res)){ 
                                $idCat = $row['id_categoria'];
                                $Ncategoria = $row['nombre'];        
                            ?>
                                <option value="<?php echo $idCat; ?>"><?php echo $Ncategoria; ?></option>
                            <?php 
                                } 
                            ?>
                            </select>

                        <!--
                            <input type="text" class="form-control" id="id_categoria" name="id_categoria" placeholder="Ingrese la descripcion" value="<?php echo $categoria ?>">
                        -->
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