<?php

function getTransactionFiles(string $dir): array
{
          if (!is_dir($dir)) {
                    echo "Directory does not exist: " . $dir;
                    return [];
          }
          $files_arr = [];
          foreach (scandir($dir) as $file) {
                    if (is_file($dir . $file)) {
                              $files_arr[] = $dir . $file;
                    }
          }
          return $files_arr;
}

function getTransactionData(string $file, ?callable $formatLines = null): array
{
          if (!is_file($file)) {
                    echo "File does not exist: " . $file;
                    return [];
          }
          $readFile = fopen($file, "r+");

          fgetcsv($readFile);
          $lineArr = [];
          while ($getLines = fgetcsv($readFile)) {
                    $lineArr[] = $formatLines($getLines);
          }
          return $lineArr;
}

function formatLines(array $linesArr): array
{
          if (!is_array($linesArr))
                    return [];

          $date = $linesArr[0];
          $checkNumber = $linesArr[1];
          $transactionCount = $linesArr[2];
          $amount = $linesArr[3];

          $formated_amt = str_replace([',', '$'], '', $amount);

          return [
                    'Date' => $date,
                    'Check Number' => $checkNumber,
                    'Transaction Count' => $transactionCount,
                    'Amount' => $formated_amt,
          ];
}

function calculateTotal(?array $readLines): ?array
{
          if (!is_array($readLines)) {
                    return [];
          }

          $Total_bill_arr = ["Total Income" => 0, "Total Expense" => 0, "Net Total" => 0];


          foreach ($readLines as $line) {
                    $Total_bill_arr["Net Total"] += (int) $line["Amount"];

                    if ($line["Amount"] < 0) {
                              $Total_bill_arr["Total Expense"] += $line["Amount"];
                    } elseif ($line["Amount"] > 0) {
                              $Total_bill_arr["Total Income"] += $line["Amount"];
                    }
          }

          return $Total_bill_arr;
}

function FormatDollar(?string $amount): ?string
{
          if (!is_string($amount)) {
                    return "";
          }
          $isNegative = $amount < 0;
          return ($isNegative ? "-" : "") . "$" . number_format(abs($amount), 2);
}

function formatDate(?string $date): ?string
{
          if (!is_string($date)) {
                    return "";
          }
          return date("M d, Y", strtotime($date));
}
?>