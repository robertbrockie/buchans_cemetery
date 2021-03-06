<?php

class CemeterySiteHelper {

	public static function getThumbnailURL($site) {

		$thumbnail_url = $site->getThumbnailImage();
		if (empty($thumbnail_url)) {
			return 'http://cemetery.townofbuchans.nf.ca/row_a/thumbnails/no_headstone.jpg';
		} else {
			return 'http://cemetery.townofbuchans.nf.ca/row_'.strtolower($site->getRow()).'/'.$site->getThumbnailImage();
		}
	}

	public static function getFullImageURL($site) {

		$full_image_url = $site->getFullImage();
		if (empty($full_image_url)) {
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