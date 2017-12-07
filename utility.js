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

function prikazKorisnika(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var korisnik = JSON.parse(this.responseText);
            document.getElementById("korisnik_id").value = korisnik.id;
            document.getElementById("ime").value = korisnik.ime;
            document.getElementById("prezime").value = korisnik.prezime;
            document.getElementById("odeljenje").value = korisnik.odeljenje;
        }
    };
    xmlhttp.open("GET", "prikazKorisnika.php?id=" + id, true);
    xmlhttp.send();
}

function brisiKorisnika() {
    window.location.href = 'brisanje-korisnika.php?ID=' + brisanjeId;
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
            table.removeChild(table.getElementsByTagName("tbody")[0]);

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

