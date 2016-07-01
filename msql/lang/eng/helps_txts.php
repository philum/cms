<?php
//philum_microsql_helps_txts
$r["_menus_"]=array('description');
$r["philum_pub_txt"]=array('[[http://philum.net/236§[phi1§32::picto]:popart] [v[:ver]§txtsmall2:css] [http://philum.net§[logo:picto]]:center]');
$r["update_ok_alert"]=array('mettre à jour le htaccess /ajax.php et le server param 5 (141201)');
$r["conn_help_txt"]=array('The connectors substitute the thml to an askable langage with some parameters ;

Connectors for text
- [link§word] : word attached to a link;
- [:b] : \'word\' is in \'bold\' ;
- [[http://lien.com§example]:b] : connectors are iterative;
- [link.extension] : some medias [.jpg.mp3.flv.pdf.swf] call players

Logical connectors :
- [attribut:connector] : basic syntax
- [attribut§option:connector] : add an option
- [param1/param2§attribut:connector] : multiple parameters (attribut placed in option) example : [640/480/&flvar=true§MyFlashMovie:flash]

Codeline
- [_VAR§div:bal] : a div balise appears if _VAR is not empty ;
- [_VAR§div|id|css:balise] : this balise appear as if _VAR is empty ;;

Instructions
- [param/title/command/option:module->target§button[,]] : the most complicated, call a chain of modules from a connector, including parameters proper to each module id addition of those of the connector (\'module\' or \'ajax\')');
$r["shop_class"]=array('this section is obsolete
- activate the module \'cart\'
- create one article by product
- all articles affiliated to a product are available by the connecteur \':shop\'.
- in an article we can call another article as product with connector \':prod\'. (accept multiple IDs with separator: \',\' ; Ex: [123,124,125:prod]
- the connector [:form] make a form, used to validate the shopping.');
$r["console"]=array('The set of modules (Mods) is saved in an msql table.
It generate the Html Divs of the page.
In the set, the block of modules correspond to a Div.
Each module return the result of an application.

- backup / restore : save and restore de sets of modules
- refresh : refresh the modules, used after a modification in Msql.
- lab : to make tests or obtain the script of a module');
$r["trackbacks"]=array('Waiting for moderation');
$r["microxml"]=array('send/receive microsql table by xml');
$r["newhub_mail"]=array('Wecome

Please remember your nickname and password : 
Login: _USER 
password: _PASS
(after 3 attempts you receive a mail to recall them)');
$r["anchor_select"]=array('Select position of the second part of the Anchor');
$r["anchor_dbclic"]=array('use double-clic if it already exists');
$r["anchor_manual"]=array('add anchors manually (top and bottom)');
$r["anchor_auto"]=array('text must contain two times (1) or [1]');
$r["published_art"]=array('Your article have been published');
$r["trackmail"]=array('a comment had just been released');
$r["restrictions"]=array('Access|Content|Articles|Art_infos|User_menu');
$r["design"]=array('- [exit:b] :: shut down sessions
- [save:b] :: save table of definitions and create css, but not affect mods
- [backup:b] :: make a backup of the table
- [apply:b] :: make visible design for public ;
- [select: design:15/clrset:15:b] :: select a table of definitions
- [herit:b] :: save datas from another table
- [new_from:b] :: create new table from the current one
- [make_public:b] :: copy the design on the public hub
- [inform_public:b] :: update public table with same name
- [rebuild:b] :: build css from the definitions of the table
- [restore: design, clrset:b] :: revert the saved backup
- [reset: design, clrset:b] :: use defaults definitions
- [update:b] :: add new definitions from default to current table
- [refresh: saved_css, dev_css, clrset:b] :: see the built css');
$r["designwidths"]=array('Choosing widths will affect all the needed classes in the css

A width of 0 mean delete this bloc, as visible in the bloc \'system\' named \'blocks\'

Be carefull if you permut two column right and left, to be sure modules are affected to that column

Informations about widths in console are used to determinate widths of images and video and can be adjusted');
$r["designcond"]=array('All the edition of design affect a special css, who will not be seen by the visitor.
Only buttons \'apply\' will affect the design visitors can see.

At booting the css_builder select the current design

Open two windows to watch the changes

To select a css in a context, duplicate design module and specify it\'s condition');
$r["formail"]=array('Thank you for your message');
$r["userforms"]=array('your datas has been saved with success');
$r["fontserver"]=array('inject new definitions to the table \'server/edition_typos\',
because this table is not affected by the updates.

The news definitions can come from :
- from update of table \'system/edition_fonts\' ;
- from a .tar archive located in \'/fonts\' of user space disk ;
- from the plugin \'addfonts\', who save typos from web starting from the css classe @face-fonts.');
$r["clbasic"]=array('To write connecteors or module we use the language named \'codeline basic\', abble to call functions from core, or others modules or connectors.

/apply functions to param
_PARAM§txtit:css
/or
txtit:css

/iteration
txtit:css§u:html§18:size

/tables
+system/edition_typosbrowsers/§msql_read:core 
make_table:core
_1 _2:text

/call a connector
_PARAM§txtit:css§h:conn');
$r["templates"]=array('templates for articles need to be assigned in console (global) or in article himself (local) to be activated ;

use restriction 55 \'user template\' to activate the procedure of searching user template, then public template, then the one bydefault. (not needed for the template of articles)');
$r["track_follow"]=array('the mail let you to receive other comments');
$r["track_captcha"]=array('copy code here');
$r["update_ok"]=array('software is up-to-date');
$r["update_help"]=array('If an error occur, enter in ');
$r["upload_folder"]=array('select a directory xhere send documents ;
to send a folder of images, just contain them into a .tar archive');
$r["bool"]=array('Bolean method : return common articles to all researches on each word');
$r["dev"]=array('A copy of the program is in the folder /progb. 
You must be in Dev (/?dev=dev) for the modifications take effect.
\'2prod\' means copy progb in prog.');
$r["blocsystem"]=array('The bloc \'system\' is not used to build a Div ;
It define the parameters of the blocks of modules.');
$r["import_art"]=array('URL of article to import');
$r["public_design"]=array('this will affect public design');
$r["modules"]=array('- content : built for the main div ;
- multi : can be displayed anywhere anytime ;
- once : can be displayed one time (used modules don\'t appear) ; 
- connectors : shortcuts to connectors ;
- articles : attached to the current article ;
- user  : user modules');
$r["rssurl_1"]=array('Import articles of the feeds where column \'bot\' is checked in the table \'_rssurl\'');
$r["words"]=array('Known words sorted by relevance');
$r["book"]=array('multiple params [,] : 
- script to call articles ; 
- list of ID [ ] ;
4 options [/] :
- title ;
- 1=growing ID, 2=inverse;
- template (\'book\' by default) ;
- template for cover (\'book_cover\') :

ex: [cat=public~nbdays=30,412 413 414§hello/2/book:book]

It\'s possible to create an ID list using the plugin \'favs\'.');
$r["call_arts"]=array('Parameters for script to articles :
- cat : category 
- nocat : category to exclude
- tag : (specify)
- notag : tag to exclude
- nbdays : \'30-60\' from 30 to 60 jours
- lasts : \'0-10\' the 10 last articles
- preview : \'true/false/full\' display mode
- priority : level of priority (1 à 4)
- nopriority : level of priority to exclude (1 à 4)
- lenght : \'<4000\' less than 4000 characters');
$r["htaccess"]=array('The file named \'.htaccess\' must have enough permissions.

The htaccess is designed to use the url as a console of commands for actions.

Verify the specific defs for each server.');
$r["favs"]=array('The symbol Like add articles in your favorites.
Later you can build a book of your favs.');
$r["icons"]=array('They are the existing icons from the typo \'pictos\', and the sockets for used icons by the system.
Affect a connector to the sockets, who say the type of icon : typo, image or svg. 
The existing icons are in the editor.');
$r["finder"]=array('Finder is for navigate in directories, virtual directories, and to share files.

- disk : user directories
- shared : shared files
- list : display list
- panel : display pages
- local/global/distant : virtual directories
- virtual/real : shared files mode
- picto/mini : pictos or thumbnails');
$r["comline"]=array('Commande-line:  Some modules need as parameter a command of module (MenusJ, Apps,...), also like the connector \':module\'.');
$r["mod_cond"]=array('Default contexts are (nothing), home, cat, art.
[0-9] : context of a article (id)
[a-z] : context of a targeted category
[a-z] : context given by url /context/name');
$r["updfonts"]=array('after download a typo, go to admin/fonts and do \'inject\' ; that will unzip file, copy it, and add an entry in the server table, who is not aware of the update, unlike the table \'system\'.');
$r["updpictos"]=array('The system need pictograms, download the font \'philum\' in the tab \'pictos\'');
$r["breadcrumb"]=array('The Breadcrumb display the name of the category and other infos.
Le restriction Access/user_templates (55) let use the template named \'titles\' in place of the default one.');
$r["login"]=array('log-in or new user');
$r["mail_article"]=array('A friend send you this article:');
$r["log_no"]=array('username required');
$r["log_nopass"]=array('bad password');
$r["log_nohub"]=array('no new users');
$r["log_newser"]=array('Register as New User of level:');
$r["empty_msg"]=array('empty message');
$r["meta_related"]=array('ID of articles using space as separator');
$r["newsletter_ok"]=array('Newsletter successfully sent');
$r["newsletter_ko"]=array('no result');
$r["newsletter_uns"]=array('unsubscribe');
$r["conn_pub"]=array('The connectors are used in place of html and let write commands for applications');
$r["search"]=array('Tips: 
- bolean search : add * at end
- empty search : only on parameters
- numerical search : call an article from it\'s ID
- filters : ex: \"word1;word2:tag;word3:author\" (\'author is an usertag, separator: \';\')
- line of command: priority=4~from=01-02-13 (cat, nocat, tag, notag, until, nbdays)
- cache can be deleted
- dig check other time fields
- \'last\' give the last published article');
$r["defcons"]=array('The Definitions are using some input and outputs for title, text, and another option if needed. Il the output is not set, it will be the natural end of the balise. Lot of rules let adjust the content, as del the title, the line 1, a link or a line with a keyworks, or strip some balises.');
$r["apps"]=array('the restriction 61 is activated : the default Apps are loaded, and the yours are added after (system/default_apps)');
$r["apps_add"]=array('Apps presets. when rstr 61 is active, the user apps replace the system apps.
The button \"upload\" will replace all your apps ! make bakups');
$r["trackhelp"]=array('- links, images and vidéos (youtube etc...) are automatically converted
- link to an article from the site : \'1234§link\' or \'1234:pub\' (display title) 
- #public : call the room \'public\' of the Chat');
$r["suggest"]=array('The article will have the mention \'proposed by\' [prefix of the mail]');
$r["suggest_ok"]=array('Your article have been published');
$r["console_cond"]=array('[Context:b]: The states are \'cat\' and \'art\' (category and article),
in addition of \'home\' and \'all\'.
The modules are activated while the state is corresponding.
The console present a simulation of the site at this moment.');
$r["console_mods"]=array('Here are the number of versions of the table of mods.
This menu does not affect the configuration. 
To set the current mods as visible for the visitors, do \'apply\' or set it in [config/params/table_mods:l] (change the number, that will create a new table from current if it not exists)');
$r["scripts"]=array('param/title/command/option/cache/hide/template/br:module§button[,]');
$r["video"]=array('Youtube, Dailymotion, Vimeo, Rutube, vk.com, Livestream');
$r["popvideo"]=array('- option §1 : load video player
- option §440/320 : width/height');
$r["pdf"]=array('The PDF player need to be loged on Google ');
$r["art_render"]=array('The default mode of render of articles are given by the restrictions 5 and 41 (config arts) but can be overloaded here with : false, preview, full, read, auto');
$r["desklr"]=array('attributs of Desktop :
top,#_4,#_2
to bottom,#002594,#06999e,#878787,#bf1755,#4f004f
philum/photo/space/crabhubble.jpg
philum/photo/space (random img of folder)');
$r["submod_types"]=array('sub-modules types: mod plug art msql link finder ajax admin');
$r["chatxml"]=array('ChatXml works between Philum servers  (see \'admin/params\')');
$r["chatcall"]=array('_NAME is inviting you to chat NOW!');
$r["miniconn"]=array('Syntax of Miniconns :
- links, images, videos are embeded
- canal:room call a canal of the chat
- name:twitter = open a rss fromTwitter
- 1234:pub = link to an article (ID)
- bold:b, italic:i, underscore:u, thethree:b:i:u
- connectors : [param§option:connector]');
$r["artstats"]=array('The stats for an article are visibles only after have been flushed (one time by day)');
$r["track_orth"]=array('Please think to be understood, and breath three times before to write !');
$r["tracks_error1"]=array('bad Captcha');
$r["tracks_error2"]=array('please give your name');
$r["tracks_error3"]=array('empty message');
$r["retape"]=array('Some old connectors have been replaced');
$r["prmb5"]=array('the param \'auto_design\' (5) is activated : it works instead of the user design');
$r["flog"]=array('fast-log: remember your ID and retrieve yours datas');
$r["memstorage"]=array('contents are stored in local vars of your own browser');
$r["blocmenu"]=array('this div is linked to css to display correctly the ul<li');
$r["bloctest"]=array('will not be rendered, it\'s used for testing modules');
$r["ftext"]=array('content and edition are public');
$r["first_user"]=array('Create Admin account');
$r["new_user"]=array('Create account');
$r["meta_lang"]=array('ID of articles in others languages');
$r["tracks_moderation"]=array('tracks are moderated');
$r["twitter_oAuth"]=array('parameters of twitter API (https://apps.twitter.com/)');
$r["tag_rename"]=array('Rename a tag could delete and associate articles to an existing tag');
$r["usertags"]=array('Add tags to this article and retrieve themes in your favorites');
$r["api"]=array('The API give datas from a query.
- /module/api/{command} : display result
- /api/{command] : json stream');
$r["like"]=array('The Likes are public');
$r["overcats"]=array('a category can existing with an empty value, in this cas the categorie is listed at root');
$r["overcats_menu"]=array('Overcats can be used as a module, as an admin menu or as a desktop menu, using an app with type=desktop and process=overcats');
$r["menubub"]=array('types of menububs : 
- (no type) : (a-z) = category, (0-9) = article, /module/... = link 
- module : open content of a module (ex: ///lines/4///1:categories ) 
- plug : (open a plug) 
- ajax : (ex: popup_track___admin)');

?>