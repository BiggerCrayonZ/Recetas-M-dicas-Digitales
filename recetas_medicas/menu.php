<?php
    session_start();

    if (isset($_POST['cierra'])) {
        session_unset(); 
        session_destroy();
        header("Location: https://ampandroid.000webhostapp.com/rm/login.php");
    }

    
?>
    <!DOCTYPE html>
    <html>
    <style>
        .flotante {
            width: 150px;
            height: 60px;
            top: 0;
            right: 0;
            position: absolute;
            margin-top: 8px;
            margin-right: 16px;
            margin-bottom: 36px;
            border: none;
            outline: none;
            color: #FFF;
            font-size: 14px;
            font-style: bold;
        }
    </style>

    <head>
        <meta charset="utf-8">
        <title>Menú</title>
        <!-- Normalizador para compatibilidad en navegadores -->
        <link rel="stylesheet" href="rsc/css/normalize.css">
        <link rel="stylesheet" href="rsc/css/estilo.css">

    </head>

    <body>
        <div class="contenido">

            <!-- Encabezado -->
            <header id="header_menu">
                <a id="logo_header" href="#">
                    <p>Bienvenido: </p>
                    <?php
                        echo "<span class='menu_user'>" . $_SESSION["rmNombre"] ."  </span>"
                    ?>

                        <?php
                        if($_SESSION["rmTipo"] == 1){
                            echo "<span class='menu_tipo'>Paciente</span>";
                        } else if ($_SESSION["rmTipo"] == 0){
                            echo "<span class='menu_tipo'>Médico</span>";
                        } else if ($_SESSION["rmTipo"] == 2){
                            echo "<span class='menu_tipo'>Administrador del Sistema</span>";
                        }
                    ?>
                </a>
                <nav class="nav_menu">
                    <ul>
                        <li>
                            <form method="POST" action="menu.php">
                                <input type="submit" value="Cerrar Sesion" class="flotante button" name="cierra">
                            </form>
                        </li>
                    </ul>
                </nav>
            </header>

            <br>
            <br>
            <br>
            <div align="center" class="container panel content paddign64 animate-top-2">
                <table class="table_menu">
                    <?php
                    if($_SESSION["rmTipo"] == 1){


                        echo "<tr>";
                            echo "<td style='border: none;'>";
                                echo "<a href='modulo_registro_paciente.php'>" ;
                                    echo "<img src='rsc/img/ico/ico_reg.png' alt='' class='img_menu'>";
                                echo "</a>";
                            echo "</td>";
                        echo "</tr>";


                    } else if ($_SESSION["rmTipo"] == 0){
                        

                        echo "<tr>";
                            echo "<td style='border: none;'>";
                                echo "<a href='modulo_consulta.php'>" ;
                                    echo "<img src='rsc/img/ico/ico_new_consulta.png' alt='' class='img_menu'>";
                                echo "</a>";
                            echo "</td>";
                            echo "<td style='border: none;'>";
                                echo "<a href='modulo_tratamiento.html'>" ;
                                    echo "<img src='rsc/img/ico/ico_new_trat.png' alt='' class='img_menu'>";
                                echo "</a>";
                            echo "</td>";
                        echo "</tr>";


                        echo "<tr>";
                            echo "<td style='border: none; padding-left: 250px; padding-right: 250px;' colspan='2'>";
                                echo "<a href='modulo_registro_medico.php'>" ;
                                    echo "<img src='rsc/img/ico/ico_reg.png' alt='' class='img_menu'>";
                                echo "</a>";
                            echo "</td>";
                        echo "</tr>";


                    } else if ($_SESSION["rmTipo"] == 2){


                        echo "<tr>";
                            echo "<td style='border: none;'>";
                                echo "<a href='modulo_consulta.php'>" ;
                                    echo "<img src='rsc/img/ico/ico_new_consulta.png' alt='' class='img_menu'>";
                                echo "</a>";
                            echo "</td>";
                            echo "<td style='border: none;'>";
                                echo "<a href='modulo_tratamiento.html'>" ;
                                    echo "<img src='rsc/img/ico/ico_new_trat.png' alt='' class='img_menu'>";
                                echo "</a>";
                            echo "</td>";
                        echo "</tr>";


                        echo "<tr>";
                            echo "<td style='border: none;'>";
                                echo "<a href='modulo_registro.php'>" ;
                                    echo "<img src='rsc/img/ico/ico_reg.png' alt='' class='img_menu'>";
                                echo "</a>";
                            echo "</td>";
                            echo "<td style='border: none;'>";
                                echo "<a href='modulo_usuario.html'>" ;
                                    echo "<img src='rsc/img/ico/ico_new_user.png' alt='' class='img_menu'>";
                                echo "</a>";
                            echo "</td>";
                        echo "</tr>";


                    }
                ?>
                </table>
            </div>
        </div>

    </body>

    </html>