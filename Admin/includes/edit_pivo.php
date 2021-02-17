<?php
    if(isset($_GET['p_id'])){
        $the_pivo_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM pivo WHERE pivo_id = $the_pivo_id";
    $select_pivo_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_pivo_by_id)){
        $pivo_id = $row['pivo_id'];
        $pivo_title = $row['pivo_title'];
        $pivo_image = $row['pivo_image'];
        $pivo_price = $row['pivo_price'];
        $pivo_content = $row['pivo_content'];
        $pivo_tags = $row['pivo_tags'];
        $pivo_date = $row['pivo_date'];
        $pivo_comment_count = $row['pivo_comment_count'];
        $pivo_status = $row['pivo_status'];
    }
    // Uzimanje vrednosti iz upisanih polja i upisivanje u bazu podataka, kada kliknemo na dugme
    if(isset($_POST['update_pivo'])){
       // $pivo_category_id = $_POST['pivo_category_id'];
        $ime_pivo = $_POST['ime_pivo'];

        $pivo_image = $_FILES['image']['name'];
        $pivo_image_temp = $_FILES['image']['tmp_name'];

        $pivo_cena = $_POST['pivo_cena'];
        $pivo_status = $_POST['pivo_status'];
        $pivo_content = $_POST['pivo_content'];
        $pivo_tags = $_POST['pivo_tags'];

        // Prebacivanje slike iz priivremene lokacije u odredjeni folder
        move_uploaded_file($pivo_image_temp, "../assets/pivo/$pivo_image");

        // Kod za sliku, kako se ne bi izgubila prilikom editovanja
        if(empty($pivo_image)){
            $query = "SELECT * FROM pivo WHERE pivo_id = {$the_pivo_id} ";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image)){
                $pivo_image = $row['pivo_image'];
            }
        }

        $query = "UPDATE pivo SET ";
       // $query .= "pivo_category_id = '{$pivo_category_id}', ";
        $query .= "pivo_title = '{$ime_pivo}', ";
        $query .= "pivo_image = '{$pivo_image}', ";
        $query .= "pivo_price = '{$pivo_cena}', ";
        $query .= "pivo_content = '{$pivo_content}', ";
        $query .= "pivo_tags = '{$pivo_tags}', ";
        $query .= "pivo_date = now(), ";
        $query .= "pivo_status = '{$pivo_status}' ";
        $query .= "WHERE pivo_id = {$the_pivo_id} ";

        $update_pivo = mysqli_query($connection, $query);

        confirm($update_pivo);

        echo "<p class='bg-success'>Uspesno ste izmenili. <a href='admin_pivo.php'>Izmeni jos</a></p>";
    }
?>


<!-- Forma za editovanje -->
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Ime Piva</label>
        <input value="<?php echo $pivo_title ?>" type="text" class="form-control" name="ime_pivo">
    </div>

    <div class="form-group">
        <img width="150" src="../assets/pivo/<?php echo $pivo_image ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="pivo_cena">Cena</label>
        <input value="<?php echo $pivo_price ?>" type="text" class="form-control" name="pivo_cena">
    </div>

    <div class="form-group">
        <label for="pivo_content">Opis Piva/Sadrzaj</label>
        <textarea class="form-control" name="pivo_content" id="body" cols="30" rows="10"><?php echo $pivo_content ?></textarea>
    </div>

    <div class="form-group">
        <label for="pivo_status">Status</label>
        <input value="<?php echo $pivo_status ?>" type="text" class="form-control" name="pivo_status">
    </div>

    <div class="form-group">
        <label for="pivo_tag">Tagovi</label>
        <input value="<?php echo $pivo_tags ?>" type="text" class="form-control" name="pivo_tags">
    </div>

     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_pivo" value="Izmeni">
    </div> 

</form>