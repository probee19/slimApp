#!/usr/bin/env php
<?php

/**
 *
 * DB-IP.com database import script
 *
 * Copyright (C) 2016 db-ip.com
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 */

require "dbip.class.php";

$opts = getopt("f:d:t:b:u:p:");

$filename = "dbip-country-2018-03.csv";
$type = "country";

$dbname = @$opts["b"]
or $dbname = $_SERVER['RDS_DB_NAME'];

$table = @$opts["t"]
or $table = "dbip_lookup";

$username = @$opts["u"]
or $username = $_SERVER['RDS_USERNAME'];

$password = @$opts["p"]
or $password = $_SERVER['RDS_PASSWORD'];

if (!isset($type) && preg_match('/dbip-(country|city|location|isp|full)/i', $filename, $res)) {
	$type = $res[1];
}

if (!isset($filename) || !isset($type)) {
	die("usage: {$argv[0]} -f <filename.csv[.gz]> [-d <country|city|location|isp|full>] [-b <database_name>] [-t <table_name>] [-u <username>] [-p <password>]\n");
}
$localhost = $_SERVER['RDS_HOSTNAME'];

switch (strtolower($type)) {
	case "country":		$dbtype = DBIP::TYPE_COUNTRY;	break;
	case "city":		$dbtype = DBIP::TYPE_CITY;		break;
	case "location":	$dbtype = DBIP::TYPE_LOCATION;	break;
	case "isp":			$dbtype = DBIP::TYPE_ISP;		break;
	case "full":		$dbtype = DBIP::TYPE_FULL;		break;
	default:			die("invalid database type\n");
}

try {
        // Connect to the database
        $db = new PDO("mysql:host={$localhost};dbname={$dbname}", $username, $password);
        // Alternatively connect to MySQL using the old interface
        // Comment the PDO statement above and uncomment the mysql_ calls
        // below if your PHP installation doesn't support PDO :
        // $db = mysql_connect("localhost", $username, $password);
        // mysql_select_db($dbname, $db);

        // Instanciate a new DBIP object with the database connection
        $dbip = new DBIP($db);
        // Alternatively instanciate a DBIP_MySQL object
        // Comment the new statement above and uncomment below if your PHP
        // installation doesn't support PDO :
        // $dbip = new DBIP_MySQL($db);

	$nrecs = $dbip->Import_From_CSV($filename, $dbtype, $table, function($progress) {
		echo "\r{$progress} ...";
	});
	echo "\rfinished importing {$nrecs} records\n";
} catch (DBIP_Exception $e) {
	echo "error: {$e->getMessage()}\n";
}
