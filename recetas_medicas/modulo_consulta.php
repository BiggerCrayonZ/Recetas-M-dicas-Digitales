<?php

    session_start();

    $servername = "localhost";
    $username = "id3182203_user";
    $password = "recetas$1";
    $dbname = "id3182203_recetas_medicas";

    if (isset($_POST['new'])) {
        $idPaciente = trim($_POST["paciente"]);
        $idMedico = trim($_SESSION["rmUser"]);
        $idPeso = trim($_POST["peso"]);
        $idAltu = trim($_POST["altura"]);
        $idEnfe = trim($_POST["enfermedad"]);
        $idEsta = trim($_POST["estatus"]);
        $idTrat = $_POST['elige'];
        $idObse = trim($_POST["observaciones"]);
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM users WHERE usuario = '$idPaciente'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            foreach ($idTrat as $key=>$value) {	
                $sql = "INSERT INTO Consulta (peso, altura, enfermedad_registrada, estatus_salud, id_tratamiento, fecha,  id_medico, id_paciente, observaciones) VALUES ('$idPeso', '$idAltu', '$idEnfe', '$idEsta', '$value', now(), '$idMedico', '$idPaciente', '$idObse');";
                if (mysqli_query($conn, $sql)) {
                    echo "<script language='javascript'>alert('La Consulta fue añadida con exito');</script>";
                    echo "<script> salir('https://ampandroid.000webhostapp.com/rm/menu.php'); </script>";
                } else {
                    echo "<script language='javascript'>alert('Error en el servidor, contacte al administrador.');</script>";
                }
        }
        
		}else{
            echo "<script language='javascript'>alert('El Paciente no existe, verifique sus datos.');</script>";
        }           
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Consulta Médica</title>
        <!-- Normalizador para compatibilidad en navegadores -->
        <link rel="stylesheet" href="rsc/css/normalize.css">
        <link rel="stylesheet" href="rsc/css/estilo.css">
        <link href="../includes/bootstrap.css" rel="stylesheet">

    </head>

    <body>
        <div>
            <!-- Encabezado -->
            <h3 class="animate-top">Nueva Consulta</h3>
            <form class="paciente_form" action="modulo_consulta.php" method="POST">
                <div align="center" class="animate-top-2">
                    <ul>
                        <li>
                            <h4 class="animate-top">Datos del Paciente</h4>
                        </li>
                        <li>
                            <label for="name">ID de Usuario del Paciente: </label>
                            <input type="text" placeholder="Usuario" name="paciente" onkeyup="paciente_suggestion" required />
                        </li>
                    </ul>
                </div>
                <div align="center" class="animate-top-2">
                    <ul>
                        <hr>

                        <li>
                            <h4 class="animate-top">Diagnostico Médico: </h4>
                        </li>
                        <li>
                            <label for="peso">Peso del Paciente: </label>
                            <input type="text" placeholder="Añadir su peso en Kg." name="peso" name="alergia" required />
                        </li>
                        <li>
                            <label for="altura">Altura del Paciente: </label>
                            <input type="text" placeholder="Altura en cm." name="altura">
                        </li>
                        <hr>
                        <li>
                            <label for="enfermedad">Enfermedad Diagnosticada: </label>
                            <input type="text" placeholder="Enfermedad" name="enfermedad">
                        </li>
                        <li>
                            <label for="estatus">Estatus del Paciente: </label>
                            <select class="select-form-medicinas" name="estatus">
                                <option value="regular">Regular</option>
                                <option value="infección">Enfermedad Infecciosa</option>
                                <option value="congenita">Enfermedad Congenita</option>
                                <option value="hereditaria">Enfermedad Hereditaria</option>
                                <option value="autoinmune">Enfermedad Autoinmune</option>
                                <option value="neurodegenerativa">Enfermedad Neurodegenerativa</option>
                                <option value="mental">Enfermedad Mental</option>
                                <option value="Metabólica">Enfermedad Metabólica</option>
                                <option value="otra">Sin categoría</option>
                            </select>
                        </li>
                        <li>
                            <h4 class="animate-top">Tratamiento a Seguir</h4>
                        </li>
                        <li>
                            <div>
                                <table class="scroll table_medicinas ">
                                    <tr style="width:auto;">
                                        <th>Selección</th>
                                        <th>Nombre del Tratamiento: </th>
                                        <th>Nombre del Medicamento: </th>
                                        <th>Duración: </th>
                                        <th>Intervalo: </th>
                                        <th>Cantidad Sugerida: </th>
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
                                
                                        $sql = "SELECT Tratamiento.id_tratamiento, Tratamiento.nombre, Medicinas.nombreComercial, Tratamiento.duracion, Tratamiento.intervalo_uso, Tratamiento.cantidad_sugerida FROM Tratamiento INNER JOIN Medicinas ON Tratamiento.id_medicamento = Medicinas.idMedicina";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            $i=0;
                                            while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo "<input type='checkbox' name='elige[$i]' value='" . $row['id_tratamiento']."'>";
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['nombre'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['nombreComercial'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['duracion'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['intervalo_uso'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['cantidad_sugerida'] . "gr" ;
                                                echo "</td>";
                                            echo "</tr>";
                                            }

                                        } else {
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo "Sin Tratamientos Registrados";
                                                echo "</td>";
                                            echo "</tr>";
                                        }


                                    ?>
                                </table>
                            </div>
                        </li>
                        <li>
                            <label for="observaciones">Observaciones del Médico: </label>
                            <textarea name="observaciones" cols="40" rows="6" required></textarea>
                        </li>
                        <br>
                        <hr>
                        <li>
                            <button onclick="window.location.href='https://ampandroid.000webhostapp.com/rm/menu.php'">Regresar</button>
                            <button class="submit" name="new" type="submit">¡Consulta Lista!</button>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
        <script type="text/javascript">
            function salir(enlace){
                window.location.assign(enlace);
            }
        </script>

    <br>
    <br>
    <br>
    <br>
    <br>

    </body>

</html>