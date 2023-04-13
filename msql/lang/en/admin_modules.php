<?php //msql/admin_modules
$r=["_menus_"=>['description','param','option','command'],
"All"=>['All articles','Give a title','preview : 1,2,3,auto',''],
"LOAD"=>['Component who give the result of the page (home, category, read)','','preview : 1,2,3,auto','order'],
"BLOCK"=>['Call a block of modules.
The rstr60 let display the result into the article. In this case the option specify the width of this column and modify the maximum width of the images.','name of the block of modules','',''],
"MENU"=>['Calls a block as a menu of links to modules','Name of the block','',''],
"ARTMOD"=>['Calls a block of modules with an article.
rstr60 let put it in a little button \"linked artocles\".
That let modules of context \"art\" to be differents.','Name of the block','','display mode'],
"TABMOD"=>['tabs of modules','name of the block of modules','',''],
"Banner"=>['text with image in background','p=image, t=title, o=height','height',''],
"MenuBub"=>['Openable menus using bubbles and msql table','alternative number of version of table menubub_1','',''],
"Page_titles"=>['show the titles of the page, including the navigation','','parent articles',''],
"agenda"=>['articles with the tag \'agenda\' set in the future','Give a title','',''],
"api"=>['Application to serve datas','Api command','second command',''],
"api_arts"=>['Api using Load builder','Api command type get','',''],
"api_chan"=>['channel of Api commands','number of table (1)','',''],
"api_mod"=>['Api using Api builders','command type json','',''],
"app_popup"=>['open an app in a popup','params : button,type,process,param
ex: hello,art,auto,(id article)','',''],
"apps"=>['Apps','software buttons','',''],
"archives"=>['navigate in time!','Give a title','',''],
"article"=>['simple article','ID','',''],
"articles"=>['Order of the Api specialised in article scrolls','parameters of the Api: tag:word,nbdays:1,preview:auto

- cat/tag : specify a category / a tag
- nocat/notag : exit a category / a tag
- nbdays : time system
- preview : 1, 2, 3, auto
','',''],
"ban_art"=>['ID_article used as banner : the first image of catalog is used as background and all the article is one link','ID_article','',''],
"basic"=>['runs a custom connector (identified by its title), or basic code','param = input value','',''],
"birthday"=>['Article of a day','use a date [day-month] or let it blank for current date','',''],
"blocks"=>['each word is a DIV, which is a block of module','list of blocks of modules','',''],
"bridge"=>['make a bridge with anoter philum server','param : server without \'html\', option : ID of article ;
console url : /module/bridge/philum.org/1130','ID of article or url console (/module/bridge/philum.fr/236)',''],
"calendar"=>['calendar','Give a title','',''],
"cart"=>['Articles added to cart','Give a title','',''],
"cat_arts"=>['articles from a category','specify the category','',''],
"categories"=>['list of categories','Give a title','nb cols or display nb of articles, or home menu',''],
"category"=>['articles of the current category','','',''],
"cats"=>['list of categories','','',''],
"catj"=>['list of categories, in ajax','','',''],
"channel"=>['receive the datas from others hubs or Philum sites, using selections','(use space)
ex: \'philum.fr:site philum:hub 236:art CMS:tag 10:last\'
Definitions :
:site : (optionnal) without \'http\';
:cat : (optionnal) a category;
:art (illogical with cat) : affiliated articles;
:last : the N last articles ;

Channel can be used in a connector \':ajax\' (splitted with comas) like here :
[site.com:site blog:hub :channel§Titre, 
close§x:ajax]','autorefresh (seconds)',''],
"chat"=>['Chat between members','room name','autorefresh (seconds) ',''],
"chatxml"=>['chat between servers','name of room','autorefresh (seconds)',''],
"chrono"=>['time of generation of page','','',''],
"classtag_arts"=>['Display articles from a class of tags ','','',''],
"clear"=>['clear:left disable float:left','','',''],
"codeline"=>['return html from Codeline','ex: [[_URL§_SUJ:link]§h2:html] [[_OPT§txtsmall2:css]','',''],
"conn"=>['result of a simple connector','','',''],
"connector"=>['write code using connectors','the editor is copied in the field of param','article balise',''],
"contact"=>['mail to admin','title','css',''],
"content"=>['used by system to determine the width of the page','max width of content for images or videos','',''],
"context"=>['secify the context','returns the modules of a context','',''],
"cover"=>['Cover of an article','id or Api (ex: priority:4,minday:14,random:1)','',''],
"create_art"=>['form to add articles','','',''],
"credits"=>['philum','','',''],
"csscode"=>['add css in the header','','',''],
"deja_vu"=>['visited articles','Give a title','',''],
"design"=>['determinate the design to use','n>3 of css page, classic, default','css sublayer',''],
"desktop"=>['params ofdesktop','background : html color,gradient or image','',''],
"desktop_apps"=>['return the content of desktop','following the Apps with condition \'desk\', or that of the option','',''],
"desktop_arts"=>['display articles in desktop','script of command of articles (nothing = those from cache)','',''],
"desktop_files"=>['build virtual folders from files','global|virtual (default : local|real)','position of root',''],
"desktop_varts"=>['virtual articles: build folders from meta \'folder\' of articles','from [nb of days]','',''],
"disk"=>['Files of a directory of the user disk_space','specify a directory','',''],
"fav_mod"=>['Display the list of shared favs','Cibling a title will returns the stream of favs','',''],
"favs"=>['selected articles by the visitor','','',''],
"finder"=>['Open Finder','param (folder) : hub/root/dir...
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
- 6 = pictos/mini',''],
"folder"=>['list of virtual folders','','',''],
"folders"=>['nodes of articles, by number of sub-articles (folders)','nb of days','order by number of arts',''],
"folders_varts"=>['Articles in virtual folders','specify directory','',''],
"frequent_tags"=>['most frequents tags','specify the class, none=all','',''],
"friend_art"=>['return the article with the ID as title','','css',''],
"friend_rub"=>['return the article with the category as title','','css',''],
"gallery"=>['','','',''],
"hierarchics"=>['hierarchical menus','Give a title','',''],
"hour"=>['date','specify: %A %d %B %G %T (optionnal)','css',''],
"hubs"=>['list of Hubs','Give a title','display nb of articles',''],
"jscode"=>['add js in the header','','',''],
"jslink"=>['add js link in the header ','','',''],
"link"=>['return a link','home, category, 123, module/...','1: auto picto, or named one',''],
"last"=>['most recent article','','',''],
"last_search"=>['Saved searches','term of search','',''],
"last_tags"=>['last tags added','number of tags','specify a classe of tags',''],
"lbar"=>['filled by css_builder after doing \'save_width\'','max width of leftbar for images or videos','',''],
"log-out"=>['disconnect','','',''],
"login"=>['login','Give a title','float on right',''],
"login_popup"=>['login in a popup','Give a title','',''],
"module"=>['ID of module (used to simplify the calling of a module)','','',''],
"most_read"=>['most views articles','nb_days-nb_arts (ex: 7-50)','',''],
"most_read_stat"=>['most views articles, stat table','nb_days-nb_arts (ex: 7-50) ','',''],
"most_polled"=>['most polled articles','define the type of poll (fav, like, poll, mood)','limit (100)',''],
"score_datas"=>['best evaluated articles','define the type of evaluation (interest, feasibility, quality,...)','limit (100)',''],
"special_poll"=>['assigns evaluations to an article','define the name of the field','choice1|choice2',''],
"newsletter"=>['register to newsletter ; option : popup = link to popup','Give a title','button to a popup',''],
"overcats"=>['Superiors menus, where are attached the categories (see /admin/overcat)','display a menu, in javascript or ajax with the command bub','',''],
"panel_arts"=>['panel on presentation for articles','Api command or id','',''],
"player"=>['','','',''],
"app"=>['call an app','name of the app','p and o sent to the app',''],
"popart"=>['open article (local or distant) in a popup','','',''],
"prev_next"=>['link to previous and next article in time order','titles of buttons (|), ex: prev|next or &amp;lt;|&amp;gt;','option: css; command rub : in the same category',''],
"priority_arts"=>['articles with priority','define level (0-4)','nb cols or scroll limit',''],
"pub"=>['link to an article','','1,2,3 : level of preview ; 4 : multi id',''],
"pub_art"=>['title + image','ID_article','level of preview',''],
"pub_arts"=>['pub of manually selected articles','123 124 : use \'space\' as separator','',''],
"pub_img"=>['first image of an article','ID_article','',''],
"read"=>['content of an article','ID_article','css',''],
"read_art"=>['content only of an article','ID_article','',''],
"recents"=>['10 last articles in a category','specify category (1 = current, all in Home)','',''],
"related_arts"=>['related articles in the option \"related\"','Give a title','ID or [null=auto]','type of display'],
"related_by"=>['articles who are linked to this one by the option \"related\"','Give a title','ID or [null=auto]','type of display'],
"parent_art"=>['parent article','id or empty (current)','',''],
"child_arts"=>['children articles','id or empty (current)','',''],
"rbar"=>['filled by css_builder after doing \'save_width\'','max width of rightbar for images or videos','',''],
"rss"=>['Let watch on place each links of rss feed','specify the suffix of the table containing rss urls (rssurl)','',''],
"rss_input"=>['receive an rss flux, 10 last titles','specify a link RSS','',''],
"rssin"=>['channels of rss received','','',''],
"rub_tags"=>['tags of the articles of a category','class of tags','',''],
"same_title"=>['articles with same title','Give a title','',''],
"search"=>['internal search engine (opt=1 : float right)','Give a title','float on right',''],
"searched_arts"=>['saved searches','','',''],
"searched_words"=>['known words','','',''],
"cluster_tags"=>['find arts by similarity using tag cluster','set the clusters in /app/clusters','',''],
"same_tags"=>['find art with same tags','id','',''],
"see_also-rub"=>['In the same category','specify the category, 1=auto where Home=All','',''],
"see_also-source"=>['articles from the same source','Give a title','',''],
"see_also-tags"=>['Articles with the same Tags as the current article','specify a class of tags','',''],
"short_arts"=>['short articles','define lenght (4000)','',''],
"social"=>['list of publications','Give a title','',''],
"sources"=>['url source of article','number of occurences','',''],
"stats"=>['graphic of visitors','number of days (current by default)','display text',''],
"submenus"=>['drop menus','syntax :
each object is a connector \':link\' (ID, ID§titre, category)
each line generate a button
the number of tilds give the depth
buttons a top of hierarchy can not be a link

one
- two
three
- four
-- five','horizontal',''],
"suggest"=>['let the visitor purpose an article from his Url','','',''],
"tag_arts"=>['articles with Tag :','specify the tag (+ the class if needed, ex: tag:class)','',''],
"tags"=>['list of tags','specify the class of tags','nb/size of cols or scroll limit',''],
"clusters"=>['list of clusters of tags','','',''],
"tags_cloud"=>['cloud of tags','specify the class of tags','',''],
"taxo_arts"=>['articles from a parent article','specify 1 (=current/All), category, or ID_art','',''],
"taxo_nav"=>['list of nodes with openable menu','','',''],
"taxonomy"=>['','','',''],
"template"=>['template of articles','name of the template','',''],
"text"=>['free text','specify a text','',''],
"tracks"=>['comments','nb of days','1=on place, else in popup',''],
"twits"=>['Display all the saved twits','to date','number of results by page',''],
"webs"=>['Display the entries of links','id','number of results by page',''],
"twitter"=>['receive a Twitter channel','specify the hashtag (without the #)','nb of sec',''],
"video"=>['embed video','id of video','',''],
"playconn"=>['article containing the specified connector','specify the connector (img,mp4,twitter,...)','',''],
"video_viewer"=>['video viewer in ajax','rules (|) :
- tag, cat, priority 
- tag1|tag2 ou 5-tag1|tag2 (5=tags)
- priority-2|3|4 ou 11-2|3|4 (11=priority)
- cat-public : articles in \'public\' ;
- cat-1 : current category','',''],
"microarts"=>['short articles','specify a thread','',''],
"vacuum"=>['open art from web via Vacuum','','','']];