<?php
class XMLBuilder {
	public function buildXML($parameters) {
		if (is_array ( $parameters )) {
			return $this->build_level ( $parameters );
		} else {
			return "ERROR. Not an array.";
		}
	}
	private function build_level($parameters) {
		if (! is_array ( $parameters )) {
			return $this->replaceEntities ( $parameters );
		}
		$result = "";
		foreach ( $parameters as $xmltag ) {
			if (isset ( $xmltag ['name'] )) {
				$result .= "<" . strval ( $xmltag ['name'] );
				if (isset ( $xmltag ['attributes'] )) {
					$result .= $this->build_attributes ( $xmltag ['attributes'] );
				}
				$result .= ">\n";
				if (isset ( $xmltag ['childs'] )) {
					$result .= $this->build_level ( $xmltag ['childs'] );
				}
				$result .= "</" . strval ( $xmltag ['name'] ) . ">\n";
			}
		}
		return $result;
	}
	private function build_attributes($parameters) {
		if (! is_array ( $parameters )) {
			return $parameters;
		}
		$result = "";
		foreach ( $parameters as $key => $value ) {
			$result .= " $key = \"" . $this->replaceEntities ( $value ) . "\"";
		}
		return $result;
	}
	private function replaceEntities($doc) {
		$replace = array ();
		$replace ['&'] = '&amp;';
		$replace ['<'] = '&lt;';
		$replace ['>'] = '&gt;';
		$replace ['\\'] = '';
		$replace ['"'] = '&quot;';
		foreach ( $replace as $k => $v ) {
			$doc = str_replace ( $k, $v, $doc );
		}
		return $doc;
	}
}
/*
 * [0]['name'] = "body"; [0]['attributes'] = array("id"=>"123","parent"=>"12"); [0]['childs'] = array();
 */
?>