<?php
require_once "spynot.php";

mysql_toGet_clean();

foreach (mysql_toGet_getAll() as $app)
	spynot_getApp($app);

mysql_toGet_clean();

if (date("Hi") == "0300")
	foreach (mysql_app_getAll() as $app)
		spynot_updateApp($app);

mysql_settings_putLastCron();