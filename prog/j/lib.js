//lib

//states
function updateurl(a,j,io,b){
var dn=j.split("_");
if(a=='read'){a='art'; var u='/'+dn[5];
	setTimeout(function(){document.title=recuptit();},200);}
else if(a=='menu'){
	var pm=explodek(dn[2],',',':');
	pm.bt=0; var cmd=implodek(pm,',',':');
	//if(pm.m=='context')var u='/context/'+pm.p;else 
	if(pm.t)var u='#'+pm.t;
	else var u='/module/'+dn[3];}
else var u='/'+dn[4]+(dn[5]?'/'+ajx(dn[5],1)+(dn[6]?'/'+ajx(dn[6],1):''):''); //pr(a+'--'+u);
var r={u:u,a:a,j:j,i:io,t:''};
if(!b)window.history.pushState(r,a,u);// && r.j!=event.state.r.j
if('scrollRestoration' in history)history.scrollRestoration='manual';
scrolltoob('content',40);}

function restorestate(st){if(!st)return;
if(st.a=='menu')SaveBg(st.i,1);//abort update
else if(st.a=='module' && st.j)SaveJ(st.j);
else if(st.a=='art' && st.j){SaveJ(st.j); document.title=st.t;}//?st.t:recuptit()
else if(st.a=='context' && st.j){let r=st.u.split('/').splice(3);
	for(var k in r)r[k]=ajx(r[k]); var g=r.join('_');//g=st.p;
	SaveJ('page_mod,playcontext___'+g); document.title=st.t;}
else if(st.j)SaveJ(st.j);}//unused

function startstate(st){
var u=document.URL; var t=document.title; var j;
if(st.a=='art')st.a='read';
//if(st.p=='home')var j='page_mod,playcontext___home';
if(st.a=='context')var j='page_mod,playcontext___'+st.p;
else var j='content_mod,playmod___'+st.a+'_'+st.p;//rebuild cmd
var r={u:u,a:st.a,j:j,t:t,i:''};
var h=window.location.hash;
if(h){h=decodeURIComponent(h.substr(1)); var i=rha.get(h); r={u:u,a:'menu',j:j,t:t,i:i};}
/*var dn=u.split('/');//using /menu/
if(dn[3]=='menu'){var h=decodeURIComponent(dn[4]); var i=rha.get(h); r={u:u,a:'menu',j:'',t:t,i:i}; }*/
if(i)SaveBg(i,2);
window.history.replaceState(r,st.a,u);}

//window.addEventListener('popstate',function(e){restorestate(e.state);});
window.onpopstate=function(e){restorestate(e.state);}
window.onload=function(e){startstate(state);}

//inner
function addiv(tar,res,st){var ob=getbyid(tar); if(ob==null)return;
var div=document.createElement('div'); div.innerHTML=res; var parent=ob.parentNode;
if(st=='before')parent.insertBefore(div,ob);
else if(st=='after'){var childs=div.childNodes,n=childs.length;
	for(i=0;i<n;i++)if(typeof childs[i]=='object')ob.appendChild(childs[i]);}
else if(st=='begin'){var obd=ob.childNodes; ob.insertBefore(div,obd[0]);}
else if(st=='atend')parent.appendChild(div);}

function jslink(d){var head=document.getElementsByTagName('head')[0]; if(xch)clearTimeout(xch);
var js=document.createElement('script'); js.id='jslink'; var ob=getbyid('jslink');
if(ob!=null)head.removeChild(ob); js.src=d; head.appendChild(js);}

function jscode(d){var head=document.getElementsByTagName('head')[0]; if(xch)clearTimeout(xch);
var js=document.createElement('script'); js.id='jscode'; var ob=getbyid('jscode');
if(ob!=null)head.removeChild(ob); js.type='text/javascript'; js.innerHTML=d; head.appendChild(js);}

function csslink(d){var head=document.getElementsByTagName('head')[0]; if(xch)clearTimeout(xch);
var js=document.createElement('link'); js.id='csslink'; var ob=getbyid('csslink');
if(ob!=null)head.removeChild(ob); js.href=d; js.rel='stylesheet'; head.appendChild(js);}

