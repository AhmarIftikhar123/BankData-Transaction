<?php

declare(strict_types=1);
$root = (string) dirname(__DIR__) . DIRECTORY_SEPARATOR;

define("TRANSACTION_FILES_DIR", $root . "transaction_files" . DIRECTORY_SEPARATOR);
define("CONTROLLER_DIR", $root . "controller" . DIRECTORY_SEPARATOR);
define("VIEWS_DIR", $root . "views" . DIRECTORY_SEPARATOR);

require_once CONTROLLER_DIR . 'controller.php';
$getFiles_Arr = getTransactionFiles(TRANSACTION_FILES_DIR);
$readLines = null;
foreach ($getFiles_Arr as $file) {
          $readLines = getTransactionData($file, "formatLines");
}

$totals = calculateTotal($readLines);
require_once VIEWS_DIR . 'transaction_table.php';

?>