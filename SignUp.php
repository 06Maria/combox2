<?php
//get database conecction 
require('Config/database.php');

//get data from html form
$f_name = $_POST['fname'];
$l_name = $_POST['lname'];
$p_mobile = $_POST['mobile'];
$p_email = $_POST['email'];
$p_password = $_POST['password'];
$pass_enc =md5 ('$p_password');

$sql_validation_Email = 
    "SELECT email FROM users WHERE email = '$p_email'";

$sql_validation_phone = 
    "SELECT mobile_phone FROM users WHERE mobile_phone = '$p_mobile'";

//$local_res = pg_query($local_conn, $sql_validation);
$supabase_res_email = pg_query($supabase_conn, $sql_validation_Email);
$total_email = pg_fetch_result($supabase_res_email, 0, 0);
$supabase_res_phone = pg_query($supabase_conn, $sql_validation_phone);
$total_phone = pg_fetch_result($supabase_res_phone, 0, 0);

if ($total_email > 0) {
    echo "<script>alert('Email already exist, please use another one')</script>";
    header ("refresh: 0; url=register.html");
} else if ($total_phone > 0){
    echo "<script>alert('Mobile Phone already exist, please use another one')</script>";
    header ("refresh: 0; url=register.html");
} else {
        //prepare query
        $sql = "
            INSERT INTO users (
                firstname, lastname, mobile_phone, email, password)
            VALUES (
                '$f_name', '$l_name', '$p_mobile', '$p_email', '$pass_enc'
            )";

        $supabase_res = pg_query($supabase_conn, $sql);
        if ($supabase_res ) {
            echo "<script>alert('Data inserted successfully into database.')</script>";
            header ("refresh: 0; url=login.html");
        } else {
            echo "<script>alert('Error inserting data.')</script>";
            header ("refresh: 0; url=register.html");
        }
}

?>