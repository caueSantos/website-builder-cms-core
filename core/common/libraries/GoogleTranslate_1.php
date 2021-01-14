<?php
// Author: Tomasz Kapusta 2009
// First version: 30.05.2009
// Version: 14.01.2010

// Licence: MIT
// http://de77.com
// http://code.google.com/p/google-translate/

class GoogleTranslate
{
	public $langIn	= 'pr-br';
	public $langOut	= 'en';
	
	private $cache = array();
	private $cacheDir = 'gt_cache/';
	                           
	//languages available on GoogleTranslate on 30.05.2009
	public $outLangs = array(
		"pl" => "Polski",	
		"en" => "English",
		
		"ar" => "Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©",
		"bg" => "Ð‘ÑŠÐ»Ð³Ð°Ñ€ÑÐºÐ¸",
		"ca" => "CatalÃ ",		
		"cs" => "ÄŒeÅ¡tina",				
		"da" => "Dansk",
		"de" => "Deutsch",
		"el" => "ÎµÎ»Î»Î·Î½Î¹ÎºÎ¬",
		"es" => "EspaÃ±ol",		
		"et" => "Eesti",
		"fi" => "Suomi",
		"fr" => "FranÃ§ais",		
		"gl" => "Galego",		
		"hi" => "à¤¹à¤¿à¤¨à¥à¤¦à¥€",		
		"hr" => "Hrvatski",
		"hu" => "Magyar",
		"id" => "Bahasa Indonesia",
		"it" => "Italiano",		
		"iw" => "×¢×‘×¨×™×ª",
		"ja" => "æ—¥æœ¬èªž",
		"ko" => "í•œêµ­ì–´",				
		"lt" => "LietuviÅ³",
		"lv" => "LatvieÅ¡u",
		"mt" => "Malti",
		"nl" => "Nederlands",
		"no" => "Norsk",
		"pt" => "PortuguÃªs",
		"ro" => "RomÃ¢ni",		
		"ru" => "Ð ÑƒÑÑÐºÐ¸Ð¹",
		"sk" => "SlovenskÃ½",
		"sl" => "Slovenski",
		"sq" => "Shqipe",
		"sr" => "Ð¡Ñ€Ð¿ÑÐºÐ¸",				
		"sv" => "Svenska",
		"th" => "à¹„à¸—à¸¢",
		"tl" => "Philippine Wika",		
		"tr" => "TÃ¼rkÃ§e",
		"uk" => "Ð£ÐºÑ€Ð°Ñ—Ð½ÑÑŒÐºÐ°",		
		"vi" => "Tiáº¿ng Viá»‡t",										
		"zh-CN" => "ç¹ä½“å­—",  //chinese simplified
		"zh-TW" => "ç¹é«”å­—" //chinese
	);
	
	//TODO: translate these
	public $inLangs = array( 
		"sq" => "albaÅ„ski",
		"en" => "angielski",
		"ar" => "arabski",
		"bg" => "buÅ‚garski",
		"zh-CN" => "chiÅ„ski",
		"hr" => "chorwacki",
		"cs" => "czeski",
		"da" => "duÅ„ski",
		"et" => "estoÅ„ski",
		"tl" => "filipiÅ„ski",
		"fi" => "fiÅ„ski",
		"fr" => "francuski",
		"gl" => "galicyjski",
		"el" => "grecki",
		"iw" => "hebrajski",
		"hi" => "hindi",
		"es" => "hiszpaÅ„ski",
		"nl" => "holenderski",
		"id" => "indonezyjski",
		"ja" => "japoÅ„ski",
		"ca" => "kataloÅ„ski",
		"ko" => "koreaÅ„ski",
		"lt" => "litewski",
		"lv" => "Å‚otewski",
		"mt" => "maltaÅ„ski",
		"de" => "niemiecki",
		"no" => "norweski",
		"pl" => "polski",
		"pt" => "portugalski",
		"ru" => "rosyjski",
		"ro" => "rumuÅ„ski",
		"sr" => "serbski",
		"sk" => "sÅ‚owacki",
		"sl" => "sÅ‚oweÅ„ski",
		"sv" => "szwedzki",
		"th" => "tajski",
		"tr" => "turecki",
		"uk" => "ukraiÅ„ski",
		"hu" => "wÄ™gierski",
		"vi" => "wietnamski",
		"it" => "wÅ‚oski"
	);

	public function browserLang()
	{
		return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	}
	
	public function codeToLang($code, $input = true)
	{
		if ($input) return $this->inLangs[$code];
		else		return $this->outLangs[$code];
	}
	
	public function langToCode($lang, $input = true)
	{
		if ($input) return array_search($lang, $this->inLangs);
		else		return array_search($lang, $this->outLangs);
	} 
	
	private function loadCache()
	{
		chdir(__DIR__);
		if (!isset($this->cache[$this->langIn][$this->langOut]))
		{
			$cacheFile = $this->cacheDir . $this->langIn . '_' . $this->langOut . '.gtc'; 
			if (file_exists($cacheFile))
			{ 
				$data = unserialize(file_get_contents($cacheFile));
				$this->cache[$this->langIn][$this->langOut] = $data;
			}
			else
			{
				$this->cache[$this->langIn][$this->langOut] = array();
			}
		}
	}
	
	private function saveCache()
	{
		chdir(__DIR__);
		$data = serialize($this->cache[$this->langIn][$this->langOut]);
		$cacheFile = $this->cacheDir . $this->langIn . '_' . $this->langOut . '.gtc'; 
		file_put_contents($cacheFile, $data);			
	}
	
	private function getCached($text)
	{
		$this->loadCache();
		
		if (isset($this->cache[$this->langIn][$this->langOut][$text]))
		{
			return $this->cache[$this->langIn][$this->langOut][$text];
		}
		return false;
	}
		
	public function translate($text)
	{
		if ($this->langIn == $this->langOut) return $text;
	
		if ($res = $this->getCached($text))
		{
			return $res;
		}
			
		$url = 'http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=' .
				urlencode($text) . 
				'&langpair=' . $this->langIn . '%7C' .
				$this->langOut;
				
		$json_data = file_get_contents($url);
		
		$j = json_decode($json_data);
		   
		if (isset($j->responseStatus) and $j->responseStatus == 200)
		{
			$t = $j->responseData->translatedText;
			$this->cache[$this->langIn][$this->langOut][$text] = $t;
			return $t;
		}
		else return false;
	}	
	
	public function __destruct()
	{
		$this->saveCache();
	}
}


// Simple JSON decoder
// in case json_decode is not available..
if ( !function_exists('json_decode') )
{
	function json_decode($json) 
	{  		
		$comment = false;
		$out = '$x=';
		
		for ($i=0; $i<strlen($json); $i++)
		{
			if (!$comment)
			{
				if ($json[$i] == '{')		$out .= ' array(';
				else if ($json[$i] == '}')	$out .= ')';
				else if ($json[$i] == ':')	$out .= '=>';
				else 						$out .= $json[$i];			
			}
			else $out .= $json[$i];
			if ($json[$i] == '"')	$comment = !$comment;
		}
		eval($out . ';');
		return $x;
	}  
}
?>