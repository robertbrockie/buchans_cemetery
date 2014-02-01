<?php

include('Database.php');

class CemeterySiteDAO {

	public static function loadFromRow($row) {
		$cemetery_site = new CemeterySite();

		$cemetery_site->setId($row['id']);
		$cemetery_site->setRow($row['row']);
		$cemetery_site->setPlot($row['plot']);
		$cemetery_site->setName($row['name']);
		$cemetery_site->setNote($row['note']);
		$cemetery_site->setThumbnailImage($row['thumbnail_image']);
		$cemetery_site->setFullImage($row['full_image']);

		return $cemetery_site;
	}

	public static function search($query) {
		$mysql = new Database();
		$mysql->connect();

		$query = sprintf("SELECT * FROM sites WHERE name LIKE '%%%s%%'",
						mysql_real_escape_string($query));

		$result = $mysql->query($query);

		$sites = array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$sites[] = self::loadFromRow($row);
		}

		$mysql->disconnect();

		return $sites;
	}

	public static function save($cemetery_site) {

		$mysql = new Database();
		$mysql->connect();

		$query = sprintf("INSERT INTO sites (row, plot, name, note, thumbnail_image, full_image) VALUES('%s', '%s', '%s', '%s', '%s', '%s')",
			mysql_real_escape_string($cemetery_site->getRow()),
			mysql_real_escape_string($cemetery_site->getPlot()),
			mysql_real_escape_string($cemetery_site->getName()),
			mysql_real_escape_string($cemetery_site->getNote()),
			mysql_real_escape_string($cemetery_site->getThumbnailImage()),
			mysql_real_escape_string($cemetery_site->getFullImage()));

		$id = $mysql->insert($query);
 
 		$cemetery_site->setId($id);

		$mysql->disconnect();
	}

	public static function getByRowAndPlot($row, $plot) {

		$mysql = new Database();
		$mysql->connect();

		// check to see if the site is already in the database
		$query = sprintf("SELECT * FROM sites WHERE row = '%s' AND plot = '%s'",
			mysql_real_escape_string($cemetery_site->getRow()),
			mysql_real_escape_string($cemetery_site->getPlot()));

		$result = $mysql->query($query);

		$row = mysql_fetch_assoc($result);
		$mysql->disconnect();
	}
}