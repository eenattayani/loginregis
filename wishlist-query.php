<?php

include "dbconn.php";

if (isset($_POST["idbarang"])) {
    $idBarang = $_POST["idbarang"];
    $idPelanggan = $_POST["idpelanggan"];
    $state = $_POST["state"];

    // ubah check status pada tbkeranjang
    $query = "UPDATE tbkeranjang SET check_status='$state' WHERE id_barang='$idBarang' AND id_pelanggan='$idPelanggan'";
    $result = mysqli_query($connection, $query);

    echo "1";
    
    // echo "<br>$_POST[idbarang]";
    // echo "<br>$_POST[idpelanggan]";
    // echo "<br>$_POST[state]";
} else {
    echo "0";
}

?>