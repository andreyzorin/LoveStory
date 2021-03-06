<?php 
//Шифровка пароля
function my_crypt($var) {
	$salt = "abc";
	$salt2 = "zxc";
	$var = crypt(md5($var.$salt),$salt2);
	return $var;
} 
//Выводит расширенную инфомрацию об массиве
function array_info($array, $stop = false) {
	echo '<pre>'.print_r($array, 1).'</pre>';
	if 	(!$stop) {
		exit();
	}
};
//Расширеная версия mysqli_query
function my_query($query, $key = 0) {
	$res = DB::_($key)->query($query);
	$info = debug_backtrace();
	if ($res === false) {
		$error = "query: ".$query."<br>\n".
			"error: ".mysqli_error(DB::_($key))."<br>\n".DB::_($key)->error."<br>\n".
			"file: ".$info[0]['file']."<br>\n".
			"line: ".$info[0]['line']."<br>\n".
			"date: ".date("H:i d-m-Y")."<br>\n".
			"----------------------------------";

		file_put_contents('./logs/mysql.log', strip_tags($error)."\n\n", FILE_APPEND);
		echo $error;
		exit();
	} else {
		return $res;
	}
}
//Автоматическое подключение классов
function __autoload($class) {
	include './lib/class_'.$class.'.php';
}
//Фильтрация вводимых данных
function filter_int($num) {
	if (!is_array($num)) {
		$num = (int)($num);
	} else {
		$num = array_map('filter_int', $num);
	}

	return $num;
}
function filter_float ($num) {
	if (!is_array($num)) {
		$num = (float)($num);
	} else {
		$num = array_map('filter_float', $num);
	}
	return $num;
}
function mres ($string, $key = 0) {
	if (!is_array($string)) {
		$string = DB::_($key)->real_escape_string($string);
	} else {
		$string = array_map('filter_string', $string);
	}
	return $string;
}

function hsc ($char) {
	if (!is_array($char)) {
		$char = htmlspecialchars($char);
	} else {
		$char = array_map('filter_html_tags', $char);
	}
	return $char;
}
?>