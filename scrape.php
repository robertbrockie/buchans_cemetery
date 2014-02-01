<?php

include('SimpleHtmlDom.php');
include('CemeteryScrapper.php');
include('CemeterySite.php');
include('CemeterySiteDAO.php');

$scrapper = new CemeteryScrapper();
$scrapper->getCemeterySite();