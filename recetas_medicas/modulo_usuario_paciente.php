<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Creación de Paciente</title>
    <!-- Normalizador para compatibilidad en navegadores -->
    <link rel="stylesheet" href="rsc/css/normalize.css">
    <link rel="stylesheet" href="rsc/css/estilo.css">

</head>

<body>
    <?php
        $fullname = $id = $mail = $pw = $repw = "";
        $idErr = $emailErr = $pwErr = $repwErr = $fullnameErr = "";

        $servername = "localhost";
        $username = "id3182203_user";
        $password = "recetas$1";
        $dbname = "id3182203_recetas_medicas";

        

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["id"])) {
                $idErr = "Se necesita nombre de usuario";
              } else {
                $id = test_input($_POST["id"]);
              }
            if (empty($_POST["mail"])) {
                $emailErr = "Necesitamos un correo electrónico";
              } else {
                $email = test_input($_POST["mail"]);
              }
              if (empty($_POST["pw"])) {
                $pwErr = "Escribe la Contraseña";
              } else {
                $pw = test_input($_POST["pw"]);
              }
              if (empty($_POST["fullname"])) {
                $fullnameErr = "Escribe tu Nombre Completo";
              } else {
                $fullname = test_input($_POST["fullname"]);
              }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

        if (isset($_POST['new'])) {
            $idRM = trim($_POST["id"]);
            $idPass = trim($_POST["pw"]);
            $idMail = trim($_POST["mail"]);
            $idName = trim($_POST["fullname"]);
            $idSang = trim($_POST["sanguineo"]);
            $idAler = trim($_POST["alergia"]);
            $idObse = trim($_POST["message"]);

        

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO users (usuario, password, tipo, nombre, email) VALUES ('$idRM', '$idPass',1, '$idName', '$idMail');";
            if (mysqli_query($conn, $sql)) {
                $sql = "INSERT INTO DatosPaciente (idPaciente, sanguineo, alergia, observaciones) VALUES ('$idRM', '$idSang', '$idAler', '$idObse');";
                if (mysqli_query($conn, $sql)) {
                    echo "<script language='javascript'>alert('El usuario: " . $idName . " Fue añadido con exito');</script>";
                } else {
                    echo "<script language='javascript'>alert('Error en la inserción de datos personales, contcate al administrador.');</script>";
                }
			} else {
				echo "<script language='javascript'>alert('Error en el servidor, contacte al administrador.');</script>";
			}
            
        }

    ?>
        <div>
            <!-- Encabezado -->
            <h3 class="animate-top">Creación de Paciente</h3>
            <form action="modulo_usuario_paciente.php" method="POST" class="paciente_form">
                <div align="center" class="animate-top-2">
                    <ul>
                        <li>
                            <h4 class="animate-top">Usuario y Contraseña: </h4>
                        </li>
                        <li>
                            <label for="id">Nombre de Usuario: </label>
                            <input type="text" placeholder="Nombre de Usuario" name="id" required>
                            <span class="error">*
                                <?php echo $idErr;?>
                            </span>
                        </li>
                        <li>
                            <label for="pw">Contraseña: </label>
                            <input type="password" placeholder="Contraseña" name="pw" required>
                            <span class="error">*
                                <?php echo $pwErr;?>
                            </span>
                        </li>
                        <li>
                            <label for="email">Email:</label>
                            <input type="email" name="mail" placeholder="info@developerji.com" required />
                            <span class="form_hint">Formato correcto: "name@something.com"</span>
                            <span class="error">*
                                <?php echo $emailErr;?>
                            </span>
                        </li>
                    </ul>
                </div>
                <div align="center" class="animate-top-2">
                    <ul>
                        <li>
                            <h4 class="animate-top">Datos Personales: </h4>
                        </li>
                        <li>
                            <label for="name">Nombre Completo: </label>
                            <input type="text" placeholder="Axel Ortiz" name="fullname" required />
                            <span class="error">*
                                <?php echo $fullnameErr;?>
                            </span>
                        </li>
                        <li>
                            <label for="sanguineo">Tipo Sanguíneo: </label>
                            <select class="select-form" name="sanguineo">
                                <option value="a">Tipo A</option>
                                <option value="b">Tipo B</option>
                                <option value="ab">Tipo AB</option>
                                <option value="o">Tipo O</option>
                            </select>
                        </li>
                        <li>
                            <label for="name">Alergia(s): </label>
                            <input type="text" name="alergia" required />
                        </li>
                        <li>
                            <label for="observacion">Observaciones: </label>
                            <textarea name="message" cols="40" rows="6" required></textarea>
                        </li>
                        <li>
                            <button class="submit" name="new" type="submit">Crear Usuario</button>
                            <button onclick="window.location.href='https://ampandroid.000webhostapp.com/rm/menu.php'">Cancelar</button>
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