<?php
require_once "config.php";
function mysql_con()
{
	$db = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
	return $db;
}

function mysql_app_get($packageName)
{
	$db = mysql_con();

	$stmt = $db->prepare("SELECT * FROM apps WHERE (packageName = :packageName) LIMIT 1");
	$stmt->execute(array(':packageName'=>$packageName));
	if ($stmt->rowCount())
		return $stmt->fetch(PDO::FETCH_OBJ);
	else
		return null;
}

function mysql_app_add($appData)
{
	$db = mysql_con();
	if (!mysql_app_inDb($appData->packageName))
	{
		$stmt = $db->prepare("INSERT INTO apps(packageName, title, author, description, url, icon, playRating, category, cost, numDownloads, permissions) VALUES (:packageName, :title, :author, :description,	 :url, :icon, :playRating, :category, :cost, :numDownloads, :permissions);");
		$stmt->execute(array(
			':packageName'=>$appData->packageName,
			':title'=>$appData->title,
			':author'=>$appData->author,
			':description'=>$appData->description,
			':url'=>$appData->url,
			':icon'=>$appData->icon,
			':playRating'=>$appData->playRating,
			':category'=>$appData->category,
			':cost'=>$appData->cost,
			':numDownloads'=>$appData->numDownloads,
			':permissions'=>implode(", ", $appData->permissions)
			#':permissions'=>"A lot"
		));
		return $stmt->rowCount();
	}
	else
		return 0;
}

function mysql_app_getAll()
{
	$db = mysql_con();

	foreach($db->query("SELECT packageName FROM apps") as $row)
	{
		$array[] = $row['packageName'];
	}
	return $array;
}

function mysql_app_update($appData)
{
	$db = mysql_con();
	if (mysql_app_inDb($appData->packageName))
	{
		$stmt = $db->prepare("UPDATE apps SET title=:title, author=:author, description=:description, url=:url, icon=:icon, playRating=:playRating, category=:category, cost=:cost, numDownloads=:numDownloads, permissions=:permissions WHERE packageName=:packageName;");
		$stmt->execute(array(
			':packageName'=>$appData->packageName,
			':title'=>$appData->title,
			':author'=>$appData->author,
			':description'=>$appData->description,
			':url'=>$appData->url,
			':icon'=>$appData->icon,
			':playRating'=>$appData->playRating,
			':category'=>$appData->category,
			':cost'=>$appData->cost,
			':numDownloads'=>$appData->numDownloads,
			':permissions'=>implode(", ", $appData->permissions)
		));
		return $stmt->rowCount();
	}
	else
		return 0;
}

function mysql_app_inDb($packageName)
{
	$db = mysql_con();

	$stmt = $db->prepare("SELECT COUNT(*) FROM apps WHERE (packageName = :packageName)");
	$stmt->execute(array(':packageName'=>$packageName));
	$count = $stmt->fetchColumn();

	if ($count)
		return true;
	else
		return false;

}

function mysql_toGet_add($arrayPackages)
{
	$db = mysql_con();

	$stmt = $db->prepare("INSERT INTO toGet(packageName) VALUES (:packageName);");
	foreach ($arrayPackages as $package)
	{
		$stmt->execute(array(':packageName'=>$package->packageName));
	}
}

function mysql_toGet_getAll()
{
	$db = mysql_con();

	foreach($db->query("SELECT packageName FROM toGet") as $row)
	{
		$array[] = $row['packageName'];
	}
	return $array;
}

function mysql_toGet_clean()
{
	$db = mysql_con();

	$db->query("DELETE toGet FROM toGet INNER JOIN apps ON toGet.packageName = apps.packageName");
	$db->query("DELETE t2 FROM toGet t1 INNER JOIN toGet t2 on t1.packageName = t2.packageName WHERE t1.id < t2.id");

}

function mysql_settings_getLastSearch()
{
	$db = mysql_con();

	foreach ($db->query("SELECT value FROM `settings` WHERE setting LIKE 'lastSearch%' GROUP BY setting ASC") as $row)
	{
		$array[] = $row['value'];
	}
	return $array;

}
function mysql_settings_putLastSearch($term)
{
	$db = mysql_con();
	$db->query("DELETE settings FROM settings WHERE setting = 'lastSearch4';UPDATE settings SET setting='lastSearch4' WHERE setting='lastSearch3';UPDATE settings SET setting='lastSearch3' WHERE setting='lastSearch2';UPDATE settings SET setting='lastSearch2' WHERE setting='lastSearch1';");	
	$stmt = $db->prepare("INSERT INTO settings(setting, value) VALUES ('lastSearch1', :newTerm);");
	$stmt->execute(array(':newTerm'=>$term));


}

function mysql_settings_getLastCron()
{
	$db = mysql_con();

	foreach ($db->query("SELECT value FROM settings WHERE setting='lastCron'") as $row)
		return $row['value'];

}
function mysql_settings_putLastCron()
{
	$db = mysql_con();

	$time = time();
	$db->query("UPDATE settings SET value='$time' WHERE setting='lastCron'");

	return $time;
}