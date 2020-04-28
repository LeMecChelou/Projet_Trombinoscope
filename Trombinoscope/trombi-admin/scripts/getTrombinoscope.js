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
    let filiere = document.getElementById("select_filiere");
    let groupe = document.getElementById("select_groupe");

    let request = new XMLHttpRequest();
    request.responseType = "json";

    if (groupe.value === "all"){
        request.onload = function() { createTrombi(request.response, filiere.value); };
        request.open("GET", `http://benjamin-guirlet.alwaysdata.net/trombi-etu/api/api.php?key=UxjMfqINLjlpTXYy\\KDRoOcBifrKUa&filiere=${filiere.value}`);
    }
    else{
        request.onload = function() { createTrombi(request.response, groupe.value); };
        request.open("GET", `http://benjamin-guirlet.alwaysdata.net/trombi-etu/api/api.php?key=UxjMfqINLjlpTXYy\\KDRoOcBifrKUa&groupe=${groupe.value}`);
    }

    request.send();

}


function createTrombi(json, name){
    let table_trombi = document.getElementById("table_trombi");
    table_trombi.innerHTML = "";
    let array_etu = [];

    if (name.length > 2){
        for (let groupe in json[name]){
            for (let etudiant in json[name][groupe]){
                array_etu.push(json[name][groupe][etudiant]);
            }
        }
    }
    else{
        for (let etudiant in json[name]){
            array_etu.push(json[name][etudiant]);
        }
    }

    let new_trombi = "<table><tr class='ligne_trombi'>";
    for (let k = 0; k < array_etu.length; k++){
        if (k % 7 === 0 && k !== 0){
            new_trombi += "</tr><tr class='ligne_trombi'>";
        }
        new_trombi += `<td><img src="${array_etu[k]['IMAGE']}" alt="Image de profil" /><p>` +
            array_etu[k]['NOM'].toUpperCase() + ` ${array_etu[k]['PRENOM']}</p></td>`;
    }
    new_trombi += "</tr></table>";
    table_trombi.innerHTML += new_trombi;
}








