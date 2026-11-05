<?php
    //local connection
    $local_host = "localhost";
    $local_user = "postgres";
    $local_port = "5432";
    $local_dbname = "combox";
    $local_password = "unicesmag";

    //Supabase connection
    $supabase_host = "aws-0-us-east-1.pooler.supabase.com";
    $supabase_user = "postgres.icxhqgqpxrybpiyjocsc";
    $supabase_port = "6543";
    $supabase_dbname = "postgres";
    $supabase_password = "unicesmag@@";

    $local_conn = pg_connect("
        host=$local_host 
        port=$local_port 
        dbname=$local_dbname 
        user=$local_user 
        password=$local_password"
    );

    $supabase_conn = pg_connect("
        host=$supabase_host 
        port=$supabase_port 
        dbname=$supabase_dbname 
        user=$supabase_user 
        password=$supabase_password"
    );

    if (!$local_conn) {
        die("Local connection failed: ");
    }else {
        echo "<br>Local connection established successfully";
    }

    if (!$supabase_conn) {
        die("Supabase connection failed: ");
    }else {
        echo "<br>Supabase connection established successfully";
    }
?>