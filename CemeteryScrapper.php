<?php

/**
*	CemeteryScrapper
*
*	Used to scrape information from the Town of Buchans cemetery
*	website.
**/

class CemeteryScrapper {

	// URL
	const URL = 'http://cemetery.townofbuchans.nf.ca/row_a/row_a.html';


	public function CemeteryScrapper() {
		$this->COOKIE_FILE = dirname(__FILE__).'/cookie.txt';
		$this->deleteCookies();
	}

	private function deleteCookies() {
		if (is_file($this->COOKIE_FILE)) {
			unlink($this->COOKIE_FILE);
		}
	}

	public function fetch($url) {
		$dom = file_get_html($url);
			
		return $dom;
	}

	private function cleanValue($value) {
		 return trim($value);
	}

	public function getCemeterySite() {
		$dom = $this->fetch(self::URL);

		// find the table rows containg sites
		$trs = $dom->find('tr');

		foreach ($trs as $tr) {
			$cemetery_site = new CemeterySite();
			$cemetery_site->setRow($this->cleanValue($tr->find('td', 0)->plaintext));
			$cemetery_site->setPlot($this->cleanValue($tr->find('td', 1)->plaintext));
			$cemetery_site->setName($this->cleanValue($tr->find('td', 2)->plaintext));
			$cemetery_site->setNote($this->cleanValue($tr->find('td', 3)->plaintext));

			// find the headtone thumbnail image url
			$thumbnail_image = $tr->find('img', 0);
			if ($thumbnail_image) {
				$cemetery_site->setThumbnailImage($thumbnail_image->src);
			}
			
			CemeterySiteDAO::save($cemetery_site);
		}

	}
}