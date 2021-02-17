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
        case 'dodaj_pivo':
            include "includes/admin_add_pivo.php";
            break;
        case 'edit_pivo':
            include "includes/edit_pivo.php";
            break;
        case '23':
            echo "ssss";
            break;
        default:
            include "includes/view_all_pivo.php";
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