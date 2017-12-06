<?php
    session_start();

    if(isset($_SESSION["rmUser"]) && isset($_SESSION["rmTipo"]) && $_SESSION['rmTipo'] == 1 && $_SESSION['rmTipo'] == 0){
        echo "<script language='javascript'>alert('No puedes acceder al registro del administrador');</script>";
        header("Location: https://ampandroid.000webhostapp.com/rm/menu.php");
        exit; /* Redirección del navegador */
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registro Médico</title>
    <!-- Normalizador para compatibilidad en navegadores -->
    <link rel="stylesheet" href="rsc/css/normalize.css">
    <link rel="stylesheet" href="rsc/css/estilo.css">

</head>

<body>
    <div>
        <!-- Encabezado -->
        <h3 class="animate-top">Consultas Médicas</h3>
        <form action="modulo_registro.php" method="POST" class="paciente_form">
            <div align="center" class="animate-top-2">
                <ul>
                    <hr>
                    <li>
                        <h4 class="animate-top">Busqueda por Filtros</h4>
                    </li>
                    <li>
                        <label for="name">Buscar: </label>
                        <input type="text" required name="valor" />
                        <li>
                            <label for="tipo">Tipo de Busqueda: </label>
                            <select class="select-form-medicinas" name="tipo">
                                <option value="1">Paciente</option>
                                <option value="2">Médico</option>
                            </select>
                        </li>
                        <li>
                            <button class="consulta" name="consulta" type="submit">Realizar Consulta</button>
                        </li>
                        <li>
                            <h4 class="animate-top">Tabla de Consultas</h4>
                        </li>
                        <li>
                            <table class="table_registro">
                                <tr style="width:auto;">
                                    <th>Fecha y Hora: </th>
                                    <th>Paciente: </th>
                                    <th>Médico: </th>
                                    <th>Enfermedad Registrada: </th>
                                    <th>Observaciones: </th>
                                </tr>
                                <?php
                                //Validamos click al boton
                                if (isset($_POST['consulta'])) {
                                    $servername = "localhost";
                                    $username = "id3182203_user";
                                    $password = "recetas$1";
                                    $dbname = "id3182203_recetas_medicas";
                                    
                                    // Create connection
                                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                                    // Check connection
                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }

                                    //Variables
                                    $tipo = trim($_POST['tipo']);
                                    $idVal = trim($_POST['valor']);

                                    if($tipo == 2){
                                        $sql = "SELECT * FROM Consulta WHERE id_medico = '$idVal'";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $row['fecha'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['id_paciente'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['id_medico'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['enfermedad_registrada'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['observaciones'] ;
                                                echo "</td>";
                                            echo "</tr>";
                                            }
                                        }else{
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo "Consultas No Registradas al médico: " . $idVal . ", verifique su información.";
                                                echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else if($tipo == 1){
                                        $sql = "SELECT * FROM Consulta WHERE id_paciente = '$idVal'";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $row['fecha'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['id_paciente'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['id_medico'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['enfermedad_registrada'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['observaciones'] ;
                                                echo "</td>";
                                            echo "</tr>";
                                            }
                                        }else{
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo "Consultas No Registradas al paciente: " . $idVal . ", verifique su información.";
                                                echo "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    mysqli_close($conn);
                                }
                                ?>

                            </table>
                        </li>
                </ul>
            </div>
            <div align="center" class="container panel content paddign64 animate-top-3">
                <button onclick="window.location.href='https://ampandroid.000webhostapp.com/rm/menu.php'">Regresar</button>
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