<?php
    if(isset($_POST['create_zestina'])){
        //$zestina_category_id = $_POST['zestina_category_id'];
        $ime_zestina = $_POST['ime_zestina'];

        $zestina_image = $_FILES['image']['name'];
        $zestina_image_temp = $_FILES['image']['tmp_name'];

        $zestina_cena = $_POST['zestina_cena'];
        $zestina_status = $_POST['zestina_status'];
        $zestina_content = $_POST['zestina_content'];
        $zestina_tags = $_POST['zestina_tags'];

        $zestina_date = date('d-m-y');
        $zestina_comment_count = 4;

        move_uploaded_file($zestina_image_temp, "../assets/zestina/$zestina_image" );

        $query = "INSERT INTO zestina(zestina_title, zestina_image, zestina_price, zestina_content, zestina_tags, zestina_date, zestina_comment_count, zestina_status) ";
        
        $query .= "VALUES('{$ime_zestina}', '{$zestina_image}', '{$zestina_cena}', '{$zestina_content}', '{$zestina_tags}', now(), '{$zestina_comment_count}', '{$zestina_status}' ) ";

        $create_zestina_query = mysqli_query($connection, $query);

        confirm($create_zestina_query);
        
        //$the_zestina_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Uspesno ste kreirali artikl. <a href='admin_zestina.php'>Pogledaj sve artikle</a></p>";
    }
?>

<form action="" method="POST" enctype="multipart/form-data">

    <!-- <div class="form-group">
        <label for="zestina_category">Id zestina</label>
        <input type="text" class="form-control" name="zestina_category_id">
    </div> -->

    <div class="form-group">
        <label for="title">Ime Pica</label>
        <input type="text" class="form-control" name="ime_zestina">
    </div>

    <div class="form-group">
        <label for="zestina_image">Slika</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="zestina_cena">Cena</label>
        <input type="text" class="form-control" name="zestina_cena">
    </div>

    <div class="form-group">
        <label for="zestina_content">Opis pica/Sadrzaj</label>
        <textarea class="form-control" name="zestina_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <select name="zestina_status" id="">
            <option value="nedostupno">Izaberite status</option>
            <option value="dostupno">Dostupno</option>
            <option value="nedostupno">Nedostupno</option>
        </select>
    </div>

    <div class="form-group">
        <label for="zestina_tag">Tagovi</label>
        <input type="text" class="form-control" name="zestina_tags">
    </div>

     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_zestina" value="Publish">
    </div> 

</form>