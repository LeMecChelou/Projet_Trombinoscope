import random
import hashlib
import time
import os
from setup import *


def getRandomString():

    random_string = str()
    for k in range(13):
        if random.randint(0, 1) == 1:
            random_string += chr(random.randint(97, 122))
        else:
            random_string += chr(random.randint(48, 57))

    return random_string


def createPhone():

    phone = "06"
    for k in range(4):
        digits = random.randint(10, 99)
        phone += "." + str(digits)

    return phone


def saveAccount(account):

    with open("fichiers/etudiants.csv", "w") as fichier:
        fichier.write(account)


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

    compte += "{};{};{};{};{};{};{};{};{};{};{}\n".format(idt, prenom, nom, filiere, groupe, mail, tel, ADRESSE
                                                          , mdp, random_string, DIR_PP)

saveAccount(compte)

print("La génération a pris:", time.time() - t1, "s")
os.system('Pause')
