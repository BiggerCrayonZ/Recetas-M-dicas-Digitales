<?php

    session_start();
    //Detección de dispositivo movil
    require_once ('Mobile_Detect.php');
    
    //Creamos una instancia del detector de moviles
    $detect = new Mobile_Detect();
    //Letrero para mencionar si es un dispositivo movil o no lo és
    $device_label = "";
    if ($detect->isMobile()) {
            $device_label = "Versión Movil";
        }else{
            $device_label = "Versión Desktop";
        }
        
    

    if(isset($_SESSION["rmUser"]) && isset($_SESSION["rmCB"]) && $_SESSION['rmCB'] == 1 ){
        header("Location: https://ampandroid.000webhostapp.com/rm/menu.php");
        exit; /* Redirección del navegador */
    }
   
   if (isset($_POST['inicia'])) {
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

    $usuario = trim($_POST['id']);
    $pass = trim($_POST['pw']);
    $sql = "SELECT * FROM users WHERE usuario = '$usuario' and password = '$pass'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $tipo = $row['tipo'];
            $fullname = $row['nombre'];
            if(isset($_POST["cbSesion"]) && $_POST["cbSesion"] == 1){
                $_SESSION["rmUser"] = $usuario;
                $_SESSION['rmPass'] = $pass;
                $_SESSION['rmTipo'] = $tipo;
                $_SESSION['rmNombre'] = $fullname;
                $_SESSION['rmCB'] = 1;
                header("Location: https://ampandroid.000webhostapp.com/rm/menu.php");
                exit; /* Redirección del navegador */
            } else{
                $_SESSION["rmUser"] = $usuario;
                $_SESSION['rmPass'] = $pass;
                $_SESSION['rmTipo'] = $tipo;
                $_SESSION['rmNombre'] = $fullname;
                $_SESSION['rmCB'] = 0;
                header("Location: https://ampandroid.000webhostapp.com/rm/menu.php");
                exit; /* Redirección del navegador */
            }
        }
    } else {
        echo "<script language='javascript'>alert('El usuario no existe.');</script>";
    }

    mysqli_close($conn);
}
?>

    <!DOCTYPE html>
    <html>
    <style>
        .boton {
            background: url(http://www.ashleyjt.net/windows/images/Android.png)/* Url de la imagen */
            no-repeat center center, #62BC0F/* Color del botón */
            ;
            background-size: 60%;
            /* Tamaño de la imagen */
            height: 75px;
            /* Alto del botón */
            width: 75px;
            /* Ancho del botón */
            display: table;
            border-radius: 100%;
            cursor: pointer;
            box-shadow: /* Sombras externa */
            inset 0 10px 15px rgba(255, 255, 255, .35), inset 0 -10px 15px rgba(0, 0, 0, .05), inset 10px 0 15px rgba(0, 0, 0, .05), inset -10px 0 15px rgba(0, 0, 0, .05),
            /* Sombra interna */
            0 5px 20px rgba(0, 0, 0, .1);
        }

        /* Al presionar */

        .boton:active {
            box-shadow: inset 0 5px 30px rgba(0, 0, 0, .2);
            /* Sombra interior */
            background-size: 55%;
            /* Cambiamos el tamaño de la imagen */
        }
    </style>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
        <title>Login</title>
        <!-- Normalizador para compatibilidad en navegadores -->
        <link rel="stylesheet" href="rsc/css/normalize.css">
        <link rel="stylesheet" href="rsc/css/estilo.css">

    </head>

    <body>
        <div class="contenido">

            <!-- Encabezado -->
            <h1 class="animate-top">Iniciar Sesión</h1>
            <h2 class="animate-top">
                <?php echo $device_label; ?>
            </h2>
            <div align="center" class="container panel content paddign64 animate-top-2">
                <main>
                    <form action="login.php" method="POST">
                        <table>
                            <tr>
                                <td colspan="2">
                                    <input class="input border" type="text" placeholder="Nombre de Usuario" name="id" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="input border" type="password" placeholder="Contraseña" name="pw" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="button black" type="submit" name="inicia">Login</button>
                                </td>
                                <td>
                                    <input type="checkbox" name="cbSesion" id="cbSesion" value="1"> Recuerdame
                                </td>
                            </tr>
                        </table>
                    </form>
                </main>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p class="contenedor oblique">Regresar</p>
                <a class='boton' href='index.html'></a>
            </div>



        </div>



    </body>

    </html>