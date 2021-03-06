<?php
//philum_microsql_helps_plugs
$helps_plugs["_menus_"]=array('description','usage','param');
$helps_plugs["01L"]=array('transducteur html vers 01L','external','');
$helps_plugs["ascii"]=array("utilitaire servant � cr�er des tables de caract�res ASCII, qu'ensuite on peut ajouter � system/edition_chars ; le lien permet d'ouvrir une url indiquant le champ de caract�res � chercher, de 127 � 70 000, pour prendre des section pas trop longues",'external','');
$helps_plugs["backup_msql"]=array('utilis� par le logiciel pour cr�er des sauvegardes des bases de donn�es microsql ; les backups peuvent �tre quotidiens car leur titre inclue la date de cr�ation.','system','');
$helps_plugs["book"]=array("Pr�pare un fichier XML avec les articles s�lectionn�s en vue d'une importation dans un logiciel de mise en page",'external','');
$helps_plugs["cards"]=array("fabrique des cartes de visites d'apr�s un article et des param�tres de dimension de la page situ�s dans 'system/edition_cards'",'connector','0');
$helps_plugs["cart"]=array('utilis� par la boutique en ligne','connector','');
$helps_plugs["chat"]=array("utilis� par le connecteur 'chat', qui renvoie un module de discussion instantan�e",'system','');
$helps_plugs["clrset"]=array("utilis� par le logiciel au moment o� on veut afficher le s�lecteur de couleurs sans avoir d�marr� de session d'�dition du design.",'system','');
$helps_plugs["cod2base"]=array('sauvegarde le code source dans une base pour le rendre consultable','external','');
$helps_plugs["compar_txt"]=array('compare les diff�rences entre deux textes','external','');
$helps_plugs["convert_chars"]=array('conversions de format : utf8, htmlentities, base64','external','');
$helps_plugs["disk_space"]=array("Gestion de l'espace disque utilisateur",'system','');
$helps_plugs["distribution"]=array("outil de distribution et de r�ception des mises � jour du programme (c'est la m�me page de code des deux c�t�s)",'system','');
$helps_plugs["download"]=array('renvoie un fichier','system','');
$helps_plugs["dump"]=array('dump de la base mysql','external','');
$helps_plugs["edf"]=array("(Electricit� de France !) renvoie un graphique de la consommation d'�nergie.
1- cr�er un tableau dans l'�diteur 01L de deux colonnes ;
2 - la premi�re colonne re�oit la date au format 01/01/10 (jour/mois/ann�e) et la deuxi�me colonne la consommation ;
3 - dans microsql et dans le r�pertoire 'users' cr�er une table nomm�e 'edf' ('hubname'_edf), faire 'import_txt' et coller le tableau, en cochant la case 'auto_increment' ;
4 - faire attention � ce que les donn�es soient dans l'ordre chronologique ;
5 - dans l'article, appeler [edf:plug], ce qui appelle la table du hub courant et renvoie un graphique temporis�, et la consommation moyenne.",'connector','');
$helps_plugs["exec"]=array("permet d'ex�cuter du code PHP, des fuctions de la librairie sont disponibles",'external','');
$helps_plugs["exec_js"]=array('utilis� par exec','internal','');
$helps_plugs["export"]=array('exporte la base si la fonction system est activ�e sur leserveur','external','');
$helps_plugs["favs"]=array('permet au visteur de m�moriser des articles','module + plgbtn (art_options)','');
$helps_plugs["fonts"]=array('dessine les typo GDF pr�sentes','system','');
$helps_plugs["forum"]=array("utilis� par le connecteur 'forum' ; les microforums permettent des discussions autour de plusieurs sujets simultan�ment.",'connector','');
$helps_plugs["goog"]=array('r�sultats de google','connector (not usefull)','');
$helps_plugs["gravatar"]=array('afficher un gravatar','system (not used)','');
$helps_plugs["hadopi"]=array('application publique (exemple de plug-in) branch� sur le serveur de numerama.fr qui recense les t�moins de la r�pression �lectronique','external / iframe','');
$helps_plugs["ifram"]=array('ouvre une page web depuis le serveur','external','');
$helps_plugs["index"]=array('liste et descrition des plug-ins (ici !)','external','');
$helps_plugs["install"]=array('installation des tables dans la base de don�nes, utilis� pour la cr�ation de noeuds de r�seau','system','');
$helps_plugs["lib"]=array('petite librairie pour les plugs','internal','');
$helps_plugs["links"]=array('liste des liens','system / external / callable','');
$helps_plugs["mail_list"]=array("enregistre l'e-mail pour la newsletter ou d�sabonne",'used by module','');
$helps_plugs["maths"]=array('classes de trigonom�trie','internal','');
$helps_plugs["microsql"]=array('liste des installations','system / server','');
$helps_plugs["microxml"]=array('envoie des tables microsql via xml','system / internal / external','');
$helps_plugs["model"]=array("fichier de base pour la cr�ation d'un plug-in ; contient les protocoles habituels",'dev','');
$helps_plugs["pager"]=array("visualisateur rapide d'articles",'external','');
$helps_plugs["patchs"]=array("fichier contenant l'historique des patches ayant eu � �tre appliqu�s ; les anciens sont sauvegard�s car rien ne dit que l'utilisateur ne va pas prendre du retard sur l'application des patches.",'system','');
$helps_plugs["pdf"]=array("ne marche pas ; sert � construire des pages au format pdf � partir d'articles",'external (not works)','');
$helps_plugs["petition"]=array('syst�me de p�tition','module / connector','');
$helps_plugs["phpinfo"]=array('phpinfo','external','');
$helps_plugs["player"]=array('page html du flash-rss player','external','');
$helps_plugs["playlist"]=array('cr�e le fichier xml qui sert � la galerie photo','external','');
$helps_plugs["publish_site"]=array("copie fichiers vitaux dans un sous-r�pertoire '_public' en vue de distribution par mise � jour",'external','');
$helps_plugs["radio"]=array("utilis� par le connecteur 'radio' pour cr�er des listes de lecture",'system','');
$helps_plugs["reset"]=array('annihile la session','external','');
$helps_plugs["rss"]=array('envoi un flux XML selon la norme RSS2.0','external','');
$helps_plugs["rss1"]=array('envoi un flux XML selon la norme RSS2.0, avec options de s�lection, utile pour le player flash-rss','external','');
$helps_plugs["rssin"]=array('re�oit les cha�nes RSS','system','');
$helps_plugs["sendmail"]=array('envoie un mail','external','');
$helps_plugs["sitemap"]=array('renseigne les moteurs de recherche','external (robots.txt)','');
$helps_plugs["slider"]=array("utilis� par le connecteur 'slider', qui construit et renvoie une liste de lecture d'images comment�es",'system','');
$helps_plugs["stat"]=array("renvoie un graphique d'apr�s les stats et les param�tres",'system','');
$helps_plugs["stat_reflush"]=array('destin� � �tre visit� par un CRON tous les jours � minuit 15, afin de consolider la base des statistiques','system / external','');
$helps_plugs["superpoll"]=array("permet au visiteur d'ajouter et de voter pour des entr�es",'connector / iframe','');
$helps_plugs["sys"]=array("petite librairie si le plug-in peut �tre appel� sans passer par la page d'accueil de fa�on � activer les sessions",'internal','');
$helps_plugs["tags"]=array('renvoie un nuage de tags ou de tags utilisateur','system / external / callable','');
$helps_plugs["text"]=array('permet de prendre des notes','system','');
$helps_plugs["tickets"]=array("Question, suggestions et discussions entre sites Philum et avec le 'father_server'",'system','');
$helps_plugs["twitter"]=array("utilis� par le connecteur 'twitter', qui affiche un flux de donn�es r�actualis�es toutes les n secondes",'system','');

?>