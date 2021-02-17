<?php 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $bezalkoholnapica_value_id ){
            $bulk_options = $_POST['bulk_options'];
                switch($bulk_options){
                    case 'dostupno':
                        $query = "UPDATE bezalkoholnapica SET bezalkoholno_pice_status = '{$bulk_options}' WHERE bezalkoholno_pice_id = '{$bezalkoholnapica_value_id}' ";
                        $update_to_publish_status = mysqli_query($connection, $query);
                        break;
                    case 'nedostupno':
                        $query = "UPDATE bezalkoholnapica SET bezalkoholno_pice_status = '{$bulk_options}' WHERE bezalkoholno_pice_id = '{$bezalkoholnapica_value_id}' ";
                        $update_to_unpublish_status = mysqli_query($connection, $query);
                        break;
                    case 'izbrisi':
                        $query = "DELETE FROM bezalkoholnapica WHERE bezalkoholno_pice_id = '{$bezalkoholnapica_value_id}' ";
                        $update_to_delete_status = mysqli_query($connection, $query);
                        break;
                    case 'clone':
                        $query = "SELECT * FROM bezalkoholnapica WHERE bezalkoholno_pice_id = '{$bezalkoholnapica_value_id}' ";
                        $select_post_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($select_post_query)){
                        $bezalkoholno_pice_title = $row['bezalkoholno_pice_title'];
                        $bezalkoholno_pice_category_id = $row['bezalkoholno_pice_category_id'];
                        $bezalkoholno_pice_image = $row['bezalkoholno_pice_image'];
                        $bezalkoholno_pice_price = $row['bezalkoholno_pice_price'];
                        $bezalkoholno_pice_content = $row['bezalkoholno_pice_content'];
                        $bezalkoholno_pice_tags = $row['bezalkoholno_pice_tags'];
                        $bezalkoholno_pice_date = $row['bezalkoholno_pice_date'];
                        $bezalkoholno_pice_status = $row['bezalkoholno_pice_status'];
                    }
                    $query = "INSERT INTO bezalkoholnapica(bezalkoholno_pice_category_id, bezalkoholno_pice_title, bezalkoholno_pice_image, bezalkoholno_pice_price, bezalkoholno_pice_content, bezalkoholno_pice_tags, bezalkoholno_pice_date, bezalkoholno_pice_status) ";
                $query .= "VALUES({$bezalkoholno_pice_category_id}, '{$bezalkoholno_pice_title}', '{$bezalkoholno_pice_image}', '{$bezalkoholno_pice_price}', '{$bezalkoholno_pice_content}', '{$bezalkoholno_pice_tags}', now(), '{$bezalkoholno_pice_status}')";
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
    <a class="btn btn-primary" href="admin_bezalkoholna_pica.php?source=dodaj_bezalkoholno_pice">Dodaj</a>
</div>

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
    $query = "SELECT * FROM bezalkoholnapica";
    $select_bezalkoholnapica = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_bezalkoholnapica)){
        $bezalkoholno_pice_id = $row['bezalkoholno_pice_id'];
        $bezalkoholno_pice_title = $row['bezalkoholno_pice_title'];
        $bezalkoholno_pice_image = $row['bezalkoholno_pice_image'];
        $bezalkoholno_pice_price = $row['bezalkoholno_pice_price'];
        $bezalkoholno_pice_content = $row['bezalkoholno_pice_content'];
        $bezalkoholno_pice_tags = $row['bezalkoholno_pice_tags'];
        $bezalkoholno_pice_date = $row['bezalkoholno_pice_date'];
        $bezalkoholno_pice_comment_count = $row['bezalkoholno_pice_comment_count'];
        $bezalkoholno_pice_status = $row['bezalkoholno_pice_status'];

        echo "<tr>";
        ?>
            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $bezalkoholno_pice_id ?>'></td>
        <?php
        echo "<td>{$bezalkoholno_pice_id}</td>";
        echo "<td>{$bezalkoholno_pice_title}</td>";
        echo "<td><img width='80' src='../assets/bezalkoholnapica/{$bezalkoholno_pice_image}' alt='image'></td>";
        echo "<td>{$bezalkoholno_pice_price}</td>";
        echo "<td>{$bezalkoholno_pice_content}</td>";
        echo "<td>{$bezalkoholno_pice_tags}</td>";
        echo "<td>{$bezalkoholno_pice_date}</td>";
        echo "<td>{$bezalkoholno_pice_comment_count}</td>";
        echo "<td>{$bezalkoholno_pice_status}</td>";
        echo "<td><a href='admin_bezalkoholna_pica.php?source=edit_bezalkoholno_pice&p_id={$bezalkoholno_pice_id}'>Izmeni</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Da li ste sigurni da zelite da obrisete artikl?'); \" href='admin_bezalkoholna_pica.php?delete={$bezalkoholno_pice_id}'>Izbrisi</a></td>";
        echo "</tr>";
    }
?>
    </tbody>
</table>
</form>

<?php 
    if(isset($_GET['delete'])){
        $the_bezalkoholno_pice_id = $_GET['delete'];

        $query = "DELETE FROM bezalkoholnapica WHERE bezalkoholno_pice_id = {$the_bezalkoholno_pice_id} ";
        $delete_query = mysqli_query($connection, $query);
    }
?>