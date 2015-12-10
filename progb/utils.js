//philum_utils

var theSelection=false;
//check browsers
var clientPC=navigator.userAgent.toLowerCase(); // Get client info
var clientVer=parseInt(navigator.appVersion); // Get browser version
var is_ie=((clientPC.indexOf("msie")!=-1) && (clientPC.indexOf("opera")==-1));
var is_nav=((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
 && (clientPC.indexOf('compatible')==-1) && (clientPC.indexOf('opera')==-1)
 && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));
var is_moz=0;
var is_win=((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit")!=-1));
var is_mac=(clientPC.indexOf("mac")!=-1);

function setSelectionRange(input,selectionStart,selectionEnd){
	if(input.setSelectionRange){input.focus();
		input.setSelectionRange(selectionStart,selectionEnd);}
	else if(input.createTextRange){
		var range=input.createTextRange();
		range.collapse(true);
		range.moveEnd('character',selectionEnd);
		range.moveStart('character',selectionStart);
		range.select();}}

function storeCaret(textEl){//Insert at Caret position
if(textEl.createTextRange)textEl.caretPos=document.selection.createRange().duplicate();}

function findfunc(e,o){var t=e.innerHTML;//codev
	var st=e.selectionStart; var end=e.selectionEnd; var lgth=e.textLength;
	var p=(e.value).substring(st,end); if(st==end)return;
	SaveJ('results_plug__21_codeview_findfunc_'+ajxget(p));}
	//SaveJ('results_plug__14_coremap_coremap_'+ajxget(p));

function detctfunc(e){var t=e.innerHTML; 
	var t=strreplace('&amp;','&',t);var t=strreplace('&lt;','<',t);var t=strreplace('&gt;','>',t);
	var st=e.selectionStart; var one=t.substring(0,st); var two=t.substr(st);
	var ptr=[' ','=','(',')',"'",'"','.','[',']','&','|','-','+','/','*',',','{','}'];
	var first=0; var last=two.length; var f2=[]; var l2=[];
	for(i=0;i<ptr.length;i++){
		var f2=one.lastIndexOf(ptr[i]); if(f2>first)var first=f2;
		var l2=two.indexOf(ptr[i]); if(l2!=-1 && l2<last)var last=l2;}
	var pa=one.substr(first); var pb=two.substring(0,last); var p=pa+pb;
	//alert(char+' - '+first+' - '+pa); //alert(char+' - '+last+' - '+pb);
	var p=(e.value).substring(first+1,st+last); jumphtml('results_'+p);}
	//SaveJ('results_plug___dev_findev_'+ajxget(p));

//slctmenuder
function callSaveJ(tg,e,restore){
	SaveJ(tg+e.options[e.selectedIndex].value);
 	if(restore)e.selectedIndex=0;}

function embed_slct(debut,fin,id,act){var id=id?id:'txtarea';
	var txtarea=getbyid(id); txtarea.focus(); 
	donotinsert=false; theSelection=false; 
	if((clientVer>=4) && is_ie && is_win){
		theSelection=document.selection.createRange().text; // Get text selection
		if(theSelection){
		while(theSelection.substring(theSelection.length-1,theSelection.length)==' '){
				theSelection=theSelection.substring(0,theSelection.length-1);}
			// Add tags around selection
			document.selection.createRange().text=debut+theSelection+fin;
			txtarea.focus(); theSelection=''; return theSelection;}}
	else if(txtarea.selectionEnd && (txtarea.selectionEnd-txtarea.selectionStart>0)){
		theSelection=mozWrap(debut,fin,id,act);
		return theSelection;}}

//from http://www.massless.org/mozedit/
function mozWrap(opn,clo,id,action,acm){var id=id?id:'txtarea';
	var s1=''; var s2=''; var s3=''; 
	var txtarea=getbyid(id); var vl=1;//
	if(typeof txtarea.value==='undefined')var vl=0;
	var selLength=txtarea.textLength;
	var selStart=txtarea.selectionStart;
	var selEnd=txtarea.selectionEnd;
	var selTop=txtarea.scrollTop;
	if(selEnd==1 || selEnd==2)selEnd=selLength;
	if(vl)var truend=(txtarea.value).substring(selEnd-1,selEnd); 
	if(action=='del')truend='';
	if(selEnd-selStart>0 && truend==' '){selEnd=selEnd-1;}
	if(selEnd-selStart>0 && truend=="\n"){selEnd=selEnd-1;}
	if(vl)var s1=(txtarea.value).substring(0,selStart);
		else var s1=(txtarea.innerHTML).substring(0,selStart);
	if(vl)var s2=(txtarea.value).substring(selStart,selEnd);
	if(action=='del' && !s2){s1=s1.substring(0,selStart-1); selStart-=1;}
	if(vl)var s3=(txtarea.value).substring(selEnd,selLength);
	if(action=="clean_n"){
		if(s2.indexOf("\n\n")!=-1)var s2=s2.split("\n\n").join("\n");
		else var s2=s2.split("\n").join(" ");}
	else if(action=="clean_mail"){var s2=s2.split("\n\n").join("#br#");
			var s2=s2.split("\n").join(" "); var s2=s2.split("#br#").join("\n\n");}
	else if(action=="lowercase"){var s2=s2[0].toUpperCase()+s2.substring(1).toLowerCase();}
	else if(action=="mktable"){var s2=s2.split("\n").join("¬\n"); s2=s2.split(",").join("|");
		s2='['+s2+':table]';}
	else if(action=="delconn"){
		if(s2)var s2=connectors(s2,acm,'delconn');
		else if(acm){var s1=s1+s3; s3=''; var s1=connectors(s1,acm,'delconn');}
		else{
			if(s1)var na=find_next(s1,0); if(s3)var nb=find_next(s3,1);
			var s2=s1.substr(na); var s1=s1.substr(0,na);
			var s2=s2+s3.substr(0,nb); var s3=s3.substr(nb);
			//alert("-s1="+s1+"\n-s2="+s2+"\n-s3="+s3);
			var s2=connectors(s2,'','delconn');}}
	//else if(action=='editcl'){}
	else if(action=='repl'){var s2=opn; opn='';}
	else if(action=='del')var s2='';
	if(vl)txtarea.value=s1+opn+s2+clo+s3;
	else txtarea.innerHTML=s1+opn+s2+clo+s3;
	selFin=selEnd+clo.length+opn.length;
	if(action=='del' || action=="delconn")selFin=selStart; if(!s2)selStart=selFin;
	window.setSelectionRange(txtarea,selStart,selFin);//selStart
	txtarea.scrollTop=selTop;
	txtarea.focus();
	return s2;}

//conn
function find_next(d,p){//alert(d+p);
	if(p)var n=d.indexOf("]")+1; else var n=d.lastIndexOf("[");
	if(n==-1)return 0;//p?d.length:
	var d1=d.substr(0,n); var d2=d.substr(n);
	if(p)var n1=substr_count(d1,'['); else var n1=substr_count(d2,']');
		for(var ia=0;ia<n1;ia++){//not global
			if(p)var n=n+find_next(d2,p); else var n=find_next(d1,p);}
	return n;}

function delconn(d,cn){
	var na=d.lastIndexOf(':'); var nb=d.lastIndexOf('§'); var xt=d.substr(na+1);
	if((d.substr(nb)).indexOf(']')!=-1)nb=-1;
	if(xt==cn || !cn){
		if(d.substr(0,4)=='http' && !cn){
			if(nb!=-1)return d.substr(nb+1)+' ['+d.substr(0,nb)+']'; else return d;}
		else if(na!=-1){d=d.substr(0,na);if(nb!=-1)d=d.substr(0,nb);}
		else if(nb!=-1)d=d.substr(0,nb);}
	else d='['+d+']';
	return d;}

function connectors(msg,cn,act){
var deb=''; var mid=''; var end='';
var ini=msg.indexOf("[");
if(ini!=-1){var deb=msg.substr(0,ini); 
	var msb=msg.substr(ini+1); var out=msb.indexOf("]");
	if(out!=-1){var msb=msg.substr(ini+1,out);
		var nb_in=substr_count(msb,"[");
		if(nb_in>=1){
			for(var ia=1;ia<=nb_in;ia++){
				var out_tmp=ini+1+out+1;
				var msb=msg.substr(out_tmp);
				var out=out+msb.indexOf("]")+1;
				var msb=msg.substr(ini+1,out);
				var nb_in=substr_count(msb,"[");}
			var mid=msg.substr(ini+1,out);
			var mid=connectors(mid,cn,act);}
		else var mid=msb;
		if(act=='delconn')var mid=delconn(mid,cn);
		var end=msg.substr(ini+1+out+1);
		var end=connectors(end,cn,act);}
	else var end=msg.substr(ini+1);}
else var end=msg;
return deb+mid+end;}

function substr_count(d,v){n=0;
	for(i=0;i<d.length;i++){if(d.substr(i,1)==v)n++;}
	return n;}
function str_split_right(d,q,p,b){
	if(p)var n=d.lastIndexOf(q); else var n=d.indexOf(q);
	if(n!=-1){if(b==1)var d=d.substr(n+1); else var d=d.substr(0,n);}
	else return '';
	return d;}

//embed
function embed(val,bid){
	theSelection=embed_slct('',''); if(val=='video' && theSelection){
		SaveJ('socket_extractid__repl_'+ajxget(theSelection)+'___1');}
	else {theSelection=embed_slct('[',':'+val+']');
	if(theSelection==undefined){var cid=bid?'bt'+bid:'';
		SaveJ('popup_emdpop__'+bid+'_'+val.replace('_','*')+'__'+bid);}}}

function captslct(val){
	var txt=getbyid('txtarea'); txt.focus(); var s2=false;
	if((clientVer>=4) && is_ie && is_win){var s2=document.selection.createRange().text;}
	else{var s2=(txt.value).substring(txt.selectionStart,txt.selectionEnd);}
	if(!s2)var s2=txt.value; SaveJ('popup_emdpop___'+val+'_'+ajxget(escape(s2)));}

function autoslct(val){var id=val?val:'txtarea';
	var txt=getbyid(id); txt.focus();
	var s1=(txt.value).substring(0,txt.selectionStart); var sl=parseInt(s1.length);
	var s3=(txt.value).substring(txt.selectionEnd);
	var selStart=s1.lastIndexOf("["); var selFin=s3.indexOf("]")+1+sl;
	window.setSelectionRange(txt,selStart,selFin);}
	
function embed_url_j(){
	var val=getbyid('url').value;
	if(val==""){return;}
	else{theSelection=embed_slct('['+val+'§',']');
		if(theSelection==undefined){insert('['+val+']');}}}
function embed_css(conn){
	var val=getbyid('cnn').value;
	if(val==""){return;}
	else{embed_slct('[','§'+val+':'+conn+']');}}
function insert_conn(cnn){
	var va=getbyid('cnv').value;
	var vp=getbyid('cnp').value;
	if(vp!='')val=va+'§'+vp; else val=va;
	if(va)insert('['+val+':'+cnn+']');}

//embed|insert
function insert_mbd(deb,val,fin){
	theSelection=embed_slct(deb,fin);
	if(theSelection==undefined){insert(deb+val+fin);}}//Close('popup');
function insert_jc(conn,id){
	var val=getbyid(id).value;
	if(val=="")return; else insert('['+val+':'+conn+']');}//Close('popup');
function insert_jcb(id){//video
	var val=getbyid(id).value;
	new AJAX(jurl()+'call_tri_auto*video_'+val,id);}
function insert_close(text){insert(text);}//Close('popup');

//insert
function insert(text){var txtarea=getbyid('txtarea');
	if(txtarea.createTextRange && txtarea.caretPos){var caretPos=txtarea.caretPos;
		caretPos.text=caretPos.text+text+caretPos.text.charAt(caretPos.text.length-1);}
	 else{mozWrap('',text); return;}}

function insert_b(text,tar){var txtarea=getbyid(tar);
	if(txtarea.createTextRange && txtarea.caretPos){var caretPos=txtarea.caretPos;
		caretPos.text=caretPos.text.charAt(caretPos.text.length-1)==' '?caretPos.text+text+' ':caretPos.text+text;}
	 else{mozWrap('',text,tar); return;}}

function insert_photo(txt,conn){
	var txtarea=getbyid('txtarea');
	if(txt=="manual"){var txt=getbyid('source').value; 
	txt=clean_entity("\n","",txt);}
	if(conn=='slider' || conn=='sliderJ'){mozWrap('','['+txt+':'+conn+']');}
	else if(txt!=null){mozWrap('','['+txt+':photo'+conn+']');}
	//Close('popup');
	return;}

function jumpMenu_insert_b(selObj,tar){//styls
	var add=selObj.options[selObj.selectedIndex].value;
	insert_b(add,tar);}
function jumpText_insert_b(selObj,tar){
	var add=getbyid(selObj).value;
	insert_b(add,tar);}

//toggles
function SaveBc(val){var dn=val.split("_");//artopen 
	var op=active_c('toggleart'+dn[1],'','active'); if(op)var nb=3; else var nb=dn[2];
	var ajax=new AJAX(jurl()+dn[0]+"_"+dn[1]+"_"+nb+"_"+dn[3],dn[0]+dn[1]);}

function active_c(val,csa,csb){var op=getbyid(val);
	if(op.className==csa){var css=csb; var ret=1;} else{var css=csa; var ret=0;}
	op.className=css; return ret;}

function active_b(id,o){var ob=getbyid(id); var css=ob.className;
	if(css.indexOf('active')==-1 && o)ob.className='active'; 
	else ob.className='';}

function active(val){
	var op=getbyid(val).className; var act=op.replace(' active','');
	if(op==act){var css=op+" active"; var ret=1;} else{var css=act; var ret=0;}
	getbyid(val).className=css; return ret;}

function active_list_finder(div,n){
	var mnu=getbyid(div).getElementsByTagName("li");
	for(i=0;i<mnu.length;i++){
	var lnk=mnu[i].getElementsByTagName("a"); var chd=mnu[i].getElementsByTagName("ul");
	if(i==n-1){
		if(lnk[0].className=='active' && chd[0].style.display=='block'){
			lnk[0].className=''; chd[0].style.display='none';}
		else if(lnk[0].className=='' && chd[0].style.display=='block'){
			lnk[0].className='active';}
		else{lnk[0].className='active'; chd[0].style.display='block';}}
	else lnk[0].className='';}}

function active_list_bubble(ul){var li=ul.getElementsByTagName("li"); //change
	if(li.length>0)for(i=0;i<li.length;i++){var liul=li[i].getElementsByTagName("ul");
		if(liul[0]){liul[0].style.display='none';}}}// li[i].className='';
function closechild(li){var ul=li.getElementsByTagName("ul"); //desactive
	for(i=0;i<ul.length;i++){ul[i].style.display='none';}}
function closebub(e){active_list_bubble(e.parentNode); eb=e.parentNode.parentNode;//btn
	if(eb.parentNode)setTimeout(function(){closebub(eb)},100); else clbub(0,'');}
function closepbub(e,id){var pbu=e.parentNode.parentNode; active_list_bubble(pbu);
	var li=pbu.getElementsByTagName("li");//if(id)e.parentNode.id=id;
	for(i=0;i<li.length;i++){if(li[i]==e.parentNode)li[i].className='active';
		else li[i].className='';}}
//close bub
function clbub(op,bid){var div=getbyid('clbub');
	if(op){addEvent(div,'mousedown',function(){clbub(0,bid)}); 
		div.style.width='100%'; div.style.height='100%';} 
	else{div.style.width=0; div.style.height=0;
		if(bid)Close(bid); else{var bub=getbyid('bub'); active_list_bubble(bub);}}}
//close popbub
function clpop(e,id){var n=clp.length; 
	if(id)clp[n]=id; else if(n){var m=mouse(e);
		for(i=0;i<n;i++){if(clp[i]){var bub=getbyid(clp[i]); if(bub){var p=getPosition(bub);
		if(m.x<p.x||m.x>(p.x+p.w)||m.y<p.y||m.y>(p.y+p.h)){//clickoutside
		if(clp[i].substr(0,3)=='pub')cltog(clp[i]); 
		else if(clp[i].substr(0,2)=='bb')closechild(bub);
		else Remove(clp[i]);
		clp[i]=undefined;}}}}}}
//close togbub
function cltog(d){var op=getbyid(d); if(op)var ob=op.parentNode; Remove(d);
	if(ob){var oa=ob.getElementsByTagName("a")[0]; oa.className="";}}

function onclickoutsisde(){}

function rmclp(d){for(i=0;i<clp.length;i++)if(clp[i]==d)clp[i]=undefined;}

function toggle_bub(j){var dn=j.split("_"); var id=dn[2]; j=j;
	var ob=getbyid('bt'+id);
	if(ob)var oc=ob.getElementsByTagName("a")[0];
	if(ob)var op=ob.parentNode.getElementsByTagName("span");
	if(oc.className==''){oc.className="active"; SaveJ('togbub_'+j);}
	else{oc.className=''; Remove('pub'+id);}
	for(i=0;i<op.length;i++){var pid=op[i].id;
		if(pid && pid.substr(0,2)=='bt' && pid.substr(2)!=id){
			var opa=op[i].getElementsByTagName("a"); if(opa[0])opa[0].className='';
			//var bub=op[i].getElementsByTagName("div")[0];
			var bub=getbyid('pub'+(pid.substr(2))); 
			if(bub){Remove(bub.id); rmclp(bub.id);}}}}

function active_list(div,n,csa,csb){//menuder_h
	var mnu=getbyid(div).getElementsByTagName('a');
	for(i=0;i<mnu.length;i++){if(i==n)mnu[i].className=csa; else mnu[i].className=csb;}}

function SaveTg(val){var dn=val.split("_");
	var mnu=getbyid('mnu'+dn[3]).getElementsByTagName('a');
	for(i=0;i<mnu.length;i++){
		if(i==dn[4]){
			if(mnu[i].className=='active' && !dn[5]){mnu[i].className=''; Close(dn[0]);
				ajax=new AJAX(jurl()+'sesmake_0_'+dn[0],dn[0]);}
			else {mnu[i].className='active'; 
				ajax=new AJAX(jurl()+dn[1]+'_'+dn[2]+'_'+dn[3],dn[0]);}}
		else mnu[i].className='';}}

function active_tg(val,nb,nob){//tabs
	var op=getbyid(val+nb).className; 
	if(op=='txtab'){var css='txtaa'; var ret=1;
		if(nob){for(i=1;i<=nob;i++){
			if(i!=nb)getbyid(val+'bt'+i).className='txtab';}}} 
	else{var css='txtab'; var ret=0;}
	getbyid(val+nb).className=css;
	return ret;}

function Toggle(val,nb,nob){var dn=val.split("_"); //dn=undefiner(dn);
	if(nob)var ac=active_tg(dn[0],nb,nob); else var ac=active(dn[0]+nb);
	dn[2]=undefine(dn[2]); dn[3]=undefine(dn[3]); dn[4]=undefine(dn[4]); dn[5]=undefine(dn[5]); 
	if(ac){var URL=jurl()+dn[1]+'_'+dn[2]+'_'+dn[3]+'_'+dn[4]+'_'+dn[5];
		var ajax=new AJAX(URL,dn[0],3);}
	else Close(dn[0]);}

function toggle_block(v,p){//admin_menu
	var div=getbyid(v); var op=div.style.display;
	if(op=='block' || p==1)div.style.display='none'; else div.style.display='block';}

function swap_toggle(val){var dn=val.split("_");
	a=getbyid(dn[0]).style.display;
	b=getbyid(dn[1]).style.display;
	if(a=='block'){var a='none'; var b='block';} else{var a='block'; var b='none';}}

function toggle_tab(tab,obj){//tabs_html
	var ajax=new AJAX(jurl()+'sesmake_'+obj+'_tbmd'+tab,'socket',4);
	var mnu=getbyid('mnuab'+tab).getElementsByTagName("a");
	for(i=1;i<=mnu.length;i++){var b=i-1;
		if(i==obj){mnu[b].className='txtaa';
		getbyid('div'+tab+i).style.display='block';} 
		else{mnu[b].className='txtab'; Hide('div'+tab+i);}}}

function radioj(div,id,v,n){active_list(div,n,'active',''); getbyid(id).value=v;}

//utils
function utflatin(va){
	var arr=['%3D','%7E','%E8','%E9','%EA','%E0','%E2','%F4','%F6','%FB','%FC','%F9','%EE','%EF','%20','%2C','%3B','%3A','%21','%3F','%A7','%25','%26','%7C']; 
	var arb=['=','~','è','é','ê','à','â','ô','ö','û','ü','ù','î','ï',' ',',',';',':','!','?','§','%','&','|'];
	for(var i=0;i<arr.length;i++)va=strreplace(arr[i],arb[i],va);
	return va;}

function modedit(arr,tar){
	vn=arr.split("|"); var nm=""; var nb=new Array();
	for(i=0;i<vn.length;i++){
		if(vn[i]){var val=escape(getbyid(vn[i]).value);
			var np=(val); nb.push(np); if(i==0)var nm=np;
			else if(i==1 || i==2 || i==3)var nm=nm+'/'+np;
			else if(i==4){if(nm)var nm=nm+':'+np; else nm=np;}
			else if(i==5 && np)var nm=nm+'§'+np; }}
	if(!nb[1] && !nb[2] && !nb[3])nm=nm.replace('///','');
	if(!nb[0] && !nb[1] && !nb[2] && !nb[3])nm=nm.replace(':','');
	var to=getbyid(tar).value; if(to)nm=to+',\n'+nm;
	getbyid(tar).value=utflatin(nm);}

function fixelem(){//popup_fix
	var content=getbyid('pop'+curid);
	var lx=parseInt(content.style.left.replace('px',''));
	var ly=parseInt(content.style.top.replace('px',''));
	var px=window.pageXOffset; var py=window.pageYOffset;
	var cs=content.style.position;
	if(cs=='absolute'){content.style.position='fixed';
		content.style.left=lx-px+'px'; content.style.top=ly-py+'px';}
	else{content.style.position='absolute';
		content.style.left=lx+px+'px'; content.style.top=ly+py+'px';}
	zindex_sup();}

function reduce(){//popup_reduce
	var pp=getbyid('pop'+curid);
	var div=getbyid('popu'+curid); var op=div.style.display;
	if(op=='block' || !op)div.style.display='none'; 
	else div.style.display='block';}

function expand(){var div=getbyid('pop'+curid);
	var owa=div.style.width; var oha=div.style.height;
	var wa=innerSizes('w')-100; var ha=innerSizes('h')-40;
	div.style.width=wa; div.style.height=ha;
	var txa=getbyid('txtarea');
	txa.style.width='100%'; txa.style.height=(ha-40)+'px';
	poprepos();}

//mkforms
function jumpMenu_addtext(val){var dn=val.split("_");
	var old=getbyid(dn[0]).value; 
	if(!old)var old=''; else var old=old+dn[4];
	var dc=getbyid(dn[1]); var slct=dc.options[dc.selectedIndex].innerHTML;
	var va=getbyid(dn[2]).value;
	if(va){var va=va+dn[3]+slct;} else{var va=slct;}
	getbyid(dn[0]).value=old+va;}

function notepad_open(nod){var vn=nod.split("_"); //alert(vn[2]);
	SaveJ('plgtxt_plugin___txt_'+vn[2]+'_'+vn[3]);
	var ajax=new AJAX(jurl()+'sesmake_'+vn[2]+'_npnb','bck');
	var val='msqlread_'+vn[0]+'_'+vn[1]+'_'+vn[2]+'_1&res=1';
	var ajax=new AJAX(jurl()+val,'txtarea',4);}

function log_finger(id){var va=getbyid(id).value;
	var arr=['-',',','?',';','.',':','/','!','§',' ','"',"'",'(',')','_','=','+','$','*','%','<','>',' ','|','~','&','^','¨','é','è','à','ç','ù','£','@','{','}','[',']','`','^','µ','¨','^','²'];
	for(i=0;i<arr.length;i++)va=va.replace(arr[i],'');
	if(Number(va.substr(0,1)))va=va.substr(1); //var va=va.toLowerCase();
	getbyid(id).value=va;
	return va;}

function num_finger(id,mx){var va=getbyid(id).value; var n=va.length;
	if(!Number(va))va=va.substr(0,n-1); 
	if(n>mx)va=va.substr(0,mx); 
	getbyid(id).value=va;}

function num_mail(id){var v=getbyid(id); var va=v.value;
	if(va.indexOf("@")==-1)v.className='txtred';
	else if(va.indexOf(".")==-1)v.className='txtred'; else v.className='';}

function log_goodname(id){va=log_finger(id);
	var ajax=new AJAX(jurl()+'gooduser_'+va,id,4);}

//storage
function locals(id,va){if(localStorage){//,com
	//if(com=='x')localStorage.removeItem[id];
	if(va)localStorage.setitem(id,va);
	else return localStorage.getitem[id];}}

function mem_storage(val){//tar_var_copy_type
	var vn=val.split("_"); vn[0]=vn[0]?vn[0]:'txtarea';
	var ob=getbyid(vn[0].replace('*','_')); //
	if(vn[5])active_list(vn[5],vn[4],'active','');
	if(vn[3])var obj=ob.innerHTML; else var obj=ob.value;
	if(vn[2]=='x')return mozWrap('','',vn[0],'del');
	var txt=embed_slct('','',vn[0]);
	if(vn[2]){var lc=localStorage[vn[1]];//paste
		if(vn[4])getbyid('cka').value=vn[1];
		if(vn[3])ob.innerHTML=lc; //encode_conn()
		else if(txt==undefined)insert_b(lc,vn[0]); 
		else ob.value=obj.replace(txt,lc);}
	else{var val=txt?txt:(obj);//copy
		if(vn[1]=='cka')var key=getbyid('cka').value; else var key=vn[1];
		localStorage[key]=val;}
	if(vn[4])sav_btn(vn[4]);}

function sav_btn(id,n){btn=getbyid(id); cln=btn.className;
	tit=btn.innerHTML; tics=cln+' active'; btn.className="txtyl";
	setTimeout("btn.className=tics",900); setTimeout("btn.innerHTML=tit",1000);}

function conn(val){
	var vn=val.split("_"); vn[0]=vn[0]?vn[0]:'txtarea';
	return mozWrap('','',vn[0],vn[1],vn[2]);}

function autoread(id){
	doc=getbyid('scroll'); doc.scrollTop=doc.scrollTop+1;
	timer=setTimeout(function(){autoread(id)},100);}

function publishart(id){
	var ob=getbyid('art'+id);
	ob.className=ob.className.replace('hide','');
	var ajax=new AJAX(jurl()+'call_meta_prior*sav_1_'+id,'pba'+id,10);}

//drag
var popz=1;
var cpop=0;
var cpop_difx=0;
var cpop_dify=0;
var popnb=0;
var curid=0;
var exs=[];//artlive

//noselect
function nsf(){return false;} function nst(){return true;} 
function noslct(a){
	if(window.sidebar){if(a)document.onmousedown=nst; else document.onmousedown=nsf;}}
document.onselectstart = new Function("return false");

function zindex_sup(){
	getbyid('pop'+curid).style.zIndex=popz+100;}
function zindex(id){popz++; curid=id; 
	getbyid('pop'+id).style.zIndex=popz;}

function popslide(ev){
	if(cpop!=0){var souris=mouse(ev);
		cpop.style.left=(souris.x-cpop_difx)+'px';
		cpop.style.top=(souris.y-cpop_dify)+'px';}}

function artslide(e,id){var wpos=window.pageXOffset; var met=getbyid('meta'+id);
	var pmet=getPosition(met); met.innerHTML=wpos+'-'+pmet.y+'-'+delta;
	if(pmet.y<20)met.style.position='fixed';}
function listenart(e,id){addEvent(document,'mousewheel',function(){artslide(e,id)});}

function mousescroll(e){var e=window.event||e;
var delta=Math.max(-1,Math.min(1,(e.wheelDelta||-e.detail)));
getbyid('alert').innerHTML=delta;
return false;}//Firefox

function initscroll(e,id){if(e.addEventListener){id=id;
e.addEventListener("mousewheel",mousescroll,false);//IE Opera Chrome Safari
e.addEventListener("DOMMouseScroll",mousescroll,false);}//Firefox
else if(e.attachEvent)e.attachEvent("onmousewheel",mousescroll);}//IE<9

function mouse(ev){if(ev.pageX || ev.pageY){return {x:ev.pageX,y:ev.pageY};}
	return{x:ev.clientX+document.body.scrollLeft-document.body.clientLeft,
		y:ev.clientY+document.body.scrollTop-document.body.clientTop};}
function getPosition(e){if(e==null)return {x:0,y:0,w:0,h:0};
	var left=0; var top=0; var w=e.offsetWidth; var h=e.offsetHeight;
    while(e.offsetParent){left+=e.offsetLeft; top+=e.offsetTop; e=e.offsetParent;}
    left+=e.offsetLeft; top+=e.offsetTop; return {x:left,y:top,w:w,h:h};}
function get_dim(e){
	return {x:e.offsetLeft,y:e.offsetTop,w:e.offsetWidth,h:e.offsetHeight};}

function start_drag(ev,z){
	popup=getbyid('pop'+z); cpop=popup;
	old_mousep=mouse(ev);
	old_mousex=getPosition(popup);
	cpop_difx=old_mousep.x-old_mousex.x;
	cpop_dify=old_mousep.y-old_mousex.y;}
function stop_drag(ev){cpop=0;}

function goodheight(e,n,h){var v=e.value; var ch=e.style.height.replace('px','');
	var s=Math.ceil((v.length/n)); for(i=0;i<v.length;i++){if(v[i]=="\n")s=s+1;}
	var s=s>5?5:s; var eh=s?s*h:h; if(eh>ch)e.style.height=eh;}

function checkbox(id){var bt=getbyid(id); var n=bt.value==1?0:1;
	bt.value=n; SaveJ('bt'+id+'_chkbx___'+n);}
function checkbob(val){//unused
	var vn=val.split("|"); var bt=getbyid(vn[0]); 
	var n=bt.value==1?0:1; var va=n==1?vn[2]:vn[1];
	bt.value=n; getbyid('bt'+vn[0]).innerHTML=va;}
function checkact(id){getbyid(id).value=active_c('bt'+id,'popbt','popw');}

function selectj(id,v,t,o){
	if(parseInt(o)==1||parseInt(o)==3)getbyid('bt'+id).innerHTML=ajxget(t,1);
	getbyid(id).value=v; Close('popup');}

function addiv(tar,res,st){var ob=getbyid(tar);
	var div=document.createElement('div'); div.innerHTML=res; div.id='lastrack';
	if(st){var obd=ob.getElementsByTagName('div'); ob.insertBefore(div,obd[0]);}
	else ob.appendChild(div);}//Timer('opac','lastrack',0,100,2);

function lkc(d,v){return '<a class="popbt" onclick="'+d+'">'+v+'</a>';}

function scrolltxt(n){var v=n==1?1:(-1); doc.scrollTop=doc.scrollTop+v;}
function autoread(id,rid){doc=getbyid("scrll"+rid);
	scrolltxt(1); timer=setTimeout(function(){autoread(id,rid)},100);}
function scrollt(n,rid){doc=getbyid("scrll"+rid);
	for(i=0;i<200;i++){timer=setTimeout(function(){scrolltxt(n,rid)},i*4);}}

function js_chat(d){
	var fa='SaveJ(\'chtx'+d+'_chatxml__13_chatxcall_'+d+'\'); ';
	var fb='xch=setTimeout(\'chatimer'+d+'()\',3000);';
	return 'function chatimer'+d+'(){'+fa+fb+'} chatimer'+d+'();';}

function addjs(f,d,p){var head=document.getElementsByTagName('head')[0];
	var js=document.createElement('script'); 
	if(f=='chatx')js.innerHTML=js_chat(d); else js.innerHTML=d;
	if(p==1)head.appendChild(js); else clearTimeout(xch);}

function addjsrc(d){var head=document.getElementsByTagName('head')[0];
	var js=document.createElement('script'); js.type='text/javascript';
	js.src=d; head.appendChild(js); alert(js.src);}

function offon(f,d){
	var v=getbyid('offon'+d); var p=v.value==1?0:1; v.value=p; 
	SaveD('socket_sesmake_'+p+'_offon');
	setTimeout(function(){addjs(f,d,p)},1000);
	SaveJ('offonbt'+d+'_offon___'+p);}

function poplist(id){var icon='l'; var list='=';//pictos
	bt=getbyid(id);
	if(bt.innerHTML==icon){var c=''; var s='16px'; var d='inline'; bt.innerHTML=list;} 
	else{var c='icones'; var s='32px'; var d='block';  bt.innerHTML=icon;}
	var popu=getbyid('popu'+curid);
	var div=popu.getElementsByTagName('a'); 
	for(i=0;i<div.length;i++){var dv=div[i].childNodes[0]; dv.className=c;
		var dve=dv.getElementsByTagName('span');
		dve[0].style.fontSize=s; dve[1].style.display=d;}}

function getScroll(){
	if(window.pageYOffset!=undefined)return[pageXOffset,pageYOffset];
	else{var sx,sy,d=document,r=d.documentElement,b=d.body;
	sx=r.scrollLeft||b.scrollLeft||0; sy=r.scrollTop||b.scrollTop||0;
	return [sx,sy];}}

//continuous scroll
function artlive(e){var ret=''; var ia=0;
	var scrl=pageYOffset+innerHeight;
	var mnu=getbyid('content').getElementsByTagName("div");
	for(i=0;i<mnu.length;i++){
		if(parseInt(mnu[i].id)>1){var id=mnu[i].id;
			if(mnu[i].innerHTML==''){
				var pos=getPosition(mnu[i]); var pos=pos.y;
				if(scrl>pos){ia++;
					var idx=exs.indexOf(id);
					if(ia==20)i=mnu.length;//stop loop
					if(idx==-1 && ia<20){
						exs.push(id); if(mnu[i])var md=mnu[i].className;
						SaveJ(id+'_artone___'+id+'_'+md);}}}}}}
if(typeof read==='string' && flow==1)addEvent(document,'scroll',function(event){artlive(event)});

//fixdiv
function fixdiv(){var scrl=pageYOffset;
	var div=getbyid('fixtit'); var pdiv=getPosition(div);
	var mnu=getbyid('fixit'); var pmnu=getPosition(mnu);
	var bt='<a href="/'+read+'#'+read+'" class="small">'+mnu.innerHTML+'</a> ';
	if(scrl>pmnu.y){div.innerHTML=bt;}
	else{div.innerHTML='';}}
if(typeof read==='string' && read>1)addEvent(document,'scroll',function(event){fixdiv()});
