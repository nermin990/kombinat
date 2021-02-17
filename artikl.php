<?php include "include/server.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/artikl.css">
    <title>artikl</title>
</head>
<body>

<?php

    if(isset($_GET['p_id'])){
        $the_hrana_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM hrana where hrana_id = {$the_hrana_id} ";
    $select_all_hrana_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_hrana_query)){
        $hrana_id = $row['hrana_id'];
        $hrana_title = $row['hrana_title'];
        $hrana_image = $row['hrana_image'];
        $hrana_content = $row['hrana_content'];
        $hrana_price = $row['hrana_price'];
        $hrana_status = $row['hrana_status'];
    }

?>  

    <div class="container">
        <div class="image-holder">
            <img src="assets/hrana/<?php echo $hrana_image; ?>" alt="" height="480px" width="720px">
        </div>
        <div class="content-holder">
            <div>
                <h2><?php echo $hrana_title; ?></h2>
            </div>
            <div>
                <h3>Sadrzaj/Opis:</h3>
                    <p class="opis"> <?php echo $hrana_content; ?>
                </p>
            </div>
            <div class="holder">
                <div class="holderi">
                    <p>Cena: <b><?php echo $hrana_price; ?></b></p>
                </div>
                <div class="holderi">
                    <p>Status: <b> <?php echo ucfirst($hrana_status) ?> </b></p>
                </div>
            </div>
            
        </div>
    </div>
   

</body>
</html>