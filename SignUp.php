<?php
//get database conecction 
require('../Config/database.php');

//get data from html form
$f_name = $_POST['fname'];
$l_name = $_POST['lname'];
$p_mobile = $_POST['mobile'];
$p_email = $_POST['email'];
$p_password = $_POST['password'];
$pass_enc =md5 ('$p_password');

//prepare query
$sql = "
    INSERT INTO users (
        firstname, lastname, mobile_phone, email, password)
    VALUES (
        '$f_name', '$l_name', '$p_mobile', '$p_email', '$pass_enc'
    )
";

$local_res = pg_query($local_conn, $sql);
$supabase_res = pg_query($supabase_conn, $sql);

if ($local_res ) {
    echo "<br>Data inserted successfully into database.";
} else {
    echo "<br>Error inserting data " ;
}

if ($supabase_res ) {
    echo "<br>Data inserted successfully into database.";
} else {
    echo "<br>Error inserting data " ;
}
/*
echo "First Name is: " . $f_name;
echo "Last Name is: " . $l_name;
echo "Mobile Number is: " . $p_mobile;
echo "Email is: " . $p_email;
echo "Password is: " . $p_password;*/
?>