<?php
    if(isset($_POST['create_kafeicajevi'])){
        //$kafeicajevi_category_id = $_POST['kafeicajevi_category_id'];
        $ime_kafeicajevi = $_POST['ime_kafeicajevi'];

        $kafeicajevi_image = $_FILES['image']['name'];
        $kafeicajevi_image_temp = $_FILES['image']['tmp_name'];

        $kafeicajevi_cena = $_POST['kafeicajevi_cena'];
        $kafeicajevi_status = $_POST['kafeicajevi_status'];
        $kafeicajevi_content = $_POST['kafeicajevi_content'];
        $kafeicajevi_tags = $_POST['kafeicajevi_tags'];

        $kafeicajevi_date = date('d-m-y');
        $kafeicajevi_comment_count = 4;

        move_uploaded_file($kafeicajevi_image_temp, "../assets/kafeicajevi/$kafeicajevi_image" );

        $query = "INSERT INTO kafeicajevi(kafeicajevi_title, kafeicajevi_image, kafeicajevi_price, kafeicajevi_content, kafeicajevi_tags, kafeicajevi_date, kafeicajevi_comment_count, kafeicajevi_status) ";
        
        $query .= "VALUES('{$ime_kafeicajevi}', '{$kafeicajevi_image}', '{$kafeicajevi_cena}', '{$kafeicajevi_content}', '{$kafeicajevi_tags}', now(), '{$kafeicajevi_comment_count}', '{$kafeicajevi_status}' ) ";

        $create_kafeicajevi_query = mysqli_query($connection, $query);

        confirm($create_kafeicajevi_query); 

        //$the_kafeicajevi_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Uspesno ste kreirali artikl. <a href='admin_kafeicajevi.php'>Pogledaj sve artikle</a></p>";
    }
?>

<form action="" method="POST" enctype="multipart/form-data">

    <!-- <div class="form-group">
        <label for="kafeicajevi_category">Id kafeicajevi</label>
        <input type="text" class="form-control" name="kafeicajevi_category_id">
    </div> -->

    <div class="form-group">
        <label for="title">Ime Pica</label>
        <input type="text" class="form-control" name="ime_kafeicajevi">
    </div>

    <div class="form-group">
        <label for="kafeicajevi_image">Slika</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="kafeicajevi_cena">Cena</label>
        <input type="text" class="form-control" name="kafeicajevi_cena">
    </div>

    <div class="form-group">
        <label for="kafeicajevi_content">Opis pica/Sadrzaj</label>
        <textarea class="form-control" name="kafeicajevi_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <select name="kafeicajevi_status" id="">
            <option value="nedostupno">Izaberite status</option>
            <option value="dostupno">Dostupno</option>
            <option value="nedostupno">Nedostupno</option>
        </select>
    </div>

    <div class="form-group">
        <label for="kafeicajevi_tag">Tagovi</label>
        <input type="text" class="form-control" name="kafeicajevi_tags">
    </div>

     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_kafeicajevi" value="Publish">
    </div> 

</form>