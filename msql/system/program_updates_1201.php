<?php
//philum_microsql_program_updates_1201
$r["_menus_"]=array('day','text');
$r[1]=array('0101','- le module LOAD accepte les options \'preview\', \'full\' et \'false\' pour d�terminer localement le niveau d\'affichage de la pr�view qui est d�termin� globalement dans les restrictions ;
- le module \'articles\' avec la commande \'article\' prend en compte le niveau d\'affichage demand� dans le script');
$r[2]=array('0102','- les modules \'system\' deviennent sensibles � l\'attribut \'hide\' ; 
- les articles en mode \'preview\' n\'affichent plus la mise en forme des balises : b, i, c et h.
- et une restriction \'destroy_bich\' permet de se passer de cette option
- :msq_html ne renvoie plus de double sauts de lignes ;
- le mode d\'enregistrement des articles (ajax ou post) d�pend du nombre de caract�res de l\'article (5000)');
$r[3]=array('0103','l\'article enregistr� en mode ajax devait �tre capable des m�mes traitements sur l\'importation des images que ceux qui ont lieu � la vol�e au moment o� la page est relanc�e');
$r[4]=array('0104','- r�solution import d\'images ayant deux extensions
- les commentaires sont d�sormais visibles dans une popup quand on est dans le d�roul�');
$r[5]=array('0105','probl�mes de couleur de fond de la popup, fix� sur clr1, d�pend de la derni�re page visit�e (sessions) et donc, pour diminuer les probl�mes d\'affichages, la couleur de texte est l\'inverse de la couleur de fond (invert_color)');
$r[6]=array('0106','partage de fichiers:
- ne fonctionnait plus (r�par�)
- l\'affectation de r�pertoire virtuel aussi
- pr�visu fichiers .swf
msql admin:
- la fonction \'repair\' d�sormais les entr�es vides
- le hub en cours est signal� sans �tre activ� (plus facile � trouver quand ils sont tous affich�s)');
$r[7]=array('0107','- le module \'search\' fonctionne d�sormais en ajax 
- les css par d�faut sont corrig�s en cons�quence ;
- le bool�en du moteur de recherche persiste dans la navigation par pages');
$r[8]=array('0108','un module \'command\' re�oit les lignes de commandes de script, qui donnent acc�s � n\'importe quelle fonctionnalit� (modules, connecteurs) ; 
le r�sultat est envoy� dans la balise \'content\'');
$r[9]=array('0111','remaniement de l\'admin et ajout d\'icones ;
l\'admin et l\'admin microsql s\'ouvrent d�sormais dans une iframe dans une popup');
$r[10]=array('0112','le menu \'img\' dans l\'�diteur d\'articles renvoie d�sormais directement le r�sultat de l\'image import�e dans l\'article, � la position du curseur, et ferme la popup dans la foul�e (code 6 de ajax)');
$r[11]=array('0112','r�vision graphique des popup, qui re�oivent un bouton \'hide\' assez pratique quand la popup est par dessus ce qu\'on veut voir ;');
$r[12]=array('0112','d�sormais tous les connecteurs obtiennent la capacit� de choisir entre entourer la s�lection ou afficher un assistant de r�daction du connecteur (dans le cas o� aucun texte n\'est s�lectionn�).');
$r[13]=array('0113','- les popup sont d�sormais fix�es � l\'�cran, avec une option \"�pingler\" et pour les r�duire ;
- am�lioration du syst�me des assistants de connecteurs, d�tecte la pr�sence d\'une option et propose un deuxi�me champ, et affiche l\'aide ;
- suppression connecteur d�suet \'scrut\' ;');
$r[14]=array('0114','- connecteurs \'formail\' et \'msq_ads\' : ajout d\'un assistant de cr�ation de formulaires');
$r[15]=array('0115','- le bouton \"+\" (ajout d\'article) ouvre en passant un champ qui permet d\'enregistrer directement un article depuis une url ; si les d�finitions d\'importation de site sont pr�sentes');
$r[16]=array('0116','l\'insertion d\'article par voie directe (quand seule l\'url est indiqu�e) acquiert la capacit� d\'aspirer les images dans la foul�e (avant m�me la cr�ation de l\'article) ce qui permet d\'obtenir un r�sultat d�finitif imm�diatement (enfin !) ; car avant les articles import�s devaient �tre lus pour pouvoir op�rer les importations d\'images dans la foul�e, ce qui obligeait � devoir l\'afficher pour terminer le processus.');
$r[17]=array('0117','l\'insertion d\'article par voie normale aussi (pourquoi ne pas y avoir pens� avant, on sait pas, ah mais oui il fallait faire des tests)');
$r[18]=array('0118','- on d�cide que le bouton \'open\' des articles place le contenu dans une fen�tre scrollable, c\'est nettement plus cool ;
- nombreuses petites r�parations comme apr�s chaque chambardement, sur les fa�ons d\'enregistrer ;
- ajout du module \'add_art\' qui permet de placer un bouton \'ajouter un article d\'apr�s une url\' sur la page, dans l\'optique de rendre ceci accessible au visiteur ;
(anniversaire du 100i�me module)');
$r[19]=array('0119','- r�parations sur les autorisations (pr�paration du niveau 4 pour l\'attacher � un hub personnel cadr� par le hub d\'o� on est membre) ;
- restriction scroll_preview (35) ;
- am�nagement interne sur les restrictions (74 occurrences) ;');
$r[20]=array('0120','- r�paration ajout des images import�es par avance dans le catalogue de l\'article ;
- test pour voir, format vid�o � 320px en mode preview ;');
$r[21]=array('0121','le composant \'make_tabs\' obtient la capacit� de se repositionner sur le dernier onglet s�lectionn�');
$r[22]=array('0122','la restriction \'pub_titles\' affecte le module \'page_titles\'');
$r[23]=array('0123','- correction faille de s�curit� (auth=7 pour les objets inattendus) ;
- petit correctif template art par d�faut (_EDIT avant _SUJ) ;
- \'page_titles\' utilise un template ;
- r�paration connecteur \'url\' qui avait �chou� ;
- r�paration gestion du mode d\'enregistrement au moment d\'un import');
$r[24]=array('0125','l\'�l�ment \'add_art\' est d�sormais enclench� 1000 millisecondes (1s) apr�s le clic droit : c\'est un moyen d\'obtenir une r�ponse de type \'onpaste\' dont on est s�r qu\'elle fonctionnera bien partout (� condition de mettre 1s � coller l\'url)');
$r[25]=array('0126','- \'login_popup\' est un module qui permet de proposer de s\'inscrire en ouvrant le formulaire de login dans une popup
- le mod add_art obtient la capacit� de garder un article non publi� si le auth est insuffisant');
$r[26]=array('0127','- rss_art ne duplique plus les sauts de lignes
- r�novation syst�me de niveau d\'auth de l\'article');
$r[27]=array('0128','- r�novation menu admin
- am�lioration syst�me des menus, pour que les submenus ajout�s aux menus soient parfaitement int�gr�s');
$r[28]=array('0129','adaptation des css par d�faut des menus d�roulants,
voici les changements apport�s pour mettre les css en conformit� avec le logiciel :

dans msql, changer 
#menuH li ul.vertical
en
#menuH.vertical li ul

ajouter une classe 
#menuH.vertical ul 
avec
float:none; box-shadow: 0px 0px 7px #bbb;

ajouter
float:none;
�
#menuH li ul.vertical

ajouter
position:absolute; 
�
menuH li ul

ajouter
float:left; 
� 
menuH ul

effacer
box-shadow: 0px 0px 7px #bbb;
dans menuH ul
et le coller dans menuH li ul
(d�placer aussi le fond blanc)

d�placer le 
float:left;
de menu li a
vers menu li');
$r[29]=array('0130','- la page css/_menus contient les aspects par d�faut et est load�e par d�faut');
$r[30]=array('0131','ajout du design \'cloud\' (2) devient celui par d�faut, \'classic\' (1) est entretenu, les designs basiques sont ceux du node \'public\' (accessible � tous les hubs), et parfois le mod associ� est celui de m�me valeur (design2 va avec mods2) ');
$r[31]=array('0131','finalisation (beta) de l\'aptitude du plugin \'share\' � inspecter des sites distants ; le partage de fichiers devient capable de chercher les fichiers partag�s sur d\'autres serveurs.');

?>