function getGroups(){
    let filiere = document.getElementById("select_filiere");
    let groupes = document.getElementById("select_groupe");

    if (filiere.value === "all"){
        groupes.innerHTML = "<option value='all'>Tous les groupes</option>";
    }
    else if (filiere.value === "L1-MIPI"){
        groupes.innerHTML = "<option value='all'>Tous les groupes</option>\n" +
            "<option value='A1'>A1</option>\n" +
            "<option value='A2'>A2</option>\n" +
            "<option value='A3'>A3</option>\n";
    }
    else if (filiere.value === "L2-MI"){
        groupes.innerHTML = "<option value='all'>Tous les groupes</option>\n" +
            "<option value='B1'>B1</option>\n" +
            "<option value='B2'>B2</option>\n" +
            "<option value='B3'>B3</option>\n";
    }
    else if (filiere.value === "L3-I"){
        groupes.innerHTML = "<option value='all'>Tous les groupes</option>\n" +
            "<option value='C1'>C1</option>\n" +
            "<option value='C2'>C2</option>\n" +
            "<option value='C3'>C3</option>\n";
    }
    else if (filiere.value === "LP RS") {
        groupes.innerHTML = "<option value='all'>Tous les groupes</option>\n" +
            "<option value='D1'>D1</option>\n" +
            "<option value='D2'>D2</option>\n" +
            "<option value='D3'>D3</option>\n";
    }
    else if (filiere.value === "LPI-RIWS"){
        groupes.innerHTML = "<option value='all'>Tous les groupes</option>\n" +
            "<option value='E1'>E1</option>\n" +
            "<option value='E2'>E2</option>\n" +
            "<option value='E3'>E3</option>\n";
    }
}


function getJSON(){
    let request = new XMLHttpRequest();

    request.responseType = "json";

    request.onload = function() { createTrombi(request.response); };

    request.open("GET", "http://benjamin-guirlet.alwaysdata.net/trombi-etu/api/api.php?key=UxjMfqINLjlpTXYy\\KDRoOcBifrKUa&all=1");
    request.send();

}


function createTrombi(json){
    console.log(json);
}









