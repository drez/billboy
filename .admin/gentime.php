<?php

$excludeDate = [
    '2024-10-28', '2024-10-27', '2024-10-26', // boracai
    '2024-06-06/30', //vietnam
];

$comments = [
    75 => "developement",
    10 => "project management",
    15 => "research",
];

$work = [
    0 => 20,
    1 => 25,
    2 => 90,
    3 => 90,
    4 => 90,
    5 => 90,
    6 => 60,
];

$avgHours = [
    0 => [
        60 => [0, 1, 2, 3],
        40 => [3, 4, 5],
    ],
    1 => [
        75 => [0, 1, 2, 3, 4],
        25 => [1, 2],
    ],
    2 => [
        95 => [4, 5, 6, 7, 8],
        5 => [9, 10, 11],
    ],
    3 => [
        95 => [4, 5, 6, 7, 8],
        5 => [9, 10, 11],
    ],
    4 => [
        95 => [4, 5, 6, 7, 8],
        5 => [9, 10, 11],
    ],
    5 => [
        85 => [4, 5, 6, 7, 8],
        15 => [9, 10, 11],
    ],
    6 => [
        55 => [0, 1, 2],
        40 => [4, 5],
    ],
];
$argv[1] = "2024-05-08";
$startDate = strtotime($argv[1]);
$endDate = strtotime($argv[2]);

if (empty($startDate)) {
    die("Need start date");
}

if (empty($endDate)) {
    $endDate = strtotime(date('Y-m-d'));
}

echo "Start " . $argv[1] . "\n";

$day = 0;
$skipcount = 0;

while ($curTime != $endDate) {
    $curTime = strtotime("+ $day day", $startDate);
    $curDate = date('Y-m-d', $curTime);
    $skip = false;
    $hour = "-";

    if (count($excludeDate) > 0) {
        if (in_array($curDate, $excludeDate)) {
            $skip = true;
            if (($key = array_search($curDate, $excludeDate)) !== false) {
                unset($excludeDate[$key]);
            }
        } else {
            foreach ($excludeDate as $date) {
                if (strstr($date, $curDate)) {
                    $count = explode('/', $date);
                    $skipcount = $count[1];
                }
            }
        }
    }

    if (!$skip && $skipcount == 0) {
        $w = date('w', $curTime);
        $hour = getHours($w, $work, $avgHours);
    } elseif ($skipcount) {
        $skipcount--;
    }

    echo "$curDate ($w): $hour\n";
    if ($hour != '-') {
        $hours += $hour;
    }

    $day++;
}

echo $hours . "\n\n";

function getHours($w, $work, $avgHours)
{
    $time = 0;
    if ($work[$w] > rand(1, 100)) {
        $loop = 0;
        foreach ($avgHours[$w] as $p => $avg) {
            if ($loop) {
                $time = array_rand($avg);
            }

            if (rand(1, 100) < $p) {
                $time = $avg[array_rand(array:$avg)];
                break;
            }

            $loop++;
        }
    }

    return $time;
}
