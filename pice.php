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
                <h1>Meni sa Picem</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p><br><br>
            </header>
    
            <div class="vrsta-holder">
                <img src="assets/dddd.png" alt="Topli napici: " height="60px" >
                <div class="centar">Topli napici:</div>
            </div> <br>
    
            <main>
               
<?php
    $query = "SELECT * FROM kafeicajevi";
    $select_all_kafeicajevi_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_kafeicajevi_query)){
        $kafeicajevi_title = $row['kafeicajevi_title'];
        $kafeicajevi_image = $row['kafeicajevi_image'];
        $kafeicajevi_content = substr($row['kafeicajevi_content'], 0, 25) . "...";
        $kafeicajevi_price = $row['kafeicajevi_price'];

?>       <div class="card">
                    
                    <img src="assets/kafeicajevi/<?php echo $kafeicajevi_image; ?>" alt="">
                    
                    <div class="blogcontent">
                        <h3><?php echo $kafeicajevi_title ?></h3>
                        <p><?php echo $kafeicajevi_price ?></p>
                        <!-- <p>Opis: <?php echo $kafeicajevi_content ?></p> -->
                    </div>

                </div>
                <?php } ?>
            </main> <br><br><br><br><br><br>

            <div class="vrsta-holder">
                <img src="assets/dddd.png" alt="Topli napici: " height="60px" >
                <div class="centar">Bezalkoholna pica:</div>
            </div> <br>
            <main>
               
<?php
    $query = "SELECT * FROM bezalkoholnapica";
    $select_all_bezalkoholnapica_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_bezalkoholnapica_query)){
        $bezalkoholnapica_title = $row['bezalkoholno_pice_title'];
        $bezalkoholnapica_image = $row['bezalkoholno_pice_image'];
        $bezalkoholnapica_content = substr($row['bezalkoholno_pice_content'], 0, 25) . "...";
        $bezalkoholnapica_price = $row['bezalkoholno_pice_price'];

?>       <div class="card">
                    
                    <img src="assets/bezalkoholnapica/<?php echo $bezalkoholnapica_image; ?>" alt="">
                    
                    <div class="blogcontent">
                        <h3><?php echo $bezalkoholnapica_title ?></h3>
                        <p><?php echo $bezalkoholnapica_price ?></p>
                        <!-- <p>Opis: <?php echo $bezalkoholnapica_content ?></p> -->
                    </div>

                </div>
                <?php } ?>
            </main>


            </main> <br><br><br><br><br><br>

            <div class="vrsta-holder">
                <img src="assets/dddd.png" alt="Topli napici: " height="60px" >
                <div class="centar">Piva:</div>
            </div> <br>
            <main>
               
<?php
    $query = "SELECT * FROM pivo";
    $select_all_pivo_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_pivo_query)){
        $pivo_title = $row['pivo_title'];
        $pivo_image = $row['pivo_image'];
        $pivo_content = substr($row['pivo_content'], 0, 25) . "...";
        $pivo_price = $row['pivo_price'];

?>       <div class="card">
                    
                    <img src="assets/pivo/<?php echo $pivo_image; ?>" alt="">
                    
                    <div class="blogcontent">
                        <h3><?php echo $pivo_title ?></h3>
                        <p><?php echo $pivo_price ?></p>
                        <!-- <p>Opis: <?php echo $pivo_content ?></p> -->
                    </div>

                </div>
                <?php } ?>
            </main>

            </main> <br><br><br><br><br><br>

            <div class="vrsta-holder">
                <img src="assets/dddd.png" alt="Topli napici: " height="60px" >
                <div class="centar">Zestoka pica    :</div>
            </div> <br>
            <main>
               
<?php
    $query = "SELECT * FROM zestina";
    $select_all_zestina_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_zestina_query)){
        $zestina_title = $row['zestina_title'];
        $zestina_image = $row['zestina_image'];
        $zestina_content = substr($row['zestina_content'], 0, 25) . "...";
        $zestina_price = $row['zestina_price'];

?>       <div class="card">
                    
                    <img src="assets/zestina/<?php echo $zestina_image; ?>" alt="">
                    
                    <div class="blogcontent">
                        <h3><?php echo $zestina_title ?></h3>
                        <p><?php echo $zestina_price ?></p>
                        <!-- <p>Opis: <?php echo $zestina_content ?></p> -->
                    </div>

                </div>
                <?php } ?>
            </main> 

        </div>
    </section>
</body>
</html>