<?php
//philum_microsql_program_updates_1109
$r["_menus_"]=array('day','txt');
$r[1]=array('110901','ajout du composant Flash \'viewer\' qui est appel� lors de l\'affichage d\'une image en popup: permet de passer en plein �cran, zoomer et naviguer dans l\'image');
$r[2]=array('110902','ajout du connecteur \':pdf\' qui ouvre un lecteur PDF');
$r[3]=array('110902','am�lioration de embed_p : h3, table, blockquote, ul, li et div n\'engendrent plus de balise p impromptues (que le navigateur ignore)');
$r[4]=array('110903','r�vision de proc�dure (retour � celle d\'il y a deux semaines!) le connecteur \':codeline\' est supprim� puisque ses apparats suffisent � faire le job (donc tout va bien, le codeline est parfaitement compatible avec les connecteurs)');
$r[5]=array('110904','application de r�visions de p_balise, de mani�re � conserver un contenu neutre pendant les it�rations jusqu\'au traitement en sortie : les retour � la ligne simple sont respect�s quelle que soit le traitement subi');
$r[6]=array('110904','changement radical mais avec peu d\'effets observ�s, du fonctionnement du d�compacteur de connecteurs, et de la gestion de ses emplacements (intervertis pour plus de clart� dans le code) : value�param:connector, et par d�faut la donn�es � gauche est consid�r�e comme value\' (et comme \'param\' en basic) ce qui peut produire \'value�1/2/3:connector\' - c\'est seulement pour les connecteurs auto (.swf) que la dimension s\'�crit � gauche : \'w/h�name.swf\'');
$r[7]=array('110905','pour de multiples modules MenusJ sur une page, aucun ne doit �tre en cache, donc cette option est supprim�e ;
le param�tre nbdays de \'articles\' s\'enrichit : 1-7 signifie de 1 � 7 jours');
$r[8]=array('110906','ajout d\'un �diteur de scripts de modules, pour les modules \'MenusJ\' et \'tab_mods\', et le connecteur \':ajax\' qui re�oit en param�tre la m�me instruction.');
$r[9]=array('110907','ajout d\'une restriction 15 pour rendre optionnel le captcha des commentaires');
$r[10]=array('110907','am�liorations graphiques');
$r[11]=array('110912','unification en tronc commun des requ�tes ajax');
$r[12]=array('110912','profonde r�vision du codeline basic qui va supporter les variables non d�clar�es, rendre les connecteurs \"objets\", et capable d\'utiliser les fonctions du Core.');
$r[13]=array('110912','ajout d\'une pr�visualisation et d\'un s�lecteur des fonctions du Core dans l\'�diteur d\'objets tels que les templates, les connetceurs et les modules utilisateur');
$r[14]=array('110913','certification du codeline basic, un langage diff�rent du codeline (qui sert � la pagination) orient� \"machine\" (qui peut �tre g�n�r� par une). Sa forme a �t� revue en profondeur, l\'�norme bond en avant �tant d� au fait que �a permette une r�elle programmation en utilisant des tableaux de donn�es, et surtout en acc�dant � une centaine de fonctions qui appartiennent au noyau de philum');
$r[15]=array('110913','on peut tester le codeline sur place sans avoir � l�enregistrer
arriv�e des menus \'core\' et \'preview\'');
$r[16]=array('110914','les connecteurs utilisateur ont la propri�t� d\'�tre des inserts si ils ne sont appliqu�s � aucun texte s�lectionn� (�a facilite l\'usage qui consiste � ins�rer une note r�currente)');
$r[17]=array('110914','on peut s�lectionner les bases publiques ou priv�es quand on �dite les connecteurs ou modules personnalis�s');
$r[18]=array('110915','int�gration du clbasic ;
ajout de boutons d\'�dition pour le clbasic ;
bouton \'make_public\' pour publier des connecteurs');
$r[19]=array('110916','clbasic capable de sauver des r�sultats dans des variables et de les restituer dans des commandes');
$r[20]=array('110917','ajout du connecteur \':articles\', qui reproduit le module \'articles\' qui est tr�s puissant. 
retire l\'article en cours des r�sultats de la requ�te.');
$r[21]=array('110917','le bouton du connecteur \'module\' profite du nouvel �diteur d\'appel � distance des modules');
$r[22]=array('110917','petite r�novation des tables des connecteurs');
$r[23]=array('110918','�diteur msql coupe les tables par pages');
$r[24]=array('110918','mise � jour table program_core (179 functions)');
$r[25]=array('110919','ajout de l\'onglet \'connecteurs\' dans l\'�diteur codeline');
$r[26]=array('110919','suppression des connecteurs :pub1, pub2 et pub3, d�sormais :pub supporte ces options [ID�4:pub] renvoie un simple lien ; ils restent op�rationnels le temps d\'entrer en d�su�tude');
$r[27]=array('110920','ajout d\'un moyen d\'�diter le contenu d\'un article bloquant : les articles qui font appel � eux-m�mes ou � leur parent dans leur contenu peuvent bloquer l\'affichage ; dans ce cas on peut d�sormais �diter l\'article au format brut dans l\'admin');
$r[28]=array('110920','ajout de l\'aide � l\'�dition des scripts mis en param�tre au module (et au connecteur) \':articles\'. la r�daction du script renvoie ensuite vers l\'�diteur de r�daction du module');
$r[29]=array('110920','finalisation des �diteurs de scripts de modules (correctifs, mise en conformit� : les modules successifs sont s�par�s par un \',\' et plus par un \'|\'');
$r[30]=array('110921','am�lioration du module twitter pour qu\'il affiche l\'image de la t�te des gens qui parlent');
$r[31]=array('110921','la simulation de la pagination de la console des modules a �t� revue');
$r[32]=array('110925','ajout du support livestream dans les vid�os : indiquer juste le nom de la cha�ne');
$r[33]=array('110925','remise � niveau du lecteur de modules utilisateur pour joindre cbasic();
un module public nomm� \'streams\' permet de joindre une cha�ne livestream dans un module');
$r[34]=array('110926','par �conomie le s�lecteur d�signe comme miniature la premi�re image de la liste (et ne cherche plus les suivantes), ce qui permet de n\'avoir aucune miniature � l\'article si on place un �l�ment vide au d�but de la liste : \'//image...\' ;
par surprise, l\'aspirateur d\'image mettait les png en jpg ce qui provoquait des probl�mes de construction de miniatures');
$r[35]=array('110927','google.video, youtobe, dailymotion et livestream sont reconnus et renvoie directement la syntaxe de vid�o d�j� r�dig�e ; on peut ajouter des vid�os en un clic (import)');

?>