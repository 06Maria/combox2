<?php
//get database conecction 
require('Config/database.php');

session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: Login.html");
}
//get data from html form
$p_email = $_POST['email'];
$p_password = $_POST['password'];
$pass_enc =md5('$p_password');

//prepare query
$res_email = "SELECT * FROM users where email= '$p_email'";
$res_pass = "SELECT * FROM users where password = '$pass_enc'";

$res = "SELECT * FROM users WHERE email = '$p_email' AND password = '$pass_enc'";
$supabase_res = pg_query($supabase_conn, $res);

//$local_res = pg_query($local_conn, $sql);
$supabase_res_email = pg_query($supabase_conn, $res_email);
$supabase_res_pass = pg_query($supabase_conn, $res_pass);

if (pg_num_rows($supabase_res) > 0 ){
    $user = pg_fetch_assoc($supabase_res);
    // Guardamos sesión
    $_SESSION['userId'] = $user['id'];
    $_SESSION['Fname'] = $user['firstname'];
    $_SESSION['Lname'] = $user['lastname'];

    echo "<script>alert('Login exitoso! Bienvenido');</script>";
    header("refresh:0; url=index.php"); 

} else {
    if (pg_num_rows($supabase_res_email) <= 0 && pg_num_rows($supabase_res_pass) <= 0) {
        echo "<script>alert('Ni el correo ni la contraseña existen'); window.location.href='login.html';</script>";
    
    } elseif (pg_num_rows($supabase_res_email) <= 0) {
        echo "<script>alert('El correo es incorrecto o no está registrado'); window.location.href='login.html';</script>";
    
    } elseif (pg_num_rows($supabase_res_pass) <= 0) {
        echo "<script>alert('La contraseña es incorrecta'); window.location.href='login.html';</script>";
    
    } else {
        // Existe el correo y existe la contraseña, pero no son del mismo usuario
        echo "<script>alert('El correo y la contraseña no coinciden'); window.location.href='login.html';</script>";
    }
}
?>