<?php
    session_start();

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
                            <h4 class="animate-top">Tabla de Consultas</h4>
                        </li>
                        <li>
                            <table class="table_registro">
                                <tr style="width:auto;">
                                    <th>Fecha y Hora: </th>
                                    <th>Médico: </th>
                                    <th>Enfermedad Registrada: </th>
                                    <th>Observaciones: </th>
                                </tr>
                                <?php
                                //Validamos click al boton
                                    $servername = "localhost";
                                    $username = "id3182203_user";
                                    $password = "recetas$1";
                                    $dbname = "id3182203_recetas_medicas";

                                    //Variable
                                    $usuario = $_SESSION["rmUser"];
                                    
                                    // Create connection
                                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                                    // Check connection
                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }
                                        $sql = "SELECT Consulta.fecha, users.nombre, Consulta.id_medico, Consulta.enfermedad_registrada, Consulta.observaciones FROM Consulta INNER JOIN users ON Consulta.id_medico = users.usuario WHERE Consulta.id_paciente = '$usuario'";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $row['fecha'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['nombre'];
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
                                                    echo "No tiene consultas registradas";
                                                echo "</td>";
                                            echo "</tr>";
                                        } 
                                    mysqli_close($conn);
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