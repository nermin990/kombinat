<?php
    if(isset($_POST['create_hrana'])){
        //$hrana_category_id = $_POST['hrana_category_id'];
        $ime_hrane = $_POST['ime_hrane'];

        $hrana_image = $_FILES['image']['name'];
        $hrana_image_temp = $_FILES['image']['tmp_name'];

        $hrana_cena = $_POST['hrana_cena'];
        $hrana_status = $_POST['hrana_status'];
        $hrana_content = $_POST['hrana_content'];
        $hrana_tags = $_POST['hrana_tags'];

        $hrana_date = date('d-m-y');
        $hrana_comment_count = 4;

        move_uploaded_file($hrana_image_temp, "../assets/hrana/$hrana_image" );

        $query = "INSERT INTO hrana(hrana_title, hrana_image, hrana_price, hrana_content, hrana_tags, hrana_date, hrana_comment_count, hrana_status) ";
        
        $query .= "VALUES('{$ime_hrane}', '{$hrana_image}', '{$hrana_cena}', '{$hrana_content}', '{$hrana_tags}', now(), '{$hrana_comment_count}', '{$hrana_status}' ) ";

        $create_hrana_query = mysqli_query($connection, $query);

        confirm($create_hrana_query); 

        $the_hrana_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Uspesno ste kreirali artikl. <a href='../artikl.php?p_id={$the_hrana_id}'>Pogledaj artikl </a>
        ili <a href='admin_hrana.php'>Pogledaj sve artikle</a></p>";
    }
?>

<form action="" method="POST" enctype="multipart/form-data">

    <!-- <div class="form-group">
        <label for="hrana_category">Id hrane</label>
        <input type="text" class="form-control" name="hrana_category_id">
    </div> -->

    <div class="form-group">
        <label for="title">Ime Hrane</label>
        <input type="text" class="form-control" name="ime_hrane">
    </div>

    <div class="form-group">
        <label for="hrana_image">Slika</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="hrana_cena">Cena</label>
        <input type="text" class="form-control" name="hrana_cena">
    </div>

    <div class="form-group">
        <label for="hrana_content">Opis hrana/Sadrzaj</label>
        <textarea class="form-control" name="hrana_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <select name="hrana_status" id="">
            <option value="nedostupno">Izaberite status</option>
            <option value="dostupno">Dostupno</option>
            <option value="nedostupno">Nedostupno</option>
        </select>
    </div>

    <div class="form-group">
        <label for="hrana_tag">Tagovi</label>
        <input type="text" class="form-control" name="hrana_tags">
    </div>

     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_hrana" value="Publish">
    </div> 

</form>