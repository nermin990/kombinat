<?php include ('include/server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Forma</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>  
    <div class="header">
        <h2>Registracija</h2>
    </div>

    <div class="login-box">
    <div class="col-md login-left">

    <!-- Ispisivanje validacionih gresaka -->
    <?php include('errors.php'); ?>

        <form action="register.php" method="POST">
            <div class="form-group">
                <label>Korisnicko Ime</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email ?>">
            </div>
            <div class="form-group">
                <label>Lozinka</label>
                <input type="password" name="possword_1" class="form-control" >
            </div>
            <div class="form-group">
                <label>Ptvrdite lozinku</label>
                <input type="password" name="possword_2" class="form-control" >
            </div>
            <button type="submit" name="regiter" class="btn btn-primary">Registruj se</button>
        </form>
    </div>
    </div>
    
</body>

</html>