<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Evidencija racunara</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="shortcut icon" href="images/favicon.gif" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script src="utility.js" type="text/javascript"></script>
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <!--Header Begin-->
        <div id="header">
            <div class="center">
                <div id="logo"><a href="#">Evidencija računara</a></div>
                <!--Menu Begin-->
                <div id="menu">
                    <ul>
                        <li><a href="index.php"><span>Home</span></a></li>
                        <li><a class="active" href="korisnici.php"><span>Korisnici</span></a></li>
                        <li><a href="racunari.php"><span>Računari</span></a></li>
                        <li><a href="osajtu.php"><span>O sajtu</span></a></li>
                    </ul>
                </div>
                <!--Menu END-->
            </div>
        </div>
        <!--Header END-->
        <!--MiddleRow Begin-->
        <div>
            <div class="container">
                <!-- Trigger the modal with a button -->
                <br />
                <button type="button" class="btn btn-info btn-lg pool-right" data-toggle="modal" data-target="#dodavanjeModal">+</button>

                <!--Table-->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Ime</th>
                            <th scope="col">Prezime</th>
                            <th scope="col">Odeljenje</th>
                            <th scope="col" width="5%">Računari</th>
                            <th scope="col" width="5%">Izmena</th>
                            <th scope="col" width="5%">Brisanje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
                        if (!$bp)
                            die("Greska pri pristupu bazi podataka.");

                        $rezultat = mysqli_query($bp, "select * from korisnici");
                        if (!$rezultat)
                            die(mysqli_error($bp));

                        while ($row = mysqli_fetch_object($rezultat)) {
                            echo "<tr>\n";
                            echo "<td>{$row->id}</td>\n";
                            echo "<td>{$row->ime}</td>\n";
                            echo "<td>{$row->prezime}</td>\n";
                            echo "<td>{$row->odeljenje}</td>\n";
                            echo "<td><button onclick='prikazPC({$row->id})' class='btn btn-info'><span class='glyphicon glyphicon-eye-open'></span></button></td>\n";
                            echo "<td><button onclick='izmena({$row->id})' class='btn btn-success'><span class='glyphicon glyphicon-pencil'></span></button></td>\n";
                            echo "<td><button onclick='potvrdaBrisanja({$row->id})' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>\n";
                            echo "</tr>\n";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--MiddleRow END-->
        <!--BottomRow Begin-->
        <div id="bottomrow">
            <div class="textbox">
                <h1>Evidencija računara</h1>
                <a>Ovaj sajt uraden je sa idejom da evidentira računare i njihove korisnike.</a> </div>
            <div class="feed"> <a href="#"><img alt="" src="images/compatib.png" width="200" /></a> </div>
        </div>
        <!--BottomRow END-->
        <!--Footer Begin-->
        <div id="footer">
            <div class="foot"> <span>&copy;</span>  <a href="">Vladimir Randelovic, 2017.</a></div>
        </div>
        <!--Footer END-->



        <!-- Modal -->
        <div class="modal fade" id="brisanjeModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-lock"></span> Brisanje korisnika</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <h2>Da li ste sigurni?</h2>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-cancel"></span> Odustani</button>
                        <button onClick="brisiKorisnika()" class="btn btn-danger btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Brisi</button>
                    </div>
                </div>
            </div>
        </div> 



        <!-- Modal -->
        <div class="modal fade" id="izmenaModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-pencil"></span> Izmena korisnika</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form" action="izmena-korisnika.php" method="post">
                            <input type="hidden" name="korisnik_id" id="korisnik_id"  />
                            <div class="form-group">
                                <label for="ime"><span class="glyphicon glyphicon-user"></span> Ime</label>
                                <input type="text" name="ime" class="form-control" id="ime" placeholder="ime"/>
                            </div>
                            <div class="form-group">
                                <label for="prezime"><span class="glyphicon glyphicon-user"></span> Prezime</label>
                                <input type="text" name="prezime" class="form-control" id="prezime" placeholder="prezime"/>
                            </div>
                            <div class="form-group">
                                <label for="odeljenje"><span class="glyphicon glyphicon-user"></span> Odeljenje</label>
                                <input type="text" name="odeljenje" class="form-control" id="odeljenje" placeholder="odeljenje"/>
                            </div>

                            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-pencil"></span> Izmeni korisnika</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Odustani</button>
                    </div>
                </div>
            </div>
        </div> 


        <!-- Modal -->
        <div class="modal fade" id="dodavanjeModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-plus"></span> Dodavanje korisnika</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form" action="dodavanje-korisnika.php" method="post">
                            <div class="form-group">
                                <label for="ime"><span class="glyphicon glyphicon-user"></span> Ime</label>
                                <input type="text" name="ime" class="form-control" id="ime" placeholder="ime"/>
                            </div>
                            <div class="form-group">
                                <label for="prezime"><span class="glyphicon glyphicon-user"></span> Prezime</label>
                                <input type="text" name="prezime" class="form-control" id="prezime" placeholder="prezime"/>
                            </div>
                            <div class="form-group">
                                <label for="odeljenje"><span class="glyphicon glyphicon-user"></span> Odeljenje</label>
                                <input type="text" name="odeljenje" class="form-control" id="odeljenje" placeholder="odeljenje"/>
                            </div>

                            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-plus"></span> Unesi korisnika</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Odustani</button>
                    </div>
                </div>
            </div>
        </div>     


        <!-- Modal -->
        <div class="modal fade" id="prikazPC" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-plus"></span> Prikaz racunara</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">


                        <table id="prikazPCtabela" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Proizvodjac</th>
                                    <th scope="col">Model</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Zatvori</button>
                    </div>
                </div>
            </div>
        </div>        

    </body>
</html>
