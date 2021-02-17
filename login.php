<?php include('include/server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    
<body>
    
    <div class="header">
        <h2>Ulogujte se</h2>
    </div>

    <div class="login-box">
        <div class="col-md login-left">
            <form action="login.php" method="POST">
                
            <!-- Ispisivanje validacionih gresaka -->
            <?php include('include/errors.php'); ?>

            <div class="form-group">
                <label>Korisnicko Ime</label>
                <input type="text" name="username" class="form-control" >
            </div>
            <div class="form-group">
                <label>Lozinka</label>
                <input type="password" name="possword" class="form-control" >
            </div>
            <button type="submit" name="login" class="btn btn-primary prijavi-se">Prijavi se</button>
        </form>
        <!-- <h5>Nemate nalog? <a href="register.php" style="color: blue;">Registrujte se odmah</a></h5> -->
            
        </div> 
    </div>
    </div>
</body>
</html>