<?php //philum/microsql/admin_modules
$r=["_menus_"=>['description(|||)help','option(||||)command'],"All"=>['All items(|||)Give title(||)preview; auto depende de stars',''],"BLOCK"=>['Calls a Module Block','specify the name of a module block'],"Banner"=>['text and background image(|||)p=image if there is one, t=title, o=height','height'],"Board"=>['items with priority greater than 1; sensible al tema actual','especificar el n�mero de columnas'],"Hubs"=>['Hubs(||||)Lista',''],"LOAD"=>['Dar un t�tulo',''],"MenuBub"=>['Componente principal que recibe el desbobinado de art�culos o una vista previa de un art�culo completo','(||); auto depende de los men�s de trabajo stars'],"MenusJ"=>['ajax, basados en una tabla msql (no depende de las sesiones)','indica un n�mero de versi�n alternativo al men� menub_1'],"Page_titles"=>['Menu que devuelve los m�dulos en Ajax','param/title/command/option:module->target�button[,...no reenganchable(|||)'],"Wall"=>['T�tulos de p�gina (incluyendo navegaci�n)','(||)'],"agenda"=>['Secuencia de art�culos con s�lo cuerpo del mensaje','especificaruna categor�a (opci�n)'],"api"=>['art�culos cuya etiqueta\'agenda\' est� en el futuro(|||)Dar un t�tulo',''],"api_arts"=>['Devuelve el resultado de una consultaa Api','control secuencial (ver /module/api)'],"api_mod"=>['Llamar Api usando Load(|||)Api',''],"app_link"=>['Llamar APIusando el constructor de comandos API','de Json'],"app_menu"=>['-type articles button of an App(|||)syntax or id of your user table line, o la lista de aplicaciones predefinidas con el comando',''],"app_popup"=>['- lista predefinida con los comandos',' inicio todos los hubs plan taxonom�a agenda categor�as lang hub
existente : tecla o val0 de la l�nea
configurable : mod�nb, plug�name, /url�button
auto : categor�a, id
tambi�n podemos usar la coma como delimitador'],"apps"=>['lanzar una aplicaci�n en una ventana emergente','par�metros : bot�n,tipo,proceso,param
ej: hello,art,auto,(id article)'],"archives"=>['Apps(||)Las aplicaciones son botones de software. Puede crear botones, enlaces, men�s, html, ajax, ubicados en el men� de administraci�n, en un art�culo, abriendodesplazamiento, software, in situ, anidado, vinculado a otros botones, vinculado a iconos, en una ventana emergente, o en cualquier otro lugar.... Estas oportunidades est�n clasificadas por tipo de habilidad y ubicaci�n.

Nota: las aplicaciones del mismo nombre sustituyen a las anteriores: para cancelar una aplicaci�n por defecto, a�ada la misma y oc�ltela.

Contextos :
menu : Men� Apps del men� de administraci�n
escritorio: iconos de escritorio
boot : cuando se inicia la p�gina
inicio : men� admin Men� Phi
user : menu user du menu admin (activated by rstr48)','(||)'],"art_mod"=>['navigation temporelle','Donner un titre'],"articles"=>['modules attach�s aux articles : affiche un bouton dans les titres qui ouvrir ce menu de modules','commandes de modules :
param/title/command/option:module(�button)[,]

Ej: related_arts�linked to, related_arts�linked by, tags/Tags/scroll/7:see_also-tags�tags, themes/Th�mes/scroll/7:see_also-tags�themes, //scroll/7:see_also-source�source, art:rub_taxo�context(|||)El rstr60 muestra el resultado en el cuerpo del art�culo. En este caso, se debe especificar la opci�n de ancho de columna. Disminuye el ancho de las im�genes tanto.(|||)'],"article"=>['custom unfolded articles(|||)parameters of the Api :

tag=Un&nbdays:1,vista previa:auto,limit:10

cat/tag : especifica una categor�a / etiqueta

nocat/notag : excluye una categor�a / etiqueta

nbdays : campo de tiempo

vista previa : 1, 2, 3, auto',''],"audio_playlist"=>['simple article','ID'],"ban_art"=>['articles containing .mp3','nb of days'],"basic"=>['banner','(ID)(item using the banner, or the first cataloged image of the item, as background page'],"birthday"=>['executes a custom connector (identified by its title), or basic','param=value input.'],"blocks"=>['article of a day(||)specify a date[day-month], or none for the current date',''],"br"=>['determine the DIV tags of the html page, que son tantos bloques de m�dulo (informados por el css del fabricante, requerido)','lista de bloques de m�dulo, separados por un espacio'],"bridge"=>['a�ade un salto de l�nea',''],"fav_mod"=>['puente entrephilum','param : servidor sin el\'http\''],"calendar"=>['Muestra los favoritos compartidos(|||)Al especificar un t�tulo favorito, muestra el calendario rendering',''],"cart"=>['calendar(|||)Give a title',''],"cat_arts"=>['Items added to the cart(|||)Give a title',''],"categories"=>['itemsde una categor�a(|||)especifique la categor�a','(||)'],"category"=>['lista de elementos(|||)D� un t�tulo(||)opci�n de param o nb = n�mero de elementos, home',''],"channel"=>['articles of the current category',''],"chat"=>['receives feeds from other Philum hubs or sites, including sort criteria','(parameters separated by a space)
Ejemplo :  philum.fr:sitio philum:hub 236:art CMS:tag 10:last\'
Definiciones :
sitio: (opcional) sin el\"http\";
cat : (opcional) una categor�a...............................................................................................................................................................................................;
arte (il�gico con el gato) : art�culos afiliados...........................................................................................................................................................................................;
last : los N �ltimos art�culos;
...
El m�dulo de canal puede ser llamado desde un conector\':ajax\';
ejemplo :[sitio.com:blog site:hub :canal�T�tulo, cerrar�x:ajax]'],"chatxml"=>['Chat','module room'],"chrono"=>['chat between servers','channel'],"classtag_arts"=>['tiempo de generaci�n de p�gina',''],"clear"=>['Muestra los elementos con una clase de etiqueta definida','especificar clase de etiqueta'],"codeline"=>['clear:left undoes left floating',''],"columns"=>['Retorna las etiquetas html anidadas escritas en Codeline(|||)ex: [[_URL�_SUJ:link]�h2:html] [[_OPT�txtsmall2:css]',''],"conn"=>['coloca cada m�dulo en una columna de l�nea de comandos(|||)',''],"connector"=>['resultado de un �nico conector',''],"contact"=>['permite componer el c�digo como conectores(|||)El editordevuelve su contenido en el campo param','tag article'],"content"=>['mail al admin','title'],"context"=>['determina el ancho artificial de la p�gina (informado por el fabricante css, requerido)','ancho del contenido (para im�genes y v�deos)'],"create_art"=>['especificar un contexto','retornar m�dulos pertenecientes a un contexto'],"credits"=>['a�adir formulariode css en la cabecera',''],"csscode"=>['art�culos recientemente visitados','(||)'],"deja_vu"=>['determina la hoja Css a utilizar (informado por el fabricante css, necesario)','especificar un n�mero de hoja css de suscripci�n css : coloca el css reciente como un underlay, sobre el cual es posible usar el m�nimo de personalizaci�n: classic, default, n>3 para una tabla p�blica); de lo contrario vea params/auto_design'],"design"=>['desktop','parameters specify html color, #_var, gradient or image'],"desktop"=>['returns the content of the desktop',' concerns apps with the condition\'desk\', o la opci�n'],"desktop_apps"=>['presenta art�culos en el script de comando Desktop','article (nada = los de la cach�)'],"desktop_arts"=>['presenta archivos compartidos en el Escritorio global virtual(|||)(por defecto : local|real)(|||)root',''],"desktop_files"=>['position virtual articles : construye directorios a partir de la metacarpeta de art�culos ','desde[n�mero de d�as]'],"desktop_varts"=>['Contenido de un directorio espacialuser disk','specify a directory'],"disk"=>['Items selected by the visitor',''],"favs"=>['Open Finder','param (path) : hub/root/dir....(||)opciones para cada par�metro :
0 = disco/compartido/iconos
1 = local/global/remote
2 = virtual/real
3 = lista/panel/flap/iconos/icon-disk
4 = normal/recursivo/conectado
5 = solo
6 = nodos de pictogramas/mini'],"finder"=>['art�culo, en orden descendente del n�mero de subelementos (carpetas de art�culos)','especificar el n�mero de nodos (se ordenan de m�s a menos utilizados)'],"folders"=>['Los art�culos clasificados en una carpeta virtual','nb de d�as'],"folders_varts"=>['las etiquetas m�s frecuentes(|||)especificar una clase, none = all',''],"frequent_tags"=>['devuelve el �tem nombrado como el ID del �tem actual','(||)css'],"friend_art"=>['devuelve el �temllamado como field',''],"friend_rub"=>['',''],"gallery"=>['men�s jer�rquicos(|||)Dar t�tulo',''],"hierarchics"=>['fecha',' especificar: Un %d %B %G %T (opcional)'],"hour"=>['a�ade una barra horizontal','especifica la clase CSS'],"hr"=>['lista de Hubs(|||)Dar un t�tulo(|||) muestra el n�merojs en cabecera',''],"hubs"=>['agrega un enlace js en la cabecera',''],"jscode"=>['art�culo',''],"jslink"=>['m�s reciente Buscarsaved(|||)search term','(||)'],"last"=>['last tags added(|||)number of tags','specify class / command bub : to d menub'],"last_search"=>['width of leftbar (for images and videos)','informed by css_builder after a\'save_width\''],"last_tags"=>['returns a link (in a link)','Predefined link : Home, Article ID, Category name

Enlace directo: /module/..., /plug/....

T�tulo : texto, pictograma : inicio:picto'],"leftbar"=>['disconnection',''],"link"=>['login','Dar un t�tulo(|||)a la derecha'],"log-out"=>['login ina popup','Give a title'],"login"=>['ID del m�dulo al que llamar (utilizado para simplificar las consultas)',''],"login_popup"=>['art�culos m�s vistos','nb_day-)nb_arts (ej: 7-50)'],"module"=>['art�culos m�s vistos, estad�sticas consolidadas','nb_jours-nb_arts (ex: 7-50) '],"most_read"=>['devuelve una lista de enlaces de una microbase ;
la opci�n da el tipo de enlaces : rss, mails o nada = links(||)recibe el sufijo de la microbase (links, rssurl_1)','table source'],"most_read_stat"=>['newsletter','subscribe'],"msql_links"=>['Top menus (see /admin/overcat), to which categories','belong Muestra un men� de trabajo, escriba javascript o ajax con el comando bub'],"newsletter"=>['item','panel de comandos de la API, o id'],"overcats"=>['llamar a un plugin(|||)nombre de los valores del plugin','p y o enviado al plugin'],"panel_arts"=>['abre el art�culo(local o remoto) en una ventana emergente',''],"plan"=>['muestra un enlace a los t�tulos de los art�culos anteriores y siguientes(|||) para mostrarlos en los botones ',', v. gr: prev|next or &lt;|&gt;'],"player"=>['Articles with priority','set level for sorting (0-4)'],"plug"=>['article','pub'],"popart"=>['title +del panel de vista previa',''],"prev_next"=>['que contiene elementos ordenados manualmente(|||)123 124 ID separado por un espacio','(||)'],"priority_arts"=>['utiliza la primera imagen referenciada de un art�culo(|||)ID_article',''],"pub"=>['article','ID_article'],"pub_art"=>['contentde un art�culo','ID_article'],"pub_arts"=>['10 �ltimos art�culos de una partida(|||)especificar la partida (1 devuelve la partida actual, all in Home',''],"pub_img"=>['articles attached by the articles option\'related\'(|||)Give a title(||)command parameter (nb columns or limit before scroll)','treatment'],"read"=>['articles that point to that-ci par l\'option d\'articles\'related\'\'','Donner un titre'],"read_art"=>['largeur de rightbar (pour les images et vid�os)','inform� parcss_builder despu�s de un\'save_width\''],"recents"=>['Devuelve un espacio de consulta en el sitio rss(||) especificando el nombre de una tabla de enlace rss (rssurl por defecto)',''],"related_arts"=>['recibe un feed rss, 10 t�tulos m�s recientes','especifique un enlace RSS'],"related_by"=>['cadena de fuentes rss',''],"rightbar"=>['taxonom�a de un tema / art�culo, presentado en forma topol�gica (men�), insensible en ese momento)','art=art�culo en progreso, 1=encabezamiento en progreso/Todos, encabezamiento, ID'],"rss"=>['art�culos con el mismo t�tulo(|||)Dar un t�tulo','(||)'],"rss_input"=>['motor de b�squeda(|||)Dar un t�tulo(|||)derecho alinear',''],"rssin"=>['En el mismo campo(|||)especificar el campo, 1=auto cuando Home=All',''],"rub_tags"=>['articles from the same source','Give a title'],"rub_taxo"=>['Articles with the same Tags as the article being read(|||)specify the class',''],"same_title"=>['short (brief)','specify the number of characters of the article(4000)'],"search"=>['publicaciones no enrolladas(|||)Dar un t�tulo',''],"see_also-rub"=>['url fuente de los art�culos chupados(|||) n�merode ocurrencias',''],"see_also-source"=>['histograma de visitas','n�mero de d�as (valor por defecto actual)'],"see_also-tags"=>['men�s desplegables','sintaxis:
cada objeto es un conector\':link\' (ID,categor�a)
cada l�nea corresponde a un bot�n
el n�mero de guiones significa la profundidad
los botones en la parte superior de una jerarqu�a no pueden ser enlaces

uno
dos
tres
horno
five'],"short_arts"=>['da al visitante la forma de proponer un art�culo desde un m�dulo Url',''],"social"=>['en pesta�as','param/title/command/coption:module�button[,]'],"sources"=>['articles having for Tag','specify the reference tag for sorting ;
si es necesario, especifique la clase de etiqueta
ej: tag:class'],"stats"=>['list of keywords(tags)','specify tag class'],"submenus"=>['list of words-(nube de etiquetas)','especificar la clase de etiqueta'],"suggest"=>['taxonom�a de un tema / art�culo (lista de art�culos, usa cache)','specify 1 (=current item/All), un campo o item ID'],"tab_mods"=>['list of nodes with openable menus (refers to cache, then looks for parents in time)','plugin ; especifique el ID de un art�culo de nivel superior'],"tag_arts"=>['',''],"tags"=>['nombre de la plantilla',''],"tags_cloud"=>['texto libre',' especifique untexto plano'],"taxo_arts"=>['comentarios art�culos','nb d�as(|||)t�tulo'],"taxo_nav"=>['recibe un Twitter(|||)feed indicando hashtag (sin el signo #) ; opci�n = nb de segundos de refresh',''],"taxonomy"=>['navegaci�n del sitio(|||)enlaces predefinidos :
enlace clave : Inicio, ID, categor�a, m�dulo
poner un t�tulo : Home�Home
usando un pictograma : Home�home:pictograma
enlace interno : /?plug=myplug�name_of_plug','css'],"template"=>['affiche une vid�o','id de la vid�o'],"text"=>['articles contenant des vid�os','nb de jours(|||)'],"tracks"=>['viewer vid�o en
etiqueta, gato, prioridad
tag1|tag2 o 5-tag1|tag2 (5=tags)
prioridad-2|3|4 u 11-2|3|4 (11=prioridad)
cat-public : art�culos en\'public\' ;
cat-1 : categor�a actual',''],"twitter"=>['',''],"user_menu"=>['',''],"video"=>['',''],"video_playlist"=>['',''],"video_viewer"=>['','']];