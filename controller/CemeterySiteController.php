<?php

include_once("model/CemeterySite.php");
include_once("model/CemeterySiteDAO.php");
include_once("helper/CemeterySiteHelper.php");

class CemeterySiteController {

	/**
	*	Invoke
	*
	*	Rudimentary "routing".
	**/
	public function invoke() {

		//invoke will take care of figuring out 
		$vals = array_merge($_POST, $_GET);

		//what are we doing?
		$action = isset($vals['action']) ? $vals['action'] : 'search';

		switch ($action) {
			case 'search':
				$this->search($vals);
				break;
			case 'search_results':
				$this->search_results($vals);
				break;
		}
	}

	/**
	*	Search
	*
	*	Search for a person
	**/
	public function search($vals) {

		$query = isset($vals['query']) ? $vals['query'] : '';
		include('view/header.php');
		include('view/search.php');
		include('view/footer.php');
	}

	/**
	*	Search Results
	*
	*	Display the search results
	**/
	public function search_results($vals) {

		$query = isset($vals['query']) ? $vals['query'] : '';
		$results = $sites = CemeterySiteDAO::search($query);
		
		include('view/header.php');
		include('view/search.php');
		include('view/search_results.php');
		include('view/footer.php');	
	}
}