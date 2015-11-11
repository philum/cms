<?php
//philum_microsql_admin_modules
$r["_menus_"]=array('description','help','option','command');
$r["All"]=array('Tous les articles','Donner un titre','pr�visualisation ; auto d�pend des �toiles','');
$r["BLOCK"]=array('Appelle un Bloc de modules','sp�cifier le nom d\'un bloc de modules','','');
$r["Banner"]=array('image s\'il y en a une, titre du hub par d�faut','','','');
$r["Board"]=array('articles ayant une priorit� sup�rieure � 1 ; sensible � la rubrique en cours','sp�cifier nombre de colonnes','','');
$r["Hubs"]=array('Liste des Hubs','Donner un titre','','');
$r["LOAD"]=array('Composant principal qui re�oit le d�roul� des articles ou un article entier','','pr�visualisation ; auto d�pend des �toiles','');
$r["MenusJ"]=array('Menu qui renvoie des modules en Ajax','param/title/command/option:module->target�button[,]','non refermable','');
$r["Page_titles"]=array('Titres de la page (inclue la navigation)','','articles parents','');
$r["Wall"]=array('D�roul� d\'articles avec seulement le corps du message','sp�cifier une cat�gorie (option)','','');
$r["agenda"]=array('articles futurs','Donner un titre','','');
$r["app_link"]=array('bouton d\'une App','syntaxe ou id de la ligne de ta table utilisateur, ou celle de la commande','','');
$r["app_menu"]=array('liste d\'apps pr�d�finies','- pr�d�finis : home all hubs plan taxonomy agenda categories lang hub
- existant : key ou val0 de la ligne
- param�trables : mod�nb, plug�name, /url�button
- auto : cat�gorie, id
- on peut aussi utiliser la virgule comme d�limiteur','styles','');
$r["apps"]=array('Apps','Les Apps sont des boutons logiciels. On peut cr�er des boutons, liens, menus, html, ajax, situ�s dans le menu admin, dans un article, ouvrant des listes d�roulantes, des logiciels, sur place, imbriqu�s, li�s � d\'autres boutons, li�s � des ic�nes, dans une popup, ou ailleurs... Ces possibilit�s sont class�es par type de comp�tence et d\'emplacement.

Noter : les apps du m�me nom remplacent les pr�c�dentes : pour annuler une apps par d�faut, ajouter la m�me et la hider 

Les contextes : 
menu : menu Apps du menu admin
desk : ic�nes de bureau
boot : au lancement de la page
home : menu Phi du menu admin
user : menu user du menu admin (activ� par rstr48)','','');
$r["archives"]=array('navigation temporelle','Donner un titre','','');
$r["art_mod"]=array('modules attach�s aux articles : affiche un bouton dans les titres qui ouvrent ce menu de modules','commandes de modules : 
param/title/command/option:module(�button)[,] 

Ex: related_arts�li� �, related_by�li� par, tags/Tags/scroll/7:see_also-tags�tags, themes//scroll/7:see_also-usertags�themes, //scroll/7:see_also-source�source, art:rub_taxo�contexte','La rstr60 permet d\'afficher le r�sultat dans le corps de l\'article. Dans ce cas il faut sp�cifier l\'option de largeur de colonne. Elle diminue d\'autant la largeur des images.','');
$r["articles"]=array('d�roul� personnalis� d\'articles','liste d\'articles selon param�tres, s�par�s par un &amp;
ex: tag=Une&amp;nbdays=1&amp;preview=true&amp;lasts=1-10

- cat/tag : sp�cifie une cat�gorie / un tag ;
- nocat/notag : exclut une cat�gorie / un tag ;
- nbdays : champ temporel ;
- preview : true, false, full ;
- lasts : les plus r�cents (lasts=1 pour le premier, lasts=1-10 pour les 9 suivants) ;

La commande \'multi\' autorise les templates ponctuels, et ne divise pas le r�sultat en pages comme \'articles\'.','','');
$r["ban_art"]=array('banni�re','(ID) article utilisant la banni�re, ou la premi�re image catalogu�e de l\'article, en tant que fond de page','','');
$r["blocks"]=array('d�termine les balises DIV de la page html, qui sont autant de blocs de modules (inform� par le constructeur css, obligatoire)','liste des blocks de modules, s�par�s par un espace','','');
$r["br"]=array('ajoute un saut de ligne','','','');
$r["bridge"]=array('pont entre deux sites philum','param : serveur sans le \'http\'','ID de l\'article ou console url (/module/bridge/philum.net/236)','');
$r["calendrier"]=array('calendrier','Donner un titre','','');
$r["cart"]=array('Articles ajout�s au panier','Donner un titre','','');
$r["cat_arts"]=array('articles d\'une cat�gorie','sp�cifier la cat�gorie','','');
$r["categories"]=array('liste des rubriques','Donner un titre','option de param ou nb = nombre d\'articles, home','');
$r["category"]=array('','','','');
$r["channel"]=array('re�oit les flux d\'autres hubs ou sites Philum, incluant des crit�res de tri','(param�tres s�par�s par un espace)
Exemple : \'philum.net:site philum:hub 236:art CMS:tag 10:last\'
D�finitions :
:site : (optionnel) sans le \'http\' ;
:cat : (optionnel) une cat�gorie ;
:art (illogique avec cat) : les articles affili�s ;
:last : les N derniers articles ;
...
Le module Channel peut �tre appel� depuis un connecteur \':ajax\' ; 
exemple : [site.com:site blog:hub :channel�Titre, close�x:ajax]','autorefresh (secondes)','');
$r["chat"]=array('module de Chat','nom de la room','autorefresh (secondes) ','');
$r["chatxml"]=array('discussion entre serveurs','nom du canal','autorefresh (secondes)','');
$r["chrono"]=array('temps de generation de la page','','','');
$r["clear"]=array('clear:left annule le flottement � gauche','','','');
$r["codeline"]=array('Renvoie des balises html imbriqu�es �crites en Codeline','ex: [[_URL�_SUJ:link]�h2:html] [[_OPT�txtsmall2:css]','','');
$r["columns"]=array('met chaque module dans une colonne','ligne de commande de modules','','');
$r["conn"]=array('r�sultat d\'un connecteur unique','','','');
$r["connector"]=array('renvoie le r�sultat d\'un connecteur','Exemples:
- \'24:read\' :lit le contenu
- \'24:pub\' : pub d\'un article 
- [[104:pub]:/2][[106:pub]:/2] : connecteurs complexes (celui-ci met 2 titres sur 2 colonnes)','balise article','');
$r["contact"]=array('mail � l\'admin','titre','css','');
$r["content"]=array('d�termine la largeur artificielle de la page (inform� par le constructeur css, obligatoire)','largeur de content (pour les images et vid�os)','','');
$r["create_art"]=array('formulaire d\'ajout d\'articles','','','');
$r["credits"]=array('philum','','','');
$r["csscode"]=array('ajoute des css dans le header','','','');
$r["cssfonts"]=array('ajoute des font-face pr�d�finies dans le header ','','','');
$r["deja_vu"]=array('articles r�cemment visit�s','','','');
$r["design"]=array('d�termine la feuille Css � utiliser (inform� par le constructeur css, obligatoire)','sp�cifier un num�ro de feuille css','abonnement css : place les css r�cents en sous-couche, sur laquelle il est possible d\'utiliser le minimum de personnalisation : classic, default, n>3 pour une table public) ; sinon voir params/auto_design','');
$r["desktop_arts"]=array('pr�sente des articles dans le Desktop','script de commande d\'articles (rien = ceux du cache)','','');
$r["desktop_files"]=array('pr�sente des fichiers partag�s dans le Desktop','global|virtual (defaut : local|real)','position du root','');
$r["desktop_varts"]=array('articles virtuels : construit les r�pertoires d\'apr�s le meta \'folder\' des articles ','filtre sur les r�sultats : script de commande d\'articles (rien = tout, \'cache\' = ceux du cache)','','');
$r["disk"]=array('Contenu d\'un r�pertoire de l\'espace disque utilisateur','sp�cifier un r�pertoire','','');
$r["favs"]=array('Articles s�lectionn�s par le visiteur','','','');
$r["finder"]=array('Ouvre un Finder','param (chemin) : hub/root/dir...','options pour chaque param�tre : 
- 0 = disk/shared/icons
- 1 = local/global/distant
- 2 = virtual/real
- 3 = list/panel/flap/icons/icon-disk
- 4 = normal/recursive/conn
- 5 = alone
- 6 = pictos/mini','');
$r["folders"]=array('noeuds d\'articles, par ordre d�croissant du nombre de sous-articles (dossiers d\'articles)','sp�cifier le nombre de noeuds (ils sont ordonn�s du plus au moins utilis�s)','','');
$r["friend_art"]=array('renvoie l\'article nomm� comme l\'ID de l\'article en cours','','css','');
$r["friend_rub"]=array('renvoie l\'article nomm� comme la rubrique','','css','');
$r["gallery"]=array('','','','');
$r["hierarchics"]=array('menus hi�rarchiques','Donner un titre','','');
$r["hour"]=array('date','sp�cifier : %A %d %B %G %T (optionnel)','css','');
$r["hr"]=array('ajoute une barre horizontale','sp�cifier la classe CSS','','');
$r["hubs"]=array('liste des Hubs','Donner un titre','affiche nombre d\'articles','');
$r["jscode"]=array('ajoute des js dans le header','','','');
$r["last"]=array('article le plus r�cent','','','');
$r["leftbar"]=array('largeur de leftbar (pour les images et vid�os)','inform� par css_builder apr�s un \'save_width\'','','');
$r["link"]=array('renvoie un lien (dans un li)','liens pr�d�finis :
- lien-clef : Home, ID, cat�gorie, module
- plugin : /plug/index
- mettre un titre : Home�Accueil
- utiliser un picto : Home�home:picto','pas d\'espace apr�s (or br si col)','pas dans une balise li');
$r["log-out"]=array('d�connexion','','','');
$r["login"]=array('login','Donner un titre','� droite','');
$r["login_popup"]=array('login dans une popup','Donner un titre','','');
$r["most_read"]=array('articles les plus vus','nb_jours-nb_arts (ex: 7-50)','','');
$r["most_read_stat"]=array('articles les plus vus, stats consolid�es','nb_jours-nb_arts (ex: 7-50) ','','');
$r["msql_links"]=array('renvoie une liste de liens depuis une microbase ; 
l\'option donne le type de liens : rss, mails ou rien = links','re�oit le suffixe de la microbase (links, rssurl_1)','table source','');
$r["newsletter"]=array('inscription � la newsletter','Donner un titre','bouton vers une popup','');
$r["plan"]=array('','','','');
$r["player"]=array('','','','');
$r["plug"]=array('appel d\'un plugin','nom du plugin','valeurs p et o envoy�es au plugin','');
$r["prev_next"]=array('affiche lien vers articles pr�c�dent et suivant','titres � afficher sur les boutons (|), ex: prev|next ou &amp;lt;|&amp;gt;','css ; commande rub : dans la m�me rubrique','');
$r["priority_arts"]=array('Articles ayant pour priorit�','d�finir le niveau pour le tri (0-4)','nb cols ou limite de scroll ','');
$r["pub"]=array('pub d\'article','renvoie un simple lien si aucune option','1,2,3 : niveau de preview ; 4 : plusieurs id','');
$r["pub_art"]=array('titre + image','ID_article','niveau de preview','');
$r["pub_arts"]=array('panneau contenant des articles tri�s manuellement','123 124 : ID s�par�s par un espace','','');
$r["pub_img"]=array('utilise la premi�re image r�f�renc�e d\'un article','ID_article','','');
$r["read"]=array('contenu d\'article','ID_article','css','');
$r["read_art"]=array('contenu d\'un article','ID_article','','');
$r["recents"]=array('10 derniers articles d\'une rubrique','sp�cifier la rubrique (1 renvoie la rubrique en cours, toutes dans la Home)','','');
$r["related_arts"]=array('articles rattach�s par l\'option d\'articles \'related\'','Donner un titre','param de la commande (nb colonnes ou limite avant scroll)','traitement');
$r["related_by"]=array('articles qui pointent vers celui-ci par l\'option d\'articles \'related\'','Donner un titre','param de la commande (nb colonnes ou limite avant scroll)','traitement');
$r["rightbar"]=array('largeur de rightbar (pour les images et vid�os)','inform� par css_builder apr�s un \'save_width\'','','');
$r["rss"]=array('Renvoie un espace de consultation sur place des flux rss','indiquer le nom d\'une table de liens rss (rssurl par d�faut)','','');
$r["rss_input"]=array('re�oit un flux rss, 10 titres les plus r�cents','sp�cifier un lien RSS','','');
$r["rub_tags"]=array('tags des articles de la rubrique','titre (optionnel)','','');
$r["rub_taxo"]=array('taxonomie d\'une rubrique / d\'un article, pr�sent�e sous forme topologique (menu, insensible � l\'�poque)','art=article en cours, 1=rubrique en cours/All, rubrique, ID','','');
$r["same_title"]=array('articles ayant le m�me titre','Donner un titre','','');
$r["search"]=array('moteur de recherche','Donner un titre','aligne � droite','');
$r["see_also-rub"]=array('Dans la m�me rubrique','sp�cifier la rubrique, 1=auto quand Home=All','','');
$r["see_also-source"]=array('articles de la m�me source','Donner un titre','','');
$r["see_also-tags"]=array('Articles ayant les m�mes Tags','Donner un titre','','');
$r["see_also-usertags"]=array('liste des articles ayant les m�mes champs de tri utilisateur','sp�cifier le tag utilisateur','','');
$r["short_arts"]=array('articles courts (br�ves)','sp�cifier le nombre de caract�res de l\'article (4000)','','');
$r["social"]=array('d�roul� de publications','Donner un titre','','');
$r["sources"]=array('source url des articles aspir�s','nombre d\'occurences','','');
$r["stats"]=array('histogramme des visites','nombre de jours (valeur courante par d�faut)','avec text','');
$r["submenus"]=array('menus d�roulants','syntaxe :
chaque objet est un connecteur \':link\' (ID, ID�titre, category)
chaque ligne correspond � un bouton
le nombre de tirets signifie la profondeur
les boutons au sommet d\'une hi�rarchie ne peuvent pas �tre des liens

one
- two
three
- four
-- five','horizontal','');
$r["suggest"]=array('donne au visiteur le moyen de proposer un article depuis une Url','','','');
$r["tab_mods"]=array('modules dans des onglets (tabs en anglais)','param/title/command/option:module�button[,]','','');
$r["tag_arts"]=array('articles ayant pour Tag','sp�cifier le tag de r�f�rence pour le tri ;
CAT indique que le tag recherch� est le nom de la cat�gorie','','');
$r["tags"]=array('liste des mots-clefs (tags)','Donner un titre','nb cols ou limite de scroll','');
$r["tags_cloud"]=array('liste des mots-clefs (nuage de tags)','Donner un titre','','');
$r["taxo_arts"]=array('taxonomie d\'une rubrique / d\'un article (liste d\'articles, utilise le cache)','sp�cifier 1 (=rubrique en cours/All), une rubrique ou l\'ID d\'un article','','');
$r["taxo_nav"]=array('liste des noeuds avec menus ouvrables (se r�f�re au cache, puis cherche les parents dans le temps)','plugin ; sp�cifier l\'ID d\'un article parent','','');
$r["taxonomy"]=array('','','','');
$r["template"]=array('template d\'articles','nom du template','','');
$r["text"]=array('texte libre','sp�cifier un texte brut','','');
$r["tracks"]=array('','','','');
$r["twitter"]=array('re�oit un flux Twitter','indiquer le hashtag (sans le #) ; option = nb de secondes du rafra�chissement','','');
$r["user_menu"]=array('navigation du site','liens pr�d�finis :
- lien-clef : Home, ID, cat�gorie, module
- mettre un titre : Home�Accueil
- utiliser un picto : Home�home:picto
- lien interne : /?plug=myplug�name_of_plug','css','');
$r["usertag_arts"]=array('articles ayant un tag utilisateur (sans pr�ciser la classe)','sp�cifier le tag utilisateur ;
CAT indique que le tag recherch� est le nom de la cat�gorie','','');
$r["usertags"]=array('liste des Tags d\'un champ de tri utilisateur','sp�cifier le champ de tri utilisateur','nb cols ou limite de scroll ','');
$r["usertags_cloud"]=array('liste des tag utilisateur (nuage de tags)','','','');
$r["video_playlist"]=array('','nb de jours','','');
$r["video_viewer"]=array('viewer vid�o en ajax','r�gles de tri s�par�es par \'|\' :
- tag, cat, priority 
- tag1|tag2 ou 5-tag1|tag2 (5=tags)
- priority-2|3|4 ou 11-2|3|4 (11=priority)
- cat-public : articles dans \'public\' ;
- cat-1 : cat�gorie en cours','','');
$r["desktop"]=array('param�tres du bureau','sp�cifier couleur html, #_var, d�grad� ou image','','');
$r["popart"]=array('ouvre article (local ou distant) dans une popup','','','');
$r["video"]=array('affiche une vid�o','id de la vid�o','','');
$r["userclasstag_arts"]=array('articles ayant un tag d\'une classe utilisateur pr�cise','sp�cifier la classe de tag utilisateur','','');

?>