<?php

require_once 'classes/DBConnector.class.php';

//connect to the database
$db = DBConnector::getInstance()->getConnection();
