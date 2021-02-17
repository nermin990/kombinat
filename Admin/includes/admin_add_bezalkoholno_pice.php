<?php
    if(isset($_POST['create_bezalkoholno_pice'])){
       // $bezalkoholno_pice_category_id = $_POST['bezalkoholno_pice_category_id'];
        $bezalkoholno_pice_hrane = $_POST['ime_bezalkoholno_pice'];

        $bezalkoholno_pice_image = $_FILES['image']['name'];
        $bezalkoholno_pice_image_temp = $_FILES['image']['tmp_name'];

        $bezalkoholno_pice_cena = $_POST['bezalkoholno_pice_cena'];
        $bezalkoholno_pice_status = $_POST['bezalkoholno_pice_status'];
        $bezalkoholno_pice_content = $_POST['bezalkoholno_pice_content'];
        $bezalkoholno_pice_tags = $_POST['bezalkoholno_pice_tags'];

        $bezalkoholno_pice_date = date('d-m-y');
        $bezalkoholno_pice_comment_count = 4;

        move_uploaded_file($bezalkoholno_pice_image_temp, "../assets/bezalkoholnapica/$bezalkoholno_pice_image" );

        $query = "INSERT INTO bezalkoholnapica(bezalkoholno_pice_title, bezalkoholno_pice_image, bezalkoholno_pice_price, bezalkoholno_pice_content, bezalkoholno_pice_tags, bezalkoholno_pice_date, bezalkoholno_pice_comment_count, bezalkoholno_pice_status) ";
        
        $query .= "VALUES('{$bezalkoholno_pice_hrane}', '{$bezalkoholno_pice_image}', '{$bezalkoholno_pice_cena}', '{$bezalkoholno_pice_content}', '{$bezalkoholno_pice_tags}', now(), '{$bezalkoholno_pice_comment_count}', '{$bezalkoholno_pice_status}' ) ";

        $create_bezalkoholno_pice_query = mysqli_query($connection, $query);

        confirm($create_bezalkoholno_pice_query); 

        //$the_bezalkoholnopice_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Uspesno ste kreirali artikl. <a href='admin_bezalkoholna_pica.php'>Pogledaj sve artikle</a></p>";
    }
?>

<form action="" method="POST" enctype="multipart/form-data">

    <!-- <div class="form-group">
        <label for="bezalkoholno_pice_category">Id hrane</label>
        <input type="text" class="form-control" name="bezalkoholno_pice_category_id">
    </div> -->

    <div class="form-group">
        <label for="title">Ime Soka</label>
        <input type="text" class="form-control" name="ime_bezalkoholno_pice">
    </div>

    <div class="form-group">
        <label for="bezalkoholno_pice_image">Slika</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="bezalkoholno_pice_cena">Cena</label>
        <input type="text" class="form-control" name="bezalkoholno_pice_cena">
    </div>

    <div class="form-group">
        <label for="bezalkoholno_pice_content">Opis Soka/Sadrzaj</label>
        <textarea class="form-control" name="bezalkoholno_pice_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <select name="bezalkoholno_pice_status" id="">
            <option value="nedostupno">Izaberite status</option>
            <option value="dostupno">Dostupno</option>
            <option value="nedostupno">Nedostupno</option>
        </select>
    </div>

    <div class="form-group">
        <label for="bezalkoholno_pice_tag">Tagovi</label>
        <input type="text" class="form-control" name="bezalkoholno_pice_tags">
    </div>

     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_bezalkoholno_pice" value="Publish">
    </div> 

</form>