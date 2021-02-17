<?php 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $zestina_value_id ){
            $bulk_options = $_POST['bulk_options'];
                switch($bulk_options){
                    case 'dostupno':
                        $query = "UPDATE zestina SET zestina_status = '{$bulk_options}' WHERE zestina_id = '{$zestina_value_id}' ";
                        $update_to_publish_status = mysqli_query($connection, $query);
                        break;
                    case 'nedostupno':
                        $query = "UPDATE zestina SET zestina_status = '{$bulk_options}' WHERE zestina_id = '{$zestina_value_id}' ";
                        $update_to_unpublish_status = mysqli_query($connection, $query);
                        break;
                    case 'izbrisi':
                        $query = "DELETE FROM zestina WHERE zestina_id = '{$zestina_value_id}' ";
                        $update_to_delete_status = mysqli_query($connection, $query);
                        break;
                    case 'clone':
                        $query = "SELECT * FROM zestina WHERE zestina_id = '{$zestina_value_id}' ";
                        $select_post_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($select_post_query)){
                        $zestina_category_id = $row['zestina_category_id'];
                        $zestina_title = $row['zestina_title'];
                        $zestina_image = $row['zestina_image'];
                        $zestina_price = $row['zestina_price'];
                        $zestina_content = $row['zestina_content'];
                        $zestina_tags = $row['zestina_tags'];
                        $zestina_date = $row['zestina_date'];
                        $zestina_status = $row['zestina_status'];
                    }
                    $query = "INSERT INTO zestina(zestina_category_id, zestina_title, zestina_image, zestina_price, zestina_content, zestina_tags, zestina_date, zestina_status) ";
                $query .= "VALUES({$zestina_category_id}, '{$zestina_title}', '{$zestina_image}', '{$zestina_price}', '{$zestina_content}', '{$zestina_tags}', now(), '{$zestina_status}')";
                $copy_query = mysqli_query($connection, $query);

                if(!$copy_query ){
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                break;
                }
        }
    }
?>

<form action="" method="POST"> 

<table class="table table-bordered table-hover">

<div id="bulkOptionsContainer" class="col-xs-4">
    <select class="form-control" name="bulk_options" id="">
        <option value="">Izaberite opciju</option>
        <option value="dostupno">Dostupno</option>
        <option value="nedostupno">Nedostupno</option>
        <option value="izbrisi">Izbrisi</option>
        <option value="clone">Kloniraj</option>
    </select>
</div>
<div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="admin_pivo.php?source=dodaj_pivo">Dodaj</a>
</div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Naziv pica</th>
            <th>Slika</th>
            <th>Cena</th>
            <th>Opis pica</th>
            <th>Tagovi</th>
            <th>Datum</th>
            <th>Komentari</th>
            <th>Status</th>
            <th>Izmeni</th>
            <th>Izbrisi</th>
        </tr>
    </thead>
    <tbody>
<?php
    $query = "SELECT * FROM zestina";
    $select_zestina = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_zestina)){
        $zestina_id = $row['zestina_id'];
        $zestina_title = $row['zestina_title'];
        $zestina_image = $row['zestina_image'];
        $zestina_price = $row['zestina_price'];
        $zestina_content = $row['zestina_content'];
        $zestina_tags = $row['zestina_tags'];
        $zestina_date = $row['zestina_date'];
        $zestina_comment_count = $row['zestina_comment_count'];
        $zestina_status = $row['zestina_status'];

        echo "<tr>";
        ?>
            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $zestina_id ?>'></td>
        <?php
        echo "<td>{$zestina_id}</td>";
        echo "<td>{$zestina_title}</td>";
        echo "<td><img width='80' src='../assets/zestina/{$zestina_image}' alt='image'></td>";
        echo "<td>{$zestina_price}</td>";
        echo "<td>{$zestina_content}</td>";
        echo "<td>{$zestina_tags}</td>";
        echo "<td>{$zestina_date}</td>";
        echo "<td>{$zestina_comment_count}</td>";
        echo "<td>{$zestina_status}</td>";
        echo "<td><a href='admin_zestina.php?source=edit_zestina&p_id={$zestina_id}'>Izmeni</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Da li ste sigurni da zelite da obrisete artikl?'); \" href='admin_zestina.php?delete={$zestina_id}'>Izbrisi</a></td>";
        echo "</tr>";
    }
?>
    </tbody>
</table>
</form>

<?php 
    if(isset($_GET['delete'])){
        $the_zestina_id = $_GET['delete'];

        $query = "DELETE FROM zestina WHERE zestina_id = {$the_zestina_id} ";
        $delete_query = mysqli_query($connection, $query);
        //header("Location: zestina.php");
    }
?>