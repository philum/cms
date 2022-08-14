<?php //msql/connectors_all_sav
$r=["_menus_"=>['description'],
"h"=>['h2'],
"b"=>['gras'],
"i"=>['italique'],
"u"=>['soulign�'],
"q"=>['bloc'],
"s"=>['small'],
"c"=>['css \'txtclr\' (couleur)'],
"k"=>['barr�'],
"e"=>['exposant'],
"n"=>['indice'],
"pre"=>['balise \'pre\' (preformated) am�lior�e'],
"code"=>['balise code'],
"php"=>['affiche du code php avec sa coloration syntaxique'],
"color"=>['couleur du texte : [text�dd0000:color] [text�indigo:color]'],
"cols"=>['met le contenu dans des colonnes : [�3:cols] (nombre), [�300:cols] (taille en px)'],
"block"=>['met le contenu dans un block : [�3:block] (%), [�300:block] (taille en px)'],
"center"=>['aligne au centre'],
"add_lines"=>['ajoute des lignes � la fin de chaque phrase'],
"ajax"=>['bouton qui renvoie sur place (ou dans un div cible) le r�sultat d\'un module ou d\'un connecteur.

syntaxe : 
 [param/title/command/option:module->target�button[,]:ajax] 
o� : 
- param/title/command/option:module ; 
- target = div cible ; 
- button = � afficher ;

La s�quence peut �tre r�p�t�e en utilisant la virgule comme s�parateur, de fa�on � produire un menu.

essayer : [id:read�screen:ajax] qui renvoie un contenu d\'article.'],
"ajxget"=>['outil de pr�servation des caract�res \':\', \'/\' et \'�\' pour le connecteur \'module\''],
"apps"=>['appelle une Apps, 
- en r�f�rence � celles du module syst�me : [6:apps][6�hello:apps]
- ou �crite � la vol�e : [button;plug;stext:apps]
syntaxe(bouton;type;process;param;option)'],
"articles"=>['liste d\'articles d\'apr�s un tri, avec nombreux modes de pr�sentation'],
"basic"=>['ex�cute le code d\'instructions codeline basic'],
"bkg"=>['image en background : [value�img:bkg] (la premi�re du catalogue par d�faut)'],
"book"=>['relie des articles en un livre'],
"submenus"=>['menu � tiroirs en ajax (syntaxe du module \'submenus\')'],
"chat"=>['module de Chat en Ajax'],
"clean_br"=>['interdit plus de deux sauts de lignes'],
"clean_mail"=>['retire les sauts de ligne ill�gaux'],
"striplink"=>['�radique les liens'],
"del_inclusive"=>['supprime les appendices du langage inclusif'],
"clear"=>['annule d�tourage image'],
"console"=>['classe css \'console\''],
"convert_html"=>['convertit le html en connecteurs'],
"css"=>['applique un css au texte s�lectionn�'],
"download"=>['pointe vers un fichier et l\'envoie � l\'utilisateur'],
"draw"=>['apli externe'],
"font"=>['typo du texte [pHilUM�microsys:font]'],
"footnotes"=>['ajoute des ancres si (1) ou [1] est d�tect� deux fois'],
"formail"=>['formulaire d\'envoi de message'],
"forum"=>['place un module de Forum'],
"h1"=>['balise h1 (grand titre)'],
"h2"=>['balise h2 (titre secondaire - d�faut)'],
"h3"=>['balise h3'],
"h4"=>['balise h4'],
"h5"=>['balise h5'],
"header"=>['renvoie du contenu dans le header'],
"html"=>['[pHilUM�css=txtcadr size=16 font=microsys color=firebrick:html]'],
"iframe"=>['renvoie une \'iframe\' d\'un lien html : [src�width/height/name/seamless:iframe]'],
"object"=>['place le contenu comme source d\'une balise object (plus puissant qu\'une iframe, ouvre les pdf)'],
"img"=>['force � consid�rer ce lien comme une image'],
"img_label"=>['tente de trouver si un texte est le commentaire d\'image'],
"imgtxt"=>['typos GDF ([text�typo:imgtxt]'],
"imgdata"=>['donn�es d\'une image [datas�jpeg:imgdata]'],
"import"=>['importe un article depuis son Url'],
"jukebox"=>['lecteur des mp3 d\'un r�pertoire [hub/dossier:jukebox]'],
"last-update"=>['date de la derni�re modification d\'un document'],
"last_saved"=>['revient � la derni�re action d\'enregistrement'],
"lines"=>['efface les sauts de ligne du texte s�lectionn�'],
"link"=>['liens pr�d�finis :
- lien-clef : Home, ID, cat�gorie, module
- mettre un titre : Home�Accueil
- utiliser un picto : Home�home:picto
- lien interne : /?plug=myplug�name_of_plug'],
"lowcase"=>['r�duit la casse (minuscules) du texte s�lectionn�'],
"msql"=>['Renvoie les donn�es d\'une table : 
[hub_table_(version)-(key)|(row)�option:microsql] ;
Options : pop, read, conn, last, count, graph, form, tmp'],
"mini"=>['fabrique une miniature d\'une image avec des dimensions personnalis�es : [img.jpg�140/100:mini]
+ lien vers l\'original dans une popup en ajax'],
"module"=>['affiche un ou des modules - s�par�s par une barre verticale (|) ; ex: [hour|Home:link:module] (voir constructeurs / modules)'],
"on"=>['affiche le connecteur [hello:b:on]'],
"no"=>['n\'affiche pas le contenu'],
"ko"=>['n\'ex�cute pas le contenu'],
"list"=>['liste � puces'],
"numlist"=>['liste num�rot�es (pour chaque saut de ligne)'],
"old_conn"=>['r��crit les connecteurs obsol�tes'],
"p"=>['balise p (paragraphe)'],
"qu"=>['balise q (guillemets)'],
"paste"=>['coller du html et r�cup�rer des connecteurs'],
"pdf"=>['lecteur PDF ; ex: doc:pdf'],
"mp4"=>['lecteur mp4 (et m3u) ; �titre renvoie un bouton vers une popup'],
"petition"=>['p�tition en ligne'],
"photos"=>['planche contact de photos. Source de donn�es : id, liste s�par�e par une virgule, ou r�pertoire utilisateur'],
"gallery"=>['s�rie d\'image � la cha�ne ; source de donn�es : id, liste s�par�e par une virgule, ou r�pertoire utilisateur'],
"slider"=>['D�filement d\'images ; source de donn�es : id, liste s�par�e par une virgule, ou r�pertoire utilisateur'],
"plug"=>['plugin: [param�option:plugin:plug]'],
"app"=>['appin : [param�option:app:appin]'],
"appbt"=>['bouton vers une app [p�o:app�bt:appbt]'],
"connbt"=>['bouton vers un connecteur [p�o:c�bt:connbt]'],
"figure"=>['[image.jpg�texte:figure]'],
"pop"=>['ouvre le contenu dans une popup [texte�titre:pop]'],
"popart"=>['ouvre un article Philum (local ou distant) dans une popup'],
"popmsqt"=>['affiche le contenu d\'une entr�e msql dans une popup ; [system_program*gnu_1�GNU:popmsqt] '],
"popread"=>['affiche le contenu d\'un article dans une popup'],
"poptxt"=>['affiche un contenu dans une popup'],
"popfile"=>['affiche le contenu d\'un fichier texte dans une popup'],
"popurl"=>['ouvre une page web dans une popup'],
"prod"=>['article sous forme de produit de boutique en ligne'],
"pub"=>['[1234:pub] affiche un lien
[1234�1:pub] �2 �3 �4 ouvre article (preview mode)'],
"art"=>['[1234:art] affiche un lien
[1234�1:art] �2 �3 �4 ouvre article (preview mode)'],
"punct"=>['applique les r�gles typographiques'],
"radio"=>['pile de fichiers audio depuis l\'espace disque [dev/music:radio] (1 par article, le module fabrique une playlist)'],
"read"=>['place le contenu d\'un article'],
"rename_img"=>['enregistre l\'article en affectant un nom random aux images � importer, si par exemple elles ne sont diff�renci�es que par le nom de la variable (apr�s le \'?\')'],
"replace"=>['remplacement de texte'],
"revert"=>['revient � la version courante'],
"rss_art"=>['contenu d\'un article diffus� en rss'],
"rss_input"=>['flux rss'],
"rss_read"=>['contenu d\'un article d\'un autre site philum'],
"scan"=>['retourne le contenu d\'un document plac� dans le r�pertoire utilisateur, �1 interpr�te les connecteurs du contenu'],
"search"=>['r�sultats d\'une recherche (d�pendant de time_system)'],
"shop"=>['articles li�s par hi�rarchie sous forme de tableau de produits d\'une boutique en ligne 
(indiquer les tables personnalis�es \'prix\' et \'r�f�rence\''],
"size"=>['taille du texte [text�24:size] '],
"t"=>['css \'txtit\' (titres)'],
"del_tables"=>['supprime les tables'],
"thumb"=>['fabrique une miniature d\'une image avec des dimensions personnalis�es : [img.jpg�140/100:thumb]'],
"twitter"=>['appelle un twit depuis son ID, ou un flux depuis le nom d\'utilisateur, � travers l\'API Twitter'],
"twapi"=>['appelle l\'Api Twitter, avec p=param et o=mode'],
"twusr"=>['tableau d\'une liste d\'utilisateurs usr1,id2,... '],
"twits"=>['appelle une s�rie de twits d�sign�s par leur id num�rique et s�par�s par un espace'],
"version"=>['num version'],
"video"=>['lit une vid�o youtube daily vimeo rutube etc... d\'apr�s leur id. �1 renvoie un lien qui ouvre une popup'],
"play"=>['lit une vid�o directement'],
"w"=>['affiche le lien en entier'],
"web"=>['renvoie la pr�sentation d\'une page web'],
"webpage"=>['affiche une page web dans une popup (utilisant le plugin \'suggest\' : se r�f�re aux d�finitions de sites ou � l\'ent�te)'],
"mktable"=>['formate les donn�es csv en tableau (virgule et saut de ligne) '],
"clean_h"=>['nettoie les balises h'],
"svg"=>['pont vers le constructeur de svg [[black,white:attr][1,1,10,10:rect]�100/20:svg]'],
"math"=>['pont vers math.ml (avec connecteurs associ�s) [[e�i[pi:mo]:sup]+1:math]'],
"popmsql"=>['affiche le contenu d\'une base msql dans une popup ; [public_atomic�GNU:popmsql]'],
"image"=>['ouvre comme image sans l\'importer, n\'importe quel format'],
"slides"=>['cr�e un diaporama [:slide] param (opt) : title, sinon l\'id est utilis�'],
"fluid"=>['cr�e une image dont l\'ensemble se d�couvre lors du scroll (�hauteur) [img.jpg�100:fluid]'],
"float"=>['div flottante �1=right'],
"sigle"=>['code des monnaies (euro, dollar, yen...)'],
"caviar"=>['permet de caviarder du texte'],
"typo"=>['�quivalent ascii [hello�4:transcript]'],
"flag"=>['drapeau ascii � partir du code-pays'],
"bkgclr"=>['couleur de fond de texte : [texte�yellow:bkgclr]'],
"stabilo"=>['stabilo boss [text�orange:stabilo] (green, blue, yellow=d�faut)'],
"red"=>['texte rouge'],
"blue"=>['texte bleu'],
"parm"=>['texte parme'],
"green"=>['texte vert'],
"fact"=>['balise fact (faits notables)'],
"quote"=>['balise citation'],
"dev"=>['le contenu est r�serv� � auth(4)'],
"toggle_text"=>['contenu affichable sur place [content�title:toggle]'],
"toggle"=>['contenu affichable dans un blockquote [content�title:toggle]'],
"toggle_note"=>['contenu affichable sur place [content�title:note] � contenu non dissimul�'],
"bubble_note"=>['contenu affichable dans une bubble [content�title:bubble_note] utilisant ajax'],
"toggle_conn"=>['ouvre un connecteur sur place en ajax : [248:read�open:jconn] (ou artID)'],
"exec"=>['ex�cute du code'],
"api"=>['appel de l\'Api'],
"papi"=>['bouton d\'appel de l\'Api'],
"tag"=>['appelle le r�sultat d\'un tag : [mot-clef�classeTag:tag]'],
"picto"=>['affiche un picto � partir de sa nomination'],
"ascii"=>['affiche un ascii � partir de sa nomination'],
"webview"=>['affiche au survol une previsualisation du lien (qui propose un lien vers un import)'],
"wiki"=>['renvoie l\'ent�te de la page wikipedia s\'il y a un texte li�, sinon renvoie son contenu entier.'],
"dico"=>['permet de joindre une d�finition de wictionary.org'],
"plan"=>['table des mati�res, d\'apr�s les balises h1, h2...
[titre�option:plan] opt=1 : num�rotation topologique'],
"frame"=>['[txt�red:frame] ajoute un cadre rouge autour du texte'],
"underline"=>['[txt�red:underline] ajoute un soulignement rouge autour du texte'],
"look"=>['ouvre un article en surlignant un terme [id�word:look]'],
"lang"=>['traduction de texte [text�(es/en/fr/...):lang]'],
"vid"=>['lit une vid�o et l\'importe s\'il le faut'],
"private"=>['�l�ments priv�s'],
"cita_italics"=>['place des italiques entre les guillemets typographiques'],
"cita_quotes"=>['place les guillemets typographiques dans des blocs']];