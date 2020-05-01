import random
import os


def getImage(nom, prenom):

    image_name = nom[0].lower() + prenom + ".png"
    list_img = os.listdir("./fichiers/blank_img")

    img = random.choice(list_img)

    with open("./fichiers/blank_img/" + img, "rb") as fichier:
        img = fichier.read()

    with open("./fichiers/img_treated/" + image_name, "wb") as fichier:
        fichier.write(img)

    return image_name


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


# Création de la liste des prénoms.
PRENOMS = list()
with open("fichiers/prenom.csv") as fichier:
    fichier = fichier.read()
    fichier = fichier.split("\n")
    for name in fichier[7:]:
        PRENOMS.append(name.split(",")[0])


# Création de la liste des noms de familles.
NOMS = list()
with open("fichiers/patronymes.csv") as fichier:
    fichier = fichier.read()
    fichier = fichier.split("\n")
    for name in fichier[7:]:
        NOMS.append(name.split(",")[0])

del NOMS[len(NOMS) - 1]

FILIERES = ['L1-MIPI', "L2-MI", "L3-I", "LP RS", "LPI-RIWS"]

GROUPES = {"L1-MIPI": ["A1", "A2", "A3"], "L2-MI": ['B1', "B2", "B3"], "L3-I": ['C1', 'C2', 'C3'],
           "LP RS": ['D1', 'D2', 'D3'], "LPI-RIWS": ['E1', 'E2', 'E3']}


DIR_PP = "images_etu/"
ADRESSE = "6, rue de Paris"
URL = "https://generated.photos/faces"
