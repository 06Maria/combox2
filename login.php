<?php
//get database conecction 
require('Config/database.php');

//get data from html form
$p_email = $_POST['email'];
$p_password = $_POST['password'];
$pass_enc =md5 ('$p_password');

//prepare query
$sql = "
    SELECT * FROM users where email= '$p_email' and password= '$pass_enc'
";

$local_res = pg_query($local_conn, $sql);
$supabase_res = pg_query($supabase_conn, $sql);

if (pg_num_rows($supabase_res)> 0 || pg_num_rows($local_res)> 0){
    if (pg_num_rows($supabase_res) > 0) {
        $user = pg_fetch_assoc($supabase_res);
    } else {
        $user = pg_fetch_assoc($local_res);
    }

    // Guardamos sesión
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['firstname'] = $user['firstname'];

    echo "<script>alert('Login exitoso! Bienvenido');</script>";
    header("refresh:0; url=index.html"); // a donde quieras mandar

} else {
    echo "<script>alert('Correo o contraseña incorrectos');</script>";
    header("refresh:0; url=login.html");
}
?>