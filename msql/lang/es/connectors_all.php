<?php //philum/microsql/connectors_all
$r=["_menus_"=>['description'],"h"=>['h3'],"b"=>['bold'],"i"=>['italic'],"u"=>['underline'],"q"=>['blockquote'],"s"=>['stabilo'],"r"=>['red'],"c"=>['css txtclr (color)'],"k"=>['strike'],"l"=>['small'],"e"=>['exposant'],"pre"=>['balise pre (preformated)'],"code"=>['balise: code'],"php"=>['give the syntax coloration for php code'],"color"=>['color of text : [text�dd0000:color] [text�indigo:color] '],"cols"=>['put the content into columns : [�3:cols] (number), [�300:cols] (size in px)'],"block"=>['put the content into a block : [�3:block] (%), [�300:block] (size in px)'],":(x)"=>['delete all connectors'],":b"=>['delete the connectors :b'],":c"=>['delete the connectors :c'],":h"=>['delete the connectors :h'],":h2"=>['delete the connectors :h2'],":i"=>['delete the connectors :i'],":list"=>['delete the connectors :list'],":no"=>['delete the connectors :no'],":q"=>['delete the connectors :q'],":s"=>['delete the connectors :s'],":u"=>['delete the connectors :u'],"?"=>['delete the ? in front of lines'],"add_lines"=>['add lines at each sentences'],"ajax"=>['return (a button who return) a module or a connector :ajax
where:

- param/title/command/option:module = call module ;
- target = div ;
- button = to screen ;

That can be repeat to produce a menu like in the module MenusJ.
try [id:read�screen:ajax] give the content of an article '],"ajxget"=>['preserve characters � inside connector :module '],"apps"=>['call an icon af application : 
syntaxe: bouton;type;process;param;option
ex: [stext;plug;stext:apps] [6:apps]'],"articles"=>['list of articles from special sorting'],"basic"=>['execute the codeline basic code'],"bkg"=>['background image : [value�img:bkg] (first from catalog by default)'],"book"=>['make book from articles'],"bubble"=>['openable ajax submenus (see module submenus)'],"chat"=>['Chat (works in articles)'],"clean_br"=>['forbid more than two empty lines'],"clean_mail"=>['delete illegal lines'],"striplink"=>[''],"clear"=>['disable float image'],"console"=>['CSS class console'],"convert_html"=>['convert html to connectors'],"css"=>['apply a css to the selected text'],"data"=>['datas of the artice.
hello�1:msq_data will write hello at line 1
rewrite the connector as 1:msq_data 
and display the data attached to the key 1 '],"download"=>['send a file'],"draw"=>['external Api'],"easy_tables"=>['make tables easier to edit'],"font"=>['font of text [pHilUM�microsys:font]'],"footnotes"=>['add anchors if (1) or [1] is detected two times'],"formail"=>['form to receive mails'],"forum"=>['give a Forum module'],"h1"=>['balise: H1 (very big text)'],"h2"=>['balise: H2 (big text)'],"header"=>['send content in the header'],"html"=>['[pHilUM�css=txtcadr size=16 font=microsys color=firebrick:html]'],"iframe"=>['give an iframe from an URL [src�width/height/name/seamless:iframe]'],"img"=>['force to understand as an image (no extension)'],"img_label"=>['try to find comments for each image'],"imgtxt"=>['typos GDF ([text�typo:imgtxt]'],"import"=>['import an article (ID)'],"jconn"=>['call a connector on place in ajax; ex: [248:read�open:jconn]'],"jopen"=>['open a content on place in ajax'],"jukebox"=>['mp3 player for a directory (recursive) [hub/directory:jukebox]'],"last-update"=>['date of last modification of an article'],"last_saved"=>['restore last saved action'],"lines"=>['delete line from selected text'],"link"=>['predefined links :
- key: Home, ID, cat�gorie, module
- title: Home�Accueil
- picto : Home�home:picto
- url: /?plug=myplug�name_of_plug 
- key: Home'],"list"=>['delete the connectors :list'],"lowcase"=>['lower case of selected text'],"msq_form"=>['let the visitor add an entry n a msql table ; form to use in parameter : date=date,choice1/choice2=list,entry1,entry2,message=text,image=upload,mail=mail,ok=button'],"msq_read"=>['use datas of table msql in a template.
ex: [dev_ads_353�readatas:microread]
- build datas with :microform
- build templates in admin/template'],"msql"=>['return datas of a table : 
[hub_table_(version)-(key)|(row)�option:microsql] ;'],"mini"=>['build a thumbnail with personalized dimensions : [img.jpg�140/100:mini]
+ open the original in an ajax popup'],"module"=>['give the result of a module of content - separator: (|) ; ex: [hour|Home:link:module] (see builders / modules)'],"msq_bin"=>['replace 1 ans 0 by explicit images'],"msq_conn"=>['convert the datas of a microsql table with connectors to html'],"msq_count"=>['return the number of lines of a microbase'],"msq_graph"=>['make a graph from a column or a line of a table ; ex: 
from a column : [node_base�col:msq_graph ]
from a line : [node_base_key:msq_graph]'],"msq_lasts"=>['[node�10:msq_lasts] return the 10 lasts elements of the table'],"no"=>['do not display content'],"numlist"=>['list with numbers : ol (for each new line)'],"old_conn"=>['re-write old connectors'],"on"=>['display connector [hello:b:on]'],"p"=>['balise: p (paragraph)'],"paste"=>['paste html and recuperate connectors'],"pdf"=>['PDF reader ; ex: doc:pdf'],"petition"=>['give a Petition module'],"photo"=>['photo galleries'],"plug"=>['[param�option:plugin:plug]'],"plup"=>['plugin in a popup
[param�option:plugin�button:plup] but not :
[plugin�param:plup]'],"figure"=>['[image.jpg�texte:figure]'],"pop"=>['open content in a popup [text�title:pop]'],"popart"=>['open an article Philum (local or distant) in a popup'],"popmsqt"=>['return content from a msql entry in a popup ; [system_program*gnu_1�GNU:popmsqt] '],"popread"=>['give the content of an article in a pop-up'],"poptxt"=>['give the content of a text file in a pop-up'],"popurl"=>['open a page in a popup'],"prod"=>['make a product from an article'],"pub"=>['ad of an article [ID�option:pub] 
- default : return a simple link of the title
- �1 : article mode 1 (preview=off)
- �2 : article mode 2 (preview=true) 
- �3 : article mode 3 (preview=full) 
- �4 : use template pub_art'],"punct"=>['apply typographics rules'],"radio"=>['audio files from pace disk [dev/music:radio] (1 by article, the module build a playlist)'],"read"=>['call the content of an article'],"rename_img"=>['rename images to import'],"replace"=>['replace text'],"revert"=>['revert to current saved version'],"rss_art"=>['import the content of an article in RSS'],"rss_input"=>['rss feeds'],"rss_read"=>['import the content of an article of an other philum site'],"scan"=>['import the content of text file.  �1 will convert connectors of content'],"search"=>['result of internal search engine (knowing time_system)'],"shop"=>['give all the article affiliated to this one in an unique table of products 
(user_tags can be price and reference)'],"size"=>['size of text [text�24:size] '],"swf"=>['return a link who return an ajax popup with the Flash animation. [width/large�src:swf]'],"t"=>['css: txtit (titles)'],"tables"=>['detele tables'],"thumb"=>['build a thumbnail with personalized dimensions : [img.jpg�140/100:thumb]'],"twitter"=>['open a twit from it\'s ID or a thread from it\'s username'],"version"=>['philum version'],"video"=>['read a video youtube daily vimeo rutube etc... �1 return a link to open a popup'],"w"=>['give entire link'],"web"=>['receive decode html and interpret page from url in live (used to be sure to have the last version of this page but a few loud to do)'],"webpage"=>['display a web page in a popup (using suggest plugin)'],"mktable"=>['format csv as table datas'],"svgcode"=>['create svg from connectors. �width/height'],"popmsql"=>['return content from a msql entry in a popup ; [public_atomic�GNU:popmsql]'],":pre"=>['delete the connectors :pre'],"image"=>['open an external image, from any format'],"plugin"=>['plug_name�param:plugin'],"slides"=>['create a slide from the datas. use new line or -- as separator'],"fluid"=>['create a fixed image entirely visible while scrolling (�height) [img.jpg�100:fluid]'],"floatleft"=>['float left'],"floatright"=>['float right'],"sigle"=>['code of currencies (euro, dollar, yen...)'],"caviar"=>['cavalize the text'],"bkgclr"=>['color of background of text : [text�yellow:bkgclr]'],"dev"=>['content is only displayed to auth(4)'],":color"=>['color of text'],":bkgclr"=>['color of bakground of text'],"u-red"=>['red underscore'],"u-blue"=>['blue underscore'],"u-green"=>['green underscore'],"u-purple"=>['purple underscore'],"callin"=>['open content on place [content�title:callin]'],"exec"=>['execute code'],"api"=>['call Api'],"papi"=>['button to call Api'],"tag"=>['call the results from a tag : [keywork�classTag:tag]'],"picto"=>['display a picto from it nomination'],"ascii"=>['display an ascii from it nomination']];