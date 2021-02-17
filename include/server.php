<?php
    session_start();

    $username = "";
    $email = "";
    $errors = array();

    // Konektovanje na bazu
    $connection = mysqli_connect('localhost', 'root', '', 'kombinat');

    // Ako je dugme za registraciju kliknuto
    if(isset($_POST['regiter'])){
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password_1 = mysqli_real_escape_string($connection, $_POST['possword_1']);
        $password_2 = mysqli_real_escape_string($connection, $_POST['possword_2']);

        // Osigurati da su polja u formi popunjena propisno
        if(empty($username)){
            array_push($errors, "Neophodno je upisati korisnicko ime");
        }
        if(empty($email)){
            array_push($errors, "Neophodno je upisati email adresu");
        }
        if(empty($password_1)){
            array_push($errors, "Neophodno je upisati loziku");
        }
        if($password_1 != $password_2){
            array_push($errors, "Lozinke moraju biti identicne");
        }

        // Ako nema gresaka, upisivanje u bazu podataka
        if(count($errors) == 0){
            $password = md5($password_1); // enkriptovanje lozinke pre upisivanja u bazu
            $query = "INSERT INTO users (username, email, password) VALUE('$username', '$email', '$password')";
            mysqli_query($connection, $query);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Uspesno ste se registrovali. ";
            header('Location:home.php');
        }
    }

    // Uloguj se
    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['possword']); 

        if(empty($username)){
            array_push($errors, "Morate uneti korisnicko ime.");
        }
        if(empty($password)){
            array_push($errors, "Morate uneti Vasu loziku. ");
        }
        if(count($errors) == 0){
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
            $result = mysqli_query($connection, $query);
            if(mysqli_num_rows($result) == 1){
                // Logovanje korisnika
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Uspesno ste se prijavili. ";
                header('Location:home.php');
            } else{
                array_push($errors, "Neispravno korisnicko ime ili lozinka. Molimo Vas da proverite i pokusate ponovo. ");
              //  header('Location:index.php');
            }
        }
    }

    // Izloguj se
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('Location:index.php');
    }




























?>