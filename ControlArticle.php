<?php
require_once("ControlFunctions.php");

$Order = array("ID", "Name", "Category", "Language", "Youtubelink", "Brief", "Rate", "ArticleDay", "ArticleMonth", "ArticleYear", "WriterID", "EditorID" , "IMG" );
$OrderSize = 13;
$Seperator = "~#*$%#";
$FileLoc = "Data".DIRECTORY_SEPARATOR."Users".DIRECTORY_SEPARATOR."ArticlesList.txt";

function SaveArticle($Article) {
	global $OrderSize, $Order, $Seperator, $FileLoc;
	$ID = 0;
	$file = fopen($FileLoc, "a+") or die("Unable to open file!");
	fwrite($file, ArticleToString($Article));
	fclose($file);
}

function ArrToArticle($arr) {
	global $OrderSize, $Order;
	for ($i = 0; $i < $OrderSize && isset($arr[$i]); $i++) {
		$Article[$Order[$i]] = $arr[$i];
	}
	return $Article;
}

function ArticleToString($Article) {
	global $OrderSize, $Order, $Seperator, $FileLoc;
	$txt = "";
	for ($i = 0; $i < $OrderSize; $i++) {
		if (isset($Article[$Order[$i]])) {
			$txt.= $Article[$Order[$i]].$Seperator;
		} else {
			$txt.= "".$Seperator;
		}
	}
	return $txt."\r\n";
}
function LastID() {
	global $FileLoc;
	$ID = 0;
	$file = fopen($FileLoc, "a+") or die("Unable to open file!");
	while ((!feof($file))) {
		$arr = explode("~#*$%#", fgets($file));
		if($ID<$arr[0]){
			$ID = $arr[0];
		}
	}
	fclose($file);
	return $ID;
}
//=========================================HTML=========================================
function SaveBodyHtml($ID , $Body) {
	$ds = DIRECTORY_SEPARATOR;
	$destination = 'Data\Articles'.$ds.$ID.'.html';
	$file = fopen($destination, "x+") or die("Unable to open file!");
	fwrite($file, $Body);
	fclose($file);
}
function UpdateHTML($ID , $Body){
	$ds = DIRECTORY_SEPARATOR;
	$destination = 'Data\Articles'.$ds.$ID.'.html';
	$file = fopen($destination, "w+") or die("Unable to open file!");
	fwrite($file, $Body);
	fclose($file);
}
//=========================================Load=========================================
function LoadArticleCategory($Find) {
	global $FileLoc, $Seperator;
	$file = fopen($FileLoc, "a+") or die("Unable to open file!");
	$AllArticle = array();
	$i = 0;
	while ((!feof($file))) {
		$temp = fgets($file);
		if($temp!=""){
			$Article = ArrToArticle(explode($Seperator, $temp));
			if (strpos($Article["Category"], $Find) !== FALSE) {
				$AllArticle[$i++] = $Article;
			}
		}
	}
	return $AllArticle;
}
function LoadArticle($ID) {
	global $FileLoc, $Seperator;
	$file = fopen($FileLoc, "a+") or die("Unable to open file!");
	while ((!feof($file))) {
		$temp = fgets($file);
		if($temp!=""){
			$Article = explode($Seperator, $temp);
			if ($Article[0] == $ID) {
				return ArrToArticle($Article);
			}
		}
	}
	return NULL;
}
function SearchStringID($Find) {
	global $FileLoc, $Seperator;
	$file = fopen($FileLoc, "a+") or die("Unable to open file!");
	while ((!feof($file))) {
		$temp = fgets($file);
		if($temp!=""){
			$Article = explode($Seperator, $temp);
			if ($Article[0] == $Find) {
				return $temp;
			}
		}
	}
	return NULL;
}
function SearchArticleTitle($Find) {
	global $FileLoc, $Seperator;
	$file = fopen($FileLoc, "a+") or die("Unable to open file!");
	$AllArticle = array();
	$i = 0;
	while ((!feof($file))) {
		$temp = fgets($file);
		if($temp!=""){
			$Article = ArrToArticle(explode($Seperator, $temp));
			if (strpos($Article["Name"], $Find) !== FALSE) {
				$AllArticle[$i++] = $Article;
			}
		}
	}
	return $AllArticle;
}
function LoadAllArticle() {
	global $FileLoc, $Seperator;
	$file = fopen($FileLoc, "a+") or die("Unable to open file!");
	$AllArticle = array();
	$i = 0;
	while ((!feof($file))) {
		$temp = fgets($file);
		if($temp!=""){
			$Article = ArrToArticle(explode($Seperator, $temp));
			$AllArticle[$i++] = $Article;
		}
	}
	return $AllArticle;
}
//=========================================Update=========================================
function DeleteArticle($ID) {
	$ds = DIRECTORY_SEPARATOR;
	global $OrderSize, $Order, $Seperator, $FileLoc;
	$temp = SearchStringID($ID);
	if(NULL != $temp){
		UpdateRecord("", $temp);
		unlink("Data\Articles".$ds.$ID.".html");
	}
}
function UpdateArticle($Article , $Body) {
	$ds = DIRECTORY_SEPARATOR;
	global $OrderSize, $Order, $Seperator, $FileLoc;
	$temp = SearchStringID($Article["ID"]);
	if(NULL != $temp){
		$new = ArticleToString($Article);
		UpdateRecord($new, $temp);
		UpdateHTML($Article["ID"] ,$Body);
	}
}
?>