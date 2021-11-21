<?php

class unk{

	function __destruct()
	{
		$this->clear();
	}

	function load(
		$str,
		$lowercase = true,
		$stripRN = true,
		$defaultBRText = DEFAULT_BR_TEXT,
		$defaultSpanText = DEFAULT_SPAN_TEXT,
		$options = 0)
	{
		global $debug_object;

		// prepare
		$this->prepare($str, $lowercase, $defaultBRText, $defaultSpanText);

		// Per sourceforge http://sourceforge.net/tracker/?func=detail&aid=2949097&group_id=218559&atid=1044037
		// Script tags removal now preceeds style tag removal.
		// strip out <script> tags
		$this->remove_noise("'<s*script[^>]*[^/]>(.*?)<s*/s*scripts*>'is");
		$this->remove_noise("'<s*scripts*>(.*?)<s*/s*scripts*>'is");

		// strip out the r n's if we are told to.
		if ($stripRN) {
			$this->doc = str_replace("\r", ' ', $this->doc);
			$this->doc = str_replace("\n", ' ', $this->doc);

			// set the length of content since we have changed it.
			$this->size = strlen($this->doc);
		}

		// strip out cdata
		$this->remove_noise("'<![CDATA[(.*?)]]>'is", true);
		// strip out comments
		$this->remove_noise("'<!--(.*?)-->'is");
		// strip out <style> tags
		$this->remove_noise("'<s*style[^>]*[^/]>(.*?)<s*/s*styles*>'is");
		$this->remove_noise("'<s*styles*>(.*?)<s*/s*styles*>'is");
		// strip out preformatted tags
		$this->remove_noise("'<s*(?:code)[^>]*>(.*?)<s*/s*(?:code)s*>'is");
		// strip out server side scripts
		$this->remove_noise("'(<?)(.*?)(?>)'s", true);

		if($options & HDOM_SMARTY_AS_TEXT) { // Strip Smarty scripts
			$this->remove_noise("'({w)(.*?)(})'s", true);
		}

		// parsing
		$this->parse();
		// end
		$this->root->_[HDOM_INFO_END] = $this->cursor;
		$this->parse_charset();

		// make load function chainable
		return $this;
	}

}