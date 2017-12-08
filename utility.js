//
//window.onload = function() {
//    document.getElementById('brisanje-id').addEventListener('click', potvrdaBrisanja(), false);
//}
//
//$(document).ready(function () {
//    $("#myBtn").click(function () {
//        $("#myModal").modal();
//    });
//});

var brisanjeId;
var izmenaId;
var korisnikId;

function potvrdaBrisanja(id)
{
    this.brisanjeId = id;
    $("#brisanjeModal").modal();
}

function izmena(id)
{
    this.izmenaId = id;
    prikazKorisnika(id);
    $("#izmenaModal").modal();

}


function izmenaRacunara(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var racunar = JSON.parse(this.responseText);
            document.getElementById("racunar_id").value = racunar.id;
            document.getElementById("izmenaProizvodjaca").value = racunar.proizvodjac;
            document.getElementById("izmenaModela").value = racunar.model;
            document.getElementById("izmenaKorisnika").value = racunar.korisnik_id;
        }
    };
    xmlhttp.open("GET", "prikazRacunara.php?id=" + id, true);
    xmlhttp.send();
    $("#izmenaModal").modal();
}


function odabirKorisnika(id) {
    select = document.getElementById('izmenaKorisnika');
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var korisnici = JSON.parse(this.responseText);
            korisnici.forEach(function (rowData) {
                var opt = document.createElement('option');
                opt.value = rowData.id;
                string="".concat(rowData.ime,", ",rowData.prezime,", ",rowData.odeljenje);
                opt.innerHTML = string;
                select.appendChild(opt);
            });
            izmenaRacunara(id);
        }
    };
    xmlhttp.open("GET", "prikazSvihKorisnika.php", true);
    xmlhttp.send();
}


function dodavanjeRacunara() {
    select = document.getElementById('selectKorisnici');
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var korisnici = JSON.parse(this.responseText);
            korisnici.forEach(function (rowData) {
                var opt = document.createElement('option');
                opt.value = rowData.id;
                string="".concat(rowData.ime,", ",rowData.prezime,", ",rowData.odeljenje);
                opt.innerHTML = string;
                select.appendChild(opt);
            });
        }
    };
    xmlhttp.open("GET", "prikazSvihKorisnika.php", true);
    xmlhttp.send();
}



function prikazKorisnika(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var korisnik = JSON.parse(this.responseText);
            document.getElementById("korisnik_id").value = korisnik.id;
            document.getElementById("izmenaImena").value = korisnik.ime;
            document.getElementById("izmenaPrezimena").value = korisnik.prezime;
            document.getElementById("izmenaOdeljenja").value = korisnik.odeljenje;
        }
    };
    xmlhttp.open("GET", "prikazKorisnika.php?id=" + id, true);
    xmlhttp.send();
}

function brisiKorisnika() {
    window.location.href = 'brisanje-korisnika.php?id=' + brisanjeId;
}

function brisiRacunar() {
    window.location.href = 'brisanje-racunara.php?id=' + brisanjeId;
}

function prikazPC(id) {
    this.korisnikId = id;
    popunaPCtabele(id);
    $("#prikazPC").modal();


}


function popunaPCtabele(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var racunari = JSON.parse(this.responseText);
            var table = document.getElementById("prikazPCtabela");

            elementi = table.getElementsByTagName("tbody");

            for (i = 0; i < elementi.length; i++)
            {
                table.removeChild(elementi[i]);
            }
            var tableBody = document.createElement('tbody');

            racunari.forEach(function (rowData) {
                var row = document.createElement('tr');
                var cell = document.createElement('td');
                cell.appendChild(document.createTextNode(rowData.id));
                row.appendChild(cell);

                var cell = document.createElement('td');
                cell.appendChild(document.createTextNode(rowData.proizvodjac));
                row.appendChild(cell);

                var cell = document.createElement('td');
                cell.appendChild(document.createTextNode(rowData.model));
                row.appendChild(cell);

                tableBody.appendChild(row);
            });
            table.appendChild(tableBody);
        }
    };
    xmlhttp.open("GET", "prikazPC.php?id=" + id, true);
    xmlhttp.send();
}

