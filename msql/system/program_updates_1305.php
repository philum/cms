<?php
//philum_microsql_program_updates_1305
$r["_menus_"]=array('day','text');
$r[1]=array('0501','- fix pb affichage login, et \'reboot\' ne se relogue pas
- fix pb miniconn activable en d�but de ligne
- ajout de raccourcis dans apps/sys
- upgrade iconographique (�diteur, finder)
- le connecteur \':color\' g�re et pr�sente les couleurs html nomm�es (blue, yellow...)
- ajout du connecteur :html, qui r�unie :size, :font, :css, et :color dans une syntaxe par attributs : [pHilUM�css=txtcadr size=16 font=microsys color=firebrick:html]
- module \'desktop\' : le param�tre restera toujours \'boot\' par d�faut, alors l\'option revient au param�tre (couleurs ou image de fond)
- le miniconn accepte 1234:pub, lien vers un article du site');
$r[2]=array('0502','- les flux rss sont class�s par cat�gories (zap� pour l\'instant)
- r�fection du plugin petition
- am�liorations du chatXml : bouton d\'activation de chat en live, bouton d\'envoi d\'invitation
- la couleur des ic�nes du desktop est optimale par rapport � la moyenne des couleurs du d�grad� du background (normalement issue de la couleur 7, ou du css \'desktop\')');
$r[3]=array('0503','- les miniconn deviennent cross-server : les liens vers des articles, images et musiques publi�es sur le chat, m�me avec un chemin local, sont joignables depuis les autres serveurs.');
$r[4]=array('0504','- raffinement chatXml : seules les nouvelles donn�es sont charg�es et affich�es lors d\'un ajout ou d\'une mise � jour
- le bouton \'live\' reste parlant de l\'�tat r�el apr�s avoir relanc� le chat');
$r[5]=array('0505','- plus d\'ic�nes dans le menu Admin
- petites am�lioration du gestionnaire Apps
- le module Desktop peut �tre activ�, si aucun submodule n\'est en \'boot\', afin d\'obtenir son param�tre de couleurs de backgroud (c\'est pas tr�s bien foutu)');
$r[6]=array('0506','correctifs :
- images dans le chat
- syst�me d\'injection de javascript � la vol�e
- affichage de la cat�gorie \'_trash\'
- fonctionnement rstr53 d�sactiv� (enregistrement sans ajax)
- niveau de priorit� dans le module \'articles\' (erreur depuis upgrade mysql)');
$r[7]=array('0507','- correctifs d�tection des images du r�pertoire \'pub\' (hors logiciel)
- on remet (encore) l\'aspirateur de certaines images en mode litt�ral (�vite les doublons)
- nouveau gestionnaire msql, en mode objet, tr�s pratique (plugin msql)
- fix pb ouverture d\'image distante vide (miniconn)');
$r[8]=array('0508','- mise � jour de plug/model.php (protocoles des plugins)
- ajout d\'un contr�le d\'affichage des ic�nes dans une popup : liste ou icones ');
$r[9]=array('0509','- le chatXml pr�sente un champ d\'�dition en html5 (wygswyg)
- le param�tre \'real\' du module \'desktop_files\' permet (enfin) de naviguer dans les r�pertoires r�els (c\'�tait l\'id�e du d�but...)
- petit effort pour que les images et mp3 s\'affichent directement depuis la navigation sans passer par le s�lecteur d\'applications du Finder ;');
$r[10]=array('0510','r�vision du syst�me de navigation dans les r�pertoires (les r�pertoires sans fichiers mais avec un r�pertoire ne s\'affichaient pas)');
$r[11]=array('0511','- ajout d\'un s�lecteur de valeurs existantes pour le champ \'folder\' des metas
- normalisation du protocole mXml concernant les sauts de lignes (la m�me r�gle partout)
- fix pb affichage image distante depuis :rss_read
- ajout syst�me de backup/restauration, d�fauts et fabrication des restrictions par d�faut');
$r[12]=array('0512','- fix pb largeur chatxml
- fix pb hauteur book
- fix pb bon serveur dans le code iframe du book
- ajout du connecteur :popbook (mode preview forc�)');
$r[13]=array('0513','- francisation de l\'admin msql');
$r[14]=array('0514','- francisation de l\'�diteur css
- ajout du param \'auto_design\', permet de toujours avoir les d�finitions css par d�faut (qui �voluent vite), avec les couleurs locales');
$r[15]=array('0515','- ajout de la restriction 71 : stats d\'article, affiche un graphique
- encore une am�lioration de vitesse gr�ce � l\'aide de notre h�bergeur Infomaniak : la d�tection du d�clenchement de la mise � jour du cache est 100 fois plus rapide, ensuite appliqu�e en diff�rents endroits
- nouveau syst�me de mise � jour du nombre d\'articles, moins gourmand en ressources (m�me principe)
- ajout d\'un moyen d\'inviter un membre du chat par mail');
$r[16]=array('0516','- fix pbs ouverture popup des commentaires (externalisation de la fabrication du captcha) et prise en compte de l\'identit� reconnue automatiquement (placeholder ne renvoie aucune valeur)
- fix pb d�placement des modules (mauvais comptage g�n�r� par l\'absence du header)
- am�lioration du fonctionnement du flux rss secondaire du Batch : y figure les sites dont on est s�r qu\'on veut les aspirer enti�rement. L\'op�ration s\'arr�te au premier titre d�j� enregistr�.
- la rstr 22 (block bots) est invers�e (vague question de logique)');
$r[17]=array('0517','- externalisation du syst�me des commentaires dans un plugin');
$r[18]=array('0518','- miniconn : la room d\'un chat peut s\'appeler avec un diez #public (plus intuitif)
- simplification du connecteur video (automatiquement :popvideo dans les commentaires)');
$r[19]=array('0519','- ajout d\'un moyen de joindre l\'auteur d\'un commentaire par mail en ligne
- r�forme du gestionnaire Msql, phase 1/10 (au moins)');
$r[20]=array('0520','- menus bubbles dans l\'admin msql (non publi�)
- ajout d\'une aide � la langue fran�aise dans les commentaires
- ajout d\'un gestionnaire des messages d\'erreurs pour les commentaires
- ajout d\'une proc�dure pour afficher dans une popup le commentaire prit en r�f�rence, lors d\'une r�ponse : @123 affiche le pseudo et le message de ce commentaire');

?>