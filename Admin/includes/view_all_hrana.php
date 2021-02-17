<?php 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $hrana_value_id ){
            $bulk_options = $_POST['bulk_options'];
                switch($bulk_options){
                    case 'dostupno':
                        $query = "UPDATE hrana SET hrana_status = '{$bulk_options}' WHERE hrana_id = '{$hrana_value_id}' ";
                        $update_to_publish_status = mysqli_query($connection, $query);
                        break;
                    case 'nedostupno':
                        $query = "UPDATE hrana SET hrana_status = '{$bulk_options}' WHERE hrana_id = '{$hrana_value_id}' ";
                        $update_to_unpublish_status = mysqli_query($connection, $query);
                        break;
                    case 'izbrisi':
                        $query = "DELETE FROM hrana WHERE hrana_id = '{$hrana_value_id}' ";
                        $update_to_delete_status = mysqli_query($connection, $query);
                        break;
                    case 'clone':
                        $query = "SELECT * FROM hrana WHERE hrana_id = '{$hrana_value_id}' ";
                        $select_post_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($select_post_query)){
                        $hrana_title = $row['hrana_title'];
                        $hrana_category_id = $row['hrana_category_id'];
                        $hrana_image = $row['hrana_image'];
                        $hrana_price = $row['hrana_price'];
                        $hrana_content = $row['hrana_content'];
                        $hrana_tags = $row['hrana_tags'];
                        $hrana_date = $row['hrana_date'];
                        $hrana_status = $row['hrana_status'];
                    }
                    $query = "INSERT INTO hrana(hrana_category_id, hrana_title, hrana_image, hrana_price, hrana_content, hrana_tags, hrana_date, hrana_status) ";
                $query .= "VALUES({$hrana_category_id}, '{$hrana_title}', '{$hrana_image}', '{$hrana_price}', '{$hrana_content}', '{$hrana_tags}', now(), '{$hrana_status}')";
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
    <a class="btn btn-primary" href="admin_hrana.php?source=dodaj_hranu">Dodaj</a>
</div>

    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Naziv jela</th>
            <th>Slika</th>
            <th>Cena</th>
            <th>Opis jela</th>
            <th>Tagovi</th>
            <th>Datum</th>
            <th>Komentari</th>
            <th>Status</th>
            <th>Pregledaj</th>
            <th>Izmeni</th>
            <th>Izbrisi</th>
        </tr>
    </thead>
    <tbody>

<?php
    $query = "SELECT * FROM hrana";
    $select_hrana = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_hrana)){
        $hrana_id = $row['hrana_id'];
        $hrana_title = $row['hrana_title'];
        $hrana_image = $row['hrana_image'];
        $hrana_price = $row['hrana_price'];
        $hrana_content = $row['hrana_content'];
        $hrana_tags = $row['hrana_tags'];
        $hrana_date = $row['hrana_date'];
        $hrana_comment_count = $row['hrana_comment_count'];
        $hrana_status = $row['hrana_status'];

        echo "<tr>";
        ?>
            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $hrana_id ?>'></td>
        <?php
        echo "<td>{$hrana_id}</td>";
        echo "<td>{$hrana_title}</td>";
        echo "<td><img width='80' src='../assets/hrana/{$hrana_image}' alt='image'></td>";
        echo "<td>{$hrana_price}</td>";
        echo "<td>{$hrana_content}</td>";
        echo "<td>{$hrana_tags}</td>";
        echo "<td>{$hrana_date}</td>";
        echo "<td>{$hrana_comment_count}</td>";
        echo "<td>{$hrana_status}</td>";
        echo "<td><a href='../artikl.php?p_id={$hrana_id}'>Vidi artikl</a></td>";
        echo "<td><a href='admin_hrana.php?source=edit_hrana&p_id={$hrana_id}'>Izmeni</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Da li ste sigurni da zelite da obrisete artikl?'); \" href='admin_hrana.php?delete={$hrana_id}'>Izbrisi</a></td>";
        echo "</tr>";
    }
?>
    </tbody>
</table>
</form>

<?php 
    if(isset($_GET['delete'])){
        $the_hrana_id = $_GET['delete'];

        $query = "DELETE FROM hrana WHERE hrana_id = {$the_hrana_id} ";
        $delete_query = mysqli_query($connection, $query);
    }
?>