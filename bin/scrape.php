<?php

include('lib/SimpleHtmlDom.php');
include('lib/CemeteryScrapper.php');
include('model/CemeterySite.php');
include('model/CemeterySiteDAO.php');
include('helper/CemeterySiteHelper.php');

$scrapper = new CemeteryScrapper();
//$scrapper->getCemeterySite();
$scrapper->getCemeterySiteFullImages();