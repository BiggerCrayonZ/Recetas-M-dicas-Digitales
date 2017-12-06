<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Añadir Medicinas</title>
    <!-- Normalizador para compatibilidad en navegadores -->
    <link rel="stylesheet" href="rsc/css/normalize.css">
    <link rel="stylesheet" href="rsc/css/estilo.css">

</head>

<body>
    <?php
        $nombre = $nombre_comercial = $descripcion = "";
        $nombreErr = $nombre_comercialErr = $descripcionErr = $repwErr = $fullnameErr = "";

        $servername = "localhost";
        $username = "id3182203_user";
        $password = "recetas$1";
        $dbname = "id3182203_recetas_medicas";

        

        
        if (isset($_POST['new'])) {
                    $idNombre = trim($_POST["nombre"]); 
                    $idNombre_comercial = trim($_POST["nombre_comercial"]);
                    $idDescripcion = trim($_POST["descripcion"]);
                    $idTipo_medicamento = trim($_POST["tipo_medicamento"]);
                    $idTipo_forma = trim($_POST["tipo_forma"]);
                    $idDosis = trim($_POST["dosis"]);
                    $idPesaje = trim($_POST["pesaje"]);
                    $idPrecio_lista = trim($_POST["precio_lista"]);

                

                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "INSERT INTO Medicinas (nombre, nombreComercial, descripcion, tipo, forma, dosis, pesaje, precio) VALUES ('$idNombre', '$idNombre_comercial', '$idDescripcion', '$idTipo_medicamento', '$idTipo_forma', '$idDosis', '$idPesaje', '$idPrecio_lista');";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script language='javascript'>alert('El medicamento: " . $idNombre . " fue añadido con exito');</script>";
                    } else {
                        echo "<script language='javascript'>alert('Error en el servidor, contacte al administrador.');</script>";
                    }
                    
                }

    ?>
    <div>
        <!-- Encabezado -->
        <h3 class="animate-top">Nueva Medicina</h3>
        <form action="modulo_medicinas.php" method="POST" class="paciente_form">
            <div align="center" class="animate-top-2">
                <ul>
                    <hr>
                    <li>
                        <h4 class="animate-top">Datos Farmacéuticos </h4>
                    </li>
                    <li>
                        <label for="name">Nombre del Medicamento: </label>
                        <input type="text" placeholder="Estandar Medicinal" name="nombre" required />
                        <span class="error">*
                                <?php echo $nombreErr;?>
                            </span>
                    </li>
                    <li>
                        <label for="name">Nombre Comercial: </label>
                        <input type="text" placeholder="Nombre impuesto por marca" name="nombre_comercial" required />
                        <span class="error">*
                                <?php echo $nombre_comercialErr;?>
                            </span>
                    </li>
                    <li>
                        <label for="desc">Descripción: </label>
                        <textarea name="descripcion" cols="40" rows="6" required></textarea>
                        <span class="error">*
                                <?php echo $descripcionErr;?>
                            </span>
                    </li>
                    <li>
                        <h4 class="animate-top">Categorías: </h4>
                    </li>
                    <li>
                        <label for="tipo">Tipo de Medicamento: </label>
                        <select class="select-form-medicinas" name="tipo_medicamento">
                                        <option value="analgesico">Analgésico</option>
                                        <option value="ansiolítico">Ansiolítico</option>
                                        <option value="antiacido">Antiácido</option>
                                        <option value="antidiarreico">Antidiarreico</option>
                                        <option value="antigripal">Antigripal</option>
                                        <option value="antihistamínico">Antihistamínico</option>
                                        <option value="antiinflamatorio">Antiinflamatorio</option>
                                </select>
                    </li>
                    <li>
                        <label for="name">Forma Farmaceutica: </label>
                        <select class="select-form-medicinas" name="tipo_forma">
                                <option value="Capsula">Capsula</option>
                                <option value="Pildoras">Pildoras</option>
                                <option value="Gotas">Gotas</option>
                                <option value="Jarabes">Jarabe</option>
                                <option value="Supositorio">Supositorio</option>
                                <option value="Elixir">Elixir</option>
                                <option value="Suspención">Suspención</option>
                        </select>
                    </li>
                    <li>
                        <label for="dosis">Dosis:  </label>
                        <input type="text" placeholder="Forma de úso" name="dosis">
                    </li>
                    <li>
                        <label for="pesaje">Pesaje: </label>
                        <input type="number" placeholder="gr(Gramos)" name="pesaje">
                    </li>
                    <li>
                        <label for="precio_lista">Precio de Lista: </label>
                        <input type="number" placeholder="$" name="precio_lista" title="Ser especifico en cuento a los datos">
                    </li>
                    <br>
                    <hr>
                    <li>
                        <button onclick="window.location.href='https://ampandroid.000webhostapp.com/rm/menu.php'">Regresar</button>
                        <button class="submit" name="new" type="submit">Añadir Medicamento</button>
                    </li>
                </ul>
            </div>
        </form>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>

</body>

</html>