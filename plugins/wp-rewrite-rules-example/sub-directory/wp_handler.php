<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
wp();

$report_name = get_query_var('report_name', 'default_report');

echo '<h1>hello handler</h1>';
echo '<p>You reached report: ' . $report_name . '</p>';

global $wp_query;
var_dump($wp_query->query_vars);
