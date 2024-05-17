<?php
require 'conexion.php';
session_start();

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $consulta = "SELECT * FROM usuario WHERE user='$user' AND pass='$pass'";
    $ejecutar = mysqli_query($enlace, $consulta);
    $row = mysqli_fetch_array($ejecutar);

    if ($row) {
        $id_usuario = $row[0];
        $rol = $row[1]; 

        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['rol'] = $rol;

        switch ($rol) {
            case 'pedido':
                header("Location: inicio_pedido.php?id_usuario=$id_usuario");
                exit();
            case 'administrador': 
                header("Location: inicio_administrador.php?id_usuario=$id_usuario");
                exit();
            case 'gerente': 
                header("Location: inicio_gerente.php?id_usuario=$id_usuario");
                exit();
            case 'produccion': 
                header("Location: inicio_produccion.php?id_usuario=$id_usuario");
                exit();
            default:
                break;
        }
    } else {
        $error_message = 'Error de autenticación, vuelva a intentar';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estilo_iniciar_sesion.css">
    <link rel="icon" type="image/png" href="img/Logo.png">
    <title>Unidotaciones</title>
</head>
<body>
    <!-- Barra de navegacion -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #000DD3;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/Logo.png" alt="Logo" width="80" height="50" class="rounded img-fluid d-inline-block align-text-top"> 
            </a>
        </div>
    </nav>
    <!-- medio -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-lg-4 contenedorCuadro mt-4"> <!-- Añade la clase mt-4 aquí para ajustar el margen superior -->
                <p style="text-align: center;">
                    <img src="img/Logot.png" alt="" width="150" height="200" class="rounded img-fluid d-inline-block align-text-top">
                </p>
                <div class="contenedorFormulario">
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?php echo $error_message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <br>
                    <form method="post" name="Formulario">
                        <div class="mb-3">
                            <label for="text" class="form-label">Ingresa tu usuario o correo electrónico</label>
                            <input type="text" name="user" id="user" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Ingresa la contraseña</label>
                            <input type="password" name="pass" id="password" class="form-control" required>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary rounded-4">Iniciar Sesión</button>
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>


