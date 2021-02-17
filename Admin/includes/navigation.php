<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">Administracija</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="deopdown">
                    <a href="../home.php">Pocetna strana</a>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                     Dobrodosli, <?php if(isset($_SESSION['username'])){
                         echo $_SESSION['username'];
                     } 
                     ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                   <!--  <li>
                        <a href="kategorije.php"><i class="fa fa-fw fa-edit"></i> Kategorije</a>
                    </li> -->
                    
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Hrana <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="admin_hrana.php">Vidi sve artikle</a>
                            </li>
                            <li>
                                <a href="admin_hrana.php?source=dodaj_hranu">Dodaj novi artikl</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#kafeICajevi_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Kafe i Cajevi <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="kafeICajevi_dropdown" class="collapse">
                            <li>
                                <a href="admin_kafeicajevi.php">Vidi sve artikle</a>
                            </li>
                            <li>
                                <a href="admin_kafeicajevi.php?source=dodaj_kafeicajevi">Dodaj novi artikl</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#sokovi_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Sokovi <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="sokovi_dropdown" class="collapse">
                            <li>
                                <a href="admin_bezalkoholna_pica.php">Vidi sve artikle</a>
                            </li>
                            <li>
                                <a href="admin_bezalkoholna_pica.php?source=dodaj_bezalkoholno_pice">Dodaj novi artikl</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#pivo_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Pivo <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="pivo_dropdown" class="collapse">
                            <li>
                                <a href="admin_pivo.php">Vidi sve artikle</a>
                            </li>
                            <li>
                                <a href="admin_pivo.php?source=dodaj_pivo">Dodaj novi artikl</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#zestina_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Zestoka pica <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="zestina_dropdown" class="collapse">
                            <li>
                                <a href="admin_zestina.php">Vidi sve artikle</a>
                            </li>
                            <li>
                                <a href="admin_zestina.php?source=dodaj_zestina">Dodaj novi artikl</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-fw fa-desktop"></i> Komentari</a>
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-fw fa-desktop"></i> Profil</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Korisnici <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Vidi sve artikle</a>
                            </li>
                            <li>
                                <a href="#">Dodaj novi artikl</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
