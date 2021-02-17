<?php include "include/server.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/meni.css">
    
    <title>Meni sa hranom</title>
</head>
<body>
    
    <section>
        <div class="container">
            <header>
                <h1>Meni sa hranom</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </header>

            <main>
               
<?php
    $query = "SELECT * FROM hrana";
    $select_all_hrana_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_hrana_query)){
        $hrana_id = $row['hrana_id'];
        $hrana_title = $row['hrana_title'];
        $hrana_image = $row['hrana_image']; 
        $hrana_content = substr($row['hrana_content'], 0, 25) . "...";
        $hrana_price = $row['hrana_price'];
        $hrana_status = $row['hrana_status'];

?>       <div class="card">
                   
                   <a href="artikl.php?p_id=<?php echo $hrana_id; ?>">
                    <img src="assets/hrana/<?php echo $hrana_image; ?>" alt="">
                    <div class="blogcontent">
                        <h3><?php echo $hrana_title ?></h3>
                        <p><?php echo $hrana_price ?></p>
                        <!-- <p>Opis: <?php echo $hrana_content ?></p> -->
                    </div>
                    </a>

                </div>
                <?php } ?>
            </main>

        </div>
    </section>
</body>
</html>