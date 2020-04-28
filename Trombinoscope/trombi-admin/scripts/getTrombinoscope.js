function getGroups(json_filieres){
    let filiere = document.getElementById("select_filiere").value;
    let groupes = document.getElementById("select_groupe");
    groupes.innerHTML = "<option value='all'>Tous les groupes</option>";

    let tab_groupes = json_filieres[filiere];
    for (let groupe in tab_groupes){
        groupes.innerHTML += `<option value='${json_filieres[filiere][groupe]}'>${json_filieres[filiere][groupe]}</option>`;
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









