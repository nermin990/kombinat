<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                        Dobrodosli u administraciju
                            <small>Autor</small>
                        </h1>

                        <!-- Dodavanje kategorije -->
                        <div class="col-xs-6">
<?php
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

    if($cat_title == "" || empty($cat_title)){
        echo "Morate uneti ime kategorije";
    } else{
        $query = "INSERT INTO kategorije(cat_title) VALUE('{$cat_title}') ";

        $create_category_query = mysqli_query($connection, $query);

    if(!$create_category_query){
        die("Doslo je do greske, proverite podatke i pokusajte ponovo. " . mysqli_error($connection));
    }
    }
    }
?>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Upisite ime nove kategorije</label>
                                    <input class="form-control" type="text"  name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit"  name="submit" value="Dodaj Kategoriju">
                                </div>
                            </form>
                        </div>

                        <!-- Iscitavanje kategorija iz baze -->
                        <div class="col-xs-6">
<?php
    $query = "SELECT * FROM kategorije";
    $select_categories = mysqli_query($connection, $query);
?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Ime kategorije</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<tr>";
    }
?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/footer.php"; ?>