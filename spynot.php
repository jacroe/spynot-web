<?php
error_reporting(E_ERROR | E_PARSE);
header("content-type: text/html; charset=UTF-8");

require_once "mysql.php";

function spynot_getApp($packageName)
{
	if (mysql_app_inDb($packageName))
		return mysql_app_get($packageName);

	if (spynot_addApp($packageName))
	{
		mysql_toGet_clean();
		return mysql_app_get($packageName);
	}
	else
		return -1;

}

function spynot_addApp($packageName)
{
	curl_setopt_array($ch = curl_init(), array(
	CURLOPT_URL => "http://spynot.ngrok.com/api",
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_POSTFIELDS => array(
	  "json" => '{"searchString":"' . $packageName . '","method":"GetDetails", "id":1}' )));
	$message = curl_exec($ch);
	curl_close($ch);
	$json = json_decode($message);
	if (is_null($json->GooglePlayData))
		return false;
	else
		return mysql_app_add($json->GooglePlayData);
}

function spynot_updateApp($packageName)
{
	curl_setopt_array($ch = curl_init(), array(
	CURLOPT_URL => "http://spynot.ngrok.com/api",
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_POSTFIELDS => array(
	  "json" => '{"searchString":"' . $packageName . '","method":"GetDetails", "id":1}' )));
	$message = curl_exec($ch);
	curl_close($ch);
	$json = json_decode($message);
	if (is_null($json->GooglePlayData))
		return false;
	else
		return mysql_app_update($json->GooglePlayData);
}

function spynot_getSearch($searchString)
{
	curl_setopt_array($ch = curl_init(), array(
	CURLOPT_URL => "http://spynot.ngrok.com/api",
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_POSTFIELDS => array(
	  "json" => '{"searchString":"' . $searchString . '","method":"SearchApp", "id":1}' )));
	$message = curl_exec($ch);
	curl_close($ch);
	$json = json_decode($message);
	if (is_null($json->results))
		return false;
	else
	{
		mysql_toGet_add($json->results);
		return $json->results;
	}		
}
