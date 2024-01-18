# PHPCalendar

## 使い方
月と年を指定して日付と予定の入ったオブジェクトを渡すことで簡単にカレンダーの多次元配列が生成できます。

```php
<?php
$calendar = new PHPCalendar($month, $year, [
  4 => ["映画を見る", "primary"],
  12 => ["服買いに行く", "danger"],
  25 => ["彼女と会う", "dark"],
]);

$weeks = $calendar->getCalendar();
// [
//   [null, null, null, null, Day(1), Day(2), Day(3)],
//   [Day(4), Day(5), Day(6), Day(7), Day(8), Day(9), Day(10)],
//   [Day(11), Day(12), Day(13), Day(14), Day(15), Day(16), Day(17)],
//   [Day(18), Day(19), Day(20), Day(21), Day(22), Day(23), Day(24)],
//   [Day(25), Day(26), Day(27), Day(28), Day(29), null, null],
// ]
?>
```

getCalendar()で返される配列にはDayオブジェクトかnullが入ります。
Dayオブジェクトは以下の値を保持します、
```php
$day->timestamp // int 0時0分0秒のタイムスタンプ
$day->today // boolean 今日であるかどうか
$day->schedule // 任意の型 その日の予定
```

## 現在の月、前の月、次の月
getCurrent(), getPrev(), getNext()を利用することで現在の月、前の月、次の月のタイムスタンプを取得できます。
```php
$calendar = new PHPCalendar(1, 2024);

$calendar->getCurrent() // 2024-01-01 0:00:00のタイムスタンプ
$calendar->getPrev() // 2023-12-01 0:00:00のタイムスタンプ
$calendar->getPrev() // 2024-02-01 0:00:00のタイムスタンプ
```


## 実装例
PHP
```php
<?php
$schedules = [
  4 => ["映画を見る", "primary"],
  12 => ["服買いに行く", "danger"],
  25 => ["彼女と会う", "dark"],
];

$calendar = new PHPCalendar($month, $year, $schedules);
?>

<table>
  <thead>
    <tr>
      <?php foreach (range(0, 6) as $w): ?>
      <th><?= PHPCalendar::jweek($w)  ?></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($calendar->getCalendar() as $week): ?>
    <tr>
      <?php foreach ($week as $day): ?>
      <td>
        <?php if ($day): ?>
        <!-- 日付や予定を表示 -->
        <?php endif; ?>
      </td>
      <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
```

## 機能の追加予定

- 祝日であるかどうか
