#!/usr/bin/env php
<?php

// Load deck information
$ids = [];
$tmp = file('./deck.txt');
$cnt = 0;
foreach (['s', 'h', 'd', 'c'] as $suit) {
    for ($rank = 1; $rank <= 13; $rank++) {
        $ids[rtrim($tmp[$cnt++])] = ['suit' => $suit, 'rank' => $rank];
    }
}
$ids[rtrim($tmp[$cnt++])] = ['suit' => 'x', 'rank' => '-1'];
$ids[rtrim($tmp[$cnt++])] = ['suit' => 'x', 'rank' => '-2'];
$ids[rtrim($tmp[$cnt++])] = ['suit' => 'x', 'rank' => '-3'];
$ids[rtrim($tmp[$cnt++])] = ['suit' => 'x', 'rank' => '-4'];

// Capture ARGV
if (isset($ids[$argv[1]])) {
    $card = 'unknown';
    if ($ids[$argv[1]]['suit'] == 'x') $card = 'Joker' . $ids[$argv[1]]['rank'];
    else {
        $rank = $ids[$argv[1]]['rank'];
        switch ($rank) {
        case '1':  $rank = 'A'; break;
        case '10': $rank = 'T'; break;
        case '11': $rank = 'J'; break;
        case '12': $rank = 'Q'; break;
        case '13': $rank = 'K'; break;
        }
        $suit = $ids[$argv[1]]['suit'];
        $card = $rank . $suit;
    }
    echo 'Read a card: ' . formatCard($card) . PHP_EOL;
} else {
    echo 'Specified card is not exists.' . PHP_EOL;
}

function formatCard($card)
{
    if (strlen($card) > 2) {
        return $card;
    }
    $card = strtr($card, array('s' => ':spades:', 'h' => ':hearts:', 'd' => ':diamonds:', 'c' => ':clubs:'));
    return $card;
}
