<?php
session_start ();
if ($_SESSION ['rekey'] == $_REQUEST ['rekey']) {
	echo "1";
} else {
	echo "0";
}
?>