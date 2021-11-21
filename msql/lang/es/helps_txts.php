<?php //philum/msql/helps_txts
$r=[1=>['menus_','descripci�n'],2=>['philum_pub_txt','\"[http://philum.fr/2�[phi1�32::picto]:popart] [v[:ver]�txtsmall2:css] [http://philum.fr�[philum:picto]]\"'],3=>['update_ok_alert',''],4=>['conn_help_txt;\"Principio general

Los conectores se escriben entre corchetes que contienen un\":\".
Se sit�an a la derecha y no a la izquierda por razones de optimizaci�n.
[param�option:conn]

Formato de los conectores:
- [http://url. com�palabra] : \'palabra\' adjunta a una url
- [palabra:b] : \'palabra\' en \'negrita\'
- [[http://lien.com�ejemplo]:b] o [http://lien.com�[ejemplo:b]] : los conectores tienen conectores asociados : .jpg;.mp3;.mp4;.pdf;. webm etc.

Algunos conectores aceptan m�ltiples opciones (ancho/alto):
[img. jpg�140/140:thumb]

Para mostrar un conector en la segunda instancia de un bot�n;s�lo hay que hacer:
[param�option:conn�button]

Para abrir un conector en el momento;en un men� que se pueda abrir;hay un conector especial para ello: 
-[ID:read�open:jconn]

El conector para llamar a un m�dulo (objetos de paginaci�n):
Los 4 primeros par�metros de un m�dulo son:  \"param/title/mode/option\"
M�dulo reciente para una categor�a \"public\";un t�tulo \"hello\";un modo de visualizaci�n \"panel\" y un l�mite de 10 entradas:
- [public/hello/panel/10: recents:module]

Conectores para llamar a un plugin:
Los plugs reciben s�lo un par�metro y una opci�n:
- [microarts:plug]
- [hello�1:connectors: enchufe] /aqu� la opci�n a�ade par�ntesis
- [hola�1:conectores:enchufe�bt] //pero no funciona si se sustituye \"hola\" por \"hola\": ba\" porque se interpretar� en primera instancia;y devolver� su c�digo html

Podemos llamar a un plugin a trav�s de un m�dulo:
- [microarts:plug:module]

Conector API:
[minday:14','order: id DESC','lang:all:api]

El principio de los conectores se declina en otros cuatro dispositivos:
- Las plantillas;que reciben variables prenombradas (para operaciones pesadas que requieren una alta velocidad de ejecuci�n);
- La microplantilla Vue;que puede recibir un conector [varable_name:var] y devolver resultados recurrentes (una lista de objetos);
- La l�nea de c�digo : Permite dise�ar conectores sencillos;utilizando _VAR y _OPT que provienen del comando de conectores personalizados;
- El Basic;un lenguaje de conectores concatenado (y sin corchetes);que tambi�n puede utilizarse para hacer conectores y m�dulos;utilizando los recursos de la biblioteca del Framework. \"'],5=>['shop_class;\"Esta secci�n se omite

- crea un art�culo por producto
- el m�dulo \'carrito\' muestra los art�culos a�adidos al carrito
- todos los art�culos afiliados entre s� pueden ser llamados como un array de productos si se llama al art�culo padre: [ID:tienda]
- llame a uno o a una serie de ID de tarjetas separados por coma: [123','124','125:prod]
- El conector [:form] devuelve un formulario editable.\"'],6=>['consola;\"La consola administra los datos de una tabla con el prefijo \'mod\'. Los \"mods\" contienen la estructura de los m�dulos para todo el sitio. Los m�dulos pueden ser seleccionados o intercambiados (ver Par�metros 1).

Los m�dulos se cargan en cascada (como el css) : el �ltimo borra el anterior. Las condiciones son iteraciones: home/cat/art.
Si no se especifica nada;el m�dulo en All permanece mostrado en cat y art (en la lectura de categor�as o art�culos). 

[backup/restore:b]: copia de seguridad y restauraci�n del conjunto de m�dulos (a realizar antes de trabajar en �l)
[default:b]: tabla por defecto
[refresh:b]: �til tras una modificaci�n externa (en Msql admin;o durante la fase de pruebas con el css builder abierto en otra ventana)
[test:b]: para realizar pruebas u obtener el script de un m�dulo\"'],7=>['trackbacks;\"Esperando la moderaci�n\"'],8=>['microxml;\"enviar/recibir una tabla microsql v�a Xml\"'],9=>['newhub_mail;\"�Su registro se ha realizado con �xito! 

Recuerde sus credenciales:
inicio de sesi�n: _USER
pass: _PASS

Conserva este mensaje para no perder tus credenciales
(en caso de 3 inicios de sesi�n fallidos recibir�s un email recordatorio)\"'],10=>['anchor_select;\"Seleccione la segunda parte del ancla:\"'],11=>['anchor_dbclic;\"utilizar un doble clic si la referencia ya existe\"'],12=>['anchor_manual;\"A�adir anclas al texto seleccionado (arriba y abajo)\"'],13=>['anchor_auto;\"el texto debe contener dos veces (1) o [1]\"'],14=>['published_art;\"Su art�culo ha sido publicado\"'],15=>['trackmail;\"Se ha publicado un nuevo comentario\"'],16=>['restricciones','Acceso|Contenido|Art�culos|informaci�n_art�stica|men�_de_usuario'],17=>['dise�o;\"En el modo de edici�n los cambios no son visibles para el visitante;hasta que se \"aplican\" (Apply).

El dise�o de usuario es una variaci�n del dise�o por defecto (llamado \"b�sico\") y hereda de \"_global\". css\'.

:: Guardar
- [use_design_15:b] :: aplica el dise�o sin guardar (sesi�n)
:: el m�dulo \'dise�o\' muestra el de la sesi�n;pero el dise�o real guardado aparece en la ventana de edici�n del m�dulo. 
- [save:b] :: guarda la tabla de definici�n y crea el css;sin afectar a los m�dulos actuales (a diferencia de \'Apply\')
- [backup:b] :: hace una copia de seguridad de la tabla (que se puede restaurar despu�s)
- [Apply / mods_1:b] :: hace visible el dise�o a los visitantes
- [exit:b] :: cierra la sesi�n de edici�n

: : Seleccionar
- [design:15/clrset:15:b] :: selector de tablas
- [herit:b] :: guarda los datos de otra tabla en la tabla actual (dise�o o colores)
- [new_from:b] :: crea un dise�o acorde con el actual
- [make_public:b] :: publica el dise�o en el hub p�blico
- [inform_public:b] :: actualiza la tabla p�blica del mismo nombre
- [rebuild:b] :: crea un nuevo dise�o despu�s del actual

:: Restaurar / Refrescar / Defaults
- [design;clrset:b] :: restaura la copia de seguridad
- [reset: design;clrset:b] :: utiliza las definiciones por defecto
- [append_defaults:b] :: a�ade nuevas definiciones de dise�o por defecto (no invasivo)
- [inject_globals:b] :: inyecta definiciones de dise�o globales;incluso en clases existentes (invasivo;permite el control del dise�o de los elementos del sistema)
- [refresh: saved_css;dev_css;clrset:b] :: permite ver los archivos realizados
- [92 objects:b] :: n�mero de objetos en la tabla\"'],18=>['designwidths;\"La gesti�n de la anchura permite afectar a todas las clases css relevantes.
Algunas anchuras artificiales se estiman y se almacenan en los m�dulos del sistema.
Determinan los l�mites para las im�genes y los v�deos.
Se pueden refinar mediante pruebas.

Una anchura de cero significa que ignoraremos esta columna y la eliminaremos de la lista de bloques del m�dulo;que se especifican en el m�dulo \'system\' \'blocks\'. 

Si por ejemplo cambiamos la columna de izquierda a derecha;tenemos que asegurarnos de que hay m�dulos en 

La casilla <inform_blocks> significa que el resultado se guardar� en la tabla de m�dulos;y as� los visitantes del sitio ver�n los cambios;si trabajamos en mods publicados. 

Algunos m�dulos se almacenan en cach�;por lo que a veces los efectos s�lo son visibles reiniciando el software (llamando a /hub;/?id== o /reload)\".'],19=>['designcond;\"Al iniciar una sesi�n de edici�n de dise�o se utilizan hojas css especialmente creadas (dev).
S�lo los botones \'Aplicar\' afectar�n al css utilizado por los visitantes.
El dise�o que se ofrece para editar es el actual en el momento de la navegaci�n.

Abre dos ventanas para ver los efectos de los cambios

Para apuntar a un css en un contexto;duplica el m�dulo de dise�o y especifica una condici�n para �l.\"'],20=>['formail;\"Gracias por su mensaje\"'],21=>['userforms;\"Sus datos han sido guardados con �xito\"'],22=>['fontserver;\"Esta disposici�n inyecta nuevas definiciones de tipos en la tabla \'server/edition_typos\';
ya que no se ve afectada por las actualizaciones.

Las nuevas definiciones pueden proceder de:
- actualizaciones (de \'system/edition_typos\');
- la presencia de un archivo . archivo tar en la carpeta \'/fonts\' del espacio de disco del usuario;que contiene versiones .woff;.eot y .svg del mismo tipo de letra;
- el plugin \'addfonts\' que permite importar fuentes desde la web;haciendo referencia a una clase css \'@font-face\'\".'],23=>['clbasic','\"- Las plantillas utilizan \'codeline\' que son conectores dedicados a escribir etiquetas html;
- Los conectores y m�dulos personalizados pueden escribirse en \'codeline_basic\';que permite llamar a funciones del n�cleo.
- Si un conector o m�dulo se escribe en codeline (con corchetes) el c�digo b�sico no se interpretar�.
- _PARAM es el nombre de la variable procedente del conector. Se puede procesar si hay varios subpar�metros.
- Podemos asignar variables llamadas _1;_2;etc... Corresponden a las columnas de un array.

[Sintaxis b�sica::b]

Se escribe de derecha a izquierda en una l�nea. A diferencia de los conectores;el par�metro m�s importante est� despu�s del \"�\". Su ausencia siempre significa \"no hay opci�n\").

Un designador (primer car�cter de una l�nea) permite cierto procesamiento del resultado:

[/barra: ignora la l�nea
/asigna 81 a var1 si no existe
? _1=81
/stockea <b>81</b>
+_1�b:tag
/ver: print_r
/restaura el valor
/_1
/�_1:text
/afecta y sobrescribe
!_2=_1
/visualiza la variable
-_2:code]

[ejemplos::b]

[/delar variable si est� vac�a
? _PARAM=hola

/Aplica css al par�metro recibido desde el conector:
_PARAM�txtit:css o directamente �txtit:css

/iteraci�n (primero = valor del segundo)
txtit:css�u:html

/lee la tabla
+sistema/edici�n_tiposbrowsers/�msql_read: core
/visualiza una tabla 
-make_table:core
/lee las variables 0 y 1 de una tabla:
-_1 _2:text:code]

Se proporcionan algunos ejemplos entre los conectores;plantillas y m�dulos p�blicos. \"'],24=>['plantillas;\"Las plantillas de art�culos se pueden asignar:
- globalmente en la consola (m�dulo sistema/plantilla);
- localmente en el propio art�culo;
- o ad hoc como opci�n de comando del m�dulo \'art�culos\'.

Para las plantillas distintas de la plantilla de art�culos;se debe habilitar la restricci�n 55 \'plantillas de usuario\';y guardar una versi�n modificada de la plantilla por defecto;del mismo nombre. 
En ausencia de una plantilla de usuario;el software buscar� una plantilla p�blica antes de referirse a la predeterminada.

Si la restricci�n de \'plantillas de usuario\' (55) est� activada;la m�quina buscar� la plantilla de usuario y luego la p�blica;antes de utilizar la predeterminada. Para evitar que una plantilla p�blica anule la predeterminada;basta con guardar la predeterminada para que sea una plantilla de usuario.\"'],25=>['track_follow;\"Especifica una direcci�n de correo electr�nico para recibir otros comentarios\"'],26=>['track_captcha;\"copiar el c�digo aqu�\"'],27=>['update_ok;\"El software est� actualizado\"'],28=>['update_help;\"Si se produce un error;descargue la imagen completa del instalador\"'],29=>['upload_folder;\"selecciona el directorio donde subir el documento;
para subir un directorio de im�genes s�lo tienes que contenerlas en un archivo .tar\"'],30=>['bool;\"M�todo booleano: resultados comunes para cada b�squeda de palabras\"'],31=>['dev;\"El directorio /progb contiene una copia del programa. Debe cambiar al modo dev (/?dev=dev) para que los cambios surtan efecto.
\'2prod\' copia los archivos de /progb a /prog. (los archivos deben tener permiso suficiente)\".'],32=>['blocksystem;\"El bloque \'system\' no se considera un Div (un elemento del dise�o).
Define la configuraci�n global. Algunos m�dulos son cr�ticos\".'],33=>['import_art;\"URL del art�culo a importar\"'],34=>['public_design;\"Esto afectar� al dise�o visible p�blicamente\"'],35=>['m�dulos','\"- contenido: destinado al div de contenido principal;
- multi: puede mostrarse en todas partes m�ltiples veces;
- una vez: s�lo puede mostrarse una vez (los m�dulos ya en uso ya no se muestran);
- conectores: accesos directos a los conectores;
- art�culos: afiliados al art�culo actual;
- usuario: m�dulos de usuario\"'],36=>['rssurl_1;\"Devuelve los art�culos recientes de los feeds rss de los que estamos seguros de querer extraer todos los art�culos. S�lo se ven afectados los feeds marcados con 1 en la columna \'bot\' de la tabla \'rssurl\'.
La operaci�n deja de buscar en el primer art�culo reconocido de cada feed.
\"'],37=>['palabras;\"Palabras conocidas ordenadas por relevancia\"'],38=>['book;\"par�metro m�ltiple [',']: 
- script de llamada al art�culo; 
- lista de IDs [ ];
4 opciones [/]:
- el t�tulo del libro;
- 1= ID creciente;2= orden inverso;
- una plantilla de formato (\'book\' por defecto);
- una plantilla de portada (\'book_cover\') : 

ex: [cat=public~nbdays=30','412 413 414�hello/2/book:book]

Para crear una lista de IDs es posible utilizar el plugin \'favs\' colocado en un m�dulo;que propone exportar la lista;\"'],39=>['call_arts;\"Par�metros del script de llamada de art�culos:
- cat: categor�a 
- nocat: categor�a a excluir
- tag: (especificar)
- notag: etiqueta a excluir
- nbdays: \'30-60\' de 30 a 60 d�as
- lasts: \'0-10\' �ltimos 10 art�culos
- preview: \'true/false/full\' modo de visualizaci�n
- priority: nivel de prioridad (1 a 4)
- nopriority: nivel de prioridad a excluir (1 a 4)
- lenght: \'<4000\' menos de 4.000 caracteres\"'],40=>['htaccess;\"Si el c�digo que se ejecuta es el mismo que el predeterminado;entonces no hay que hacer ninguna actualizaci�n.

Compruebe que el archivo \'.htaccess\' en la ra�z tiene suficientes permisos.
El archivo . El archivo htaccess est� dise�ado para hacer que la barra de direcciones sea una consola de comandos de actividad.
Compruebe las definiciones de htaccess espec�ficas de cada servidor.
- infomaniak : php_flag a \"allow_url_fopen\" a \"Ona\"
php_flag a \"allow_url_include\" a \"Ona\"'],41=>['favs;\"El icono de \"Me gusta\" en los men�s de los elementos le permite a�adirlos a Favoritos.
 Las colecciones pueden reunirse en un Libro\".'],42=>['pictos;\"Lista de pictogramas en el sistema;debido al tipo de letra \'philum\'.

Las asignaciones reciben un conector;que especifica la naturaleza del icono;un tipo de letra;una imagen o un objeto vectorial svg. 
(los iconos existentes son visibles en el editor)\"'],43=>['finder;\"Finder permite navegar por las carpetas;compartir archivos y asignarles un directorio virtual. 
El directorio virtual permite generar directorios p�blicos; <servidor/archivoscompartidos> es llamado por otros sitios Philum;

- disco: directorios de usuario
- compartido: archivos compartidos:
-- local: por usuario
-- global: por centros de servidores
-- remoto: por red de sitios Philum

- lista: lista desplegable
- panel: lista por directorios
- iconos: modo escritorio
- solapa: directorios a la izquierda;archivos a la derecha

- virtual/real: directorios reales o virtuales
- picto/mini: uso de picto o miniaturas
- actualizaci�n: informa a la tabla \'server/shared_files\'.\"'],44=>['comline;\"L�nea de comandos: algunos m�dulos utilizan un comando de m�dulos como par�metro (MenusJ;Apps;el conector \':module\')\".'],45=>['mod_cond;\"contexto por defecto: (nada);home;cat;art
[0-9]: contexto de un art�culo espec�fico (ID)
[a-z]: contexto de una categor�a existente
[a-z]: contexto activado por url /contexto/nombre\"'],46=>['updfonts;\"Despu�s de descargar un tipo de letra hay que ir a admin/fonts y hacer un \'inject\'; esto consiste en descomprimir el archivo;instalarlo e informar de su existencia a la tabla de tipos del servidor;que no se ve afectada por las actualizaciones;a diferencia de la del sistema\".'],47=>['updpictos;\"El sistema necesita pictogramas;necesitas descargar la fuente \'philum\' en la pesta�a \'pictos\'\"'],48=>['breadcrumb;\"El Breadcrumb obtiene el nombre de la categor�a;el n�mero de art�culos y;si es necesario;la topolog�a a la que pertenece el art�culo. 
La restricci�n Access/user_template (55) permite utilizar la plantilla denominada \'titles\' para controlar el orden y la apariencia.\"'],49=>['login;\"log-in / new user\"'],50=>['mail_article;\"enviar art�culo por correo\"'],51=>['log_no;\"nombre de usuario requerido\"'],52=>['log_nopass;\"contrase�a incorrecta\"'],53=>['log_nohub;\"no es posible el registro\"'],54=>['log_newser;\"Registro como nuevo usuario;nivel:\"'],55=>['empty_msg;\"mensaje vac�o\"'],56=>['meta_related;\"IDs de art�culos separados por un espacio\"'],57=>['newsletter_ok;\"Bolet�n enviado con �xito\"'],58=>['newsletter_ko;\"sin resultado\"'],59=>['newsletter_uns;\"unsubscribe\"'],60=>['conn_pub;\"Los conectores sustituyen al html para ahorrar espacio y permitir la escritura de comandos para las aplicaciones\"'],61=>['b�squeda;\"Botones:
- puntuaci�n: clasificaci�n por cantidad de resultados
- segmento: palabra entera
- booleana: m�ltiples palabras (separadas por un espacio)
- lang;cat;tag: incluir o excluir palabras relacionadas (metas)
- l�mite: n�mero m�nimo de ocurrencias (distingue entre may�sculas y min�sculas)

Pistas:
- b�squeda vac�a: se refiere s�lo a los par�metros
- id: el id de un art�culo lo abre inmediatamente
- fecha: art�culos anteriores a Y-m o Y-m-d: \"2000-01\"
- Bot�n \'del\': borra la cach�
- \'1\' devuelve el �ltimo art�culo publicado
- Bot�n \'fast-forward\': b�squeda continua en otros campos de tiempo hasta que se encuentre una respuesta (si esta opci�n est� activa)
- script de la API;(utilice un \':\' y un \'','\') ex:  \"search:word1|word2','avoid:word3','cat:Justice','tag:justice|injustice\"
- fecha precisa (API): N - \"fecha:1967\";o \"fecha:-08-15\" (cada 15 de agosto)\"'],62=>['defcons;\"Las definiciones de importaci�n del sitio son puntos de anclaje donde comienza y termina la copia de las partes que nos interesan en la p�gina.

Son el t�tulo y el cuerpo del texto;y opcionalmente una tapa. 
Si no se especifica el punto de salida se elegir� el final normal de la etiqueta (puede que no funcione).

Un post-proceso permite eliminar la primera l�nea;el t�tulo;un enlace o una l�nea o enlace que contenga una palabra clave;o destruir etiquetas.\"'],63=>['apps;\"la restricci�n 61 est� activada: se carga el men� de Apps por defecto (system/default_apps);sus definiciones se a�aden a �l y pueden anular las existentes\".'],64=>['apps_add;\"Aplicaciones predefinidas: todos los par�metros se pueden cambiar (icono;nombre;objetivo;funci�n).
�El bot�n \"actualizar\" reemplazar� todas tus aplicaciones! (hacer copias de seguridad)
el men� permite elegir otras tablas m�s especializadas\"'],65=>['trackhelp','\"- urls;im�genes y v�deos (youtube etc...) se interpretan autom�ticamente
- enlace a un art�culo: 1234:pub (devuelve el t�tulo) o 1234�word
- 123:track permite una llamada al comentario 123
- :web muestra un enlace + t�tulo + imagen del enlace
- #public: llama al canal \'p�blico\' del chat\"'],66=>['sugieren;\"Puede importar el contenido de la web desde la url del art�culo;se intentar� mostrar una vista previa. No se preocupe si la p�gina no se muestra correctamente.

El campo de correo permite a�adir un \"Sugerido por [prefijo de correo]/\". Se le notificar� cuando se publique.

�Gracias por su contribuci�n!\"'],67=>['suggest_ok;\"Su art�culo ha sido publicado\".'],68=>['console_cond;\"Los m�dulos (elementos de la p�gina) pertenecen a un [context:b]. Por defecto;lo son: N - \"casa\";\"gato\" (para una categor�a de art�culos) y \"arte\" (lectura de un art�culo). Uno puede crear contextos personalizados;declinados de gato y arte.

As� que cuando uno llama a la p�gina /contexto/nombre se muestran todos los m�dulos que pertenecen al contexto \"nombre\".

El contexto de un m�dulo se define en la edici�n de cada m�dulo. Si un m�dulo va a aparecer en varios contextos;deben crearse tantos m�dulos id�nticos como sea necesario;utilizando el bot�n \"nuevo\".\"'],69=>['console_mods;\"El men� [mods:b] s�lo afecta a la sesi�n actual. Para que los efectos surtan efecto para el visitante;debe aplicarse;para que el n�mero de versi�n de la tabla de m�dulos est� en [config/param/modules_table:l]\".'],70=>['scripts;\"param/title/command/option/cache/hide/template/br:module�button[',']\"'],71=>['video;\"Youtube;Dailymotion;Vimeo;Rutube\"'],72=>['popvideo','\"- opci�n �1: lanzar el v�deo en su lugar 
- opci�n �440/320: anchura/altura\"'],73=>['pdf;\"El lector de PDF de Google requiere que est�s conectado\"'],74=>['art_render;\"El modo de representaci�n del art�culo se define en las restricciones 5 y 41 (config arts);y puede ser anulado por una de estas configuraciones: false;preview;full;read;auto\"'],75=>['desklr;\"desktop attributes:
top','#_4','#_2
to bottom','#002594','#06999e','#878787','#bf1755','#4f004f
philum/photo/space/crabhubble.jpg
philum/photo/space (random img from folder)\"'],76=>['submod_types;\"submodule types: mod plug art msql link finder ajax admin\"'],77=>['chatxml','\"- ChatXml funciona entre servidores Philum (servidor de llamada: \'admin/params\')
- el bot�n \'live\' refresca el chat cada 4 segundos
- el primer mensaje sigue siendo el primero publicado
- un chat nombrado como hub permite al administrador de ese hub borrar todos los mensajes
- s�lo se cargan las �ltimas 20 entradas\"'],78=>['chatcall','\"_NAME te invita a chatear\"'],79=>['miniconn;\"Sintaxis de miniconn:
- los enlaces;im�genes;v�deos;audios y pdf se hacen cross-server
- http://site. com�palabra = enlace a una p�gina (muestra la palabra)
- 1234:pub = llama al art�culo 1234 en una ventana emergente (v�a Mxml)
- 1234�palabra = llama al art�culo 1234 en una ventana emergente (muestra la \'palabra\')
- canal: room = enlace a un canal
- name:twitter = abre un feed Rss de Twitter
- words bold:b italic:i underline:u;(q;h;l;k)
- soporta conectores (restringidos): [param�opci�n:conector]\"'],80=>['artstats;\"Las estad�sticas de los art�culos s�lo son visibles despu�s de ser vaciadas (cada 24 horas)\"'],81=>['track_orth;\"Ortograf�a: 
- infinitivo \'er\' en lugar de \'�\' cuando se puede sustituir el verbo por otro del tercer grupo como \'tomar\'
- conjugaci�n: el verbo concuerda con el sujeto (cuidado con �;�s �es)

Reglas tipogr�ficas: 
- espacios despu�s de una coma;no antes; excepto el punto y coma: y los dos puntos;pero no en (par�ntesis) o en \"comillas\". \"'],82=>['tracks_error1;\"Captcha rellenado incorrectamente\"'],83=>['tracks_error2;\"Por favor;introduzca un nombre\"'],84=>['tracks_error3;\"Mensaje vac�o\"'],85=>['retape;\"Los conectores obsoletos han sido reemplazados\"'],86=>['prmb5;\"El par�metro \'auto_design\' (5) est� activo: anula el dise�o del usuario\"'],87=>['flog;\"Recuerda tu n�mero de ficha para encontrar tus datos\"'],88=>['memstorage;\"El contenido se almacena en las variables locales de su navegador y s�lo es accesible por usted\"'],89=>['blockmenu;\"El bloque \'menu\' tiene un css particular que le permite manejar adecuadamente los men�s presentados en ul<li\"'],90=>['bloctest;\"no muestra;permite probar m�dulos\"'],91=>['ftext;\"el contenido y la edici�n son p�blicos\"'],92=>['first_user;\"Crear cuenta de administrador\"'],93=>['nuevo_usuario;\"Crear cuenta\"'],94=>['meta_lang;\"ID de las versiones en otro idioma\".'],95=>['tracks_moderation;\"los comentarios son moderados\"'],96=>['twitter_oAuth;\"Configuraci�n de la autenticaci�n para la API twitter 1.1 (https://developer.twitter.com/)\"'],97=>['tag_rename;\"Renombrar una etiqueta;si ya existe;la destruir� y asociar� las publicaciones con la etiqueta existente\"'],98=>['usertags;\"A�ade etiquetas a este post y encu�ntralas en tus favoritos.
Las etiquetas de usuario son p�blicas\".'],99=>['api;\"La API permite una ordenaci�n compleja a trav�s de un comando.
- /module/api/{command}: mostrar resultado
- /api/{command]: abrir feed de datos en json\"'],100=>['como;\"Los likes son p�blicos\"'],101=>['overcats;\"Una sobrecategor�a puede existir con un campo vac�o;en cuyo caso la categor�a aparece en la ra�z\".'],102=>['overcats_menu;\"Overcats puede ser usado como un m�dulo;como un men� de administraci�n;o como un objeto de escritorio;usando una App con params type=desktop y process=overcats\"'],103=>['menubub_edit;\"tipos de menubub: 
- (sin tipo): int�rprete (a-z) = categor�a;(0-9) = art�culo;/m�dulo/... = enlace
- m�dulo: abre el contenido de un m�dulo (ej: ///l�neas/4///1:categor�as )
- enchufe: (abre un enchufe)
- ajax: (ej: popup_track___admin)\"'],104=>['spitable;\"Uno nunca puede dibujar realmente un �tomo. Una representaci�n gr�fica de la realidad s�lo tiene en cuenta un n�mero de par�metros.

En esta tabla podemos ver coronas y subcoronas.
Cada subcorona expresa una familia qu�mica.
Cada corona contiene un n�mero de subcoronas igual al rango de la corona (1:1;2:2;...).

Cada �tomo est� representado por su configuraci�n electr�nica. Lo m�s frecuente es que el n�mero at�mico se corresponda con la posici�n del �ltimo electr�n de ese �tomo.

El n�mero de localizaciones de cada subcorona se incrementa en 4 en cada subcorona.

El inter�s de esta representaci�n es resaltar el hecho de que las subcoronas son reveladoras de las familias qu�micas a las que pertenecen los �tomos representados en ellas. 

La periodicidad (espiral) de los elementos queda as� definida por un algoritmo muy simple (utilizado para dibujar las cajas).
Se puede ver que la construcci�n producida por este algoritmo permite un crecimiento infinito.

Las anomal�as respecto al algoritmo de llenado electr�nico se se�alan gr�ficamente;para visualizar la configuraci�n electr�nica real de cada �tomo.\"'],105=>['fav_fav;\"Art�culos favoritos\"'],106=>['fav_tags;\"Art�culos referenciados por una etiqueta\"'],107=>['fav_com;\"Configuraci�n de la generaci�n de piensos\"'],108=>['fav_poll;\"Art�culos votados\"'],109=>['fav_visit;\"Mensajes visitados\"'],110=>['fav_shar;\"Mensajes compartidos\"'],111=>['fav_edit;\"Api script\"'],112=>['fav_like;\"Mensajes favoritos\"'],113=>['levenshtein;\"utiliza el algoritmo de la distancia Levenshtein\"'],114=>['estudio;\"le permite crear un estudio de texto;frase por frase\".'],115=>['tlex;\"Publicar en Tlex: a�adir la oAuth de Tlex Api a la tabla users/(hub)_tlex
Puede haber varias cuentas\".'],116=>['twit;\"T�rminos y condiciones de uso: la informaci�n obtenida no debe ser utilizada con fines comerciales o de da�o f�sico o moral.
Pol�tica de privacidad: la informaci�n obtenida no puede ser transmitida sin el permiso de las personas involucradas.
\"'],117=>['meta_habilidades;\"Habilidades delegadas a los usuarios\"'],118=>['umrennum;\"Renumerar los art�culos por fecha y ordenar los favoritos;los retweets y el estado\"'],119=>['search_cases;\"Haga clic varias veces en el men� meta (lang','cat','tag) para:
- incluir exclusivamente 
- excluir 
- no tener en cuenta (por defecto)
la(s) palabra(s) vinculada(s)\".'],120=>['star;\"ejemplo 1;con dc (declinaci�n);ra (ascensi�n recta) y dist (grados y AL):
dc > -23.432;dc < -21.82;ra > 255.25;ra < 270.83;dist < 100

ejemplo 2;una lista de estrellas con nombre (hip por defecto):
HD 150680;hd150680;hip 99461;88601;2021\"'],121=>['gaia;\"ejemplo 1;con dc (declinaci�n);ra (ascensi�n recta) y dist (grados y AL): 
dc > -23.432;dc < -21.82;ra > 255.25;ra < 270.83;dist < 100

- una lista de estrellas nombradas por su id de Gaia (n�mero de 19 d�gitos) separadas por un espacio\"'],122=>['umrec','\"- Para llamar a un post concreto:
http://oumo.fr/context/compile/O6-144
- Para incrustarlo en una p�gina web a trav�s de un iframe (utilizar el id):
http://oumo.fr/plug/umrec/1464
- Desde el editor (art�culo o comentarios):
[1464:umcom:on] muestra el bloque
[1464�1:umcom:on] muestra un enlace al bloque\"'],123=>['mercury;\"Lector web universal:
permite leer el contenido en bruto de una p�gina web.
Usa la API Mercury. Si su sitio no lo cumple;es mejor que lo cumpla\".'],124=>['mercurykey;\"Admin: add api_key (mercury.com) to mercury table;row 1 column 0\"'],125=>['searchlang;\"b�squeda multiling�e\"'],126=>['umsearchlang;\"b�squeda multiling�e\"'],127=>['not_published;\"Art�culo no disponible\"'],128=>['tablas;\"Separadores: 
- columnas:||\" o comas
- filas:  \"�\" o avance de l�nea\"'],129=>['menubub;\"N�mero de mesa del men�\"'],130=>['tweetfeed;\"transmisi�n de Twitter\"'],131=>['tweetfeed_help;\"Utilizar s�lo uno o m�s m�dulos \'api_arts\';
la clave de twitter utilizada es la #4\"'],132=>['prop�sito;\"A�adir y votar las propuestas; s�lo puede eliminar su entrada en el d�a actual\".'],133=>['nodos;\"Esto crear� una nueva capa de Hubs (un Nodo).
 URL del nodo: /?qd=nombredelnodo
Escribe $qd=\"pub2\"; en _connectx para asignar un nombre de dominio al nodo \"pub2\".\"'],134=>['updatenotes;\"actualizar notas\"'],135=>['lastupdate;\"�ltima sincronizaci�n a partir de\"'],136=>['softwareupdated;\"El software ha sido actualizado\".'],137=>['softwarever;\"versi�n local\"'],138=>['softwaredist;\"versi�n remota'],139=>['updatedetails;\"detalles de la �ltima actualizaci�n'],140=>['updateno;\"Este servidor no est� configurado para recibir actualizaciones\"'],141=>['cookie;\"La cookie llamada \"iq\" contiene su id de IP;lo que nos permite considerar un solo visitante aunque su IP cambie. Ver [privacy:help�data privacy policy]\".'],142=>['privacidad;\"El sitio no utiliza ni revende ning�n dato relacionado con los visitantes;a excepci�n de las estad�sticas de tr�fico del sitio.
Toda la actividad del sitio se elimina cada a�o por t�rmino medio\".']];