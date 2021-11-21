<?php
//philum_microsql_program_coreb
$program_coreb["_menus_"]=array('function','variables','usage','return','context','input','output');
$program_coreb["1"]=array('p','r','print_r','echo array','utils');
$program_coreb["2"]=array('br','','new line','xhtml new line <br />','html');
$program_coreb["3"]=array('hr','','trace an hozontal line','<hr>','html');
$program_coreb["4"]=array('hrb','c','trace an hozontal line using class c','<hr>','html');
$program_coreb["5"]=array('dlien','c/l/t','class link text','a href in a div','html');
$program_coreb["6"]=array('blien','c/l/t','class link text','a href inside a span','html');
$program_coreb["7"]=array('llien','c/l/t','class link text','a href inside a li balise with class','html');
$program_coreb["8"]=array('slien','l/t','simple link and text','a href','html');
$program_coreb["9"]=array('lient','c/l/t','class link text','a href opening a new window','html');
$program_coreb["10"]=array('lien','c/l/t','class link text','a href with class','html');
$program_coreb["11"]=array('lienb','c/l/t','class link text','a href in a span with class','html');
$program_coreb["12"]=array('lienjx','c/call/jav/t','class argument_called for javascript javascript_function text','a link for ajax called in javascript','html');
$program_coreb["13"]=array('lienj','c/call/jav/t','class argument_called for javascript javascript_function text','a link for ajax called onClick','html');
$program_coreb["14"]=array('liensubmit','c/call/t','class argument_called for javascript of the current form action ;text','ajax button for a form','html');
$program_coreb["15"]=array('btn','c/t','class txt','span balise','html');
$program_coreb["16"]=array('div','a/v','a=attributs value','balise div','html');
$program_coreb["17"]=array('divc','c/t','c=class value','balise div','html');
$program_coreb["18"]=array('divd','c/t','id value','balise div','html');
$program_coreb["19"]=array('bal','b/c/t','b=balise c=class t=text','balise html','html');
$program_coreb["20"]=array('image','v/w/h','image width height','html embed image','html');
$program_coreb["21"]=array('relod','v','reload to a page','javascript immediately applied','html');
$program_coreb["22"]=array('hostname','','give the ip of current user','REMOTE_ADDR','utils');
$program_coreb["23"]=array('br2nl','tx','string with <br /> <br> <br/>','delete /n and replace <br> by /n','html');
$program_coreb["24"]=array('ifcss','v/vrf/csa/csb','good css csa or csb for v if vrf=v','choosen class','utils');
$program_coreb["25"]=array('attrb','d/v','make html attribute','$d.\'=\"\'.$v.\'\"\'','html');
$program_coreb["26"]=array('nms','d','number of the nomination','nominations (helps_nominations)','builders','','');
$program_coreb["27"]=array('ses','d','call session from his name','','utils','','');
$program_coreb["28"]=array('rcptb','db','show tables','mysql_query','database');
$program_coreb["29"]=array('lstrc','rq','make array from range 0 in mysql_fetch_array','array','database');
$program_coreb["31"]=array('qr','req','used by rse() and ser()','mysql_fetch_array','database');
$program_coreb["32"]=array('msq','ph/bz','build sequence for res() from ph=SELECT attributs and bz=WHERE attributs','formated string','database');
$program_coreb["33"]=array('res','ph/bz','ph=asked columns bz=where condition','object mysql_fetch_array','database');
$program_coreb["34"]=array('ser','ph/bz','multiple datas of an entry in ph where bz','simple array to use in list($a,$b)=ser($ph,$bz)','database');
$program_coreb["35"]=array('rse','ph/bz','ph=asked column bz=where condition','string result','database');
$program_coreb["36"]=array('sre','ph/bz','results of a query SELECT ph WHERE bz :: the results are in the key and value give number of occurences found for the key','formated array :: $ret[$ph]=number','database');
$program_coreb["37"]=array('srf','pha/phb/bz','results of a query SELECT pha,phb FROM bz :: key=pha receive arrays with value= (result of) phb','formated array :: $ret[$pha][]=$phb','database');
$program_coreb["38"]=array('savething','sql','mysql query','id of the new entry','database');
$program_coreb["39"]=array('update','bs/in/v/col/id','UPDATE bs SET in=v WHERE col=id','nothing (and no error)','database');
$program_coreb["40"]=array('delete','bs/id','delete in bs where id','nothing','database');
$program_coreb["41"]=array('reflush','bs','ALTER TABLE bs ORDER BY id :: used bu delete(()','nothing','database');
$program_coreb["42"]=array('req','f/a/b/c/d','public database calling function=f select=a inb wherec is equal to d','result depend of user function in $f','database');
$program_coreb["43"]=array('plurial','r','r=array of objects','letter "s" if $r>1','utils');
$program_coreb["44"]=array('prep_input','r','parameters used by balise(()','array','builders');
$program_coreb["45"]=array('balise','b/r/t','b=balise r=attributs t=text :: 
attributs_rule : array(\"id\"=>1,5=>\'txtx\')
where key=html_attribut=>value
numerical code of attributs is : 
array(1=>\"type\",2=>\"name\",3=>\"id\",4=>\"value\",5=>\"class\",6=>\"size\",7=>\"maxlenght\",8=>\"onKeyPress\",9=>\"cols\",10=>\"rows\",11=>\"wrap\",12=>\"action\",13=>\"method\",14=>\"for\",15=>\"onchange\",16=>\"style\")','html balise from an array of attributes','html');
$program_coreb["46"]=array('inputcreate','t/n/v','type name value','balise input','html');
$program_coreb["47"]=array('inputcreate2','t/n/v/css','type name value class','balise input','html');
$program_coreb["48"]=array('input','t/d/v/c','1/0=text/hidden d=ID v=value c=class','input text for forms','builders','','');
$program_coreb["49"]=array('txarea','n/t/cl/rw','n=name t=text cl=cols rw=rows','very famous used to create textarea','html');
$program_coreb["50"]=array('txarea1','msg/idy','msg=text and idy=edit tracks or arts :: formated textarea used for edition and callable from ajax','sophisticated textarea','builders');
$program_coreb["51"]=array('formcreate','go/fll','create a form callin the url go and containing fll','balise form','html');
$program_coreb["52"]=array('autoclic','name/valu/size/maxlenght/css','input text auto-hide content','balise input with javascript','html');
$program_coreb["53"]=array('goodarea','v/id/css/jv/n','jv=javascripts n=size or cols','balise input text or a textarea','html');
$program_coreb["54"]=array('label','id/c/s/t','','','','','');
$program_coreb["55"]=array('checkbox','name/val/label/chk','chk=0/1 if checked','checkbox for a form','html');
$program_coreb["56"]=array('imgform','here/cl/oth/ttl','here=url to call cl=class oth=text ttl=title attribut (on rollover)','upload form','html');
$program_coreb["57"]=array('menuder','list/here','list of options with ckecked range, child of slctmenuder()','sorted options values for select balise','html');
$program_coreb["58"]=array('slctmenuder','list/here','create a form with a list of values who call a page as soon a value is selected :: need pagup() and use menuder()','form for menu in javascript','builders');
$program_coreb["59"]=array('batch_defil','r','array','string: <option>$k</options>','html');
$program_coreb["60"]=array('menuder_form','r/d','call batch_defil() with r (options) and name the select input d','input select','html');
$program_coreb["61"]=array('batch_defil_kv','r/here/kv','=array =value of a key of the array kv=usage of the values of the array :
kk=use and echo k;
kv=use k and echo v;
vv=use and echo v;
vk=use v and echo k
-- used by menuder_form_kv','string: <value>$k</value> <option>$v</options> with a checked value','html');
$program_coreb["62"]=array('menuder_form_kv','r/d/here/kv','build option calling batch_defil_kv() knowing here=selected value and kv=key or value to use for value and title of the options','input select','html');
$program_coreb["63"]=array('input_with_suggest','i/id/r/default','i=first paraam of js id=second param for js r=list of words default=saved value','classical input with suggestions loaded is javascript','builders');
$program_coreb["64"]=array('on2cols','r/w/p','r is an array with key=label and value=content, w=total width, with of labels=1/p','table in divs','builders');
$program_coreb["65"]=array('scroll','obj/txt/nb','obj=array used to build txt, nb is the limit for create a scrool','div with ovrflow if needed','html');
$program_coreb["66"]=array('headers','title/css_out/css_in/javs','title of page css_url css stylsheets javascript balises','headers','html');
$program_coreb["67"]=array('meta','d/v/c','meta d=v and content=c','balise meta for header()','html');
$program_coreb["68"]=array('css_spe','d','d=css url','balise style for header with link to a specific page of css','html');
$program_coreb["69"]=array('javs_spe','d','literal javascript code for headers via javs','balise script','html');
$program_coreb["70"]=array('css_in','d','d=css code','balise style for header with css inside','html');
$program_coreb["71"]=array('javs_in','d','build javascrip from link for headers via javs','balise script','html');
$program_coreb["72"]=array('popup','','let MM_openBrWindow opening popup','javascript for header()','html');
$program_coreb["74"]=array('pagup','f','javascript calling a new page from the value of selected option','javascript for header()','html');
$program_coreb["75"]=array('MM_jumpMenu','targ/selObj/restore','','','','','');
$program_coreb["76"]=array('temporize','name/func/p','name of the function, func=content, p=milliseconds :: temporize() will call a javascript cuntion every p seconds','javascript','mecanics');
$program_coreb["77"]=array('".$name.$i."','','','','','','');
$program_coreb["78"]=array('make_tables','titles/datas/csa/csb','datas=array of arrays, csb is only for the first range, if it is present in titles','balise table','builders');
$program_coreb["79"]=array('make_table','datas/csa/csb','datas=array of arrays, csb is only for the first range','balise table','builders');
$program_coreb["80"]=array('slct_menus','r/lk/vf/cs1/cs2/kv','r=array (keys will be used) lk=link (like /?var=) vf=verif (var) cs1=active cs2=normal css kv=k or v: use key or value','list of links with detection of activated ','builders');
$program_coreb["81"]=array('slct_menus_tags','r/lk/vf/ct/csa/kv','r=array lk=link (like /?var=) vf=verif (var) ct=if nb is called, render also the number of occurences) cs1=css (use active class if detect var) kv=k/v: use key or value','list of links under li balise with detection of activated ','builders');
$program_coreb["82"]=array('slctmenusj','r/lk/vf/cal','r=array (keys will be used) lk=link (like /?var=) vf=verif (var) cal=javascript to call','list of links in javascript with detection of selected','builders');
$program_coreb["83"]=array('mkdir_r','u','build directories topology from a string like dir1/dir11/dir111','nothing','directories');
$program_coreb["84"]=array('rmdir_r','j/k/v/io','','','','','');
$program_coreb["85"]=array('write_file','f/t','file_url text to save in f','save file on server','mecanics');
$program_coreb["86"]=array('read_file','f','open datas from fil f','text','directories');
$program_coreb["87"]=array('recup_fileinfo','doc','file','formated date and size of a file','utils');
$program_coreb["88"]=array('scrut_dir','dr','explore the files of a directory recursively','multidimensional array','directories');
$program_coreb["89"]=array('scrut_dir_only','dr','detect only the directories (not recursive)','array of directories','directories');
$program_coreb["90"]=array('scrut_files_only','dr','explore the files of a directory (not recursive)','array of files','directories');
$program_coreb["91"]=array('func','d/k/v/n',"it's an example of func() used  by explode_dir()",'string for array built by explode_dir()','mecanics');
$program_coreb["92"]=array('explode_dir','r/j/func','used after scrut_dir() in obtain_from_dir()','array of files in $j directory applied to the function $func','directories');
$program_coreb["93"]=array('obtain_from_dir','dr/func','call scrut_dir() with dr and explode_dir() knowing func','array of result of the function $func on the files found recursively in drectory $dr','directories');
$program_coreb["94"]=array('gz_create','f/fb','file_url bz_name of the compressed archive','store a bz archive','builders');
$program_coreb["95"]=array('gz_write','d/f','bz_url file_name of the decompressed archive','store a file from a bz archive','builders');
$program_coreb["96"]=array('w','d','','','','','');
$program_coreb["97"]=array('witch_quote','v','choose witch sort of quote to protect by slashes :: used only by dump()','formated $v','microbases');
$program_coreb["98"]=array('create_page','t/p','t=content p=name of base','final step for build a msql table before to write it','builders');
$program_coreb["99"]=array('dump','r/p',"array of arrays and name of node like 'hub_table'",'prepared values for create_page()','microbases');
$program_coreb["100"]=array('plug_motor','base/nod/defsb','call a microtable base/nod or create it using _menus_ defsb','array of arrays','microbases');
$program_coreb["101"]=array('auto_menus','r','r=array of any key of a msql_array (an array)','generated array of _menus_ range in a msql_array','builders');
$program_coreb["102"]=array('save_vars','base/nod/defs','save microtable: directory table defs=array of arrays','nothing','microbases');
$program_coreb["103"]=array('msql_dir','','','','','','');
$program_coreb["104"]=array('modif_vars','base/nod/arr/k',"  (like hub_table) =array of arrays ='add' / 'push' / 'del' / value (optionnal)",'the modified microtable with $arr','microbases');
$program_coreb["105"]=array('msql_modif','dr/nod/defs/dfb/act/n','','','','','');
$program_coreb["106"]=array('msql_save','base/nod/defs/dfb','save array of arrays defs in base/nod adding dfb as _menus_  :: resolve root problems','nothing','microbases');
$program_coreb["107"]=array('msql_read','dr/nod/in','directory nod=table i=range (optionnal) :: resolve root problems','array of a table 
or a part of it 
or only the value there is only one range','microbases');
$program_coreb["108"]=array('msq_select','dr/qb/nd',"select microbases in directory  from user  and table= (in 'bs_') if theses tables are numeroted",'array of needed tables from selection','microbases');
$program_coreb["109"]=array('msq_tri','r/n/vrf','','','','','');
$program_coreb["110"]=array('msq_cat','r/n','','','','','');
$program_coreb["111"]=array('msq_reorder','r','','','','','');
$program_coreb["112"]=array('prep_read_msql','b/d','treatable datas from a microtable where range 0 is used as a key containing an array with all occurrences of key (sort by range 0)','sorted array','microbases');
$program_coreb["113"]=array('copy_msql','da/na/db/nb','da=directory of a na=node of a db=directory of b nb=node of b','duplicate a msql base using a name (db/nb.php)','microbases');
$program_coreb["114"]=array('call_plug','func/param/id','','','','','');
$program_coreb["115"]=array('define_mods_cond','vl','vl=table of modules','structure of blocks to build for the current condition','builders');
$program_coreb["116"]=array('pecho_arts','id','call informations about article id in cache if possible or in database','array: day,frm,suj,img,nod,thm,lu,re,host,mail,ib','utils');
$program_coreb["117"]=array('read_msg','d/m','','','','','');
$program_coreb["118"]=array('find_id','id','give id of an article called by unkwonw parameter as title, id, or "last"','id of existing and published article','builders');
$program_coreb["119"]=array('last_art','','most recent article','id of a published article','database');
$program_coreb["120"]=array('id_of_suj','id','use title of an article','return id of article','database');
$program_coreb["121"]=array('tri_tag','v',"basic action of tri_tags() :: explode  by ',' and trim it, used for tags",'array from string','mecanics');
$program_coreb["122"]=array('tri_tags','r','convert all values or tha array r (containing tags with commas) in an array of tag in key, and number of occurences in value','formated array','mecanics');
$program_coreb["123"]=array('count_art','suj/frm','suj=title of article frm=category','number of published articles found','database');
$program_coreb["124"]=array('forbidden_img','nnm','eradic words containing one of masks specified in admin/config/params/21 forbidden_images','formated string','builders');
$program_coreb["125"]=array('which_ext','v','give the extension in v','formated string','mecanics');
$program_coreb["126"]=array('is_image','doc','verify if doc is an image','true','mecanics');
$program_coreb["127"]=array('recup_mails_tosend','base','list of mails of published trackbacks in an article base ','nothing (echo success results)','builders');
$program_coreb["128"]=array('data_val','v/id/cat/val',"value to recuperate in 'qdd' where id, cat and val are known - use rse()","value from mysql - specific to mysql table 'qdd' (datas)",'database');
$program_coreb["129"]=array('read_rss','f/t/r',"system/program_functions.php=file_url =master_balise name (like 'item') =array of sub-balises (like 'title','description')",'array of arrays of an sml or rss source','builders');
$program_coreb["130"]=array('mb_detect_encoding_b','d','','','','','');
$program_coreb["131"]=array('time_ago','dt/df','php date(dt,df=timestamp) use relative time',"formated string like '2h 10min ago'",'dates');
$program_coreb["132"]=array('rss_date','date','find timestamp from rss formated date','timestamp','filters');
$program_coreb["133"]=array('rss_date_b','d','','','','','');
$program_coreb["134"]=array('jump_btns','id/v/add','buttons of values separated by \"|\" in v sent by javascript to id and replacing the input id if add=0 or adding the words in add (like \', \')','buttons who send values in an input','utils');
$program_coreb["135"]=array('make_tabs','r','','','','','');
$program_coreb["136"]=array('eradic_acc','n','convert all accentuated  characters to normal','formated string','filters');
$program_coreb["137"]=array('normalize','n','forbid special characters and accept only A-aZ-z0-9','formated string','filters');
$program_coreb["138"]=array('parse_bal','v','htmlentities only for balises','formated string','filters');
$program_coreb["139"]=array('clean_acc','v','kill all types of accents','formated string','filters');
$program_coreb["140"]=array('quotes','msg','clean up all kinds of quotes in one classic \'\"\' and apply clean_punct() and lowercase()','formated string for titles','filters');
$program_coreb["141"]=array('clean_punct','in','apply typographic rules','formated string','filters');
$program_coreb["142"]=array('clean_punct_b','v','apply typographic rules specific to bad spaces around the quote " (slower)','formated string','filters');
$program_coreb["143"]=array('lowercase','v','strtolower but keep ucfirst for each words','formated string','mecanics');
$program_coreb["144"]=array('utflatindecode','d','','','','','');
$program_coreb["145"]=array('make_mini','in/out/w/h','','','','','');
$program_coreb["146"]=array('imgalpha','img','','','','','');
$program_coreb["147"]=array('embed_detect','v/s/e/n','string start-cut end-cut cut_from','the part of $v who begin and finish with $s and $e','utils');
$program_coreb["148"]=array('countchars','v','count number of characters from count_chars() method (adding range 1) - used by embed_detect','value','utils');
$program_coreb["149"]=array('strrchr_b','v/d','','','','','');
$program_coreb["150"]=array('substr_v','ret/posa/posb','like php substr() but posb is the second position and not the lenght','formated string','mecanics');
$program_coreb["151"]=array('split_one','s/v/n','part of value after and before string (n=0), or after and before the last found string (n=1)','an array with entries','mecanics');
$program_coreb["152"]=array('split_onb','s/v/n','','','','','');
$program_coreb["153"]=array('split_two','v/d/p','value data parameter=00,01,10,11 : first 0/1=first/last occurence of d, second 0/1=before/after d','formated string','mecanics');
$program_coreb["154"]=array('strstr_b','v/s','invers of php strstr() : the value until the segment','formated string','mecanics');
$program_coreb["155"]=array('strsplit','v','php str_split() for php4','array of each letter of $v','mecanics');
$program_coreb["156"]=array('array_combine_a','a/b','a=keys b=values','combined array','mecanics');
$program_coreb["157"]=array('array_keys_b','r','','','','','');
$program_coreb["158"]=array('array_keys_r','r/n','r=array in an array n=range: key_target','array: values of a range','mecanics');
$program_coreb["159"]=array('in_array_b','va/r','find key in ranges r where value=va','like in_array() ','mecanics');
$program_coreb["160"]=array('in_array_r','r/d/n','','','','','');
$program_coreb["161"]=array('array_add_r','ra/rb','','','','','');
$program_coreb["162"]=array('recup_get','','','','','','');
$program_coreb["163"]=array('nb_page','tot/npg/page','','','','','');
$program_coreb["164"]=array('by_pages','r','','','','','');
$program_coreb["165"]=array('core','f/p/v1/v2/v3/v4','call the function p or f with 4 values','depend of the function','maths');
$program_coreb["166"]=array('currentwidth','','give the max width available at this moment of the script, inside the current div','number to use as max width in content','utils');
$program_coreb["167"]=array('good_url','id/suj','deprecated :: build explicit url from formated title (suj) if present, or i by default',"url of an article found by htacc('read')",'builders');
$program_coreb["168"]=array('htacc','d',"part of url knowing htaccess for 'read' or 'id'",'the param of variable formated','utils');
$program_coreb["169"]=array('htac','d','part of url knowing htaccess','the param of variable formated','utils');
$program_coreb["170"]=array('subdom','v','make url from hub v, depend if subdomain or htaccess are activated ','url','utils');
$program_coreb["171"]=array('prep_host','nod','good url with thttp for hub=nod if subdomain or htaccess or nothing activated','formated string','builders');
$program_coreb["172"]=array('calc_date','d','d=timestamp','timestamp of $d days before','dates');
$program_coreb["173"]=array('mkday','d','timestamp',"datadav using 'ymd'",'dates');
$program_coreb["174"]=array('ajx_get','v/p','v=cha�ne p=0/1','mise en conformit� ajax (0=encode 1=decode)','ajax');
$program_coreb["175"]=array('ajxcor','v','','','','','');
$program_coreb["176"]=array('define_s','v/d','give the the session s the value d if session is not set, then give get value to session','value of the session $v','html');
$program_coreb["177"]=array('call_plug_func','css/r/val','r=array of params in values val=echo :: params of SaveJ are : targetdiv_function_(id)_(x/xx)_val1_val2_val3_val4_miwedvar1|mixedvar2
where :
targetdiv=where send the result
function=a condition in the hangars of conditions ajax.php
(id)=optionnal, a div where read value
(x/xx)=x close the popup, xx close the popup after 1 second
val1-4=strings prepared for ajax
mixedvar= diferents id where catch values',"classical ajax button callin 'SaveJ'",'ajax');
$program_coreb["178"]=array('patch_replace','bs/in/wh/repl','replace in by repl where wh in bs','confirmation success','database');
$program_coreb["179"]=array('chronotest','d','d=timestamp','echo the time elapsed from last time this function was called','utils');

?>