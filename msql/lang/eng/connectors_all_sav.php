<?php
//philum_microsql_connectors_all_sav
$r["_menus_"]=array('description');
$r["h"]=array('h3');
$r["b"]=array('bold');
$r["i"]=array('italic');
$r["u"]=array('underline');
$r["s"]=array('stabilo');
$r["r"]=array('red');
$r["c"]=array('css txtclr (color)');
$r["k"]=array('strike');
$r["l"]=array('small');
$r["e"]=array('exposant');
$r["pre"]=array('balise pre (preformated)');
$r["code"]=array('balise: code');
$r["php"]=array('give the syntax coloration for php code');
$r["color"]=array('color of text : [text§dd0000:color] [text§indigo:color] ');
$r["/2"]=array('column width/2');
$r["/3"]=array('column witdh/3');
$r["2cols"]=array('texte on 2 columns');
$r["3cols"]=array('text on 3 columns');
$r[":(x)"]=array('delete all connectors');
$r[":b"]=array('delete the connectors :b');
$r[":c"]=array('delete the connectors :c');
$r[":h"]=array('delete the connectors :h');
$r[":h2"]=array('delete the connectors :h2');
$r[":i"]=array('delete the connectors :i');
$r[":list"]=array('delete the connectors :list');
$r[":no"]=array('delete the connectors :no');
$r[":q"]=array('delete the connectors :q');
$r[":s"]=array('delete the connectors :s');
$r[":u"]=array('delete the connectors :u');
$r["?"]=array('delete the ? in front of lines');
$r["add_lines"]=array('add lines at each sentences');
$r["ajax"]=array('return (a button who return) a module or a connector :ajax
where:

- param/title/command/option:module = call module ;
- target = div ;
- button = to screen ;

That can be repeat to produce a menu like in the module MenusJ.
try [id:read§screen:ajax] give the content of an article ');
$r["ajxget"]=array('preserve characters § inside connector :module ');
$r["apps"]=array('call an icon af application : 
syntaxe: bouton;type;process;param;option
ex: [stext;plug;stext:apps] [6:apps]');
$r["articles"]=array('list of articles from special sorting');
$r["basic"]=array('execute the codeline basic code');
$r["bkg"]=array('background image : [value§img:bkg] (first from catalog by default)');
$r["book"]=array('make book from articles');
$r["bubble"]=array('openable ajax submenus (see module submenus)');
$r["chat"]=array('Chat (works in articles)');
$r["clean_br"]=array('forbid more than two empty lines');
$r["clean_mail"]=array('delete illegal lines');
$r["clear"]=array('disable float image');
$r["console"]=array('CSS class console');
$r["convert_html"]=array('convert html to connectors');
$r["css"]=array('apply a css to the selected text');
$r["data"]=array('datas of the artice.
hello§1:msq_data will write hello at line 1
rewrite the connector as 1:msq_data 
and display the data attached to the key 1 ');
$r["download"]=array('send a file');
$r["draw"]=array('external Api');
$r["easy_tables"]=array('make tables easier to edit');
$r["font"]=array('font of text [pHilUM§microsys:font]');
$r["footnotes"]=array('add anchors if (1) or [1] is detected two times');
$r["formail"]=array('form to receive mails');
$r["forum"]=array('give a Forum module');
$r["h1"]=array('balise: H1 (very big text)');
$r["h2"]=array('balise: H2 (big text)');
$r["header"]=array('send content in the header');
$r["html"]=array('[pHilUM§css=txtcadr size=16 font=microsys color=firebrick:html]');
$r["iframe"]=array('give an iframe from an URL [src§width/height/name/seamless:iframe]');
$r["img"]=array('force to understand as an image (no extension)');
$r["img_label"]=array('try to find comments for each image');
$r["imgtxt"]=array('typos GDF ([text§typo:imgtxt]');
$r["import"]=array('import an article (ID)');
$r["jconn"]=array('call a connector on place in ajax; ex: [248:read§open:jconn]');
$r["jopen"]=array('open a content on place in ajax');
$r["jukebox"]=array('mp3 player for a directory (recursive) [hub/directory:jukebox]');
$r["label"]=array('label of image');
$r["last-update"]=array('date of last modification of an article');
$r["last_saved"]=array('restore last saved action');
$r["lines"]=array('delete line from selected text');
$r["link"]=array('predefined links :
- key: Home, ID, catégorie, module
- title: Home§Accueil
- picto : Home§home:picto
- url: /?plug=myplug§name_of_plug 
- key: Home');
$r["list"]=array('delete the connectors :list');
$r["lowcase"]=array('lower case of selected text');
$r["microform"]=array('let the visitor add an entry n a msql table ; form to use in parameter : date=date,choice1/choice2=list,entry1,entry2,message=text,image=upload,mail=mail,ok=button ');
$r["microread"]=array('use datas of table msql in a template.
ex: [dev_ads_353§readatas:microread] 
- build datas with :microform
- build templates in admin/template');
$r["microsql"]=array('return the datas of a microbase as a table ;
[hub_table:microsql] [hub_table_key:microsql]  [system/hub_table:microsql][system/hub_table_version:microsql][system/hub_table_version_key:microsql]');
$r["msql"]=array('return datas of a table : 
[hub_table_(version)-(key)|(row)§option:microsql] ;');
$r["mini"]=array('build a thumbnail with personalized dimensions : [img.jpg§140/100:thumb]
+ open the original in an ajax popup');
$r["module"]=array('give the result of a module of content - separator: (|) ; ex: [hour|Home:link:module] (see builders / modules)');
$r["msq_bin"]=array('replace 1 ans 0 by explicit images');
$r["msq_conn"]=array('convert the datas of a microsql table with connectors to html');
$r["msq_count"]=array('return the number of lines of a microbase');
$r["msq_graph"]=array('make a graph from a column or a line of a table ; ex: 
from a column : [node_base§col:msq_graph ]
from a line : [node_base_key:msq_graph]');
$r["msq_lasts"]=array('[node§10:msq_lasts] return the 10 lasts elements of the table');
$r["no"]=array('do not display content');
$r["numlist"]=array('list with numbers : ol (for each new line)');
$r["old_conn"]=array('re-write old connectors');
$r["on"]=array('display connector [hello:b:on]');
$r["p"]=array('balise: p (paragraph)');
$r["paste"]=array('paste html and recuperate connectors');
$r["pdf"]=array('PDF reader ; ex: doc:pdf');
$r["petition"]=array('give a Petition module');
$r["photo"]=array('photo galleries');
$r["plug"]=array('[param§option:plugin:plug]');
$r["plup"]=array('plugin in a popup
[param§option:plugin§button:plup] but not :
[plugin§param:plup]');
$r["polaroid"]=array('[image.jpg§texte:polaroid]');
$r["pop"]=array('open content in a popup [text§title:pop]');
$r["popart"]=array('open an article Philum (local or distant) in a popup');
$r["popmsqt"]=array('return content from a msql entry in a popup ; [system_program*gnu_1§GNU:popmsqt] ');
$r["popread"]=array('give the content of an article in a pop-up');
$r["poptxt"]=array('give the content of a text file in a pop-up');
$r["popurl"]=array('open a page in a popup');
$r["prod"]=array('make a product from an article');
$r["pub"]=array('ad of an article [ID§option:pub] 
- default : return a simple link of the title
- §1 : article mode 1 (preview=off)
- §2 : article mode 2 (preview=true) 
- §3 : article mode 3 (preview=full) 
- §4 : use template pub_art');
$r["punct"]=array('apply typographics rules');
$r["radio"]=array('audio diffusion from a playlist in a microtable ; ex: [180/200§dev_music:radio] or [auto§dev_music:radio] for full width');
$r["read"]=array('call the content of an article');
$r["rename_img"]=array('rename images to import');
$r["replace"]=array('replace text');
$r["revert"]=array('revert to current saved version');
$r["rss_art"]=array('import the content of an article in RSS');
$r["rss_input"]=array('rss feeds');
$r["rss_read"]=array('import the content of an article of an other philum site');
$r["scan"]=array('import the content of text file.  §1 will convert connectors of content');
$r["search"]=array('result of internal search engine (knowing time_system)');
$r["shop"]=array('give all the article affiliated to this one in an unique table of products 
(user_tags can be price and reference)');
$r["size"]=array('size of text [text§24:size] ');
$r["swf"]=array('return a link who return an ajax popup with the Flash animation. [width/large§src:swf]');
$r["t"]=array('css: txtit (titles)');
$r["tables"]=array('detele tables');
$r["thumb"]=array('build a thumbnail with personalized dimensions : [img.jpg§140/100:thumb]');
$r["poptwit"]=array('open a twit in a popup');
$r["twitter"]=array('open a twit from it\'s ID or a thread from it\'s username');
$r["version"]=array('philum version');
$r["video"]=array('read a video youtube daily vimeo rutube etc... §1 return a link to open a popup');
$r["w"]=array('give entire link');
$r["web"]=array('receive decode html and interpret page from url in live (used to be sure to have the last version of this page but a few loud to do)');
$r["webpage"]=array('display a web page in a popup (using suggest plugin)');
$r["mktable"]=array('format csv as table datas');
$r["svgcode"]=array('create svg from connectors. §width/height');
$r["popmsql"]=array('return content from a msql entry in a popup ; [public_atomic§GNU:popmsql]');
$r[1]=array('');
$r[":pre"]=array('');

?>