<?php
//philum_microsql_admin_modules
$r["_menus_"]=array('description','help','option','command');
$r["All"]=array('All articles','Give a title','preview ; auto depend of stars','');
$r["BLOCK"]=array('call a block of modules','specify the name of a block','','');
$r["Banner"]=array('image if there is one, else title of hub','','','');
$r["Board"]=array('articles with priority &gt; 1','specify number of columns','','');
$r["Hubs"]=array('list of Hubs','Give a title','','');
$r["LOAD"]=array('Component who give the result of the page (home, category, read)','','preview ; auto depend of stars','');
$r["MenusJ"]=array('Ajax Menus of modules','param/title/command/option:module->target§button[,]','not closable','');
$r["Page_titles"]=array('show the titles of the page, including the navigation','','parent articles','');
$r["Wall"]=array('seed of articles with only content','option: category','','');
$r["agenda"]=array('articles of futur','Give a title','','');
$r["app_link"]=array('button to an App','syntaxe or id of the line in the user apps table, or of the table of the param \'command\'','','');
$r["app_menu"]=array('predefined apps','- predefined: home all hubs plan taxonomy agenda categories lang hub
- existing: key or val0 of the line (of the table of the command)
- with param: mod§nb plug§name /url§button
- auto: category or id
- we can also use spaces as delimiter','styles','');
$r["apps"]=array('Apps','software buttons','','');
$r["archives"]=array('navigate in time!','Give a title','','');
$r["art_mod"]=array('attached modules to articles','commands of modules :  param/title/command/option:module(§button)[,]
ex: :related_arts§linked to, :related_by§linked by','The rstr60 let display the result into the article. In this case the option specify the width of this column and modify the maximum width of the images.','');
$r["articles"]=array('list of articles from params','separator: tild (~), example: tag=Une~nbdays=1~preview=true~lasts=1-10
- cat/tag : specify a category / a tag ;
- nocat/notag : exit a category / a tag ;
- nbdays : time system ;
- preview : true, false, full;
- lasts : most read (lasts=1 for the first, lasts=1-10 for the nine left)

The Command \'multi\' is needed if you use a ponctual template, but dont segment the result by pages.','','');
$r["ban_art"]=array('ID_article used as banner : the first image of catalog is used as background and all the article is one link','ID_article','','');
$r["blocks"]=array('each word is a DIV, which is a block of module','list of blocks of modules','','');
$r["br"]=array('add a line','','','');
$r["bridge"]=array('make a bridge with anoter philum server','param : server without \'html\', option : ID of article ;
console url : /module/bridge/philum.org/1130','ID of article or url console (/module/bridge/philum.net/236)','');
$r["calendrier"]=array('calendar','Give a title','','');
$r["cart"]=array('Articles added to cart','Give a title','','');
$r["cat_arts"]=array('articles from a category','specify the category','','');
$r["categories"]=array('list of categories','Give a title','nb cols or display nb of articles, or home menu','');
$r["category"]=array('','','','');
$r["channel"]=array('receive the datas from others hubs or Philum sites, using selections','(use space)
ex: \'philum.net:site philum:hub 236:art CMS:tag 10:last\'
Definitions :
:site : (optionnal) without \'http\';
:cat : (optionnal) a category;
:art (illogical with cat) : affiliated articles;
:last : the N last articles ;

Channel can be used in a connector \':ajax\' (splitted with comas) like here :
[site.com:site blog:hub :channel§Titre, 
close§x:ajax]','autorefresh (seconds)','');
$r["chat"]=array('Chat between members','room name','autorefresh (seconds) ','');
$r["chatxml"]=array('chat between servers','name of room','autorefresh (seconds)','');
$r["chrono"]=array('time of generation of page','','','');
$r["clear"]=array('clear:left disable float:left','','','');
$r["codeline"]=array('return html from Codeline','ex: [[_URL§_SUJ:link]§h2:html] [[_OPT§txtsmall2:css]','','');
$r["columns"]=array('place each module on a column','command of modules (comline)','','');
$r["conn"]=array('result of a simple connector','','','');
$r["connector"]=array('result of a connector','examples:
- \'24:read\' :read content
- \'24:pub\' : pub of an article
- [[104:pub]:/2][[106:pub]:/2] : (this one put 2 titles on 2 columns)','article balise','');
$r["contact"]=array('mail to admin','title','css','');
$r["content"]=array('used by system to determine the width of the page','max width of content for images or videos','','');
$r["create_art"]=array('form to add articles','','','');
$r["credits"]=array('philum','','','');
$r["csscode"]=array('add css in the header','','','');
$r["cssfonts"]=array('add predefined font-faces in the header','','','');
$r["deja_vu"]=array('visited articles','Give a title','','');
$r["design"]=array('determinate the design to use','n>3 of css page, classic, default','css sublayer','');
$r["desktop_arts"]=array('display articles in desktop','script of command of articles (nothing = those from cache)','','');
$r["desktop_files"]=array('build virtual folders from files','global|virtual (default : local|real)','position of root','');
$r["desktop_varts"]=array('virtual articles: build folders from meta \'folder\' of articles','filter on results : script of command of articles (nothing = from all articles, \'cache\' = those from cache) ','','');
$r["disk"]=array('Files of a directory of the user disk_space','specify a directory','','');
$r["favs"]=array('selected articles by the visitor','','','');
$r["finder"]=array('Open Finder','param (folder) : hub/root/dir...
option (mode) : 
-0=disk/shared/icons
-1=local/global/distant
-2=virtual/real
-3=list/panel/flap/icons/icon-disk
-4=normal/recursive/conn
-5=alone
-6=pictos/mini','options for each param: 
- 0 = disk/shared/icons
- 1 = local/global/distant
- 2 = virtual/real
- 3 = list/panel/flap/icons/icon-disk
- 4 = normal/recursive/conn
- 5 = alone
- 6 = pictos/mini','');
$r["folders"]=array('nodes of articles, by number of sub-articles (folders)','specify the number of nodes (ordered from most to less used)','','');
$r["friend_art"]=array('return the article with the ID as title','','css','');
$r["friend_rub"]=array('return the article with the category as title','','css','');
$r["gallery"]=array('','','','');
$r["hierarchics"]=array('hierarchical menus','Give a title','','');
$r["hour"]=array('date','specify: %A %d %B %G %T (optionnal)','css','');
$r["hr"]=array('add a horizontal bar (hr)','specify the CSS','','');
$r["hubs"]=array('list of Hubs','Give a title','display nb of articles','');
$r["jscode"]=array('add js in the header','','','');
$r["last"]=array('most recent article','','','');
$r["leftbar"]=array('filled by css_builder after doing \'save_width\'','max width of leftbar for images or videos','','');
$r["link"]=array('return a link (protocol)','predefined links :
- key: Home, ID, category, module
- /plug/index
- title: Home§Accueil
- picto : Home§home:picto
- url: /?plug=myplug§name_of_plug','not space after','not in a li');
$r["log-out"]=array('disconnect','','','');
$r["login"]=array('login','Give a title','float on right','');
$r["login_popup"]=array('login in a popup','Give a title','','');
$r["most_read"]=array('most views articles','nb_days-nb_arts (ex: 7-50)','','');
$r["most_read_stat"]=array('most views articles, stat table','nb_days-nb_arts (ex: 7-50) ','','');
$r["msql_links"]=array('give a list of links from an microbase','need the name of the table (suffix as links or rssurl_1) ; option mean type of list (rss, mail or nothing = links)','table source','');
$r["newsletter"]=array('register to newsletter ; option : popup = link to popup','Give a title','button to a popup','');
$r["plan"]=array('','','','');
$r["player"]=array('','','','');
$r["plug"]=array('call a plugin','name of the plugin','values p and o sent to the plugin','');
$r["prev_next"]=array('link to previous and next article in time order','titles of buttons (|), ex: prev|next or &amp;lt;|&amp;gt;','option: css; command rub : in the same category','');
$r["priority_arts"]=array('articles with priority','define level (0-4)','nb cols or scroll limit','');
$r["pub"]=array('link to an article','','1,2,3 : level of preview ; 4 : multi id','');
$r["pub_art"]=array('title + image','ID_article','level of preview','');
$r["pub_arts"]=array('pub of manually selected articles','123 124 : use \'space\' as separator','','');
$r["pub_img"]=array('first image of an article','ID_article','','');
$r["read"]=array('content of an article','ID_article','css','');
$r["read_art"]=array('content only of an article','ID_article','','');
$r["recents"]=array('10 last articles in a category','specify category (1 = current, all in Home)','','');
$r["related_arts"]=array('related articles in the option \"related\"','Give a title','param of command : nb of cols or limit before scroll','type of display');
$r["related_by"]=array('articles who are linked to this one by the option \"related\"','Give a title','param of command : nb of cols or limit before scroll','type of display');
$r["rightbar"]=array('filled by css_builder after doing \'save_width\'','max width of rightbar for images or videos','','');
$r["rss"]=array('Let watch on place each links of rss feed','specify the suffix of the table containing rss urls (rssurl)','','');
$r["rss_input"]=array('receive an rss flux, 10 last titles','specify a link RSS','','');
$r["rub_tags"]=array('tags of the articles of a category','title (option)','','');
$r["rub_taxo"]=array('taxonomy from an article or a category','art=current article, 1=current category / All, category, ID','','');
$r["same_title"]=array('articles with same title','Give a title','','');
$r["search"]=array('internal search engine (opt=1 : float right)','Give a title','float on right','');
$r["see_also-rub"]=array('In the same category','specify the category, 1=auto where Home=All','','');
$r["see_also-source"]=array('articles from the same source','Give a title','','');
$r["see_also-tags"]=array('Articles with the same Tags','Give a title','','');
$r["see_also-usertags"]=array('list of articles with same user_tag','specify the user_tag','','');
$r["short_arts"]=array('short articles','define lenght (4000)','','');
$r["social"]=array('list of publications','Give a title','','');
$r["sources"]=array('url source of article','number of occurences','','');
$r["stats"]=array('graphic of visitors','number of days (current by default)','display text','');
$r["submenus"]=array('drop menus','syntax :
each object is a connector \':link\' (ID, ID§titre, category)
each line generate a button
the number of tilds give the depth
buttons a top of hierarchy can not be a link

one
- two
three
- four
-- five','horizontal','');
$r["suggest"]=array('let the visitor purpose an article from his Url','','','');
$r["tab_mods"]=array('tabs of modules','param/title/command/option:module§button[,]','','');
$r["tag_arts"]=array('articles with Tag :','specify the tag ; CAT = current category','','');
$r["tags"]=array('list of tags','Give a title','nb cols or scroll limit','');
$r["tags_cloud"]=array('cloud of tags','Give a title','','');
$r["taxo_arts"]=array('articles from a parent article','specify 1 (=current/All), category, or ID_art','','');
$r["taxo_nav"]=array('list of nodes with openable menu','','','');
$r["taxonomy"]=array('','','','');
$r["template"]=array('template of articles','name of the template','','');
$r["text"]=array('free text','specify a text','','');
$r["tracks"]=array('','','','');
$r["twitter"]=array('receive a Twitter channel','specify the hashtag (without the #); option: nb of sec','','');
$r["user_menu"]=array('site navigation','predefined links :
- key: Home, ID, catégorie, module
- title: Home§Accueil
- picto : Home§home:picto
- url: /?plug=myplug§name_of_plug','css','');
$r["usertag_arts"]=array('articles with an user_tag','(not need to specify the class of tags) ; 
CAT = current category','','');
$r["usertags"]=array('list of usertags','','nb cols or scroll limit','');
$r["usertags_cloud"]=array('cloud of user_tags','','','');
$r["video_playlist"]=array('list of videos founded','nb of days','','');
$r["video_viewer"]=array('video viewer in ajax','rules (|) :
- tag, cat, priority 
- tag1|tag2 ou 5-tag1|tag2 (5=tags)
- priority-2|3|4 ou 11-2|3|4 (11=priority)
- cat-public : articles in \'public\' ;
- cat-1 : current category','','');
$r["desktop"]=array('params ofdesktop','background : html color,gradient or image','','');
$r["popart"]=array('open article (local or distant) in a popup','','','');
$r["video"]=array('embed video','id of video','','');
$r["userclasstag_arts"]=array('articles with an user tag of specified class','specify the class of tags','','');

?>