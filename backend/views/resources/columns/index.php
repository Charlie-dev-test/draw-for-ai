<?

include("_common.php");

$columnsList = [
  'title',
  'field',
  'filter_type',
  'eval',
];
$templates = '{update} {delete} {up} {down} {active}';

$globalFormsInc = realpath(__DIR__."/../")."/_globalforms.php";
include($globalFormsInc);