function csscode(d){var head=document.getElementsByTagName('head')[0]; if(xch)clearTimeout(xch);
var js=document.createElement('style'); js.id='csscode'; var ob=getbyid('csscode');
if(ob!=null)head.removeChild(ob); js.type='text/css'; js.innerHTML=d; head.appendChild(js);}

//setInterval
function Timer(func,id,start,end,t){var timer=0;
if(typeof id==='undefined'||id=='')return;
if(start>end){for(i=start;i>=end;i--){timer++; curi=i;
	x=setTimeout(func+"("+i+",'"+id+"')",timer*t);}}
else if(start<end){for(i=start;i<=end;i++){timer++;
	x=setTimeout(func+"("+i+",'"+id+"')",timer*t);}}}

//function getbyid0(id){return document.getElementById(id);}
function getbyid(id,tg){//tg.target.id
if(tg!=undefined){var pa=tg.parentNode;
	if(pa==undefined)return getbyid(id);
	else if(pa.id==id)return pa;
	else{var pc=pa.childNodes;
		for(i=0;i<pc.length;i++)if(pc[i].id==id)return pc[i];}
	return getbyid(id,pa);}
return document.getElementById(id);}

//actions
function addEvent(obj,event,func){if(obj!=undefined)obj.addEventListener(event,func,true);}
function opac(op,id){if(id!=null){var ob=getbyid(id); if(ob!=undefined)ob.style.opacity=(op/100);}}
function resiz(op,id){getbyid(id).style.height=op+'px';}
function slide(op,id){getbyid(id).style.marginLeft=op+'px';}
function scrl(op,id){getbyid(id).scrollTo=op;}
function isNumeric(n){return !isNaN(parseFloat(n)) && isFinite(n);}//Number(parseFloat(n))===n;
function isNumber(n){return (n>=0||n<0);}//old

