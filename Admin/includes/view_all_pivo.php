<?php 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $pivo_value_id ){
            $bulk_options = $_POST['bulk_options'];
                switch($bulk_options){
                    case 'dostupno':
                        $query = "UPDATE pivo SET pivo_status = '{$bulk_options}' WHERE pivo_id = '{$pivo_value_id}' ";
                        $update_to_publish_status = mysqli_query($connection, $query);
                        break;
                    case 'nedostupno':
                        $query = "UPDATE pivo SET pivo_status = '{$bulk_options}' WHERE pivo_id = '{$pivo_value_id}' ";
                        $update_to_unpublish_status = mysqli_query($connection, $query);
                        break;
                    case 'izbrisi':
                        $query = "DELETE FROM pivo WHERE pivo_id = '{$pivo_value_id}' ";
                        $update_to_delete_status = mysqli_query($connection, $query);
                        break;
                    case 'clone':
                        $query = "SELECT * FROM pivo WHERE pivo_id = '{$pivo_value_id}' ";
                        $select_post_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($select_post_query)){
                        $pivo_category_id = $row['pivo_category_id'];
                        $pivo_title = $row['pivo_title'];
                        $pivo_image = $row['pivo_image'];
                        $pivo_price = $row['pivo_price'];
                        $pivo_content = $row['pivo_content'];
                        $pivo_tags = $row['pivo_tags'];
                        $pivo_date = $row['pivo_date'];
                        $pivo_status = $row['pivo_status'];
                    }
                $query = "INSERT INTO pivo(pivo_category_id, pivo_title, pivo_image, pivo_price, pivo_content, pivo_tags, pivo_date, pivo_status) ";
                $query .= "VALUES({$pivo_category_id}, '{$pivo_title}', '{$pivo_image}', '{$pivo_price}', '{$pivo_content}', '{$pivo_tags}', now(), '{$pivo_status}')";
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
            <th>Naziv piva</th>
            <th>Slika</th>
            <th>Cena</th>
            <th>Opis piva</th>
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
    $query = "SELECT * FROM pivo";
    $select_pivo = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_pivo)){
        $pivo_id = $row['pivo_id'];
        $pivo_title = $row['pivo_title'];
        $pivo_image = $row['pivo_image'];
        $pivo_price = $row['pivo_price'];
        $pivo_content = $row['pivo_content'];
        $pivo_tags = $row['pivo_tags'];
        $pivo_date = $row['pivo_date'];
        $pivo_comment_count = $row['pivo_comment_count'];
        $pivo_status = $row['pivo_status'];

        echo "<tr>";
        ?>
            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $pivo_id ?>'></td>
        <?php
        echo "<td>{$pivo_id}</td>";
        echo "<td>{$pivo_title}</td>";
        echo "<td><img width='80' src='../assets/pivo/{$pivo_image}' alt='image'></td>";
        echo "<td>{$pivo_price}</td>";
        echo "<td>{$pivo_content}</td>";
        echo "<td>{$pivo_tags}</td>";
        echo "<td>{$pivo_date}</td>";
        echo "<td>{$pivo_comment_count}</td>";
        echo "<td>{$pivo_status}</td>";
        echo "<td><a href='admin_pivo.php?source=edit_pivo&p_id={$pivo_id}'>Izmeni</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Da li ste sigurni da zelite da obrisete artikl?'); \" href='admin_pivo.php?delete={$pivo_id}'>Izbrisi</a></td>";
        echo "</tr>";
    }
?>
    </tbody>
</table>
</form>

<?php 
    if(isset($_GET['delete'])){
        $the_pivo_id = $_GET['delete'];

        $query = "DELETE FROM pivo WHERE pivo_id = {$the_pivo_id} ";
        $delete_query = mysqli_query($connection, $query);
    }
?>