<?php

class CemeterySiteHelper {

	public static function getThumbnailURL($site) {

		if (empty($site->getThumbnailImage())) {
			return 'http://cemetery.townofbuchans.nf.ca/row_a/thumbnails/no_headstone.jpg';
		} else {
			return 'http://cemetery.townofbuchans.nf.ca/row_'.strtolower($site->getRow()).'/'.$site->getThumbnailImage();
		}
	}

	public static function getFullImageURL($site) {
		if (empty($site->getFullImage())) {
			return 'http://cemetery.townofbuchans.nf.ca/row_a/thumbnails/no_headstone.jpg';
		} else {
			return 'http://cemetery.townofbuchans.nf.ca/row_'.strtolower($site->getRow()).'/'.$site->getFullImage();
		}
	}

	public static function isValidSite($site) {
		return !($site->getRow() == 'ROW' && $site->getPlot() == 'PLOT' &&
			$site->getName() == 'NAME' && $site->getNote() == 'NOTE');
	}

}