function setit(d,e){popw=getbyid(e);
if(typeof(popw)!='undefined')popw.style.backgroundColor='#'+d;}
function colorwheel(div,a){var rgb=new Array;
var arr=[0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f']; //if(a)arr=arr.reverse();
for(i=0;i<arr.length;i++){rgb=String(arr[i])+String(arr[i])+'4444';
	setTimeout(function(){setit(rgb,div)},200*i);}}

//enc//encodeURI():utf8 error with »//not enc to utf8
function encUri(val){return val;}//enc!='utf-8'?encodeURIComponent(val)://test core decuri
//function decUri(val){return unescape(val);}//SaveJm//decodeURIComponent
function encUriJ(val){val=ajx(val); //if(enc!='utf-8')val=encodeURIComponent(val);
return val;}// else var val=encodeURI(val);
function decUriJ(val){return unescape(ajx(val));}//decodeURI
function utf8_enc(v){return unescape(encodeURIComponent(v));}
function utf8_dec(v){return decodeURIComponent(escape(v));}
function addslashes(val){var val=clean_entity(/\"/g,'\\"',val);
return clean_entity(/\'/g,'\\\'',val);}
function stripslashes(val){var val=clean_entity(/\\"/g,'"',val);
return clean_entity(/\\'/g,'\'',val);}
function strreplace(rep,by,val){if(!val)return ''; return val.split(rep).join(by);}
//var repl=function(rep,by){return this.split(rep).join(by);}
function clean_entity(a,b,v){var vn=v.split(a); var nb=vn.length;
for(var i=0;i<nb;i++){var v=v.replace(a,b);} return v;}
function undefine(d){return typeof d=='undefined'?'':d;}//
function undefiner(r,n){for(i=0;i<n;i++)r[i]=undefine(r[i]); return r;}

function exploder(d,l,c){var r=d.split(l); var rt={};
for(i=0;i<r.length;i++)rt[i]=r[i].split(c); return rt;}
function explodek(d,l,c){var r=d.split(l); var rt={};
for(i=0;i<r.length;i++){var v=r[i].split(c); rt[v[0]]=ajx(v[1],1);}
return rt;}
function implodek(r,l,c){var rt=[];
for(i=0;i<r.length;i++)rt[i]=r[i].join(c);
return rt.join(l);}

function innerW(){return parseInt(window.innerWidth);}
function innerH(){return parseInt(window.innerHeight);}

//str
function substr_count(d,v){n=0;
for(i=0;i<d.length;i++){if(d.substr(i,1)==v)n++;}
return n;}
function str_split_right(d,q,p,b){
if(p)var n=d.lastIndexOf(q); else var n=d.indexOf(q);
if(n!=-1){if(b==1)var d=d.substr(n+1); else var d=d.substr(0,n);}
else return '';
return d;}

function replacetxt(id,ida,idb){
var ob=getbyid(id);
var t=ob.value?ob.value:ob.innerHTML;
var a=getbyid(ida).value;
var b=getbyid(idb).value;
ob.value=strreplace(a,b,t);}

//menus
function jumpslct(val,e){
var add=e.options[e.selectedIndex].value;
getbyid(val).value=add;}

function jumpMenu_text(val){var dn=val.split('_');//
if(dn[2]){var va=getbyid(dn[0]).value;
	if(va && va!=' '){va=va+(dn[2]!=1?dn[2]:'')+dn[1];} else{var va=dn[1];}}
else {var va=dn[1];}
getbyid(dn[0]).value=ajx(va,1);}

function jumpval(val){var dn=val.split('_'); getbyid(dn[0]).value=dn[1];}
function jumpvalue(id,v,o){getbyid(id).value=ajx(v,1); if(o)Close('popup');}
function jumphtml(id,v){getbyid(id).innerHTML=v;}
function transvalue(id,to){var tx=getbyid(id).value; getbyid(to).value=tx;}
function transhtml(id,to){var tx=getbyid(id).innerHTML; getbyid(to).innerHTML=tx;}
function insert_value(to,id){insert_b(getbyid(id).value,to);}
function strcount(id){var ob=getbyid(id).value; var to=getbyid('strcount'); to.innerHTML=ob.length;}
function execom(d){var u=null; if(d=='createLink')u=prompt('Url'); document.execCommand(d,false,u);}
function execom2(d){document.execCommand('formatBlock',false,'<'+d+'>'); getbyid('wygs').value='no';}

//pao
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

var nbw=0;
function reduce(){//popup_reduce
var pp=getbyid('pop'+curid);
var po=getbyid('popu'+curid); var ob=po.style.display;
//var pa=getbyid('popa'+curid); var obb=po.style.display;
if(ob=='block'||!ob){po.style.display='none'; nbw+=1; //pa.style.display='none';
	var pos=getPosition(pp); pp.dataset.x=pos.x; pp.dataset.y=pos.y;
	var top=innerH()-(nbw*pp.offsetHeight); var left=0;}//pp.style.top=top+'px'; pp.style.left=left+'px';
else{po.style.display='block'; nbw-=1;}}//setTimeout(function(){poprepos()},200);
	//pp.style.left=pp.dataset.x+'px'; pp.style.top=pp.dataset.y+'px';

function expand(){var po=getbyid('pop'+curid);
var owa=po.style.width; var oha=po.style.height;
var wa=innerW()-100; var ha=innerH()-40;
po.style.width=wa; po.style.height=ha;
var txa=getbyid('txtarea');
txa.style.width='100%'; txa.style.height=(ha-40)+'px';
poprepos();}

//fullscreen
function getFullscreenElement(){return document.fullscreenElement;}
function toggleFullscreen(id){var ob=getbyid(id); var oc=getbyid('art'+id);
if(getFullscreenElement()){document.exitFullscreen();
ob.style.overflow='visible'; oc.style.width='auto'; oc.style.margin='';}
else{ob.requestFullscreen().catch(console.log);
ob.style.overflow='hidden scroll'; oc.style.width='60vw'; oc.style.margin='auto';}}

//unload
const leave=()=>{if(confirm("Voulez vous quitter la page ?"))window.close();}
//document.addEventListener('unload',leave,false);}

//wheel
function mousescroll(e){var e=window.event||e;
var delta=Math.max(-1,Math.min(1,(e.wheelDelta||-e.detail)));
getbyid('alert').innerHTML=delta;
return false;}

function initscroll(e,id,fc){if(e.addEventListener){id=id;
e.addEventListener("mousewheel",mousescroll,false);//IE Opera Chrome Safari
e.addEventListener("DOMMouseScroll",mousescroll,false);}//Firefox
else if(e.attachEvent)e.attachEvent("onmousewheel",fc);}//IE<9

function mouse(ev){if(ev.pageX||ev.pageY){return {x:ev.pageX,y:ev.pageY};}
return{x:ev.clientX+document.body.scrollLeft-document.body.clientLeft,
	y:ev.clientY+document.body.scrollTop-document.body.clientTop};}

function wheelcount(e,j,o){var e=window.event||e;
var delta=Math.max(-1,Math.min(1,(e.wheelDelta||-e.detail)));
n+=delta; if(n<1)n=1;//need n
if(delta)SaveJ(j+"_"+n+"_"+o);
return false;}

function wheelinc(e){//getbyid(id)
addEvent(document,"mousewheel",function(){wheelcount(event)});}

function getPosition(e){if(e==null)return {x:0,y:0,w:0,h:0};
var left=0; var top=0; var w=e.offsetWidth; var h=e.offsetHeight;
while(e.offsetParent){left+=e.offsetLeft; top+=e.offsetTop; e=e.offsetParent;}
left+=e.offsetLeft; top+=e.offsetTop; return {x:left,y:top,w:w,h:h};}
function get_dim(e){
return {x:e.offsetLeft,y:e.offsetTop,w:e.offsetWidth,h:e.offsetHeight};}

function scrollinpos(e){if(e==null)return ''; var top=0;
while(e.parentNode){if(e.parentNode.tagName!='html')top+=e.scrollTop; e=e.parentNode;}
return top;}

function infixed(e){if(e==null)return 'no';
while(e.parentNode){if(e.style.position=='fixed')return e; e=e.parentNode;}
return 0;}

//scroll
function scrollto(to){window.scrollTo(to,0);}

function scrolltoup(p){
if(!p)var p=document.documentElement.scrollTop;
document.documentElement.scrollTop=(p-100);
x=setTimeout(function(){scrolltoup(p-100)},10);
if(p<1)clearTimeout(x);}

function scrolltoob(id,dec){
var ob=getbyid(id); var pos=getPosition(ob); var p=pos.y;
if(p)document.documentElement.scrollTop=(p-dec);}

/*function scrolltoanim(to){var inc=100;
var p=document.documentElement.scrollTop; var diff=(to-p)/inc;
for(i=0;i<=inc;i++){var set=Math.round(p+(diff*i)); setTimeout(scrollto(set),100*i);}}

function scrolltoel(id,dec){
var ob=getbyid(id); var pos=getPosition(ob); var to=pos.y-dec; pr(to);
scrolltoanim(to);}*/

function getScroll(){
if(window.pageYOffset!=undefined)return[pageXOffset,pageYOffset];
else{var sx,sy,d=document,r=d.documentElement,b=d.body;
sx=r.scrollLeft||b.scrollLeft||0; sy=r.scrollTop||b.scrollTop||0;
return [sx,sy];}}

//drag
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

//forms
function checkbox(id,t,j){var bt=getbyid(id); var n=bt.value==1?0:1; if(j)SaveJ(j);
bt.value=n; SaveJ('bt'+id+'_usg,togno___'+n+'_'+ajx(t));}
function checkact(id){getbyid(id).value=active('bt'+id);}

function checkEnter(){var e=event;
if(e && e.which)var char=e.which; else var char=e.keyCode;
if(char==13)return true;}

function checkj(o){if(checkEnter())SaveJ(o.dataset.j);}
function checksearch(id){if(checkEnter())Search2(id);}

function cases_j(id,v,n){var rb=[]; var bt=getbyid('bt'+id+n);
var hid=getbyid(id).value; var r=hid.split('~'); var ok=1;
for(i=0;i<r.length;i++){var ri=r[i]; var prf=''; var ad='+';
	if(ri.substr(0,1)=='+'){ri=ri.substr(1); prf='+';}
	else if(ri.substr(0,1)=='-'){ri=ri.substr(1); prf='-';}
	if(ri==v){ok=0;
		if(prf=='+')ad='-'; else if(prf=='-')ad='';
		if(ad){rb[i]=ad+ri; bt.innerHTML=ad+ri;} else bt.innerHTML=ri;}
	else if(ri)rb[i]=prf+ri;}
if(ok){rb.push(ad+v); bt.innerHTML=ad+v;}
getbyid(id).value=rb.join('~');}

function hidslct(id,v,t,o){
if(parseInt(o)==1||parseInt(o)==3)getbyid('bt'+id).innerHTML=ajx(t,1);
getbyid(id).value=v; Close('popup');}

function selectprnt(id,v){
getbyid('ib'+id).value=v; Close('prnt'+id);}

function areasize(e){var n=e.cols; n=n+12; var d=e.value;;
var h=Math.round(d.length/n);
var hb=d.split("\n"); if(hb.length>h)h=hb.length;
e.rows=h;}

//strings
function clean_lines(d){
var r=d.split("\n");
for(i=0;i<r.length;i++){
	r[i]=r[i].substring(0,1)==' '?r[i].substr(1):r[i];
	r[i]=r[i].substring(r[i].length-1,r[i].length)==' '?r[i].substring(0,r[i].length-1):r[i];}
return r.join("\n");}

function clean_mail(d){
d=clean_lines(d);
d=strreplace("\n ","\n",d);
d=strreplace(".\n",".µµ",d);
d=strreplace("\n","µ",d);
d=strreplace("µµ","\n\n",d);
d=strreplace("µ"," ",d);
return d;}

function base64DecodeUnicode(str){
percentEncodedStr=atob(str).split('').map(function(c){
return '%'+('00'+c.charCodeAt(0).toString(16)).slice(-2);}).join('');
return decodeURIComponent(percentEncodedStr);}

function lkc(d,v){return '<a class="popbt" onclick="'+d+'">'+v+'</a>';}
function pr(d){console.log(d);}

//audio
function audio(f){
if(!f)f='/imgb/audio/ting1.wav';
var audio=new Audio(f);
audio.play();}

function audioif(id){
var ok=getbyid('dong');
if(ok && ok.value==1)audio();}

//utils
function ajx(val,n){
var arr=['_','*','&','+',"'",'"'];//'?',':','#','’','“','”','/'
var arb=['(und)','(star)','(and)','(add)','(quote)','(dquote)'];//,'(qmark)','(ddot)','(diez)','(quote)','(dquote)','(dquote)','(slash)'
if(n){for(var i=0;i<arr.length;i++){val=strreplace(arb[i],arr[i],val);}}//decode
else{for(var i=0;i<arr.length;i++){val=strreplace(arr[i],arb[i],val);}}
return val;}

function utflatin(va){
var arr=['%3D','%7E','%E8','%E9','%EA','%E0','%E2','%F4','%F6','%FB','%FC','%F9','%EE','%EF','%20','%2C','%3B','%3A','%21','%3F','%A7','%25','%26','%7C'];
var arb=['=','~','è','é','ê','à','â','ô','ö','û','ü','ù','î','ï',' ',',',';',':','!','?','§','%','&','|'];
for(var i=0;i<arr.length;i++)va=strreplace(arr[i],arb[i],va);
return va;}

function normalize(va){
var arr=['=','~','è','é','ê','à','â','ô','ö','û','ü','ù','î','ï',' ',',',';',':','!','?','§','%','&','|'];
var arb=['','','e','e','e','a','a','o','o','u','u','u','i','i','','','','','','','','','',''];
for(var i=0;i<arr.length;i++)va=strreplace(arr[i],arb[i],va);
return va;}