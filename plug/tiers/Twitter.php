<?php
//https://github.com/tfairane/TwitterAPI
/**
 * @file	TwitterAPI.php
 * @brief	Twitter Application Programming Interface
 * @author	Toufik Airane
 * @author-revision	davH
 * @version	1.3
 * @date	2015
 */

/**
 * @class Twitter
 * @brief class Twitter
 */
class Twitter{
	/**
	* @public
	* @method __construct
	*/
	public function __construct(){
		//params of you App are in an msql table named (hub)_twit
		$r=msql_read('',ses('qb').'_twit','',1);
		$this->_oauth_token=$r[1];
		$this->_oauth_token_secret=$r[2];
		$this->_oauth_consumer_key=$r[3];
		$this->_oauth_consumer_secret=$r[4];
		$this->_oauth_nonce=md5(rand());
		$this->_oauth_signature_method='HMAC-SHA1';
		$this->_oauth_timestamp=time();
		$this->_oauth_version='1.0';
	}
	
	/**
	* @method buildUrl build url from known Array
	*/
	private function urlParams(){
		return array(
			'oauth_consumer_key'=>$this->_oauth_consumer_key,
			'oauth_nonce'=>$this->_oauth_nonce,
			'oauth_signature'=>$this->_oauth_signature,
			'oauth_signature_method'=>$this->_oauth_signature_method,
			'oauth_timestamp'=>$this->_oauth_timestamp,
			'oauth_token'=>$this->_oauth_token,
			'oauth_version'=>$this->_oauth_version
		);
	}
	
	private function buildUrlParams(){$ret='';
		$r=$this->urlParams(); unset($r['oauth_signature']);
		foreach($r as $k=>$v)$rt[]=$k.'='.rawurlencode($v);
	return implode('&',$rt);}
	
	private function buildUrlArray(){$ret='';
		$r=$this->urlParams();
		foreach($r as $k=>$v)$rt[]=$k.'="'.rawurlencode($v).'"';
	return implode(',',$rt);}
	
