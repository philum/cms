<?php
//philum_microsql_admin_modules
$r["_menus_"]=array('description','help','option','command');
$r["All"]=array('Tous les articles','Donner un titre','prévisualisation ; auto dépend des étoiles','');
$r["BLOCK"]=array('Appelle un Bloc de modules','spécifier le nom d\'un bloc de modules','','');
$r["Banner"]=array('image s\'il y en a une, titre du hub par défaut','','','');
$r["Board"]=array('articles ayant une priorité supérieure à 1 ; sensible à la rubrique en cours','spécifier nombre de colonnes','','');
$r["Hubs"]=array('Liste des Hubs','Donner un titre','','');
$r["LOAD"]=array('Composant principal qui reçoit le déroulé des articles ou un article entier','','prévisualisation ; auto dépend des étoiles','');
$r["MenusJ"]=array('Menu qui renvoie des modules en Ajax','param/title/command/option:module->target§button[,]','non refermable','');
$r["Page_titles"]=array('Titres de la page (inclue la navigation)','','articles parents','');
$r["Wall"]=array('Déroulé d\'articles avec seulement le corps du message','spécifier une catégorie (option)','','');
$r["agenda"]=array('articles futurs','Donner un titre','','');
$r["app_link"]=array('bouton d\'une App','syntaxe ou id de la ligne de ta table utilisateur, ou celle de la commande','','');
$r["app_menu"]=array('liste d\'apps prédéfinies','- prédéfinis : home all hubs plan taxonomy agenda categories lang hub
- existant : key ou val0 de la ligne
- paramétrables : mod§nb, plug§name, /url§button
- auto : catégorie, id
- on peut aussi utiliser la virgule comme délimiteur','styles','');
$r["apps"]=array('Apps','Les Apps sont des boutons logiciels. On peut créer des boutons, liens, menus, html, ajax, situés dans le menu admin, dans un article, ouvrant des listes déroulantes, des logiciels, sur place, imbriqués, liés à d\'autres boutons, liés à des icônes, dans une popup, ou ailleurs... Ces possibilités sont classées par type de compétence et d\'emplacement.

Noter : les apps du même nom remplacent les précédentes : pour annuler une apps par défaut, ajouter la même et la hider 

Les contextes : 
menu : menu Apps du menu admin
desk : icônes de bureau
boot : au lancement de la page
home : menu Phi du menu admin
user : menu user du menu admin (activé par rstr48)','','');
$r["archives"]=array('navigation temporelle','Donner un titre','','');
$r["art_mod"]=array('modules attachés aux articles : affiche un bouton dans les titres qui ouvrent ce menu de modules','commandes de modules : 
param/title/command/option:module(§button)[,] 

Ex: related_arts§lié à, related_by§lié par, tags/Tags/scroll/7:see_also-tags§tags, themes//scroll/7:see_also-usertags§themes, //scroll/7:see_also-source§source, art:rub_taxo§contexte','La rstr60 permet d\'afficher le résultat dans le corps de l\'article. Dans ce cas il faut spécifier l\'option de largeur de colonne. Elle diminue d\'autant la largeur des images.','');
$r["articles"]=array('déroulé personnalisé d\'articles','liste d\'articles selon paramètres, séparés par un &amp;
ex: tag=Une&amp;nbdays=1&amp;preview=true&amp;lasts=1-10

- cat/tag : spécifie une catégorie / un tag ;
- nocat/notag : exclut une catégorie / un tag ;
- nbdays : champ temporel ;
- preview : true, false, full ;
- lasts : les plus récents (lasts=1 pour le premier, lasts=1-10 pour les 9 suivants) ;

La commande \'multi\' autorise les templates ponctuels, et ne divise pas le résultat en pages comme \'articles\'.','','');
$r["ban_art"]=array('bannière','(ID) article utilisant la bannière, ou la première image cataloguée de l\'article, en tant que fond de page','','');
$r["blocks"]=array('détermine les balises DIV de la page html, qui sont autant de blocs de modules (informé par le constructeur css, obligatoire)','liste des blocks de modules, séparés par un espace','','');
$r["br"]=array('ajoute un saut de ligne','','','');
$r["bridge"]=array('pont entre deux sites philum','param : serveur sans le \'http\'','ID de l\'article ou console url (/module/bridge/philum.net/236)','');
$r["calendrier"]=array('calendrier','Donner un titre','','');
$r["cart"]=array('Articles ajoutés au panier','Donner un titre','','');
$r["cat_arts"]=array('articles d\'une catégorie','spécifier la catégorie','','');
$r["categories"]=array('liste des rubriques','Donner un titre','option de param ou nb = nombre d\'articles, home','');
$r["category"]=array('','','','');
$r["channel"]=array('reçoit les flux d\'autres hubs ou sites Philum, incluant des critères de tri','(paramètres séparés par un espace)
Exemple : \'philum.net:site philum:hub 236:art CMS:tag 10:last\'
Définitions :
:site : (optionnel) sans le \'http\' ;
:cat : (optionnel) une catégorie ;
:art (illogique avec cat) : les articles affiliés ;
:last : les N derniers articles ;
...
Le module Channel peut être appelé depuis un connecteur \':ajax\' ; 
exemple : [site.com:site blog:hub :channel§Titre, close§x:ajax]','autorefresh (secondes)','');
$r["chat"]=array('module de Chat','nom de la room','autorefresh (secondes) ','');
$r["chatxml"]=array('discussion entre serveurs','nom du canal','autorefresh (secondes)','');
$r["chrono"]=array('temps de generation de la page','','','');
$r["clear"]=array('clear:left annule le flottement à gauche','','','');
$r["codeline"]=array('Renvoie des balises html imbriquées écrites en Codeline','ex: [[_URL§_SUJ:link]§h2:html] [[_OPT§txtsmall2:css]','','');
$r["columns"]=array('met chaque module dans une colonne','ligne de commande de modules','','');
$r["conn"]=array('résultat d\'un connecteur unique','','','');
$r["connector"]=array('renvoie le résultat d\'un connecteur','Exemples:
- \'24:read\' :lit le contenu
- \'24:pub\' : pub d\'un article 
- [[104:pub]:/2][[106:pub]:/2] : connecteurs complexes (celui-ci met 2 titres sur 2 colonnes)','balise article','');
$r["contact"]=array('mail à l\'admin','titre','css','');
$r["content"]=array('détermine la largeur artificielle de la page (informé par le constructeur css, obligatoire)','largeur de content (pour les images et vidéos)','','');
$r["create_art"]=array('formulaire d\'ajout d\'articles','','','');
$r["credits"]=array('philum','','','');
$r["csscode"]=array('ajoute des css dans le header','','','');
$r["cssfonts"]=array('ajoute des font-face prédéfinies dans le header ','','','');
$r["deja_vu"]=array('articles récemment visités','','','');
$r["design"]=array('détermine la feuille Css à utiliser (informé par le constructeur css, obligatoire)','spécifier un numéro de feuille css','abonnement css : place les css récents en sous-couche, sur laquelle il est possible d\'utiliser le minimum de personnalisation : classic, default, n>3 pour une table public) ; sinon voir params/auto_design','');
$r["desktop_arts"]=array('présente des articles dans le Desktop','script de commande d\'articles (rien = ceux du cache)','','');
$r["desktop_files"]=array('présente des fichiers partagés dans le Desktop','global|virtual (defaut : local|real)','position du root','');
$r["desktop_varts"]=array('articles virtuels : construit les répertoires d\'après le meta \'folder\' des articles ','filtre sur les résultats : script de commande d\'articles (rien = tout, \'cache\' = ceux du cache)','','');
$r["disk"]=array('Contenu d\'un répertoire de l\'espace disque utilisateur','spécifier un répertoire','','');
$r["favs"]=array('Articles sélectionnés par le visiteur','','','');
$r["finder"]=array('Ouvre un Finder','param (chemin) : hub/root/dir...','options pour chaque paramètre : 
- 0 = disk/shared/icons
- 1 = local/global/distant
- 2 = virtual/real
- 3 = list/panel/flap/icons/icon-disk
- 4 = normal/recursive/conn
- 5 = alone
- 6 = pictos/mini','');
$r["folders"]=array('noeuds d\'articles, par ordre décroissant du nombre de sous-articles (dossiers d\'articles)','spécifier le nombre de noeuds (ils sont ordonnés du plus au moins utilisés)','','');
$r["friend_art"]=array('renvoie l\'article nommé comme l\'ID de l\'article en cours','','css','');
$r["friend_rub"]=array('renvoie l\'article nommé comme la rubrique','','css','');
$r["gallery"]=array('','','','');
$r["hierarchics"]=array('menus hiérarchiques','Donner un titre','','');
$r["hour"]=array('date','spécifier : %A %d %B %G %T (optionnel)','css','');
$r["hr"]=array('ajoute une barre horizontale','spécifier la classe CSS','','');
$r["hubs"]=array('liste des Hubs','Donner un titre','affiche nombre d\'articles','');
$r["jscode"]=array('ajoute des js dans le header','','','');
$r["last"]=array('article le plus récent','','','');
$r["leftbar"]=array('largeur de leftbar (pour les images et vidéos)','informé par css_builder après un \'save_width\'','','');
$r["link"]=array('renvoie un lien (dans un li)','liens prédéfinis :
- lien-clef : Home, ID, catégorie, module
- plugin : /plug/index
- mettre un titre : Home§Accueil
- utiliser un picto : Home§home:picto','pas d\'espace après (or br si col)','pas dans une balise li');
$r["log-out"]=array('déconnexion','','','');
$r["login"]=array('login','Donner un titre','à droite','');
$r["login_popup"]=array('login dans une popup','Donner un titre','','');
$r["most_read"]=array('articles les plus vus','nb_jours-nb_arts (ex: 7-50)','','');
$r["most_read_stat"]=array('articles les plus vus, stats consolidées','nb_jours-nb_arts (ex: 7-50) ','','');
$r["msql_links"]=array('renvoie une liste de liens depuis une microbase ; 
l\'option donne le type de liens : rss, mails ou rien = links','reçoit le suffixe de la microbase (links, rssurl_1)','table source','');
$r["newsletter"]=array('inscription à la newsletter','Donner un titre','bouton vers une popup','');
$r["plan"]=array('','','','');
$r["player"]=array('','','','');
$r["plug"]=array('appel d\'un plugin','nom du plugin','valeurs p et o envoyées au plugin','');
$r["prev_next"]=array('affiche lien vers articles précédent et suivant','titres à afficher sur les boutons (|), ex: prev|next ou &amp;lt;|&amp;gt;','css ; commande rub : dans la même rubrique','');
$r["priority_arts"]=array('Articles ayant pour priorité','définir le niveau pour le tri (0-4)','nb cols ou limite de scroll ','');
$r["pub"]=array('pub d\'article','renvoie un simple lien si aucune option','1,2,3 : niveau de preview ; 4 : plusieurs id','');
$r["pub_art"]=array('titre + image','ID_article','niveau de preview','');
$r["pub_arts"]=array('panneau contenant des articles triés manuellement','123 124 : ID séparés par un espace','','');
$r["pub_img"]=array('utilise la première image référencée d\'un article','ID_article','','');
$r["read"]=array('contenu d\'article','ID_article','css','');
$r["read_art"]=array('contenu d\'un article','ID_article','','');
$r["recents"]=array('10 derniers articles d\'une rubrique','spécifier la rubrique (1 renvoie la rubrique en cours, toutes dans la Home)','','');
$r["related_arts"]=array('articles rattachés par l\'option d\'articles \'related\'','Donner un titre','param de la commande (nb colonnes ou limite avant scroll)','traitement');
$r["related_by"]=array('articles qui pointent vers celui-ci par l\'option d\'articles \'related\'','Donner un titre','param de la commande (nb colonnes ou limite avant scroll)','traitement');
$r["rightbar"]=array('largeur de rightbar (pour les images et vidéos)','informé par css_builder après un \'save_width\'','','');
$r["rss"]=array('Renvoie un espace de consultation sur place des flux rss','indiquer le nom d\'une table de liens rss (rssurl par défaut)','','');
$r["rss_input"]=array('reçoit un flux rss, 10 titres les plus récents','spécifier un lien RSS','','');
$r["rub_tags"]=array('tags des articles de la rubrique','titre (optionnel)','','');
$r["rub_taxo"]=array('taxonomie d\'une rubrique / d\'un article, présentée sous forme topologique (menu, insensible à l\'époque)','art=article en cours, 1=rubrique en cours/All, rubrique, ID','','');
$r["same_title"]=array('articles ayant le même titre','Donner un titre','','');
$r["search"]=array('moteur de recherche','Donner un titre','aligne à droite','');
$r["see_also-rub"]=array('Dans la même rubrique','spécifier la rubrique, 1=auto quand Home=All','','');
$r["see_also-source"]=array('articles de la même source','Donner un titre','','');
$r["see_also-tags"]=array('Articles ayant les mêmes Tags','Donner un titre','','');
$r["see_also-usertags"]=array('liste des articles ayant les mêmes champs de tri utilisateur','spécifier le tag utilisateur','','');
$r["short_arts"]=array('articles courts (brèves)','spécifier le nombre de caractères de l\'article (4000)','','');
$r["social"]=array('déroulé de publications','Donner un titre','','');
$r["sources"]=array('source url des articles aspirés','nombre d\'occurences','','');
$r["stats"]=array('histogramme des visites','nombre de jours (valeur courante par défaut)','avec text','');
$r["submenus"]=array('menus déroulants','syntaxe :
chaque objet est un connecteur \':link\' (ID, ID§titre, category)
chaque ligne correspond à un bouton
le nombre de tirets signifie la profondeur
les boutons au sommet d\'une hiérarchie ne peuvent pas être des liens

one
- two
three
- four
-- five','horizontal','');
$r["suggest"]=array('donne au visiteur le moyen de proposer un article depuis une Url','','','');
$r["tab_mods"]=array('modules dans des onglets (tabs en anglais)','param/title/command/option:module§button[,]','','');
$r["tag_arts"]=array('articles ayant pour Tag','spécifier le tag de référence pour le tri ;
CAT indique que le tag recherché est le nom de la catégorie','','');
$r["tags"]=array('liste des mots-clefs (tags)','Donner un titre','nb cols ou limite de scroll','');
$r["tags_cloud"]=array('liste des mots-clefs (nuage de tags)','Donner un titre','','');
$r["taxo_arts"]=array('taxonomie d\'une rubrique / d\'un article (liste d\'articles, utilise le cache)','spécifier 1 (=rubrique en cours/All), une rubrique ou l\'ID d\'un article','','');
$r["taxo_nav"]=array('liste des noeuds avec menus ouvrables (se réfère au cache, puis cherche les parents dans le temps)','plugin ; spécifier l\'ID d\'un article parent','','');
$r["taxonomy"]=array('','','','');
$r["template"]=array('template d\'articles','nom du template','','');
$r["text"]=array('texte libre','spécifier un texte brut','','');
$r["tracks"]=array('','','','');
$r["twitter"]=array('reçoit un flux Twitter','indiquer le hashtag (sans le #) ; option = nb de secondes du rafraîchissement','','');
$r["user_menu"]=array('navigation du site','liens prédéfinis :
- lien-clef : Home, ID, catégorie, module
- mettre un titre : Home§Accueil
- utiliser un picto : Home§home:picto
- lien interne : /?plug=myplug§name_of_plug','css','');
$r["usertag_arts"]=array('articles ayant un tag utilisateur (sans préciser la classe)','spécifier le tag utilisateur ;
CAT indique que le tag recherché est le nom de la catégorie','','');
$r["usertags"]=array('liste des Tags d\'un champ de tri utilisateur','spécifier le champ de tri utilisateur','nb cols ou limite de scroll ','');
$r["usertags_cloud"]=array('liste des tag utilisateur (nuage de tags)','','','');
$r["video_playlist"]=array('','nb de jours','','');
$r["video_viewer"]=array('viewer vidéo en ajax','règles de tri séparées par \'|\' :
- tag, cat, priority 
- tag1|tag2 ou 5-tag1|tag2 (5=tags)
- priority-2|3|4 ou 11-2|3|4 (11=priority)
- cat-public : articles dans \'public\' ;
- cat-1 : catégorie en cours','','');
$r["desktop"]=array('paramètres du bureau','spécifier couleur html, #_var, dégradé ou image','','');
$r["popart"]=array('ouvre article (local ou distant) dans une popup','','','');
$r["video"]=array('affiche une vidéo','id de la vidéo','','');
$r["userclasstag_arts"]=array('articles ayant un tag d\'une classe utilisateur précise','spécifier la classe de tag utilisateur','','');

?>