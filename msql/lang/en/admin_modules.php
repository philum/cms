<?php //philum/microsql/admin_modules
$r=["_menus_"=>['description','help','option','command'],"All"=>['All articles','Give a title','preview ; auto depend of stars',''],"BLOCK"=>['call a block of modules','specify the name of a block','',''],"Banner"=>['text with image in background','p=image, t=title, o=height','height',''],"Board"=>['articles with priority &gt; 1','specify number of columns','',''],"Hubs"=>['list of Hubs','Give a title','',''],"LOAD"=>['Component who give the result of the page (home, category, read)','','preview ; auto depend of stars',''],"MenuBub"=>['Openable menus using bubbles and msql table','alternative number of version of table menubub_1','',''],"MenusJ"=>['Ajax Menus of modules','param/title/command/option:module->target�button[,]','not closable',''],"Page_titles"=>['show the titles of the page, including the navigation','','parent articles',''],"Wall"=>['seed of articles with only content','option: category','',''],"agenda"=>['articles with the tag \'agenda\' set in the future','Give a title','',''],"api"=>['Application to serve datas','enter a command','',''],"api_arts"=>['Api using Load builder','command type get','',''],"api_mod"=>['Api using Api builders','command type json','',''],"app_link"=>['button to an App','syntaxe or id of the line in the user apps table, or of the table of the param \'command\'','',''],"app_menu"=>['predefined apps','- predefined: home all hubs plan taxonomy agenda categories lang hub
- existing: key or val0 of the line (of the table of the command)
- with param: mod�nb plug�name /url�button
- auto: category or id
- we can also use spaces as delimiter','styles',''],"app_popup"=>['open an app in a popup','params : button,type,process,param
ex: hello,art,auto,(id article)','',''],"apps"=>['Apps','software buttons','',''],"archives"=>['navigate in time!','Give a title','',''],"art_mod"=>['attached modules to articles','commands of modules :  param/title/command/option:module(�button)[,]
ex: :related_arts�linked to, :related_by�linked by','The rstr60 let display the result into the article. In this case the option specify the width of this column and modify the maximum width of the images.',''],"articles"=>['list of articles from params','parameters of the Api: tag:word,nbdays:1,preview:auto

- cat/tag : specify a category / a tag
- nocat/notag : exit a category / a tag
- nbdays : time system
- preview : 1, 2, 3, auto
','',''],"article"=>['simple article','ID','',''],"audio_playlist"=>['articles with .mp3','nb of days','',''],"ban_art"=>['ID_article used as banner : the first image of catalog is used as background and all the article is one link','ID_article','',''],"basic"=>['runs a custom connector (identified by its title), or basic code','param = input value','',''],"birthday"=>['Article of a day','use a date [day-month] or let it blank for current date','',''],"blocks"=>['each word is a DIV, which is a block of module','list of blocks of modules','',''],"br"=>['add a line','','',''],"bridge"=>['make a bridge with anoter philum server','param : server without \'html\', option : ID of article ;
console url : /module/bridge/philum.org/1130','ID of article or url console (/module/bridge/philum.fr/236)',''],"fav_mod"=>['Display the list of shared favs','Cibling a title will returns the stream of favs','',''],"calendar"=>['calendar','Give a title','',''],"cart"=>['Articles added to cart','Give a title','',''],"cat_arts"=>['articles from a category','specify the category','',''],"categories"=>['list of categories','Give a title','nb cols or display nb of articles, or home menu',''],"category"=>['articles of the current category','','',''],"channel"=>['receive the datas from others hubs or Philum sites, using selections','(use space)
ex: \'philum.fr:site philum:hub 236:art CMS:tag 10:last\'
Definitions :
:site : (optionnal) without \'http\';
:cat : (optionnal) a category;
:art (illogical with cat) : affiliated articles;
:last : the N last articles ;

Channel can be used in a connector \':ajax\' (splitted with comas) like here :
[site.com:site blog:hub :channel�Titre, 
close�x:ajax]','autorefresh (seconds)',''],"chat"=>['Chat between members','room name','autorefresh (seconds) ',''],"chatxml"=>['chat between servers','name of room','autorefresh (seconds)',''],"chrono"=>['time of generation of page','','',''],"classtag_arts"=>['Display articles from a class of tags ','','',''],"clear"=>['clear:left disable float:left','','',''],"codeline"=>['return html from Codeline','ex: [[_URL�_SUJ:link]�h2:html] [[_OPT�txtsmall2:css]','',''],"columns"=>['place each module on a column','command of modules (comline)','',''],"conn"=>['result of a simple connector','','',''],"connector"=>['write code using connectors','the editor is copied in the field of param','article balise',''],"contact"=>['mail to admin','title','css',''],"content"=>['used by system to determine the width of the page','max width of content for images or videos','',''],"context"=>['secify the context','returns the modules of a context','',''],"create_art"=>['form to add articles','','',''],"credits"=>['philum','','',''],"csscode"=>['add css in the header','','',''],"deja_vu"=>['visited articles','Give a title','',''],"design"=>['determinate the design to use','n>3 of css page, classic, default','css sublayer',''],"desktop"=>['params ofdesktop','background : html color,gradient or image','',''],"desktop_apps"=>['return the content of desktop','following the Apps with condition \'desk\', or that of the option','',''],"desktop_arts"=>['display articles in desktop','script of command of articles (nothing = those from cache)','',''],"desktop_files"=>['build virtual folders from files','global|virtual (default : local|real)','position of root',''],"desktop_varts"=>['virtual articles: build folders from meta \'folder\' of articles','from [nb of days]','',''],"disk"=>['Files of a directory of the user disk_space','specify a directory','',''],"favs"=>['selected articles by the visitor','','',''],"finder"=>['Open Finder','param (folder) : hub/root/dir...
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
- 6 = pictos/mini',''],"folders"=>['nodes of articles, by number of sub-articles (folders)','specify the number of nodes (ordered from most to less used)','',''],"folders_varts"=>['Articles in virtual folders','nb of days','',''],"frequent_tags"=>['most frequents tags','specify the class, none=all','',''],"friend_art"=>['return the article with the ID as title','','css',''],"friend_rub"=>['return the article with the category as title','','css',''],"gallery"=>['','','',''],"hierarchics"=>['hierarchical menus','Give a title','',''],"hour"=>['date','specify: %A %d %B %G %T (optionnal)','css',''],"hr"=>['add a horizontal bar (hr)','specify the CSS','',''],"hubs"=>['list of Hubs','Give a title','display nb of articles',''],"jscode"=>['add js in the header','','',''],"jslink"=>['add js link in the header ','','',''],"last"=>['most recent article','','',''],"last_search"=>['Saved searches','term of search','',''],"last_tags"=>['last tags added','number of tags','specify a classe of tags',''],"leftbar"=>['filled by css_builder after doing \'save_width\'','max width of leftbar for images or videos','',''],"link"=>['return a link (protocol)','predefined links :
- key: Home, ID, category
- /plug/index, /module/...
- title: Home�Accueil
title: word, picto: Home�home:picto','not space after','not in a li'],"log-out"=>['disconnect','','',''],"login"=>['login','Give a title','float on right',''],"login_popup"=>['login in a popup','Give a title','',''],"module"=>['ID of module (used to simplify the calling of a module)','','',''],"most_read"=>['most views articles','nb_days-nb_arts (ex: 7-50)','',''],"most_read_stat"=>['most views articles, stat table','nb_days-nb_arts (ex: 7-50) ','',''],"msql_links"=>['give a list of links from an microbase','need the name of the table (suffix as links or rssurl_1) ; option mean type of list (rss, mail or nothing = links)','table source',''],"newsletter"=>['register to newsletter ; option : popup = link to popup','Give a title','button to a popup',''],"overcats"=>['Superiors menus, where are attached the categories (see /admin/overcat)','display a menu, in javascript or ajax with the command bub','',''],"panel_arts"=>['panel on presentation for articles','Api command or id','',''],"plan"=>['','','',''],"player"=>['','','',''],"plug"=>['call a plugin','name of the plugin','values p and o sent to the plugin',''],"popart"=>['open article (local or distant) in a popup','','',''],"prev_next"=>['link to previous and next article in time order','titles of buttons (|), ex: prev|next or &amp;lt;|&amp;gt;','option: css; command rub : in the same category',''],"priority_arts"=>['articles with priority','define level (0-4)','nb cols or scroll limit',''],"pub"=>['link to an article','','1,2,3 : level of preview ; 4 : multi id',''],"pub_art"=>['title + image','ID_article','level of preview',''],"pub_arts"=>['pub of manually selected articles','123 124 : use \'space\' as separator','',''],"pub_img"=>['first image of an article','ID_article','',''],"read"=>['content of an article','ID_article','css',''],"read_art"=>['content only of an article','ID_article','',''],"recents"=>['10 last articles in a category','specify category (1 = current, all in Home)','',''],"related_arts"=>['related articles in the option \"related\"','Give a title','param of command : nb of cols or limit before scroll','type of display'],"related_by"=>['articles who are linked to this one by the option \"related\"','Give a title','param of command : nb of cols or limit before scroll','type of display'],"rightbar"=>['filled by css_builder after doing \'save_width\'','max width of rightbar for images or videos','',''],"rss"=>['Let watch on place each links of rss feed','specify the suffix of the table containing rss urls (rssurl)','',''],"rss_input"=>['receive an rss flux, 10 last titles','specify a link RSS','',''],"rssin"=>['channels of rss received','','',''],"rub_tags"=>['tags of the articles of a category','class of tags','',''],"rub_taxo"=>['taxonomy from an article or a category','art=current article, 1=current category / All, category, ID','',''],"same_title"=>['articles with same title','Give a title','',''],"search"=>['internal search engine (opt=1 : float right)','Give a title','float on right',''],"see_also-rub"=>['In the same category','specify the category, 1=auto where Home=All','',''],"see_also-source"=>['articles from the same source','Give a title','',''],"see_also-tags"=>['Articles with the same Tags as the current article','specify a class of tags','',''],"short_arts"=>['short articles','define lenght (4000)','',''],"social"=>['list of publications','Give a title','',''],"sources"=>['url source of article','number of occurences','',''],"stats"=>['graphic of visitors','number of days (current by default)','display text',''],"submenus"=>['drop menus','syntax :
each object is a connector \':link\' (ID, ID�titre, category)
each line generate a button
the number of tilds give the depth
buttons a top of hierarchy can not be a link

one
- two
three
- four
-- five','horizontal',''],"suggest"=>['let the visitor purpose an article from his Url','','',''],"tab_mods"=>['tabs of modules','param/title/command/option:module�button[,]','',''],"tag_arts"=>['articles with Tag :','specify the tag (+ the class if needed, ex: tag:class)','',''],"tags"=>['list of tags','specify the class of tags','nb/size of cols or scroll limit',''],"tags_cloud"=>['cloud of tags','specify the class of tags','',''],"taxo_arts"=>['articles from a parent article','specify 1 (=current/All), category, or ID_art','',''],"taxo_nav"=>['list of nodes with openable menu','','',''],"taxonomy"=>['','','',''],"template"=>['template of articles','name of the template','',''],"text"=>['free text','specify a text','',''],"tracks"=>['comments','nb of days','title',''],"twitter"=>['receive a Twitter channel','specify the hashtag (without the #); option: nb of sec','',''],"user_menu"=>['site navigation','predefined links :
- key: Home, ID, cat�gorie, module
- title: Home�Accueil
- picto : Home�home:picto
- url: /?plug=myplug�name_of_plug','css',''],"video"=>['embed video','id of video','',''],"video_playlist"=>['list of videos founded','nb of days','',''],"video_viewer"=>['video viewer in ajax','rules (|) :
- tag, cat, priority 
- tag1|tag2 ou 5-tag1|tag2 (5=tags)
- priority-2|3|4 ou 11-2|3|4 (11=priority)
- cat-public : articles in \'public\' ;
- cat-1 : current category','','']];