	/**
	 * @method send used to open the websarvice of twitter
	*/
	private function send($url,$postfields){
		$session=curl_init();
		curl_setopt($session,CURLOPT_URL,$url);
		curl_setopt($session,CURLOPT_HTTPHEADER,$this->_DST);
		if($postfields){
		curl_setopt($session,CURLOPT_POST,TRUE);
		curl_setopt($session,CURLOPT_POSTFIELDS,$postfields);}
		curl_setopt($session,CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($session,CURLOPT_SSL_VERIFYHOST,0);
		curl_setopt($session,CURLOPT_RETURNTRANSFER,1);
		$ret=json_decode(curl_exec($session),true);
	return $ret;}
	
	/**
	 * @method update
	 * @brief publish a tweet
	 * @param[in] $tweet tweet to post
	 */
	public function update($tweet){
		$this->_url='https://api.twitter.com/1.1/statuses/update.json';
		$this->_method='POST';
		$this->_query='status='.rawurlencode($tweet);
		$this->_parameter_string=$this->buildUrlParams().'&'.$this->_query;
		$this->gen();
		return $this->send($this->_url,$this->_query);
	}
	
	/**
	 * @method retweet
	 * @brief retweet
	 * @param[in] $id tweet to retweet
	 */
	public function retweet($id){
		$this->_url='https://api.twitter.com/1.1/statuses/retweets.json';
		$this->_method='POST';
		$this->_query='status='.rawurlencode($id);
		$this->_parameter_string=$this->buildUrlParams().'&'.$this->_query;
		$this->gen();
		return $this->send($this->_url,$this->_query);
	}
	
	/**
	 * @method follow
	 * @brief follow an user
	 * @param[in] $id id of user
	 */
	public function follow($id){
		$this->_url='https://api.twitter.com/1.1/friendships/create.json';
		$this->_method='POST';
		$this->_query='user_id='.rawurlencode($id);
		$this->_follow='follow=true';
		$this->_parameter_string=$this->_follow .'&'.$this->buildUrlParams().'&'.$this->_query;
		$this->gen();
		return $this->send($this->_url,$this->_follow.'&'.$this->_query);
	}
	
	/**
	 * @method user_timeline
	 * @brief		consulter les dernières activités d'une timeline
	 * @param[in]	$user	Twitter user
	 * @param[in]	$count	Last tweets count
	 * @param[in]	$max	tweets after
	 */	
	public function user_timeline($user,$count,$max=''){
		$this->_url='https://api.twitter.com/1.1/statuses/user_timeline.json';
		$this->_method='GET';
		$this->_user='screen_name='.rawurlencode($user);
		$this->_count='count='.rawurlencode($count).'&include_rts=1';
		$this->_count.=$max?'&max_id='.rawurlencode($max):'';
		$this->_parameter_string=$this->_count.'&'.$this->buildUrlParams().'&'.$this->_user;
		$this->gen();
		return $this->send($this->_url.'?'.$this->_user.'&'.$this->_count,'');
	}
	
	/**
	 * @method home_timeline
	 * @brief		consulter les dernières activités d'une timeline
	 * @param[in]	$user	Twitter user
	 * @param[in]	$count	Last tweets count
	 */
	
	public function home_timeline($user,$count,$max=''){
		$this->_url='https://api.twitter.com/1.1/statuses/home_timeline.json';
		$this->_method='GET';
		$this->_user='screen_name='.rawurlencode($user);
		$this->_count='count='.rawurlencode($count).'&include_rts=1';
		$this->_count.=$max?'&max_id='.rawurlencode($max):'';
		$this->_parameter_string=$this->_count.'&'.$this->buildUrlParams().'&'.$this->_user;
		$this->gen();
		return $this->send($this->_url.'?'.$this->_user.'&'.$this->_count,'');
	}

	/**
	 * @method show
	 * @brief		consulter les informations relatives à un compte
	 * @param[in]	$user	nom du compte
	 */
	public function show($user){
		$this->_url='https://api.twitter.com/1.1/users/show.json';
		$this->_method='GET';
		$this->_user='screen_name='.rawurlencode($user);
		$this->_parameter_string=$this->buildUrlParams().'&'.$this->_user;
		$this->gen();
		return $this->send($this->_url.'?'.$this->_user,'');
	}
	
	/**
	 * @method read
	 * @brief		consulter les informations relatives à un compte
	 * @param[in]	$user	nom du compte
	 */
	public function read($id){
		$this->_url='https://api.twitter.com/1.1/statuses/show/'.$id.'.json';
		$this->_method='GET';
		//$this->_id='id='.rawurlencode($id);
		$this->_parameter_string=$this->buildUrlParams();
		$this->gen();
		return $this->send($this->_url,'');
	}
	
	/**
	 * @method replies
	 * @brief		consulter les informations relatives à un compte
	 * @param[in]	$user	nom du compte
	 */
	//676869457180946432
	public function replies($id){
		$this->_url='https://api.twitter.com/1/related_results/show/'.$id.'.json?include_entities=1';
		$this->_method='GET';
		//$this->_id='id='.rawurlencode($id);
		$this->_parameter_string=$this->buildUrlParams();
		$this->gen();
		return $this->send($this->_url,'');
	}
	
	/**
	 * @private
	 * @method gen
	 * @brief		Créer les différentes signatures importantes pour l'OAuth
	 */
	private function gen(){
		$this->_signature_base_string=rawurlencode($this->_method).'&'.rawurlencode($this->_url).'&'.rawurlencode($this->_parameter_string);
		$this->_signing_key=rawurlencode($this->_oauth_consumer_secret).'&'.rawurlencode($this->_oauth_token_secret);
		$this->_oauth_signature=base64_encode(hash_hmac('SHA1',$this->_signature_base_string,$this->_signing_key,TRUE));
		$this->_DST=array('Authorization: OAuth '.$this->buildUrlArray());
	}

	/*
	 * @brief Class members
	*/
	
	private $urlParams;
	 
	private $_max;
	private $_count;
	private $_DST;
	private $_follow;
	private $_method;
	private $_oauth_consumer_key;
	private $_oauth_consumer_secret;
	private $_oauth_nonce;
	private $_oauth_signature;
	private $_oauth_signature_method;
	private $_oauth_timestamp;
	private $_oauth_token;
	private $_oauth_token_secret;
	private $_oauth_version;
	private $_parameter_string;
	private $_query;
	private $_signature_base_string;
	private $_signing_key;
	private $_url;
	private $_user;
	private $_id;
}
?>