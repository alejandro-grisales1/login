<?php

  include 'conexion_be.php';

  $nombre_completo = $_POST['nombre_completo'];
  $correo = $_POST['correo'];
  $usuario = $_POST['usuario'];
  $contraseña = $_POST['contraseña'];

  $contraseña = hash('sha512', $contraseña);

    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contraseña) 
              VALUES('$nombre_completo', '$correo', '$usuario', '$contraseña')";

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");

    if (mysqli_num_rows($verificar_correo) > 0) {
      echo '
          <script>
            alert("Este correo ya esta registrado, intenta con otro diferente");
            window.location = "../index.php";
          </script>
      ';
      exit();
      mysqli_close($conexion);
    }

    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' ");

    if (mysqli_num_rows($verificar_usuario) > 0) {
      echo '
          <script>
            alert("Este nombre de usuario ya existe, Intenta nuevamente con otro");
            window.location = "../index.php";
          </script>
      ';
      exit();
      mysqli_close($conexion);
    }

    $ejecutar = mysqli_query($conexion, $query);

    if ($ejecutar) {
      echo '
          <script>
            alert("Usuario almacenado exitosamente");
            window.location = "../index.php";
          </script>
      ';
    } else {
      echo '
          <script>
            alert("Intentalo de nuevo, Usuario no almacenado");
            window.location = "../index.php";
          </script>
      ';
    }

    mysqli_close($conexion);
?>