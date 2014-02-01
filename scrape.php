<?php

include('SimpleHtmlDom.php');
include('CemeteryScrapper.php');
include('CemeterySite.php');
include('CemeterySiteDAO.php');
include('CemeterySiteHelper.php');

$scrapper = new CemeteryScrapper();
$scrapper->getCemeterySite();