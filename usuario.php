<?php

// Importar la conexión 

require 'includes/config/database.php';
$db = conectarDB();

// Crear un email y password

$email = "correo@correo.com";
$password = "123456";


//$passwordHash = password_hash($password, PASSWORD_BCRYPT);



//  Query para crear al usuario
$query = " INSERT INTO usuarios(email, password) VALUES ('${email}', '${password}')";



mysqli_query($db, $query);
