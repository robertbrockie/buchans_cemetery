<?php

include('lib/Database.php');

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

	public static function update($cemetery_site) {

		$mysql = new Database();
		$mysql->connect();

		$query = sprintf("UPDATE sites set row = '%s', plot = '%s', name = '%s', note = '%s', thumbnail_image = '%s', full_image = '%s' WHERE id = %d",
			mysql_real_escape_string($cemetery_site->getRow()),
			mysql_real_escape_string($cemetery_site->getPlot()),
			mysql_real_escape_string($cemetery_site->getName()),
			mysql_real_escape_string($cemetery_site->getNote()),
			mysql_real_escape_string($cemetery_site->getThumbnailImage()),
			mysql_real_escape_string($cemetery_site->getFullImage()),
			mysql_real_escape_string($cemetery_site->getId()));

		$mysql->query($query);

		$mysql->disconnect();

		return $cemetery_site;
	}

	public static function getByRowAndPlot($row, $plot) {

		$mysql = new Database();
		$mysql->connect();

		$query = sprintf("SELECT * FROM sites WHERE row = '%s' AND plot = '%s'",
			mysql_real_escape_string($row),
			mysql_real_escape_string($plot));

		$result = $mysql->query($query);

		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$mysql->disconnect();

		return self::loadFromRow($row);
	}

	public static function getAll() {
		$mysql = new Database();
		$mysql->connect();

		$query = sprintf("SELECT * FROM sites");

		$result = $mysql->query($query);

		$sites = array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$sites[] = self::loadFromRow($row);
		}

		$mysql->disconnect();

		return $sites;
	}
}