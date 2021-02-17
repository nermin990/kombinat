<?php
    if(isset($_GET['p_id'])){
        $the_bezalkoholno_pice_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM bezalkoholnapica WHERE bezalkoholno_pice_id = $the_bezalkoholno_pice_id";
    $select_bezalkoholnapica_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_bezalkoholnapica_by_id)){
        $bezalkoholno_pice_id = $row['bezalkoholno_pice_id'];
        $bezalkoholno_pice_title = $row['bezalkoholno_pice_title'];
        $bezalkoholno_pice_image = $row['bezalkoholno_pice_image'];
        $bezalkoholno_pice_price = $row['bezalkoholno_pice_price'];
        $bezalkoholno_pice_content = $row['bezalkoholno_pice_content'];
        $bezalkoholno_pice_tags = $row['bezalkoholno_pice_tags'];
        $bezalkoholno_pice_date = $row['bezalkoholno_pice_date'];
        $bezalkoholno_pice_comment_count = $row['bezalkoholno_pice_comment_count'];
        $bezalkoholno_pice_status = $row['bezalkoholno_pice_status'];
    }
    // Uzimanje vrednosti iz upisanih polja i upisivanje u bazu podataka, kada kliknemo na dugme
    if(isset($_POST['update_bezalkoholno_pice'])){
       // $bezalkoholno_pice_category_id = $_POST['bezalkoholno_pice_category_id'];
        $ime_bezalkoholno_pice = $_POST['ime_bezalkoholno_pice'];

        $bezalkoholno_pice_image = $_FILES['image']['name'];
        $bezalkoholno_pice_image_temp = $_FILES['image']['tmp_name'];

        $bezalkoholno_pice_cena = $_POST['bezalkoholno_pice_cena'];
        $bezalkoholno_pice_status = $_POST['bezalkoholno_pice_status'];
        $bezalkoholno_pice_content = $_POST['bezalkoholno_pice_content'];
        $bezalkoholno_pice_tags = $_POST['bezalkoholno_pice_tags'];

        // Prebacivanje slike iz priivremene lokacije u odredjeni folder
        move_uploaded_file($bezalkoholno_pice_image_temp, "../assets/bezalkoholnapica/$bezalkoholno_pice_image");

        // Kod za sliku, kako se ne bi izgubila prilikom editovanja
        if(empty($bezalkoholno_pice_image)){
            $query = "SELECT * FROM bezalkoholnapica WHERE bezalkoholno_pice_id = {$the_bezalkoholno_pice_id} ";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image)){
                $bezalkoholno_pice_image = $row['bezalkoholno_pice_image'];
            }
        }

        $query = "UPDATE bezalkoholnapica SET ";
       // $query .= "bezalkoholno_pice_category_id = '{$bezalkoholno_pice_category_id}', ";
        $query .= "bezalkoholno_pice_title = '{$ime_bezalkoholno_pice}', ";
        $query .= "bezalkoholno_pice_image = '{$bezalkoholno_pice_image}', ";
        $query .= "bezalkoholno_pice_price = '{$bezalkoholno_pice_cena}', ";
        $query .= "bezalkoholno_pice_content = '{$bezalkoholno_pice_content}', ";
        $query .= "bezalkoholno_pice_tags = '{$bezalkoholno_pice_tags}', ";
        $query .= "bezalkoholno_pice_date = now(), ";
        $query .= "bezalkoholno_pice_status = '{$bezalkoholno_pice_status}' ";
        $query .= "WHERE bezalkoholno_pice_id = {$the_bezalkoholno_pice_id} ";

        $update_bezalkoholno_pice = mysqli_query($connection, $query);

        confirm($update_bezalkoholno_pice);

        echo "<p class='bg-success'>Uspesno ste izmenili. <a href='admin_bezalkoholna_pica.php'>Izmeni jos</a></p>";
    }
?>


<!-- Forma za editovanje -->
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Ime Pica</label>
        <input value="<?php echo $bezalkoholno_pice_title ?>" type="text" class="form-control" name="ime_bezalkoholno_pice">
    </div>

    <div class="form-group">
        <img width="150" src="../assets/bezalkoholnapica/<?php echo $bezalkoholno_pice_image ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="bezalkoholno_pice_cena">Cena</label>
        <input value="<?php echo $bezalkoholno_pice_price ?>" type="text" class="form-control" name="bezalkoholno_pice_cena">
    </div>

    <div class="form-group">
        <label for="bezalkoholno_pice_content">Opis pica/Sadrzaj</label>
        <textarea class="form-control" name="bezalkoholno_pice_content" id="body" cols="30" rows="10"><?php echo $bezalkoholno_pice_content ?></textarea>
    </div>

    <div class="form-group">
        <label for="bezalkoholno_pice_status">Status</label>
        <input value="<?php echo $bezalkoholno_pice_status ?>" type="text" class="form-control" name="bezalkoholno_pice_status">
    </div>

    <div class="form-group">
        <label for="bezalkoholno_pice_tag">Tagovi</label>
        <input value="<?php echo $bezalkoholno_pice_tags ?>" type="text" class="form-control" name="bezalkoholno_pice_tags">
    </div>

     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_bezalkoholno_pice" value="Izmeni">
    </div> 

</form>