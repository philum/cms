<?php
//philum_microsql_program_updates_1405
$r["_menus_"]=array('date','text');
$r[1]=array('0501','- nouveau plugin \'viewcode\', va remplacer \'cod2base\'
- mise � jour des apps par d�faut');
$r[2]=array('0505','- renommages : Admin->admin, set_admin->set
- et rectif des htaccess
- ajout du param \'hover\' dans les lienj() (meilleur contr�le du statut des menus admin)
- la cat�gorie r�serv�e antique \'user\' est r�volue
');
$r[3]=array('0506','- renommages : anciens modules dont on retire la majusule, certaines fonctions du noyau sont harmonis�es
- ajout de \'tablet\' dans le user_menu (accessible via une apps) : adapte l\'ui aux les tablettes
- ajout de \'deskboot\' dans les user_menu, pour lancer les apps de la condition \'boot\'
- mise � jour des css par d�faut et du global
- fix taille des images d\'un lien pdf
- fix largeur adaptative des scroll');
$r[4]=array('0507','retouches :
- ajout du param�tre ajax 15 : repositionne la popup apr�s une action
- le module \'Home\' �tait intempestivement activ�, ce qui allumait des menus non visit�s
- sliderJ : position des boutons, des commentaires
- design global : d�fait de ses d�j� antiques shadows, la typo \'microsys\' supprim�e');
$r[5]=array('0508','- r�organisation des tables css par d�faut : 1=global, 2=d�faut, 3=d�faut sans couleurs
- ajout de pictos dans les menus de l\'admin
- les boutons du module menusJ deviennent toggle, d�sactivable en option
- ajout d\'une aide sp�cifique � l\'option de chaque module');
$r[6]=array('0509','- correctifs dans le htaccess
- option du module system/design : permet de lancer le css classic avant le css utilisateur
- �diteur css : bouton \'design vide\' permet de ne garder que les d�finitions de couleurs
- design css : bouton \'inverser couleurs\'
');
$r[7]=array('0510','- fusion : le module menusJ prend en charge le mode popup ou surplace, closed ou closeable ; menusP est obsol�te
- rendu plus clair : le module popadmin prend en charge les restrictions 51, 52 et 75, qui d�finissent le type d\'ic�ne et l\'orientation verticale, et sont rendus obsol�tes ; seuls quelques boutons peuvent �tre appel�s en option, et la liste d\'articles est d�plac�e vers l\'admin globale, et le finder dans le menu Actions');
$r[8]=array('0511','- patch filtre url dans le lecteur rss d�sign� pour spip
- on peut acc�der aux modules depuis le menu admin/console/modules
');
$r[9]=array('0512','- menus ajax : tous les boutons suivent les r�gles de menu, effacement des autres, activit�, fermeture au clic
- rstr51 permet d\'activer le menu admin au public
- menu admin : on peut modifier les rstr dans admin/console/restrictions');
$r[10]=array('0513','- dans l\'�diteur css le traitement des couleurs perso l\'�diteur re�oit le param�tre alpha(.2) apr�s la variable : #_4.2
- les css par d�faut sont d�barrass�s de leur rgba absolus
- le param�tre de couleur du desktop re�oit aussi les alpha
- r�vision du rattachement des options d\'articles venant du plugin
- fix menusJ option closed mais opened d\'une page � l\'autre
- fix tab qui ne restait pas actif au refresh (dans css edit)');
$r[11]=array('0513','- remise en chantier de msql2
- l\'admin msql est int�gr�e au programme, et mieux isolable');
$r[12]=array('0514','- correctif hi�rarchie popadmin, css
- les menus des backoffices console et msql s\'int�grent � popadmin
- mysql2 : patch de conversion des tables lues vers nouvelle architecture');
$r[13]=array('0515','�tude du nouveau moteur msql2 (todo) : structure topologique, moteur isol� (philum n\'en n\'est qu\'une application, o� on nomme les niveaux, ce qui les fige) ');
$r[14]=array('0516','- r�forme des menus url de l\'admin msql (prologue de msql2)
- les tr�s anciens formats de msql forcent la r��criture du nouveau, une fois pour toutes');
$r[15]=array('0517','- nouvelle admin msql, r�vision du syst�me des urls');
$r[16]=array('0518','- suppression des anciens dispositifs de l\'admin msql
- r�organisation des menus admin phi, destin� � �tre publique
- r�habilitation des outils madmin
- les menus de msql et de l\'admin sont int�gr�s au menu admin principal');
$r[17]=array('0519','- fix pb ancien de ciblage de la table msql lors d\'un enregistrement survenant apr�s un changement de page sur une autre fen�tre
- r�vision architecture de madmin
- les requires passent par une function de ciblage
- r�visions css
- fix pb erase css');
$r[18]=array('0520','- une erreur inconnue appara�t quand un fichier du programme existe hors de son r�pertoire
- correctif affichage popup de qq s�lecteurs
- correctif de l\'option ktag de sql()
- am�lioration du batch : g�n�ralisation des menus de cat�gories (addart, batch, rss) ; l\'ajout d\'article interroge automatiquement ce menu en cas d\'absence de cat�gorie
- picto icone/liste de la popup rendu toggle');
$r[19]=array('0521','- suppression de l\'antique \'clbub\' (close bubbles) remplac� par un simple background-click
- r�vision du menu admin msql : chaque noeud du root renvoie le contenu de son r�pertoire parent
- ajax/text rec�oit params
- slct all dans madmin
- am�lioration menu cat�gorie : se souvient si elle a d�j� �t� s�lectionn�e dans un autre menu
- r�surrection du principe de plugin comme du contexte global (il peut n\'�tre qu\'un module mais l\'url est plus cool : plug/plugin/p/o) ; modif htaccess');
$r[20]=array('0522','- le menu admin import est plac� dans le batch et dispara�t
- on peut appeler une ligne d\'une table en pla�ant l\'index en position 4 du node : lang/helps_txtx__publish*art
- la table program_plugs est repens�e en vue du futur menu plugs, et coreflush ajoute les nouveaux plugins dans la table. 
- fix video daily');
$r[21]=array('0523','- am�lioration index des plugins, on peut les �diter
- fix pb root dev avec prog()
- popup image arrive � la taille du resize
- renommage des connecteurs msq_html=>microconn, msq_ads=>microform, msq_template=>microread
- coup de balai sur d\'anciens dispositifs de la popup
- l\'option popup 3 permet d\'allumer le btn \'desktop\'
- l\'�diteur de plugins est en ajax');
$r[22]=array('0525','- renommages : substr_v=>strtopos, bubbles=>bubs
- meilleure gestion de la taille des images non import�es
- suppression du fichier syst�me vide \'desktop\'
- r�organisation des menus pour placer les plugins et les connecteurs, modules et template dans admin/global
- les mimes des pictos sont d�plac�s dans la table program_mimes');
$r[23]=array('0526','- nouvelle console bcp plus compacte, exit le simulateur de design pour pr�senter les modules
- le menu admin articles est disponible dans popadmin
- [ajout d\'un menu apps \'favs\':k]');
$r[24]=array('0527','- des donn�es de la config server sont plac�es dans des tables (admin_config, defaults, et lang), et fonctionnent comme admin_params
- modernisation du code de l\'admin, la plupart des actions ayant �t� externalis�es
- les images non aspir�es sont rendues adaptatives
- ajout du connecteur msq_lasts : affiche les �n derniers objets de la table');
$r[25]=array('0528','- am�lioration de la pr�sentation des listes venues des s�lections de cat�gories et tags (batch, rss, saveiec) : taille du scroll, � la ligne ou pas, comportement des fen�tres parentes
- jointure de saveiec avec slct_cat : les cat�gories peuvent �tre pr�s�lectionn�es, n\'importe quel enregistrement y fait r�f�rence');
$r[26]=array('0529','- usage des balises article et nav dans le template, les defs d\'importation sont modifi�es
- r�glage de la position par d�faut du menu admin
- une alerte pr�vient des modules syst�mes vitaux absents dans la console (il y en a d�j� au d�marrage)
- prise en charge par la nouvelle console de l\'ouverture des blocks de modules et de la newsletter depuis le menu admin
- dsnav (navigation dans r�pertoires) es externalis� en un plugin system');
$r[27]=array('0530','- la table syst�me apps est divis�es en plusieurs, les obligatoires et les optionnelles : la table Apps utilisateur est seulement additionnelle aux tables syst�mes lanc�es
- dans l\'admin msql, ajout des filtres \'add_menus\' et \'merge\'
- les donn�es des connecteurs obsol�tes sont plac�s dans la table system/connectors_old');
$r[28]=array('0531','- le push en prod g�n�re un backup quotidien
- le param�tre \'private\' des apps re�oit le niveau d\'autorisation
- fix pb dossiers vides dans les apps (o� les branches topologiques se greffent � d\'autres)
- r�vision du retape_conn (r�paration des connecteurs obsol�tes), les antiques conn pub1 pub2 et pub3 ne sont plus corrig�s, et les �couteurs sont plac�s dans et hors des connecteurs.
- ajout du plug \'retape\' pour retaper des articles en s�rie et mettre l\'option � off
- le mod prevnext marche avec les anciens articles (hors cache)');

?>