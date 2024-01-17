<?php

require "./vendor/autoload.php";

$schedules = [
  4 => ["映画を見る", "primary"],
  12 => ["服買いに行く", "danger"],
  25 => ["彼女と会う", "dark"],
];

$calendar = new PHPCalendar($_GET["month"] ?? date("m"), $_GET["year"] ?? date("Y"), $schedules);
$current = $calendar->getCurrent();
$prev = $calendar->getPrev();
$next = $calendar->getNext();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body style="height: 100vh; display: grid; place-items: center;">

<div class="mx-auto" style="max-width: 720px;">
  <div class="text-center mb-4">
    <div class="btn-group">
      <a href="?month=<?= date("n", $prev) ?>&year=<?= date("Y", $prev) ?>" class="btn btn-outline-dark px-3">
        <i class="fa-solid fa-angle-left fa-xl"></i>
      </a>
      <a href="#" class="btn btn-outline-dark px-5 active">
        <span class="fw-bold"><?= date("Y", $current) ?>年 <?= date("n", $current) ?>月</span>
      </a>
      <a href="?month=<?= date("n", $next) ?>&year=<?= date("Y", $next) ?>" class="btn btn-outline-dark px-3">
        <i class="fa-solid fa-angle-right fa-xl"></i>
      </a>
    </div>
  </div>
  <table class="calendar-table table table-bordered" style="table-layout: fixed;">
    <thead class="text-center">
      <tr>
        <?php foreach (range(0, 6) as $w): ?>
          <th scope="col"><?= PHPCalendar::jweek($w)  ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($calendar->getCalendar() as $week): ?>
        <tr>
          <?php foreach ($week as $day): ?>
            <td style="height: 100px;">
              <?php if ($day): ?>
                <p class="text-center"><span class="<?= $day->today ? "text-bg-primary badge" : ""; ?>"><?= date("j", $day->timestamp); ?></span></p>
                <?php if (isset($day->schedule)): ?>
                  <span class="badge text-bg-<?= $day->schedule->color ?>"><?= $day->schedule->title ?></span>
                <?php endif; ?>
              <?php endif; ?>
            </td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
  
</body>
</html>