<?php //philum/msql/helps_txts_sav
$r=["_menus_"=>['description'],
"philum_pub_txt"=>['[http://philum.fr/2§[phi1§32::picto]:popart] [v[:ver]§txtsmall2:css] [http://philum.fr§[philum:picto]]'],
"update_ok_alert"=>['mettre à jour le htaccess /ajax.php et le server param 5 (141201)'],
"conn_help_txt"=>['General Principle

Connectors are written between brackets containing a \":\".
They are located on the right and not on the left for optimization reasons.
[param§option:conn]

Shaping connectors :
- [http://url.com] : \'word\' attached to a url.
- [mot:b] : \'word\' to \'bold\'.
- [[http://lien.com§example]:b] or [http://lien.com§[example:b]]: the connectors are have associated connectors: .jpg, .mp3, .mp4, .pdf, .webm etc.

Some connectors accept multiple options (width/height) :
[img.jpg§140/140:thumb]

To display a second instance connector of a button, simply do :
[param§option:conn§button]

To open a connector on the spot, there is a special connector for this in an openable menu :
- [ID:read§open:jconn]

The connector to call a module (paging objects) :
The first 4 parameters of a module are: \"param/title/mode/option\".
Recent\" module for a \"public\" category, a \"hello\" title, a \"panel\" display mode and a limit of 10 entries :
- [public/hello/panel/10:recents:module]

Connectors to call a plugin :
Plugins receive only one parameter and one option:
- [microarts:plug]
- [hello§1:connectors:plug] //there the option adds square brackets
To create a button :
- [hello§1:connectors:plug§bt] //but it doesn\'t work if \"hello\" is replaced by \"hello:b\" because it will be interpreted in the first instance, and will return its html code.

You can call a plugin through a module : 
- [microarts:plug:module]

Api connector :
[minday:14,order:id DESC,lang:all:api]

The principle of the connectors is declined in four other devices :
- The Templates, which receive pre-named variables (for heavy operations that require a high speed of execution);
- The Vue micro-template, which can receive a connector [varable_name:var] and return recurrent results (a list of objects);
- The Codeline: allows to design simple connectors, using _VAR and _OPT which come from the custom connector command ;
- The Basic, a concatenated (and brackless) connector language, which can also be used to build connectors and modules, using the resources of the Framework library.

Translated with www.DeepL.com/Translator (free version)'],
"shop_class"=>['this section is obsolete
- activate the module \'cart\'
- create one article by product
- all articles affiliated to a product are available by the connecteur \':shop\'.
- in an article we can call another article as product with connector \':prod\'. (accept multiple IDs with separator: \',\' ; Ex: [123,124,125:prod]
- the connector [:form] make a form, used to validate the shopping.'],
"console"=>['The set of modules (Mods) is saved in an msql table.
It generate the Html Divs of the page.
In the set, the block of modules correspond to a Div.
Each module return the result of an application.

- backup / restore : save and restore de sets of modules
- refresh : refresh the modules, used after a modification in Msql.
- lab : to make tests or obtain the script of a module'],
"trackbacks"=>['Waiting for moderation'],
"microxml"=>['send/receive microsql table by xml'],
"newhub_mail"=>['Wecome

Please remember your nickname and password : 
Login: _USER 
password: _PASS
(after 3 attempts you receive a mail to recall them)'],
"anchor_select"=>['Select position of the second part of the Anchor'],
"anchor_dbclic"=>['use double-clic if it already exists'],
"anchor_manual"=>['add anchors manually (top and bottom)'],
"anchor_auto"=>['text must contain two times (1) or [1]'],
"published_art"=>['Your article have been published'],
"trackmail"=>['a comment had just been released'],
"restrictions"=>['Access|Content|Articles|Art_infos|User_menu'],
"design"=>['- [exit:b] :: shut down sessions
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
- [refresh: saved_css, dev_css, clrset:b] :: see the built css'],
"designwidths"=>['Choosing widths will affect all the needed classes in the css

A width of 0 mean delete this bloc, as visible in the bloc \'system\' named \'blocks\'

Be carefull if you permut two column right and left, to be sure modules are affected to that column

Informations about widths in console are used to determinate widths of images and video and can be adjusted'],
"designcond"=>['All the edition of design affect a special css, who will not be seen by the visitor.
Only buttons \'apply\' will affect the design visitors can see.

At booting the css_builder select the current design

Open two windows to watch the changes

To select a css in a context, duplicate design module and specify it\'s condition'],
"formail"=>['Thank you for your message'],
"userforms"=>['your datas has been saved with success'],
"fontserver"=>['inject new definitions to the table \'server/edition_typos\',
because this table is not affected by the updates.

The news definitions can come from :
- from update of table \'system/edition_fonts\' ;
- from a .tar archive located in \'/fonts\' of user space disk ;
- from the plugin \'addfonts\', who save typos from web starting from the css classe @face-fonts.'],
"clbasic"=>['To write connecteors or module we use the language named \'codeline basic\', abble to call functions from core, or others modules or connectors.

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
_PARAM§txtit:css§h:conn'],
"templates"=>['templates for articles need to be assigned in console (global) or in article himself (local) to be activated ;

use restriction 55 \'user template\' to activate the procedure of searching user template, then public template, then the one bydefault. (not needed for the template of articles)'],
"track_follow"=>['the mail let you to receive other comments'],
"track_captcha"=>['copy code here'],
"update_ok"=>['The software is up-to-date'],
"update_help"=>['If an error occurs, renove all from install.php'],
"upload_folder"=>['select a directory xhere send documents ;
to send a folder of images, just contain them into a .tar archive'],
"bool"=>['Bolean method : return common articles to all researches on each word'],
"dev"=>['A copy of the program is in the folder /progb. 
You must be in Dev (/?dev=dev) for the modifications take effect.
\'2prod\' means copy progb in prog.'],
"blocsystem"=>['The bloc \'system\' is not used to build a Div ;
It define the parameters of the blocks of modules.'],
"import_art"=>['URL of article to import'],
"public_design"=>['this will affect public design'],
"modules"=>['- content : built for the main div ;
- multi : can be displayed anywhere anytime ;
- once : can be displayed one time (used modules don\'t appear) ; 
- connectors : shortcuts to connectors ;
- articles : attached to the current article ;
- user  : user modules'],
"rssurl_1"=>['Import articles of the feeds where column \'bot\' is checked in the table \'_rssurl\''],
"words"=>['Known words sorted by relevance'],
"book"=>['multiple params [,] : 
- script to call articles ; 
- list of ID [ ] ;
4 options [/] :
- title ;
- 1=growing ID, 2=inverse;
- template (\'book\' by default) ;
- template for cover (\'book_cover\') :

ex: [cat=public~nbdays=30,412 413 414§hello/2/book:book]

It\'s possible to create an ID list using the plugin \'favs\'.'],
"call_arts"=>['Parameters for script to articles :
- cat : category 
- nocat : category to exclude
- tag : (specify)
- notag : tag to exclude
- nbdays : \'30-60\' from 30 to 60 jours
- lasts : \'0-10\' the 10 last articles
- preview : \'true/false/full\' display mode
- priority : level of priority (1 à 4)
- nopriority : level of priority to exclude (1 à 4)
- lenght : \'<4000\' less than 4000 characters'],
"htaccess"=>['The file named \'.htaccess\' must have enough permissions.

The htaccess is designed to use the url as a console of commands for actions.

Verify the specific defs for each server.'],
"favs"=>['The symbol Like add articles in your favorites.
Later you can build a book of your favs.'],
"icons"=>['They are the existing icons from the typo \'pictos\', and the sockets for used icons by the system.
Affect a connector to the sockets, who say the type of icon : typo, image or svg. 
The existing icons are in the editor.'],
"finder"=>['Finder is for navigate in directories, virtual directories, and to share files.

- disk : user directories
- shared : shared files
- list : display list
- panel : display pages
- local/global/distant : virtual directories
- virtual/real : shared files mode
- picto/mini : pictos or thumbnails'],
"comline"=>['Commande-line:  Some modules need as parameter a command of module (MenusJ, Apps,...), also like the connector \':module\'.'],
"mod_cond"=>['Default contexts are (nothing), home, cat, art.
[0-9] : context of a article (id)
[a-z] : context of a targeted category
[a-z] : context given by url /context/name'],
"updfonts"=>['after download a typo, go to admin/fonts and do \'inject\' ; that will unzip file, copy it, and add an entry in the server table, who is not aware of the update, unlike the table \'system\'.'],
"updpictos"=>['The system need pictograms, download the font \'philum\' in the tab \'pictos\''],
"breadcrumb"=>['The Breadcrumb display the name of the category and other infos.
Le restriction Access/user_templates (55) let use the template named \'titles\' in place of the default one.'],
"login"=>['log-in or new user'],
"mail_article"=>['A friend send you this article:'],
"log_no"=>['username required'],
"log_nopass"=>['bad password'],
"log_nohub"=>['no new users'],
"log_newser"=>['Register as New User of level:'],
"empty_msg"=>['empty message'],
"meta_related"=>['ID of articles using space as separator'],
"newsletter_ok"=>['Newsletter successfully sent'],
"newsletter_ko"=>['no result'],
"newsletter_uns"=>['unsubscribe'],
"conn_pub"=>['The connectors are used in place of html and let write commands for applications'],
"search"=>['Buttons:
- score: ranking by quantity of results
- segment: whole word
- boolean: several words (separated by a space)
- lang, cat, tag: include or exclude linked words (meta)
- limit: minimum number of occurrences (case sensitive)

Tips :
- empty search: only concerns parameters
- id : the id of an article allows to open it immediately
- date: articles of the targeted period (Y-m or Y-m-d)
- del button: clears the cache
- \'1\' returns the last published article
- fast forward\' button: continuous search on other time fields until an answer is found (if this option is active)
- API script, (use a:\':\' and a\',\') ex: \"search:word1|mot2,avoid:word3,cat:Justice,tag:justice|injustice\"
- precise date (API): \"date:1967,\" or \"date:-08-15\" (every 15 August)'],
"defcons"=>['Site import definitions are anchor points where the copy of the relevant parts of the page begins and ends.

These are the title and body text, and optionally a cap.
If the exit point is not specified then the normal end of the tag will be chosen (this may not work).

By specifying the Dom\'s targeting connectors you can dispense with the entry and exit tags. Their wording consists of : \"prop:attr:tag:n\"
where tag is the tag, attribute (default class), property. \"n\" specifies one iteration among all matching iterations (1 by default).
e.g. \"content:::2\" var search (the second encountered) div class=\"content\".

The \"utf=1\" option forces utf-8 decoding if it is not detected, and \"utf=2\" disallows it, which can be useful if the Dom returns nothing.

The \"post-treat\" option acts as a trim output, and allows you to delete the first line, the title, a link or a line or link containing a keyword, destroy tags, or delimit a since->to.'],
"apps"=>['the restriction 61 is activated : the default Apps are loaded, and the yours are added after (system/default_apps)'],
"apps_add"=>['Apps presets. when rstr 61 is active, the user apps replace the system apps.
The button \"upload\" will replace all your apps ! make bakups'],
"trackhelp"=>['- links, images and vidéos (youtube etc...) are automatically converted
- link to an article from the site : \'1234§link\' or \'1234:pub\' (display title) 
- #public : call the room \'public\' of the Chat'],
"suggest"=>['You can import web content from the article url, a preview will try to display. Don\'t worry if the page doesn\'t display correctly.

The mail field allows you to add a mention \"Suggested by [mail prefix]\". You will be notified when the page is published.

Thank you for your contribution!'],
"suggest_ok"=>['Your article have been published'],
"console_cond"=>['The modules (the page elements) belong to a[context: b]. By default, they are:\"home\",\"cat\" (for a category of articles) and \"art\" (read an article). We can create personalized contexts, declined of cat and art.

So when you call the page /context/name all modules belonging to context \"name\" are displayed.

The context of a module is defined in the output of each module. If a module is to appear in more than one context, create as many identical modules as necessary using the \"new\"button.'],
"console_mods"=>['Here are the number of versions of the table of mods.
This menu does not affect the configuration. 
To set the current mods as visible for the visitors, do \'apply\' or set it in [config/params/table_mods:l] (change the number, that will create a new table from current if it not exists)'],
"scripts"=>['param/title/command/option/cache/hide/template/br:module§button[,]'],
"video"=>['Youtube, Dailymotion, Vimeo, Rutube, vk.com, Livestream'],
"popvideo"=>['- option §1 : load video player
- option §440/320 : width/height'],
"pdf"=>['The PDF player need to be loged on Google '],
"art_render"=>['The default mode of render of articles are given by the restrictions 5 and 41 (config arts) but can be overloaded here with : false, preview, full, read, auto'],
"desklr"=>['attributs of Desktop :
top,#_4,#_2
to bottom,#002594,#06999e,#878787,#bf1755,#4f004f
philum/photo/space/crabhubble.jpg
philum/photo/space (random img of folder)'],
"submod_types"=>['sub-modules types: mod plug art msql link finder ajax admin'],
"chatxml"=>['ChatXml works between Philum servers  (see \'admin/params\')'],
"chatcall"=>['_NAME is inviting you to chat NOW!'],
"miniconn"=>['Syntax of Miniconns :
- links, images, videos are embeded
- canal:room call a canal of the chat
- name:twitter = open a rss fromTwitter
- 1234:pub = link to an article (ID)
- bold:b, italic:i, underscore:u, thethree:b:i:u
- connectors : [param§option:connector]'],
"artstats"=>['The stats for an article are visibles only after have been flushed (one time by day)'],
"track_orth"=>['Please think to be understood, and breath three times before to write !'],
"tracks_error1"=>['bad Captcha'],
"tracks_error2"=>['please give your name'],
"tracks_error3"=>['empty message'],
"retape"=>['Some old connectors have been replaced'],
"prmb5"=>['the param \'auto_design\' (5) is activated : it works instead of the user design'],
"flog"=>['Remember your ID to retrieve yours datas'],
"memstorage"=>['contents are stored in local vars of your own browser and are only visibles to you'],
"blocmenu"=>['this div is linked to css to display correctly the ul<li'],
"bloctest"=>['will not be rendered, it\'s used for testing modules'],
"ftext"=>['content and edition are public'],
"first_user"=>['Create Admin account'],
"new_user"=>['Create account'],
"meta_lang"=>['ID of articles in others languages'],
"tracks_moderation"=>['tracks are moderated'],
"twitter_oAuth"=>['parameters of twitter API (https://apps.twitter.com/)'],
"tag_rename"=>['Rename a tag could delete and associate articles to an existing tag'],
"usertags"=>['Add tags to this article and retrieve themes in your favorites. The user tags are publics.'],
"api"=>['The API give datas from a query.
- /module/api/{command} : display result
- /api/{command] : json stream'],
"like"=>['The Likes are public'],
"overcats"=>['a category can existing with an empty value, in this cas the categorie is listed at root'],
"overcats_menu"=>['Overcats can be used as a module, as an admin menu or as a desktop menu, using an app with type=desktop and process=overcats'],
"menubub"=>['types of menububs : 
- (no type) : (a-z) = category, (0-9) = article, /module/... = link 
- module : open content of a module (ex: ///lines/4///1:categories ) 
- plug : (open a plug) 
- ajax : (ex: popup_track___admin)'],
"spitable"=>['Atoms are represented by means of their electronic configuration. The electrons are distributed in orbits, and each orbit has potentially as many sub-orbit than the number of the orbit (the 5th can have 5 sub-orbits). Each sub-orbit has an identical configuration, made of a number of locations of electrons increasing of 4 to each sub-orbital level. The number of electrons in each orbit is the sum of sub-orbital (eg 32 is composed of 2+6+10+14).

The advantage of this representation is to highlight the fact that the sub-orbits are talking chemical families to which those atoms are represented.

Periodicity (spiral) of the elements is thus defined by a very simple algorithm (which does not include some variations on large atoms).
We can see that the overall structure (small - large - small) is maintained at all levels, and that this table can be extended indefinitely.'],
"fav_fav"=>['Articles favorites'],
"fav_tags"=>['Articles referenced by added Tags'],
"fav_com"=>['Api\'s parameters for list of articles'],
"fav_poll"=>['Voted Articles'],
"fav_visit"=>['visited Articles'],
"fav_shar"=>['Shared Articles'],
"fav_edit"=>['Script of the Api'],
"fav_like"=>['Liked Articles'],
"levenshtein"=>['Algorithm of Levenshtein'],
"study"=>['Allows you to create a text study, sentence by sentence.'],
"tlex"=>['Publish on Tlex : add the oAuth of the Api in the table users/(hub)_tlex.
It can have many accounts.'],
"twit"=>['General conditions of use: the information obtained must not be used for commercial purposes or as a physical or moral nuisance. 
Privacy policy: The information obtained can not be relayed without the authorization of the persons concerned.'],
"meta_abilities"=>['open / close abilities'],
"umrenum"=>['Renumber items by date and categorize favorites, retweets, and status'],
"search_cases"=>['Click several times in the menu to:
- include only
- exclude
- ignore (by default)
the terms of the request'],
"star"=>['- ra (right ascension in hours), dc (declination in degrees), and dist (distance in AL)
ex: ra>15,ra<21,dc>-1,dc<5,dist>13,dist<19

- radius parameter (default degrees, h, m, rad, mas)
ex: ra=18,dc=2,dist=16,radius=3

- around a star
ex: 88601,dist<30,radius=1h

- a list of named stars (HIP by default) :
HD 150680, hd150680, hip99461, 88601, 2021'],
"gaia"=>['example 1, with dc (declination), ra (right ascent) and dist (degrees and AL): 
dc > -23.432, dc < -21.82, ra > 255.25, ra < 270.83, dist < 100

a list of stars named by their id Gaia (number of 19 digits) separated by a space.'],
"umrec"=>['To call a specific message: 
http://oumo.fr/context/compile/O6-144
To integrate it in a web page via an iframe (use id) :
http://oumo.fr/plug/umrec/1464
From the editor (article or comments):
[1464:umcom:on] display the block
[1464§1:umcom:on] display the link'],
"mercury"=>['Universal web player'],
"mercurykey"=>['Admin: add the api_key (mercury.com) in the mercury table, row 1 column 0'],
"not_published"=>['Article not published'],
"tables"=>['Separators : 
- columns:\"|\" or [coma]
- lines: \"¬\"or [line break]'],
"twits"=>['calls a series of twits designated by their numerical id and separated by a space'],
"tweetfeed_help"=>['use only one or more \'api_arts\' module'],
"purpose"=>['Add and vote on proposals; you can only delete your entry on the current day.'],
"nodes"=>['This will create a new layer of hubs (a Node).
Change node : /?qd=nodename
Write $qd=\"pub2\"; in _connectx to assign a domaine name to the node \'pub2\'.'],
"updatenotes"=>['release notes'],
"lastupdate"=>['Last synchronization'],
"softwareupdated"=>['The software has been updated'],
"softwarever"=>['Actual version'],
"softwaredist"=>['Distant version'],
"updatedetails"=>['details of the last update'],
"updateno"=>['This server is not set to receive updates'],
"cookie"=>['The cookie named \"iq\" contains the id of your IP, which makes it possible to consider only one visitor even if your IP changes. See [privacy:help§data privacy policy].'],
"privacy"=>['The site does not use or resell any data related to visitors, except for site traffic statistics.
All activities on the site are cancelled on average every year.'],
"urmrsrch"=>['Search for :
- an id (1873)
- a title (Oay-126)
- a date ymd (150706)
- a term in any language
- a list of ids or titles (ot-100,1873,312-14) (also in spreadsheet mode)'],
"starmap"=>['HD or HIP stars (HIP by default)
e.g. HD 150680, hd150680, hip99461, 88601, 2021
pre-set commands: knownstars, allstars
Accepts Star requests (ra, dc, dist, radius)']];