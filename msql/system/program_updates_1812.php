<?php //philum/microsql/program_updates_1812
$r=[1=>['1201','publication'],2=>['1217','am�lioration substantielle du service twitter
- am�lioration du gestionnaire de mise en cache
- uniformisation des processus via une mini-api
- ajout du support de like, retweet pour l\'utilisateur
- switch de clefs d\'api twitter
- am�lioration du gestionnaire de la colonne media, qui capte l\'ensemble des objets
- ajout de colonnes lang et mentions
- visualisation de la banni�re des utilisateurs
- poursuite des messages parents en enfants
- backup des followers (et ajout d\'un filtre de comparaison de tableaux dans msql)'],3=>['1225','ajout de l\'option d\'article \'last-update\', qui remplace l\'artifice en forme de connecteurs, et permet de sp�cifier une date de derni�re mise � jour de l\'article. Le patch r�forme les fichiers txt dans /plug/_data, les efface et transpose leurs donn�es dans la table art_datas (qdd).
La rstr113 permet d\'annuler l\'affichage de la mention \"modifi� le\", et le connecteur :last-update permet toujours d\'afficher et d\'activer l\'option d\'article.']];