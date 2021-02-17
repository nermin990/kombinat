<?php
    if(isset($_GET['p_id'])){
        $the_hrana_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM hrana WHERE hrana_id = $the_hrana_id";
    $select_hrana_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_hrana_by_id)){
        $hrana_id = $row['hrana_id'];
        $hrana_title = $row['hrana_title'];
        $hrana_image = $row['hrana_image'];
        $hrana_price = $row['hrana_price'];
        $hrana_content = $row['hrana_content'];
        $hrana_tags = $row['hrana_tags'];
        $hrana_date = $row['hrana_date'];
        $hrana_comment_count = $row['hrana_comment_count'];
        $hrana_status = $row['hrana_status'];
    }
    // Uzimanje vrednosti iz upisanih polja i upisivanje u bazu podataka, kada kliknemo na dugme
    if(isset($_POST['update_hrana'])){
       // $hrana_category_id = $_POST['hrana_category_id'];
        $ime_hrane = $_POST['ime_hrane'];

        $hrana_image = $_FILES['image']['name'];
        $hrana_image_temp = $_FILES['image']['tmp_name'];

        $hrana_cena = $_POST['hrana_cena'];
        $hrana_status = $_POST['hrana_status'];
        $hrana_content = $_POST['hrana_content'];
        $hrana_tags = $_POST['hrana_tags'];

        // Prebacivanje slike iz priivremene lokacije u odredjeni folder
        move_uploaded_file($hrana_image_temp, "../assets/hrana/$hrana_image");

        // Kod za sliku, kako se ne bi izgubila prilikom editovanja
        if(empty($hrana_image)){
            $query = "SELECT * FROM hrana WHERE hrana_id = {$the_hrana_id} ";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image)){
                $hrana_image = $row['hrana_image'];
            }
        }

        $query = "UPDATE hrana SET ";
       // $query .= "hrana_category_id = '{$hrana_category_id}', ";
        $query .= "hrana_title = '{$ime_hrane}', ";
        $query .= "hrana_image = '{$hrana_image}', ";
        $query .= "hrana_price = '{$hrana_cena}', ";
        $query .= "hrana_content = '{$hrana_content}', ";
        $query .= "hrana_tags = '{$hrana_tags}', ";
        $query .= "hrana_date = now(), ";
        $query .= "hrana_status = '{$hrana_status}' ";
        $query .= "WHERE hrana_id = {$the_hrana_id} ";

        $update_hrana = mysqli_query($connection, $query);

        confirm($update_hrana);

        echo "<p class='bg-success'>Uspesno ste izmenili. <a href='../artikl.php?p_id={$the_hrana_id}'>Pogledaj izmene </a>
        ili <a href='admin_hrana.php'>Izmeni jos</a></p>";
    }
?>


<!-- Forma za editovanje -->
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Ime Hrane</label>
        <input value="<?php echo $hrana_title ?>" type="text" class="form-control" name="ime_hrane">
    </div>

    <div class="form-group">
        <img width="150" src="../assets/hrana/<?php echo $hrana_image ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="hrana_cena">Cena</label>
        <input value="<?php echo $hrana_price ?>" type="text" class="form-control" name="hrana_cena">
    </div>

    <div class="form-group">
        <label for="hrana_content">Opis hrana/Sadrzaj</label>
        <textarea class="form-control" name="hrana_content" id="body" cols="30" rows="10"><?php echo $hrana_content ?></textarea>
    </div>

    <div class="form-group">
        <select name="hrana_status" id="">
            <option value="<?php echo $hrana_status; ?>"><?php echo $hrana_status; ?></option>
                <?php
                    if($hrana_status == 'dostupno'){
                        echo "<option value='nedostupno'>Nedostupno</option>";
                    } else{
                        echo "<option value='dostupno'>Dostupno</option>";
                    }
                ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="hrana_tag">Tagovi</label>
        <input value="<?php echo $hrana_tags ?>" type="text" class="form-control" name="hrana_tags">
    </div>

     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_hrana" value="Izmeni">
    </div> 

</form>