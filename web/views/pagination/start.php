<?php  
$limit = (isset($limit) && gettype($limit)==='integer')?$limit:DEFAULT_LIMIT;  
if (isset($_GET["page"])) 
{
    $page  = $_GET["page"]; 
} else{ 
    $page=1;
};  
$start = ($page-1) * $limit;