<?php
    if(isset($_GET['p_id'])){
        $the_zestina_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM zestina WHERE zestina_id = $the_zestina_id";
    $select_zestina_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_zestina_by_id)){
        $zestina_id = $row['zestina_id'];
        $zestina_title = $row['zestina_title'];
        $zestina_image = $row['zestina_image'];
        $zestina_price = $row['zestina_price'];
        $zestina_content = $row['zestina_content'];
        $zestina_tags = $row['zestina_tags'];
        $zestina_date = $row['zestina_date'];
        $zestina_comment_count = $row['zestina_comment_count'];
        $zestina_status = $row['zestina_status'];
    }
    // Uzimanje vrednosti iz upisanih polja i upisivanje u bazu podataka, kada kliknemo na dugme
    if(isset($_POST['update_zestina'])){
       // $zestina_category_id = $_POST['zestina_category_id'];
        $ime_zestina = $_POST['ime_zestina'];

        $zestina_image = $_FILES['image']['name'];
        $zestina_image_temp = $_FILES['image']['tmp_name'];

        $zestina_cena = $_POST['zestina_cena'];
        $zestina_status = $_POST['zestina_status'];
        $zestina_content = $_POST['zestina_content'];
        $zestina_tags = $_POST['zestina_tags'];

        // Prebacivanje slike iz priivremene lokacije u odredjeni folder
        move_uploaded_file($zestina_image_temp, "../assets/zestina/$zestina_image");

        // Kod za sliku, kako se ne bi izgubila prilikom editovanja
        if(empty($zestina_image)){
            $query = "SELECT * FROM zestina WHERE zestina_id = {$the_zestina_id} ";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image)){
                $zestina_image = $row['zestina_image'];
            }
        }

        $query = "UPDATE zestina SET ";
       // $query .= "zestina_category_id = '{$zestina_category_id}', ";
        $query .= "zestina_title = '{$ime_zestina}', ";
        $query .= "zestina_image = '{$zestina_image}', ";
        $query .= "zestina_price = '{$zestina_cena}', ";
        $query .= "zestina_content = '{$zestina_content}', ";
        $query .= "zestina_tags = '{$zestina_tags}', ";
        $query .= "zestina_date = now(), ";
        $query .= "zestina_status = '{$zestina_status}' ";
        $query .= "WHERE zestina_id = {$the_zestina_id} ";

        $update_zestina = mysqli_query($connection, $query);

        confirm($update_zestina);

        echo "<p class='bg-success'>Uspesno ste izmenili. <a href='admin_zestina.php'>Izmeni jos</a></p>";
    }
?>


<!-- Forma za editovanje -->
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Ime Pica</label>
        <input value="<?php echo $zestina_title ?>" type="text" class="form-control" name="ime_zestina">
    </div>

    <div class="form-group">
        <img width="150" src="../assets/zestina/<?php echo $zestina_image ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="zestina_cena">Cena</label>
        <input value="<?php echo $zestina_price ?>" type="text" class="form-control" name="zestina_cena">
    </div>

    <div class="form-group">
        <label for="zestina_content">Opis Pica/Sadrzaj</label>
        <textarea class="form-control" name="zestina_content" id="body" cols="30" rows="10"><?php echo $zestina_content ?></textarea>
    </div>

    <div class="form-group">
        <label for="zestina_status">Status</label>
        <input value="<?php echo $zestina_status ?>" type="text" class="form-control" name="zestina_status">
    </div>

    <div class="form-group">
        <label for="zestina_tag">Tagovi</label>
        <input value="<?php echo $zestina_tags ?>" type="text" class="form-control" name="zestina_tags">
    </div>

     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_zestina" value="Izmeni">
    </div> 

</form>