<?php

function confirm($result){
    global $connection;

    if(!$result){
        die("Doslo je do greske, proverite i pokusajte ponovo. " . mysqli_error($connection));
    }
}



































?>