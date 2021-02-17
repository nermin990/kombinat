<?php
    if(isset($_POST['create_pivo'])){
        //$pivo_category_id = $_POST['pivo_category_id'];
        $ime_pivo = $_POST['ime_pivo'];

        $pivo_image = $_FILES['image']['name'];
        $pivo_image_temp = $_FILES['image']['tmp_name'];

        $pivo_cena = $_POST['pivo_cena'];
        $pivo_status = $_POST['pivo_status'];
        $pivo_content = $_POST['pivo_content'];
        $pivo_tags = $_POST['pivo_tags'];

        $pivo_date = date('d-m-y');
        $pivo_comment_count = 4;

        move_uploaded_file($pivo_image_temp, "../assets/pivo/$pivo_image" );

        $query = "INSERT INTO pivo(pivo_title, pivo_image, pivo_price, pivo_content, pivo_tags, pivo_date, pivo_comment_count, pivo_status) ";
        
        $query .= "VALUES('{$ime_pivo}', '{$pivo_image}', '{$pivo_cena}', '{$pivo_content}', '{$pivo_tags}', now(), '{$pivo_comment_count}', '{$pivo_status}' ) ";

        $create_pivo_query = mysqli_query($connection, $query);

        confirm($create_pivo_query); 

        //$the_pivo_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Uspesno ste kreirali artikl. <a href='admin_pivo.php'>Pogledaj sve artikle</a></p>";
    }
?>

<form action="" method="POST" enctype="multipart/form-data">

    <!-- <div class="form-group">
        <label for="pivo_category">Id pivo</label>
        <input type="text" class="form-control" name="pivo_category_id">
    </div> -->

    <div class="form-group">
        <label for="title">Ime Piva</label>
        <input type="text" class="form-control" name="ime_pivo">
    </div>

    <div class="form-group">
        <label for="pivo_image">Slika</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="pivo_cena">Cena</label>
        <input type="text" class="form-control" name="pivo_cena">
    </div>

    <div class="form-group">
        <label for="pivo_content">Opis pica/Sadrzaj</label>
        <textarea class="form-control" name="pivo_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <select name="pivo_status" id="">
            <option value="nedostupno">Izaberite status</option>
            <option value="dostupno">Dostupno</option>
            <option value="nedostupno">Nedostupno</option>
        </select>
    </div>

    <div class="form-group">
        <label for="pivo_tag">Tagovi</label>
        <input type="text" class="form-control" name="pivo_tags">
    </div>

     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_pivo" value="Publish">
    </div> 

</form>