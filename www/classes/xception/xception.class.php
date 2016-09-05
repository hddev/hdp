<?php
class Xception extends Exception {
	private $type;
	function __construct($message, $code, $type) {
		parent::__construct ( $message, $code );
		$this->type = $this->DetectType ( $type );
	}
	/**
	 * Определяет тип исключения.
	 *
	 * @param string $type        	
	 * @return string
	 */
	private function DetectType($type) {
		switch ($type) {
			case "access" :
				return "access";
			case "fatal" :
				return "fatal";
			case "info" :
				return "info";
			default :
				return "error";
		}
	}
	/**
	 * Показывает сообщение об ошибке.
	 */
	public function ShowMessage() {
		echo "
			<table width='100%' cellpadding='3' cellspacing='0' border='0'
				style='background-color: #fff8be; border: 2px solid #ff5400; clear: both;'>
				<tr>
					<td width='16'>
							<img src='/images/exceptions/" . $this->type . ".png'
						title=" . $this->type . " alt=" . $this->type . " /></td>
					<td>" . parent::getMessage () . "</td>
				</tr>
			</table>				
			";
	}
}
?>
