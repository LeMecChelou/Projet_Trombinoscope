import random
import hashlib
from setup import *


def createPhone():

    phone = "06"
    for k in range(4):
        digits = random.randint(10, 99)
        phone += "." + str(digits)

    return phone


def saveAccount(account):

    with open("comptes.csv", "a") as fichier:
        fichier.write(account)


nb_comptes = int(input("Entrez le nombre de comptes à créer: "))

m_hash = hashlib.sha256()

for nb in range(nb_comptes):
    prenom = random.choice(PRENOMS)
    nom = random.choice(NOMS)
    filiere = random.choice(FILIERES)
    groupe = random.choice(GROUPES[filiere])
    phone = createPhone()

    idt = (prenom[0] + nom).lower()
    mail = (prenom + "." + nom + "@gmail.com").lower()

    mdp = (nom[0] + prenom).lower().encode()
    m_hash.update(mdp)

    compte = "{};{};{};{};{};{};{};{};{};{}\n".format(idt, prenom, nom, filiere, groupe, mail, phone, ADRESSE,
                                                   m_hash.hexdigest(), DIR_PP)
    saveAccount(compte)
