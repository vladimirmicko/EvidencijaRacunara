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
                        <li><a href="korisnici.php"><span>Korisnici</span></a></li>
                        <li><a class="active" href="racunari.php"><span>Računari</span></a></li>
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
                <button type="button" onClick="dodavanjeRacunara()" class="btn btn-info btn-lg pool-right" data-toggle="modal" data-target="#dodavanjeModal">+</button>

                <!--Table-->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Proizvodjac</th>
                            <th scope="col">Model</th>
                            <th scope="col">Korisnik</th>
                            <th scope="col" width="5%">Izmena</th>
                            <th scope="col" width="5%">Brisanje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $bp = mysqli_connect("localhost", "root", "root", "evidencija_racunara");
                        if (!$bp)
                            die("Greska pri pristupu bazi podataka.");

                        $rezultat = mysqli_query($bp, "select racunari.id, proizvodjac, model, korisnici.ime from racunari left join korisnici on racunari.korisnik_id=korisnici.id");
                        if (!$rezultat)
                            die(mysqli_error($bp));

                        while ($row = mysqli_fetch_object($rezultat)) {
                            echo "<tr>\n";
                            echo "<td>{$row->id}</td>\n";
                            echo "<td>{$row->proizvodjac}</td>\n";
                            echo "<td>{$row->model}</td>\n";
                            echo "<td>{$row->ime}</td>\n";
                            echo "<td><button onclick='izmenaRacunara({$row->id})' class='btn btn-success'><span class='glyphicon glyphicon-pencil'></span></button></td>\n";
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
        <div class="modal fade" id="dodavanjeModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-plus"></span> Dodavanje računara</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form" action="dodavanje-racunara.php" method="post">
                            <div class="form-group">
                                <label for="proizvodjac"><span class="glyphicon glyphicon-user"></span> Proizvodjač</label>
                                <input type="text" name="proizvodjac" class="form-control" id="ime" placeholder="proizvodjac"/>
                            </div>
                            <div class="form-group">
                                <label for="model"><span class="glyphicon glyphicon-user"></span> Model</label>
                                <input type="text" name="model" class="form-control" id="model" placeholder="model"/>
                            </div>
                            <div class="form-group">
                                <label for="selectKorisnici"><span class="glyphicon glyphicon-user"></span> Korisnik</label>
                                <select name="selectKorisnici" class="form-control" placeholder="selectKorisnici" id="selectKorisnici"></select>
                            </div>
                            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-plus"></span> Unesi računar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Odustani</button>
                    </div>
                </div>
            </div>
        </div>     


        <!-- Modal -->
        <div class="modal fade" id="brisanjeModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-lock"></span> Brisanje računara</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <h2>Da li ste sigurni?</h2>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-cancel"></span> Odustani</button>
                        <button onClick="brisiRacunar()" class="btn btn-danger btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Briši</button>
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>
