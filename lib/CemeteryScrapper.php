<?php

/**
*	CemeteryScrapper
*
*	Used to scrape information from the Town of Buchans cemetery
*	website.
**/

class CemeteryScrapper {

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

		$urls = array(
			'http://cemetery.townofbuchans.nf.ca/row_a/row_a.html',
			'http://cemetery.townofbuchans.nf.ca/row_b/row_b.html',
			'http://cemetery.townofbuchans.nf.ca/row_c/row_c.html',
			'http://cemetery.townofbuchans.nf.ca/row_d/row_d.html',
			'http://cemetery.townofbuchans.nf.ca/row_e/row_e.html',
			'http://cemetery.townofbuchans.nf.ca/row_f/row_f.html',
			'http://cemetery.townofbuchans.nf.ca/row_g/row_g.html',
			'http://cemetery.townofbuchans.nf.ca/row_h/row_h.html',
			'http://cemetery.townofbuchans.nf.ca/row_i/row_i.html',
			'http://cemetery.townofbuchans.nf.ca/row_j/row_j.html',
			'http://cemetery.townofbuchans.nf.ca/row_k/row_k.html',
		);		

		foreach ($urls as $url) {

			echo 'Scrapping url: '.$url."\n";

			$dom = $this->fetch($url);

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

				// Don't save the headers
				if (CemeterySiteHelper::isValidSite($cemetery_site)) {
					CemeterySiteDAO::save($cemetery_site);	
				}
			}
		}
	}

	public function getCemeterySiteFullImages() {
		$sites = CemeterySiteDAO::getAll();

		foreach($sites as $site) {
			$url = 'http://cemetery.townofbuchans.nf.ca/row_'.strtolower($site->getRow()).'/plot'.strtolower($site->getRow()).sprintf("%02d", intval($site->getPlot())).'.htm';
			
			if ($this->url_exists($url)) {
				$dom = $this->fetch($url);
				
				$full_image = $dom->find('img', 0);

				if ($full_image) {
					echo 'Updating site: '.$site->getId()."\n";
					$site->setFullImage($full_image->src);
					CemeterySiteDAO::update($site);
				}
			}
		}
	}

	function url_exists($url){
		$handle = curl_init($url);
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($handle);
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		return ($httpCode == 200);
	}
}