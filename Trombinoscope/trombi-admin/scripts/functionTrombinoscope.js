function getGroups(json_filieres){
    let filiere = document.getElementById("select_filiere").value;
    let groupes = document.getElementById("select_groupe");
    groupes.innerHTML = "<option value='all'>Tous les groupes</option>";

    let tab_groupes = json_filieres[filiere];
    for (let groupe in tab_groupes){
        groupes.innerHTML += `<option value='${json_filieres[filiere][groupe]}'>${json_filieres[filiere][groupe]}</option>`;
    }

    let nb_etu = document.getElementById("input_nb_etudiants_max");
    nb_etu.value = 0;
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
    let table_trombi = document.getElementById("div_trombi");
    let nb_etu_max = document.getElementById("input_nb_etudiants_max");

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

    if (nb_etu_max.value === "0"){
        nb_etu_max.value = array_etu.length;
    }
    else if (parseInt(nb_etu_max.value) > array_etu.length){
        nb_etu_max.value = array_etu.length;
    }

    let new_trombi = "<div class='ligne_trombi'>";

    for (let k = 0; k < nb_etu_max.value; k++){
        if (k % 7 === 0 && k !== 0){
            new_trombi += "</div><div class='ligne_trombi'>";
        }

        new_trombi += `<div class="case_trombi"><img id="img_etu_${k}" class="img_etu" src="${array_etu[k]['IMAGE']}" alt="Image de profil" width="200" height="200" onclick="showInformations(this.id);"/>` +
            `<p class="nom_prenom_etu">${array_etu[k]['NOM'].toUpperCase()}</p><p class="nom_prenom_etu">${array_etu[k]['PRENOM']}</p>` +
            `<div id="div_img_etu_${k}" class="div_infos_supp" style="display: none">` +
            `<p class="infos_supp">${array_etu[k]['MAIL']}</p></div></div>`;
    }

    new_trombi += "</div>";
    table_trombi.innerHTML += new_trombi;
}


function showInformations(test){
    let infos_etu = document.getElementById("div_" + test);

    if (infos_etu.style.display === "none"){
        infos_etu.style.display = "block";
    }
    else{
        infos_etu.style.display = "none";
    }
}


function checkImpression(){
    let all_etu = document.getElementsByClassName("div_infos_supp");

    for (let etu of all_etu){
        etu.style.display = "none";
    }

    window.print();
}









