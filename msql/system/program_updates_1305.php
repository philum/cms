<?php //msql/program_updates_1305
$r=["_menus_"=>['day','text'],
"1"=>['0501','- fix pb affichage login, et \'reboot\' ne se relogue pas
- fix pb miniconn activable en dÃ©but de ligne
- ajout de raccourcis dans apps/sys
- upgrade iconographique (Ã©diteur, finder)
- le connecteur \':color\' gÃ¨re et prÃ©sente les couleurs html nommÃ©es (blue, yellow...)
- ajout du connecteur :html, qui rÃ©unie :size, :font, :css, et :color dans une syntaxe par attributs : [pHilUMÂ§css=txtcadr size=16 font=microsys color=firebrick:html]
- module \'desktop\' : le paramÃ¨tre restera toujours \'boot\' par dÃ©faut, alors l\'option revient au paramÃ¨tre (couleurs ou image de fond)
- le miniconn accepte 1234:pub, lien vers un article du site'],
"2"=>['0502','- les flux rss sont classÃ©s par catÃ©gories (zapÃ© pour l\'instant)
- rÃ©fection du plugin petition
- amÃ©liorations du chatXml : bouton d\'activation de chat en live, bouton d\'envoi d\'invitation
- la couleur des icÃ´nes du desktop est optimale par rapport Ã  la moyenne des couleurs du dÃ©gradÃ© du background (normalement issue de la couleur 7, ou du css \'desktop\')'],
"3"=>['0503','- les miniconn deviennent cross-server : les liens vers des articles, images et musiques publiÃ©es sur le chat, mÃªme avec un chemin local, sont joignables depuis les autres serveurs.'],
"4"=>['0504','- raffinement chatXml : seules les nouvelles donnÃ©es sont chargÃ©es et affichÃ©es lors d\'un ajout ou d\'une mise Ã  jour
- le bouton \'live\' reste parlant de l\'Ã©tat rÃ©el aprÃ¨s avoir relancÃ© le chat'],
"5"=>['0505','- plus d\'icÃ´nes dans le menu Admin
- petites amÃ©lioration du gestionnaire Apps
- le module Desktop peut Ãªtre activÃ©, si aucun submodule n\'est en \'boot\', afin d\'obtenir son paramÃ¨tre de couleurs de backgroud (c\'est pas trÃ¨s bien foutu)'],
"6"=>['0506','correctifs :
- images dans le chat
- systÃ¨me d\'injection de javascript Ã  la volÃ©e
- affichage de la catÃ©gorie \'_trash\'
- fonctionnement rstr53 dÃ©sactivÃ© (enregistrement sans ajax)
- niveau de prioritÃ© dans le module \'articles\' (erreur depuis upgrade mysql)'],
"7"=>['0507','- correctifs dÃ©tection des images du rÃ©pertoire \'pub\' (hors logiciel)
- on remet (encore) l\'aspirateur de certaines images en mode littÃ©ral (Ã©vite les doublons)
- nouveau gestionnaire msql, en mode objet, trÃ¨s pratique (plugin msql)
- fix pb ouverture d\'image distante vide (miniconn)'],
"8"=>['0508','- mise Ã  jour de plug/model.php (protocoles des plugins)
- ajout d\'un contrÃ´le d\'affichage des icÃ´nes dans une popup : liste ou icones '],
"9"=>['0509','- le chatXml prÃ©sente un champ d\'Ã©dition en html5 (wygswyg)
- le paramÃ¨tre \'real\' du module \'desktop_files\' permet (enfin) de naviguer dans les rÃ©pertoires rÃ©els (c\'Ã©tait l\'idÃ©e du dÃ©but...)
- petit effort pour que les images et mp3 s\'affichent directement depuis la navigation sans passer par le sÃ©lecteur d\'applications du Finder ;'],
"10"=>['0510','rÃ©vision du systÃ¨me de navigation dans les rÃ©pertoires (les rÃ©pertoires sans fichiers mais avec un rÃ©pertoire ne s\'affichaient pas)'],
"11"=>['0511','- ajout d\'un sÃ©lecteur de valeurs existantes pour le champ \'folder\' des metas
- normalisation du protocole mXml concernant les sauts de lignes (la mÃªme rÃ¨gle partout)
- fix pb affichage image distante depuis :rss_read
- ajout systÃ¨me de backup/restauration, dÃ©fauts et fabrication des restrictions par dÃ©faut'],
"12"=>['0512','- fix pb largeur chatxml
- fix pb hauteur book
- fix pb bon serveur dans le code iframe du book
- ajout du connecteur :popbook (mode preview forcÃ©)'],
"13"=>['0513','- francisation de l\'admin msql'],
"14"=>['0514','- francisation de l\'Ã©diteur css
- ajout du param \'auto_design\', permet de toujours avoir les dÃ©finitions css par dÃ©faut (qui Ã©voluent vite), avec les couleurs locales'],
"15"=>['0515','- ajout de la restriction 71 : stats d\'article, affiche un graphique
- encore une amÃ©lioration de vitesse grÃ¢ce Ã  l\'aide de notre hÃ©bergeur Infomaniak : la dÃ©tection du dÃ©clenchement de la mise Ã  jour du cache est 100 fois plus rapide, ensuite appliquÃ©e en diffÃ©rents endroits
- nouveau systÃ¨me de mise Ã  jour du nombre d\'articles, moins gourmand en ressources (mÃªme principe)
- ajout d\'un moyen d\'inviter un membre du chat par mail'],
"16"=>['0516','- fix pbs ouverture popup des commentaires (externalisation de la fabrication du captcha) et prise en compte de l\'identitÃ© reconnue automatiquement (placeholder ne renvoie aucune valeur)
- fix pb dÃ©placement des modules (mauvais comptage gÃ©nÃ©rÃ© par l\'absence du header)
- amÃ©lioration du fonctionnement du flux rss secondaire du Batch : y figure les sites dont on est sÃ»r qu\'on veut les aspirer entiÃ¨rement. L\'opÃ©ration s\'arrÃªte au premier titre dÃ©jÃ  enregistrÃ©.
- la rstr 22 (block bots) est inversÃ©e (vague question de logique)'],
"17"=>['0517','- externalisation du systÃ¨me des commentaires dans un plugin'],
"18"=>['0518','- miniconn : la room d\'un chat peut s\'appeler avec un diez #public (plus intuitif)
- simplification du connecteur video (automatiquement :popvideo dans les commentaires)'],
"19"=>['0519','- ajout d\'un moyen de joindre l\'auteur d\'un commentaire par mail en ligne
- rÃ©forme du gestionnaire Msql, phase 1/10 (au moins)'],
"20"=>['0520','- menus bubbles dans l\'admin msql (non publiÃ©)
- ajout d\'une aide Ã  la langue franÃ§aise dans les commentaires
- ajout d\'un gestionnaire des messages d\'erreurs pour les commentaires
- ajout d\'une procÃ©dure pour afficher dans une popup le commentaire prit en rÃ©fÃ©rence, lors d\'une rÃ©ponse : @123 affiche le pseudo et le message de ce commentaire']];