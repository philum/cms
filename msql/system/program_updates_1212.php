<?php
//philum_microsql_program_updates_1212
$r["_menus_"]=array('day','text');
$r[1]=array('1201','am�liorations de commodit� de l\'interface, 
- des css, 
- du traitement des popups qui ouvrent un objet de l\'admin, 
- du comportement de la fen�tre du moteur de recherche,
- et de l\'interface v�cue par les diff�rentes sortes de membres');
$r[2]=array('1202','- ajout du module \'columns\' qui permet de mettre des modules sur plusieurs colonnes
- menu apps r�cursif ;');
$r[3]=array('1203','- r�novation de l\'installation des bases');
$r[4]=array('1204','- le format \'brut\' (connecteurs) renvoie des url absolues pour les images (pour les transactions entre sites) ;
- ajout d\'une balise \'source\' dans le rss de l\'article ;');
$r[5]=array('1205','- am�lioration du menu Apps (r�cursivit� et pr�sentation) ;
- r�vision du fonctionnement de la d�tection du mode admin (�radication de l\'affichage intempestif d\'une page d\'admin) ;
- changement du mode d\'affichage des menus de l\'admin msql (menus d�roulants) ;');
$r[6]=array('1206','- le permalog est r�gl� sur 30 jours, 12 requ�tes par an �a suffit
- on remet le menu normal de l\'admin msql
- francisation des alertes du login');
$r[7]=array('1207','- prise en compte serveurs en utf-8 (config serveur) (pas encore compl�t�) ;
- r�vision moteur de microsql, les variables ne sont plus nomm�es et la propagation de cette m�thode est non intrusive (pas besoin de patch) : baisse de poids des bases ;
- optimisation des quelques requ�tes mysql (d�marrage et recherche) : l�ger gain de vitesse ;
- am�lioration du plugin \'suggest\' (affichage d\'erreurs) ;');
$r[8]=array('1208','- menues am�liorations dans les plugins notepad, sText, htaccess ;
- correctifs d�tection mise � jour (due � la r�cente mutation des mb) ;');
$r[9]=array('1209','- ajax.php � racine a �t� modifi� ;
- ajout du composant \'Admin/codev\' pour �diter le code sur place en mode texte ;');
$r[10]=array('1210','- r�paration du AMT qui s\'�tait mit � ne plus marcher pour les plugins (sText, htaccess...) ;');
$r[11]=array('1211','- r�vision d\'un filtre de protection de ajax, afin de rendre op�rationnelle l\'�dition du code en ligne (qui perdait les antislashes et les %u)');
$r[12]=array('1212','- r�vision des apparitions des htmlentities qui posaient probl�me sur certains serveurs ;');
$r[13]=array('1213','- on remet youtube en flash, qui propose le fullscreen, et qui est plus v�loce');
$r[14]=array('1214','- mise en place de la mise � jour automatique ;
- la restriction \'check updates\' (48) devient \'auto-update\' ;');
$r[15]=array('1215','- petite r�vision du comportement du rendu avec ou sans la rstr \'p_balise\' (13) ;');
$r[16]=array('1216','- la limite d\'upload par d�faut passe � 250Mo, et devient un param�tre serveur ;');
$r[17]=array('1217','- francisation des titres du menu admin (lang/admin_menus)  ;
-ajout du bouton menu admin \'about\' ;');
$r[18]=array('1218','- r�paration du fonctionnement conjoint des restrictions \'save in ajax\' et \'save in popup\' (53 et 57) : popup implique ajax...
- l\'alerte de mise � jour pr�sente les notes de dev depuis la derni�re maj ;');
$r[19]=array('1219','- mise � jour du template d\'articles par d�faut ;
- r�paration du comportement des popups qui se ferment en modifiant le contenu d\'une autre ;
- r�paration de l\'�diteur rapide de couleurs du sites ;');
$r[20]=array('1220','- am�lioration et francisation de la pr�sentation de la mise � jour ;');
$r[21]=array('1221','remise � niveau du proc�d� des templates : 
- l\'option template du module \'load\' est aussi valable pour la lecture de l\'article seul (comme �a on peut en choisir un diff�rent par condition) ;
- ajout de variables aux templates : les intitul�s des tags utilisateurs, anciennement regroup�s sous \'_usertags\', peuvent �tre d�group�s comme dans \'_auteurs\' ;
- Enfin �a y est on s\'est d�cid�s : la proc�dure \'pubart\' (souvent appel�e, qui se r�f�re aux donn�es du cache) est r�gie par un template \'pubart\', et qu\'on peut supplanter par une autre table utilisateur ou table publique : cela permet d\'avoir des pubs d\'articles possibles � mettre en forme ;
Par contre les pubs ne sont plus sensibles � la restriction \'ajax mode\' (8) donc il faut �crire le template comme ceci : 
[_PURL�_SUJ:jurl:on] au lieu de [_URL�_SUJ:url:on] pour ouvrir le contenu dans une popup ou sur place avec _jurl ;
- suppression de la rstr 17 (smart edit, obsol�te) ;');
$r[22]=array('1222','- fix pb d�tection de l\'update + apparition de l\'ic�ne upload en cas d\'�chec de l\'automate ;
- fix pb variable vide dans le template ;
- rstr 17 : \'fast console\', permet d\'�diter les modules sur place ;
- renommage des restrictions pour plus de clart� ;');
$r[23]=array('1223','- fix bug amdin msql');
$r[24]=array('1224','- le menu msql de l\'admin renvoie les tables r�elles de l\'utilisateur ;');
$r[25]=array('1225','- une s�rie de fonctions sans usage a �t� d�sactiv�e temporairement (champs �ditables)');
$r[26]=array('1226','- correctif erreur indicatif pour meta robots');
$r[27]=array('1227','- correctif compatibilit� du template article avec le module d\'article \'open\' (ouvrir sur place) ;');
$r[28]=array('1228','- les menus select de l\'�diteur de meta sont remplac�s par les composants ajax �quivalents ;
- l\'ouverture sur place des articles se souvient du niveau de preview initial (1 ou 2) ;
- l\'int�grateur vid�o supporte l\'url youtu.be ;');
$r[29]=array('1229','- r��criture du plugin de gestion des inscriptions � la newsletter (plugin \'mailist\'), en ajax ;');
$r[30]=array('1230','- fix d�calage horaire dans le syst�me d\'envoi de mails ;
- fix stupiderie dans l\'outil de tags ;');
$r[31]=array('1231','- r�novation du syst�me d\'envoi de la newsletter (ajout d\'un plugin \'newsletter\') ;');

?>