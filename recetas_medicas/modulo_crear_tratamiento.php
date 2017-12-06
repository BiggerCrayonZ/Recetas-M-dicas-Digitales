<?php

    session_start();

    $servername = "localhost";
    $username = "id3182203_user";
    $password = "recetas$1";
    $dbname = "id3182203_recetas_medicas";

    if (isset($_POST['new'])) {

        //Insertamos los campos en las variables
        $idName = trim($_POST["nombre_trat"]);
        $idInte = trim($_POST["intervalo"]);
        $idDura = trim($_POST["duracion"]);
        $idCaSu = trim($_POST["cantidadSug"]);
        $idMedi = $_POST['elige'];
        $idReco = trim($_POST["recomendacion"]);

        //Conectamos
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        //Preparamos sql
            foreach ($idMedi as $key=>$value) {	
                $sql = "INSERT INTO Tratamiento (nombre, duracion, intervalo_uso, cantidad_sugerida, recomendaciones, id_medicamento) VALUES ('$idName', '$idDura', '$idInte', '$idCaSu', '$idReco', '$value');";
                //Ejecutamos inserción y validamos
                if (mysqli_query($conn, $sql)) {
                    echo "<script language='javascript'>alert('El Tratamiento fue añadido con exito');</script>";
                    echo "<script> salir(); </script>";
                } else {
                    echo "<script language='javascript'>alert('Error en el servidor, contacte al administrador.');</script>";
                }
        }           
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Añadir Tratamiento</title>
    <!-- Normalizador para compatibilidad en navegadores -->
    <link rel="stylesheet" href="rsc/css/normalize.css">
    <link rel="stylesheet" href="rsc/css/estilo.css">

</head>

<body>
    <div>
        <!-- Encabezado -->
        <h3 class="animate-top">Nueva Tratamiento</h3>
        <form action="modulo_crear_tratamiento.php" method="POST" class="paciente_form">
            <div align="center" class="animate-top-2">
                <ul>
                    <hr>
                    <li>
                        <h4 class="animate-top">Formularío de Alta </h4>
                    </li>
                    <li>
                        <label class="left" for="name_trat">Nombre del Tratamiento: </label>
                        <input type="text" placeholder="Estandar por Consultorio" name="nombre_trat" required />
                    </li>
                    <li>
                        <label class="left" for="intervalo">Intervalo: (Diário) </label>
                        <select class="select-form-medicinas " name="intervalo">
                                    <option value="menor a 4 horas">Menor a cada 4 horas</option>
                                    <option value="Cada 4 horas" selected>Cada 4 horas</option>
                                    <option value="Cada 6 horas">Cada 6 horas</option>
                                    <option value="Cada 8 horas">Cada 8 horas</option>
                                    <option value="Cada 10 horas">Cada 10 horas</option>
                                    <option value="Cada 12 horas">Cada 12 horas</option>
                                    <option value="Cada 18 horas">Cada 18 horas</option>
                                    <option value="Cada 24 horas">Cada 24 horas</option>
                                    <option value="Más de 24 horas">Mayor a cada 24 horas</option>
                            </select>
                    </li>
                    <li>
                        <label class="left" for="name">Duración: </label>
                        <select class="select-form-medicinas" name="duracion">
                                <option value="Por Menos de un Día">Por Menos de un Día</option>
                                <option value="Por 1 Día" selected>Por 1 Día</option>
                                <option value="Por 3 Días">Por 3 Días</option>
                                <option value="Por 5 Días">Por 5 Días</option>
                                <option value="Por 1 Semana">Por 1 Semana</option>
                                <option value="Por 2 Semanas">Por 2 Semanas</option>
                                <option value="Por 3 Semanas">Por 3 Semanas</option>
                                <option value="Por solo un Més">Por 1 Més</option>
                                <option value="Por Mas de un Més">Por Mas de un Més</option>
                        </select>
                    </li>
                    <li>
                        <label class="left" for="cantidad">Cantidad Sugerida: </label>
                        <select class="select-form-medicinas" name="cantidadSug">
                                    <option value="Menor a una Unidad">Menor a una Unidad</option>
                                    <option value="Una Unidad" selected>Una Unidad</option>
                                    <option value="Dos unidades">Dos unidades</option>
                                    <option value="Tres Unidades">Tres Unidades</option>
                                    <option value="Cuatro Unidades">Cuatro Unidades</option>
                                    <option value="Mas de 4 unidades">Mas de 4 unidades</option>
                            </select>
                    </li>
                    <hr>
                    <li>
                        <h4 class="animate-top">Selecciona los Medicamentos </h4>
                    </li>
                    <li>
                        <div>
                            <table class="table_medicinas">
                                <tr style="width:auto;">
                                    <th>Selección</th>
                                    <th>Nombre del Medicamento: </th>
                                    <th>Nombre Comercial: </th>
                                    <th>Descripción: </th>
                                    <th>Tipo: </th>
                                    <th>Precio de Lista: </th>
                                </tr>
                                <?php
                                        $servername = "localhost";
                                        $username = "id3182203_user";
                                        $password = "recetas$1";
                                        $dbname = "id3182203_recetas_medicas";

                                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                                        if (!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }
                                
                                        $sql = "SELECT * FROM Medicinas";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            $i=0;
                                            while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo "<input type='checkbox' name='elige[$i]' value='" . $row['idMedicina']."'>";
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['nombre'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['nombreComercial'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['descripcion'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['tipo'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo "$" . $row['precio'];
                                                echo "</td>";
                                            echo "</tr>";
                                            }

                                        } else {
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo "Sin Medicinas Registradas";
                                                echo "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                            </table>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <label for="desc">Recomendaciones para Medicamento: </label>
                        <textarea name="recomendacion" cols="40" rows="6" required></textarea>
                    </li>
                    <br>
                    <hr>
                    <li>
                        <button onclick="window.location.href='https://ampandroid.000webhostapp.com/rm/menu.php'">Regresar</button>
                        <button class="submit" name="new" type="submit">Tratamiento Listo!</button>
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <br>
    <br>
    <br>
    <br>

</body>

</html>