// JavaScript Document


function fnc()
{
    var desc = document.getElementById("desc");
    var height = document.getElementById("height");
    var weight = document.getElementById("weight");
    var bmi = document.getElementById("bmi");
    var sexM = document.getElementById("mSex");
    var sexF = document.getElementById("fSex");
    var bmiN = weight.value / ((height.value / 100) * (height.value / 100));
    bmiN = parseFloat(Math.round(bmiN * 100) / 100).toFixed(2);
    var bmiI = parseInt(bmiN, 10);

    bmi.innerHTML = bmiN;

    var desc1 = "<h3>Objašnjenje BMI rezultata:</h3>";

    el = document.getElementById("m1");
    el.style.backgroundColor = "transparent";
    el.style.color = "gray";
    

    if (sexM.checked) {
        if (bmiN < 20.7) {
            el = document.getElementById("m1");
            el.style.backgroundColor = "#0215BF";
            el.style.color = "white";
            desc.innerHTML = desc1;
        }
    }
}
