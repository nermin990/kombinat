<?php 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $kafeicajevi_value_id ){
            $bulk_options = $_POST['bulk_options'];
                switch($bulk_options){
                    case 'dostupno':
                        $query = "UPDATE kafeicajevi SET kafeicajevi_status = '{$bulk_options}' WHERE kafeicajevi_id = '{$kafeicajevi_value_id}' ";
                        $update_to_publish_status = mysqli_query($connection, $query);
                        break;
                    case 'nedostupno':
                        $query = "UPDATE kafeicajevi SET kafeicajevi_status = '{$bulk_options}' WHERE kafeicajevi_id = '{$kafeicajevi_value_id}' ";
                        $update_to_unpublish_status = mysqli_query($connection, $query);
                        break;
                    case 'izbrisi':
                        $query = "DELETE FROM kafeicajevi WHERE kafeicajevi_id = '{$kafeicajevi_value_id}' ";
                        $update_to_delete_status = mysqli_query($connection, $query);
                        break;
                    case 'clone':
                        $query = "SELECT * FROM kafeicajevi WHERE kafeicajevi_id = '{$kafeicajevi_value_id}' ";
                        $select_post_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($select_post_query)){
                        $kafeicajevi_category_id = $row['kafeicajevi_category_id'];
                        $kafeicajevi_title = $row['kafeicajevi_title'];
                        $kafeicajevi_image = $row['kafeicajevi_image'];
                        $kafeicajevi_price = $row['kafeicajevi_price'];
                        $kafeicajevi_content = $row['kafeicajevi_content'];
                        $kafeicajevi_tags = $row['kafeicajevi_tags'];
                        $kafeicajevi_date = $row['kafeicajevi_date'];
                        $kafeicajevi_status = $row['kafeicajevi_status'];
                    }
                    $query = "INSERT INTO kafeicajevi(kafeicajevi_category_id, kafeicajevi_title, kafeicajevi_image, kafeicajevi_price, kafeicajevi_content, kafeicajevi_tags, kafeicajevi_date, kafeicajevi_status) ";
                $query .= "VALUES({$kafeicajevi_category_id}, '{$kafeicajevi_title}', '{$kafeicajevi_image}', '{$kafeicajevi_price}', '{$kafeicajevi_content}', '{$kafeicajevi_tags}', now(), '{$kafeicajevi_status}')";
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
    <a class="btn btn-primary" href="admin_kafeicajevi.php?source=dodaj_kafeicajevi">Dodaj</a>
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
    $query = "SELECT * FROM kafeicajevi";
    $select_kafeicajevi = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_kafeicajevi)){
        $kafeicajevi_id = $row['kafeicajevi_id'];
        $kafeicajevi_title = $row['kafeicajevi_title'];
        $kafeicajevi_image = $row['kafeicajevi_image'];
        $kafeicajevi_price = $row['kafeicajevi_price'];
        $kafeicajevi_content = $row['kafeicajevi_content'];
        $kafeicajevi_tags = $row['kafeicajevi_tags'];
        $kafeicajevi_date = $row['kafeicajevi_date'];
        $kafeicajevi_comment_count = $row['kafeicajevi_comment_count'];
        $kafeicajevi_status = $row['kafeicajevi_status'];

        echo "<tr>";
        ?>
            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $kafeicajevi_id ?>'></td>
        <?php
        echo "<td>{$kafeicajevi_id}</td>";
        echo "<td>{$kafeicajevi_title}</td>";
        echo "<td><img width='80' src='../assets/kafeicajevi/{$kafeicajevi_image}' alt='image'></td>";
        echo "<td>{$kafeicajevi_price}</td>";
        echo "<td>{$kafeicajevi_content}</td>";
        echo "<td>{$kafeicajevi_tags}</td>";
        echo "<td>{$kafeicajevi_date}</td>";
        echo "<td>{$kafeicajevi_comment_count}</td>";
        echo "<td>{$kafeicajevi_status}</td>";
        echo "<td><a href='admin_kafeicajevi.php?source=edit_kafeicajevi&p_id={$kafeicajevi_id}'>Izmeni</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Da li ste sigurni da zelite da obrisete artikl?'); \" href='admin_kafeicajevi.php?delete={$kafeicajevi_id}'>Izbrisi</a></td>";
        echo "</tr>";
    }
?>
    </tbody>
</table>
</form>

<?php 
    if(isset($_GET['delete'])){
        $the_kafeicajevi_id = $_GET['delete'];

        $query = "DELETE FROM kafeicajevi WHERE kafeicajevi_id = {$the_kafeicajevi_id} ";
        $delete_query = mysqli_query($connection, $query);
    }
?>