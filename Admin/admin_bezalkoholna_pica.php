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
                            <small><?php if(isset($_SESSION['username'])){
                         echo $_SESSION['username'];
                     } 
                     ?></small>
                </h1>

<?php  
    if(isset($_GET['source'])){
        $source = $_GET['source'];
    } else{
        $source = '';
    }

    switch($source){
        case 'dodaj_bezalkoholno_pice':
            include "includes/admin_add_bezalkoholno_pice.php";
            break;
        case 'edit_bezalkoholno_pice':
            include "includes/edit_bezalkoholna_pica.php";
            break;
        default:
            include "includes/view_all_bezalkoholnapica.php";
            break;
}
?>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>