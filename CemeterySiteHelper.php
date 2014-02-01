<?php

class CemeterySiteHelper {

	public static function getThumbnailURL($site) {
		//http://cemetery.townofbuchans.nf.ca/row_a/thumbnails/gray_a02.jpg

		return 'http://cemetery.townofbuchans.nf.ca/row_'.strtolower($site->getRow()).'/'.$site->getThumbnailImage();
	}

	public static function isValidSite($site) {
		return !($site->getRow() == 'ROW' && $site->getPlot() == 'PLOT' &&
			$site->getName() == 'NAME' && $site->getNote() == 'NOTE');
	}

}