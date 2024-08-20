<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Transaction Data</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<body>
          <table class="table table-white table-hover">
                    <thead>
                              <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Check Number</th>
                                        <th scope="col">Transaction Count</th>
                                        <th scope="col">Amount</th>
                              </tr>
                    </thead>
                    <tbody>

                              <?php foreach ($readLines as $line): ?>
                                        <tr>;
                                                  <td><?= formatDate($line["Date"]) ?></td>
                                                  <td><?= $line["Check Number"] ?></td>
                                                  <td><?= $line["Transaction Count"] ?></td>
                                                  <?php $isIncome = (int) $line["Amount"] < 0 ? "red" : "green" ?>
                                                  <td><span style="color: <?= $isIncome ?>;" class="fw-medium">
                                                                      <?= FormatDollar($line["Amount"]) ?>
                                                            </span></td>
                                        </tr>
                              <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                              <tr>
                                        <th colspan="3" class="text-end bg-white text-dark">Total Income:</th>
                                        <td class="text-success fw-bold"><?= FormatDollar($totals["Total Income"]) ?>
                                        </td>
                              </tr>
                              <tr>
                                        <th colspan="3" class="text-end bg-white text-dark">Total Expense:</th>
                                        <td class="text-danger fw-bold"><?= FormatDollar($totals["Total Expense"]) ?>
                                        </td>
                              </tr>
                              <tr>
                                        <th colspan="3" class="text-end bg-white text-dark">Net Total:</th>
                                        <td class="bg-dark text-white fw-bolder">
                                                  <?= FormatDollar($totals["Net Total"]) ?></td>
                              </tr>
                    </tfoot>
          </table>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

</html>