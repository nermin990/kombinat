<?php
    if(isset($_GET['p_id'])){
        $the_kafeicajevi_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM kafeicajevi WHERE kafeicajevi_id = $the_kafeicajevi_id";
    $select_kafeicajevi_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_kafeicajevi_by_id)){
        $kafeicajevi_id = $row['kafeicajevi_id'];
        $kafeicajevi_title = $row['kafeicajevi_title'];
        $kafeicajevi_image = $row['kafeicajevi_image'];
        $kafeicajevi_price = $row['kafeicajevi_price'];
        $kafeicajevi_content = $row['kafeicajevi_content'];
        $kafeicajevi_tags = $row['kafeicajevi_tags'];
        $kafeicajevi_date = $row['kafeicajevi_date'];
        $kafeicajevi_comment_count = $row['kafeicajevi_comment_count'];
        $kafeicajevi_status = $row['kafeicajevi_status'];
    }
    // Uzimanje vrednosti iz upisanih polja i upisivanje u bazu podataka, kada kliknemo na dugme
    if(isset($_POST['update_kafeicajevi'])){
       // $kafeicajevi_category_id = $_POST['kafeicajevi_category_id'];
        $ime_kafeicajevi = $_POST['ime_kafeicajevi'];

        $kafeicajevi_image = $_FILES['image']['name'];
        $kafeicajevi_image_temp = $_FILES['image']['tmp_name'];

        $kafeicajevi_cena = $_POST['kafeicajevi_cena'];
        $kafeicajevi_status = $_POST['kafeicajevi_status'];
        $kafeicajevi_content = $_POST['kafeicajevi_content'];
        $kafeicajevi_tags = $_POST['kafeicajevi_tags'];

        // Prebacivanje slike iz priivremene lokacije u odredjeni folder
        move_uploaded_file($kafeicajevi_image_temp, "../assets/kafeicajevi/$kafeicajevi_image");

        // Kod za sliku, kako se ne bi izgubila prilikom editovanja
        if(empty($kafeicajevi_image)){
            $query = "SELECT * FROM kafeicajevi WHERE kafeicajevi_id = {$the_kafeicajevi_id} ";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image)){
                $kafeicajevi_image = $row['kafeicajevi_image'];
            }
        }

        $query = "UPDATE kafeicajevi SET ";
       // $query .= "kafeicajevi_category_id = '{$kafeicajevi_category_id}', ";
        $query .= "kafeicajevi_title = '{$ime_kafeicajevi}', ";
        $query .= "kafeicajevi_image = '{$kafeicajevi_image}', ";
        $query .= "kafeicajevi_price = '{$kafeicajevi_cena}', ";
        $query .= "kafeicajevi_content = '{$kafeicajevi_content}', ";
        $query .= "kafeicajevi_tags = '{$kafeicajevi_tags}', ";
        $query .= "kafeicajevi_date = now(), ";
        $query .= "kafeicajevi_status = '{$kafeicajevi_status}' ";
        $query .= "WHERE kafeicajevi_id = {$the_kafeicajevi_id} ";

        $update_kafeicajevi = mysqli_query($connection, $query);

        confirm($update_kafeicajevi);

        echo "<p class='bg-success'>Uspesno ste izmenili. <a href='admin_kafeicajevi.php'>Izmeni jos</a></p>";
    }
?>


<!-- Forma za editovanje -->
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Ime Pica</label>
        <input value="<?php echo $kafeicajevi_title ?>" type="text" class="form-control" name="ime_kafeicajevi">
    </div>

    <div class="form-group">
        <img width="150" src="../assets/kafeicajevi/<?php echo $kafeicajevi_image ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="kafeicajevi_cena">Cena</label>
        <input value="<?php echo $kafeicajevi_price ?>" type="text" class="form-control" name="kafeicajevi_cena">
    </div>

    <div class="form-group">
        <label for="kafeicajevi_content">Opis pica/Sadrzaj</label>
        <textarea class="form-control" name="kafeicajevi_content" id="body" cols="30" rows="10"><?php echo $kafeicajevi_content ?></textarea>
    </div>

    <div class="form-group">
        <label for="kafeicajevi_status">Status</label>
        <input value="<?php echo $kafeicajevi_status ?>" type="text" class="form-control" name="kafeicajevi_status">
    </div>

    <div class="form-group">
        <label for="kafeicajevi_tag">Tagovi</label>
        <input value="<?php echo $kafeicajevi_tags ?>" type="text" class="form-control" name="kafeicajevi_tags">
    </div>

     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_kafeicajevi" value="Izmeni">
    </div> 

</form>