<?php

session_start();

if ( !isset($_SESSION["admin"]) ) {
    echo '
    <script>
    alert("Gagal Login!");    
    location.replace("../login.php");
    </script>
    '; 
}



?>