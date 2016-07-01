<?php
//philum_microsql_connectors_all
$r["_menus_"]=array('description');
$r["h"]=array('h3');
$r["b"]=array('bold');
$r["i"]=array('italic');
$r["u"]=array('underline');
$r["s"]=array('stabilo');
$r["r"]=array('red');
$r["c"]=array('css \'txtclr\' (couleur)');
$r["k"]=array('barr�');
$r["l"]=array('small');
$r["e"]=array('exposant');
$r["pre"]=array('balise \'pre\' (preformated) am�lior�e');
$r["code"]=array('balise code');
$r["php"]=array('affiche du code php avec sa coloration syntaxique');
$r["color"]=array('couleur du texte : [text�dd0000:color] [text�indigo:color]');
$r["/2"]=array('colonne largeur/2');
$r["/3"]=array('colonne 1/3 de largeur ');
$r["2cols"]=array('texte sur 2 colonnes');
$r["3cols"]=array('texte sur 3 colonnes');
$r[":(x)"]=array('efface tous les connecteurs');
$r[":b"]=array('efface les connecteurs :b');
$r[":c"]=array('efface les connecteurs :c');
$r[":h"]=array('efface les connecteurs :h');
$r[":h2"]=array('efface les connecteurs :h2');
$r[":i"]=array('efface les connecteurs :i');
$r[":list"]=array('efface les connecteurs :list');
$r[":no"]=array('efface les connecteurs :no');
$r[":q"]=array('efface les connecteurs :q');
$r[":s"]=array('efface les connecteurs :s');
$r[":u"]=array('efface les connecteurs :u');
$r["?"]=array('efface les \'?\' en d�but de ligne');
$r["add_lines"]=array('ajoute des lignes � la fin de chaque phrase');
$r["ajax"]=array('bouton qui renvoie sur place (ou dans un div cible) le r�sultat d\'un module ou d\'un connecteur.

syntaxe : 
 [param/title/command/option:module->target�button[,]:ajax] 
o� : 
- param/title/command/option:module ; 
- target = div cible ; 
- button = � afficher ;

La s�quence peut �tre r�p�t�e en utilisant la virgule comme s�parateur, de fa�on � produire un menu.

essayer : [id:read�screen:ajax] qui renvoie un contenu d\'article.');
$r["ajxget"]=array('outil de pr�servation des caract�res \':\', \'/\' et \'�\' pour le connecteur \'module\'');
$r["apps"]=array('appelle une Apps, 
- en r�f�rence � celles du module syst�me : [6:apps][6�hello:apps]
- ou �crite � la vol�e : [button;plug;stext:apps]
syntaxe(bouton;type;process;param;option)');
$r["articles"]=array('liste d\'articles d\'apr�s un tri, avec nombreux modes de pr�sentation');
$r["basic"]=array('ex�cute le code d\'instructions codeline basic');
$r["bkg"]=array('image en background : [value�img:bkg] (la premi�re du catalogue par d�faut)');
$r["book"]=array('relie des articles en un livre');
$r["bubble"]=array('menu � tiroirs en ajax (syntaxe du module \'submenus\')');
$r["chat"]=array('module de Chat en Ajax');
$r["clean_br"]=array('interdit plus de deux sauts de lignes');
$r["clean_mail"]=array('retire les sauts de ligne ill�gaux');
$r["clear"]=array('annule d�tourage image');
$r["console"]=array('classe css \'console\'');
$r["convert_html"]=array('convertit le html en connecteurs');
$r["css"]=array('applique un css au texte s�lectionn�');
$r["data"]=array('donn�es affili�es � l\'article (son id). 
hello�1:msq_data va �crire hello � la ligne 1, 
r��crire le connecteur en 1:msq_data, 
pour afficher la valeur associ�e � la clef 1');
$r["download"]=array('pointe vers un fichier et l\'envoie � l\'utilisateur');
$r["draw"]=array('apli externe');
$r["easy_tables"]=array('�clairci les tableaux');
$r["font"]=array('typo du texte [pHilUM�microsys:font]');
$r["footnotes"]=array('ajoute des ancres si (1) ou [1] est d�tect� deux fois');
$r["formail"]=array('formulaire d\'envoi de message');
$r["forum"]=array('place un module de Forum');
$r["h1"]=array('balise h1 (tr�s grand texte)');
$r["h2"]=array('balise h2 (grand texte)');
$r["header"]=array('renvoie du contenu dans le header');
$r["html"]=array('[pHilUM�css=txtcadr size=16 font=microsys color=firebrick:html]');
$r["iframe"]=array('renvoie une \'iframe\' d\'un lien html : [src�width/height/name/seamless:iframe]');
$r["img"]=array('force � consid�rer ce lien comme une image');
$r["img_label"]=array('tente de trouver si un texte est le commentaire d\'image');
$r["imgtxt"]=array('typos GDF ([text�typo:imgtxt]');
$r["import"]=array('importe un article depuis son Url');
$r["jconn"]=array('appelle un connecteur sur place en ajax : [248:read�open:jconn]');
$r["jopen"]=array('ouvre un contenu sur place en ajax : [ID:jopen]');
$r["jukebox"]=array('lecteur des mp3 d\'un r�pertoire [hub/dossier:jukebox]');
$r["last-update"]=array('date de la derni�re modification d\'un document');
$r["last_saved"]=array('revient � la derni�re action d\'enregistrement');
$r["lines"]=array('efface les sauts de ligne du texte s�lectionn�');
$r["link"]=array('liens pr�d�finis :
- lien-clef : Home, ID, cat�gorie, module
- mettre un titre : Home�Accueil
- utiliser un picto : Home�home:picto
- lien interne : /?plug=myplug�name_of_plug');
$r["list"]=array('efface les connecteurs :list');
$r["lowcase"]=array('r�duit la casse (minuscules) du texte s�lectionn�');
$r["microform"]=array('conf�re au visiteur le moyen d\'ajouter des entr�es dans une table msql ; exemple de formulaire � mettre en param�tre : date=date, choix1/choix2=list, entr�e1, entr�e2, message=text, image=upload, mail=mail, ok=button');
$r["microread"]=array('place les donn�es d\'une table msql dans un template.
ex: [dev_ads_353�readatas:microread] 
- fabriquer des donn�es avec :microform, 
- fabriquer des templates dans admin/templates');
$r["microsql"]=array('renvoie une microbase sous forme de tableau : [hub_table_(version/key)_(key)�(row):microsql] ;');
$r["msql"]=array('renvoie les donn�es d\'une table : 
[hub_table_(version)-(key)|(row)�option:microsql] ;');
$r["mini"]=array('fabrique une miniature d\'une image avec des dimensions personnalis�es : [img.jpg�140/100:thumb]
+ lien vers l\'original dans une popup en ajax');
$r["module"]=array('affiche un ou des modules - s�par�s par une barre verticale (|) ; ex: [hour|Home:link:module] (voir constructeurs / modules)');
$r["msq_bin"]=array('convertit les 1 et 0 des donn�es d\'une base microsql en images explicites');
$r["msq_conn"]=array('comme :microsql mais interpr�te les connecteurs dans les donn�es');
$r["msq_count"]=array('renvoie le nombre de lignes d\'une base microsql');
$r["msq_graph"]=array('renvoie un histogramme des donn�es d\'une colonne ou d\'une ligne d\'une table microsql ; ex: [node_base�col:msq_graph] (colonne) [node_base_key:msq_graph] (ligne)');
$r["msq_lasts"]=array('[node�10:msq_lasts] renvoie les 10 derniers �l�ments du tableau');
$r["no"]=array('n\'affiche pas le contenu');
$r["numlist"]=array('liste num�rot�es (pour chaque saut de ligne)');
$r["old_conn"]=array('r��crit les connecteurs obsol�tes');
$r["on"]=array('affiche le connecteur [hello:b:on]');
$r["p"]=array('balise p (paragraphe)');
$r["paste"]=array('coller du html et r�cup�rer des connecteurs');
$r["pdf"]=array('lecteur PDF ; ex: doc:pdf');
$r["petition"]=array('p�tition en ligne');
$r["photo"]=array('geleries photo');
$r["plug"]=array('connecteur imbriqu� : [param�option:plugin:plug]');
$r["plup"]=array('plugin dans une popup 
[param�option:plugin�button:plup]');
$r["figure"]=array('[image.jpg�texte:figure]');
$r["pop"]=array('ouvre le contenu dans une popup [texte�titre:pop]');
$r["popart"]=array('ouvre un article Philum (local ou distant) dans une popup');
$r["popmsqt"]=array('affiche le contenu d\'une entr�e msql dans une popup ; [system_program*gnu_1�GNU:popmsqt] ');
$r["popread"]=array('affiche le contenu d\'un article dans une popup');
$r["poptxt"]=array('affiche le contenu d\'un fichier texte dans une popup');
$r["popurl"]=array('ouvre une page web dans une popup');
$r["prod"]=array('article sous forme de produit de boutique en ligne');
$r["pub"]=array('publicit� d\'un article  [ID�option:pub] 
- par d�faut : renvoie un simple lien du titre
- �1 : panneau d\'article en mode 1 (preview=false)
- �2 : panneau d\'article en mode 2 (preview=true)
- �3 : panneau d\'article en mode 3 (preview=full)
- �4 : template \'pub_art\'');
$r["punct"]=array('applique les r�gles typographiques');
$r["radio"]=array('diffusion audio depuis une microtable ; ex: [auto/200�dev_music:radio] ou [auto�dev_music:radio] (pleine largeur)');
$r["read"]=array('place le contenu d\'un article');
$r["rename_img"]=array('enregistre l\'article en affectant un nom random aux images � importer, si par exemple elles ne sont diff�renci�es que par le nom de la variable (apr�s le \'?\')');
$r["replace"]=array('remplacement de texte');
$r["revert"]=array('revient � la version courante');
$r["rss_art"]=array('contenu d\'un article diffus� en rss');
$r["rss_input"]=array('flux rss');
$r["rss_read"]=array('contenu d\'un article d\'un autre site philum');
$r["scan"]=array('retourne le contenu d\'un document plac� dans le r�pertoire utilisateur, �1 interpr�te les connecteurs du contenu');
$r["search"]=array('r�sultats d\'une recherche (d�pendant de time_system)');
$r["shop"]=array('articles li�s par hi�rarchie sous forme de tableau de produits d\'une boutique en ligne 
(indiquer les tables personnalis�es \'prix\' et \'r�f�rence\'');
$r["size"]=array('taille du texte [text�24:size] ');
$r["swf"]=array('Renvoie un lien qui renvoie une popup en ajax o� s\'affiche l\'animation Flash. [width/large�src:swf]');
$r["t"]=array('css \'txtit\' (titres)');
$r["tables"]=array('efface les tableaux');
$r["thumb"]=array('fabrique une miniature d\'une image avec des dimensions personnalis�es : [img.jpg�140/100:thumb]');
$r["poptwit"]=array('ouvre un twit dans une popup');
$r["twitter"]=array('appelle un twit depuis son ID, ou un flux depuis le nom d\'utilisateur, � travers l\'API Twitter');
$r["version"]=array('num version');
$r["video"]=array('lit une vid�o youtube daily vimeo rutube etc... d\'apr�s leur id. �1 renvoie un lien qui ouvre une popup');
$r["w"]=array('affiche le lien en entier');
$r["web"]=array('renvoie le contenu d\'une page html et l\'interpr�te');
$r["webpage"]=array('affiche une page web dans une popup (utilisant le plugin \'suggest\' : se r�f�re aux d�finitions de sites ou � l\'ent�te)');
$r["mktable"]=array('formate les donn�es csv en tableau (virgule et saut de ligne) ');
$r["svgcode"]=array('cr�e un svg depuis des connecteurs. �width/height');
$r["popmsql"]=array('affiche le contenu d\'une base msql dans une popup ; [public_atomic�GNU:popmsql]');
$r[":pre"]=array('efface les connecteurs :pre');
$r["image"]=array('ouvre comme image sans l\'importer, n\'importe quel format');
$r["plugin"]=array('se comporte comme un connecteur habituel : name�param:plugin');
$r["slides"]=array('cr�e un diaporama d\'apr�s les donn�es dans le connecteur, s�par�es par un saut de ligne ou par --');

?>