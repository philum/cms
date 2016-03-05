<?php
//philum_microsql_program_updates_1201
$program_updates_1201["_menus_"]=array('day','text');
$program_updates_1201[1]=array('1201',"- le module LOAD accepte les options 'preview', 'full' et 'false' pour d�terminer localement le niveau d'affichage de la pr�view qui est d�termin� globalement dans les restrictions ;
- le module 'articles' avec la commande 'article' prend en compte le niveau d'affichage demand� dans le script");
$program_updates_1201[2]=array('1202',"- les modules 'system' deviennent sensibles � l'attribut 'hide' ; 
- les articles en mode 'preview' n'affichent plus la mise en forme des balises : b, i, c et h.
- et une restriction 'destroy_bich' permet de se passer de cette option
- :msq_html ne renvoie plus de double sauts de lignes ;
- le mode d'enregistrement des articles (ajax ou post) d�pend du nombre de caract�res de l'article (5000)");
$program_updates_1201[3]=array('1203',"l'article enregistr� en mode ajax devait �tre capable des m�mes traitements sur l'importation des images que ceux qui ont lieu � la vol�e au moment o� la page est relanc�e");
$program_updates_1201[4]=array('1204',"- r�solution import d'images ayant deux extensions
- les commentaires sont d�sormais visibles dans une popup quand on est dans le d�roul�");
$program_updates_1201[5]=array('1205',"probl�mes de couleur de fond de la popup, fix� sur clr1, d�pend de la derni�re page visit�e (sessions) et donc, pour diminuer les probl�mes d'affichages, la couleur de texte est l'inverse de la couleur de fond (invert_color)");
$program_updates_1201[6]=array('1206',"partage de fichiers:
- ne fonctionnait plus (r�par�)
- l'affectation de r�pertoire virtuel aussi
- pr�visu fichiers .swf
msql admin:
- la fonction 'repair' d�sormais les entr�es vides
- le hub en cours est signal� sans �tre activ� (plus facile � trouver quand ils sont tous affich�s)");
$program_updates_1201[7]=array('1207',"- le module 'search' fonctionne d�sormais en ajax 
- les css par d�faut sont corrig�s en cons�quence ;
- le bool�en du moteur de recherche persiste dans la navigation par pages");
$program_updates_1201[8]=array('1208',"un module 'command' re�oit les lignes de commandes de script, qui donnent acc�s � n'importe quelle fonctionnalit� (modules, connecteurs) ; 
le r�sultat est envoy� dans la balise 'content'");
$program_updates_1201[9]=array('1211',"remaniement de l'admin et ajout d'icones ;
l'admin et l'admin microsql s'ouvrent d�sormais dans une iframe dans une popup");
$program_updates_1201[10]=array('1212',"le menu 'img' dans l'�diteur d'articles renvoie d�sormais directement le r�sultat de l'image import�e dans l'article, � la position du curseur, et ferme la popup dans la foul�e (code 6 de ajax)");
$program_updates_1201[11]=array('1212',"r�vision graphique des popup, qui re�oivent un bouton 'hide' assez pratique quand la popup est par dessus ce qu'on veut voir ;");
$program_updates_1201[12]=array('1212',"d�sormais tous les connecteurs obtiennent la capacit� de choisir entre entourer la s�lection ou afficher un assistant de r�daction du connecteur (dans le cas o� aucun texte n'est s�lectionn�).");
$program_updates_1201[13]=array('1213','- les popup sont d�sormais fix�es � l\'�cran, avec une option \"�pingler\" et pour les r�duire ;
- am�lioration du syst�me des assistants de connecteurs, d�tecte la pr�sence d\'une option et propose un deuxi�me champ, et affiche l\'aide ;
- suppression connecteur d�suet \'scrut\' ;');
$program_updates_1201[14]=array('1214',"- connecteurs 'formail' et 'msq_ads' : ajout d'un assistant de cr�ation de formulaires");
$program_updates_1201[15]=array('1215','- le bouton \"+\" (ajout d\'article) ouvre en passant un champ qui permet d\'enregistrer directement un article depuis une url ; si les d�finitions d\'importation de site sont pr�sentes');
$program_updates_1201[16]=array('1216',"l'insertion d'article par voie directe (quand seule l'url est indiqu�e) acquiert la capacit� d'aspirer les images dans la foul�e (avant m�me la cr�ation de l'article) ce qui permet d'obtenir un r�sultat d�finitif imm�diatement (enfin !) ; car avant les articles import�s devaient �tre lus pour pouvoir op�rer les importations d'images dans la foul�e, ce qui obligeait � devoir l'afficher pour terminer le processus.");
$program_updates_1201[17]=array('1217',"l'insertion d'article par voie normale aussi (pourquoi ne pas y avoir pens� avant, on sait pas, ah mais oui il fallait faire des tests)");
$program_updates_1201[18]=array('1218',"- on d�cide que le bouton 'open' des articles place le contenu dans une fen�tre scrollable, c'est nettement plus cool ;
- nombreuses petites r�parations comme apr�s chaque chambardement, sur les fa�ons d'enregistrer ;
- ajout du module 'add_art' qui permet de placer un bouton 'ajouter un article d'apr�s une url' sur la page, dans l'optique de rendre ceci accessible au visiteur ;
(anniversaire du 100i�me module)");
$program_updates_1201[19]=array('1219',"- r�parations sur les autorisations (pr�paration du niveau 4 pour l'attacher � un hub personnel cadr� par le hub d'o� on est membre) ;
- restriction scroll_preview (35) ;
- am�nagement interne sur les restrictions (74 occurrences) ;");
$program_updates_1201[20]=array('1220',"- r�paration ajout des images import�es par avance dans le catalogue de l'article ;
- test pour voir, format vid�o � 320px en mode preview ;");
$program_updates_1201[21]=array('1221',"le composant 'make_tabs' obtient la capacit� de se repositionner sur le dernier onglet s�lectionn�");
$program_updates_1201[22]=array('1222',"la restriction 'pub_titles' affecte le module 'page_titles'");
$program_updates_1201[23]=array('1223',"- correction faille de s�curit� (auth=7 pour les objets inattendus) ;
- petit correctif template art par d�faut (_EDIT avant _SUJ) ;
- 'page_titles' utilise un template ;");

?>