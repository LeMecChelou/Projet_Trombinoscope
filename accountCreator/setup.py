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

DIR_PP = "assets/pp_none.png"

ADRESSE = "6, rue de Paris"
