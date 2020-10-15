<?php
$now = date("Y-m");
if (isset($_GET['date'])) $now = $_GET['date'];

$timestamps = strtotime("$now-01");

$curDay = date('d');
$curMonth = date('m', strtotime($now));

$dayCount = date('t', $timestamps);
$firstDay = date('N', $timestamps);

$offset = $firstDay % 7;
$startRow = 7 - $offset;

$rowCount = ceil(($dayCount - $startRow) / 7);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="calendar.css">
</head>

<body>


    <div class="custom-calendar-wrap">
        <div class="custom-inner">
            <div class="custom-header clearfix">
                <nav>
                    <a href="?date=<?= date('Y-m', strtotime('-1 month', $timestamps)) ?>" class="custom-btn custom-prev"></a>
                    <a href="?date=<?= date('Y-m', strtotime('+1 month', $timestamps)) ?>" class="custom-btn custom-next"></a>
                </nav>
                <h2 id="custom-month" class="custom-month"><?= date('F', $timestamps) ?></h2>
                <h3 id="custom-year" class="custom-year"><?= date('Y', $timestamps) ?></h3>
            </div>
            <div id="calendar" class="fc-calendar-container">
                <div class="fc-calendar fc-five-rows">
                    <div class="fc-head">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="fc-body">
                        <div class="fc-row">
                            <?php for ($i = 0; $i < $offset; $i++) : ?>
                                <div><span class="fc-date"></span></div>
                            <?php endfor ?>
                            <?php for ($i = 1; $i <= $startRow; $i++) : ?>
                                <div class="<?= ($i == $curDay && date('m') == $curMonth) ? 'fc-today' : '' ?>"><span class="fc-date"><?= $i ?></span></div>
                            <?php endfor ?>
                        </div>
                        <?php for ($i = 0; $i < $rowCount; $i++) : ?>
                            <div class="fc-row">
                                <?php for ($j = $startRow + 1; $j <= $startRow + 7; $j++) : ?>
                                    <?php if ($j <= $dayCount) : ?>
                                        <div class="<?= ($j == $curDay && date('m') == $curMonth) ? 'fc-today' : '' ?>"><span class="fc-date"><?= $j ?></span></div>
                                    <?php else : ?>
                                        <div><span class="fc-date"></span></div>
                                    <?php endif; ?>
                                <?php endfor;
                                $startRow += 7; ?>
                            </div>
                        <?php endfor ?>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>