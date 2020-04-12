<?php
    session_start();
    $conn = oci_connect("project","dbms","localhost/orcl");
    if(!$conn){
        echo "Failed to Connect DB ";
    }
    
    ?>