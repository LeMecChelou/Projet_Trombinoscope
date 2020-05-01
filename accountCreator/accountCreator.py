import hashlib
import time
from setup import *


nb_comptes = int(input("Entrez le nombre de comptes à créer: "))
compte = str()

t1 = time.time()


for nb in range(nb_comptes):
    prenom = random.choice(PRENOMS)
    prenom = prenom[0] + prenom[1:].lower()

    nom = random.choice(NOMS)
    filiere = random.choice(FILIERES)
    groupe = random.choice(GROUPES[filiere])

    tel = createPhone()

    idt = (prenom[0] + nom + tel[3:5]).lower()
    mail = (prenom + "." + nom + "@gmail.com").lower()

    random_string = getRandomString()
    mdp = (nom[0] + prenom + random_string).lower()
    mdp = hashlib.sha256(mdp.encode()).hexdigest()

    image_name = getImage(nom, prenom)
    dir_image = DIR_PP + image_name

    compte += "{};{};{};{};{};{};{};{};{};{};{}\n".format(idt, prenom, nom, filiere, groupe, mail, tel, ADRESSE
                                                          , mdp, random_string, dir_image)

saveAccount(compte)

print("La génération a pris:", time.time() - t1, "s")
os.system('Pause')
