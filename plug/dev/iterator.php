<?php 

class iterator implements Iterator{
private $position=0;
private $array=[];
public function __construct(){$this->position=0;}
public function build1(){array_push($this->array,1,2,3);}
public function build2(){array_push($this->array,3,4,5);}
public function rewind(){$this->position=0;}
public function current(){return $this->array[$this->position];}
public function key(){return $this->position;}
public function next(){++$this->position;}
public function valid(){return isset($this->array[$this->position]);}
}

class iterator{
static function home($p,$o){
$it=new iterator;
$r=$it->build1();
$r=$it->build2();
foreach($it as $k=>$v)$ret.=$v;
return $ret;}
}
?>