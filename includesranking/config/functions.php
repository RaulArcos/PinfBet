<?php

function colorRank($position){
    switch($position){
        case 1: 
            $color = "#ffd700"; //#ffd700;
            break;
        case 2:
            $color = "#c0c0c0"; //#c0c0c0;
            break;
        case 3:
            $color = "#cd7f32"; //#cd7f32;
            break;
    }

    return $color;
}

function levelRank($pinfcoins){
    if($pinfcoins <= 83){
        $rank = 'Level 1';
    }elseif($pinfcoins >= 83 && $pinfcoins <= 174){
        $rank = 'Level 2';
    }elseif($pinfcoins >= 174 && $pinfcoins <= 276){
        $rank = 'Level 3';
    }elseif($pinfcoins >= 276 && $pinfcoins <= 388){
        $rank = 'Level 4';
    }elseif($pinfcoins >= 388 && $pinfcoins <= 512){
        $rank = 'Level 5';
    }elseif($pinfcoins >= 512 && $pinfcoins <= 650){
        $rank = 'Level 6';
    }elseif($pinfcoins >= 650 && $pinfcoins <= 801){
        $rank = 'Level 7';
    }elseif($pinfcoins >= 801 && $pinfcoins <= 969){
        $rank = 'Level 8';
    }elseif($pinfcoins >= 969 && $pinfcoins <= 1154){
        $rank = 'Level 9';
    }elseif($pinfcoins >= 1154 && $pinfcoins <= 1358){
        $rank = 'Level 10';
    }elseif($pinfcoins >= 1358 && $pinfcoins <= 1584){
        $rank = 'Level 11';
    }elseif($pinfcoins >= 1584 && $pinfcoins <= 1833){
        $rank = 'Level 12';
    }elseif($pinfcoins >= 1833 && $pinfcoins <= 2107){
        $rank = 'Level 13';
    }elseif($pinfcoins >= 2107 && $pinfcoins <= 2411){
        $rank = 'Level 14';
    }elseif($pinfcoins >= 2411 && $pinfcoins <= 2746){
        $rank = 'Level 15';
    }elseif($pinfcoins >= 2746 && $pinfcoins <= 3115){
        $rank = 'Level 16';
    }elseif($pinfcoins >= 3115 && $pinfcoins <= 3523){
        $rank = 'Level 17';
    }elseif($pinfcoins >= 3523 && $pinfcoins <= 3973){
        $rank = 'Level 18';
    }elseif($pinfcoins >= 3973 && $pinfcoins <= 4470){
        $rank = 'Level 19';
    }elseif($pinfcoins >= 4470 && $pinfcoins <= 5018){
        $rank = 'Level 20';
    }elseif($pinfcoins >= 5018 && $pinfcoins <= 5624){
        $rank = 'Level 21';
    }elseif($pinfcoins >= 5624 && $pinfcoins <= 6291){
        $rank = 'Level 22';
    }elseif($pinfcoins >= 6291 && $pinfcoins <= 7028){
        $rank = 'Level 23';
    }elseif($pinfcoins >= 7028 && $pinfcoins <= 7842){
        $rank = 'Level 24';
    }elseif($pinfcoins >= 7842 && $pinfcoins <= 8740){
        $rank = 'Level 25';
    }elseif($pinfcoins >= 8740 && $pinfcoins <= 9730){
        $rank = 'Level 26';
    }elseif($pinfcoins >= 9730 && $pinfcoins <= 10824){
        $rank = 'Level 27';
    }elseif($pinfcoins >= 10824 && $pinfcoins <= 12031){
        $rank = 'Level 28';
    }elseif($pinfcoins >= 12031 && $pinfcoins <= 13363){
        $rank = 'Level 29';
    }elseif($pinfcoins >= 13363 && $pinfcoins <= 14833){
        $rank = 'Level 30';
    }elseif($pinfcoins >= 14833 && $pinfcoins <= 16456){
        $rank = 'Level 31';
    }elseif($pinfcoins >= 16456 && $pinfcoins <= 18247){
        $rank = 'Level 32';
    }elseif($pinfcoins >= 18247 && $pinfcoins <= 20224){
        $rank = 'Level 33';
    }elseif($pinfcoins >= 20224 && $pinfcoins <= 22406){
        $rank = 'Level 34';
    }elseif($pinfcoins >= 22406 && $pinfcoins <= 24815){
        $rank = 'Level 35';
    }elseif($pinfcoins >= 24815 && $pinfcoins <= 27473){
        $rank = 'Level 36';
    }elseif($pinfcoins >= 27473 && $pinfcoins <= 30408){
        $rank = 'Level 37';
    }elseif($pinfcoins >= 30408 && $pinfcoins <= 33648){
        $rank = 'Level 38';
    }elseif($pinfcoins >= 33648 && $pinfcoins <= 37224){
        $rank = 'Level 39';
    }elseif($pinfcoins >= 37224 && $pinfcoins <= 41171){
        $rank = 'Level 40';
    }elseif($pinfcoins >= 41171 && $pinfcoins <= 45529){
        $rank = 'Level 41';
    }elseif($pinfcoins >= 45529 && $pinfcoins <= 50339){
        $rank = 'Level 42';
    }elseif($pinfcoins >= 50339 && $pinfcoins <= 55649){
        $rank = 'Level 43';
    }elseif($pinfcoins >= 55649 && $pinfcoins <= 61512){
        $rank = 'Level 44';
    }elseif($pinfcoins >= 61512 && $pinfcoins <= 67983){
        $rank = 'Level 45';
    }elseif($pinfcoins >= 67983 && $pinfcoins <= 75127){
        $rank = 'Level 46';
    }elseif($pinfcoins >= 75127 && $pinfcoins <= 83014){
        $rank = 'Level 47';
    }elseif($pinfcoins >= 83014 && $pinfcoins <= 91721){
        $rank = 'Level 48';
    }elseif($pinfcoins >= 91721 && $pinfcoins <= 101333){
        $rank = 'Level 49';
    }elseif($pinfcoins >= 101333 && $pinfcoins <= 111945){
        $rank = 'Level 50';
    }elseif($pinfcoins >= 111945 && $pinfcoins <= 123660){
        $rank = 'Level 51';
    }elseif($pinfcoins >= 123660 && $pinfcoins <= 136594){
        $rank = 'Level 52';
    }elseif($pinfcoins >= 136594 && $pinfcoins <= 150872){
        $rank = 'Level 53';
    }elseif($pinfcoins >= 150872 && $pinfcoins <= 166636){
        $rank = 'Level 54';
    }elseif($pinfcoins >= 166636 && $pinfcoins <= 184040){
        $rank = 'Level 55';
    }elseif($pinfcoins >= 184040 && $pinfcoins <= 203254){
        $rank = 'Level 56';
    }elseif($pinfcoins >= 203254 && $pinfcoins <= 224466){
        $rank = 'Level 57';
    }elseif($pinfcoins >= 224466 && $pinfcoins <= 247886){
        $rank = 'Level 58';
    }elseif($pinfcoins >= 247886 && $pinfcoins <= 273742){
        $rank = 'Level 59';
    }elseif($pinfcoins >= 273742 && $pinfcoins <= 302288){
        $rank = 'Level 60';
    }elseif($pinfcoins >= 302288 && $pinfcoins <= 333804){
        $rank = 'Level 61';
    }elseif($pinfcoins >= 333804 && $pinfcoins <= 368599){
        $rank = 'Level 62';
    }elseif($pinfcoins >= 368599 && $pinfcoins <= 407015){
        $rank = 'Level 63';
    }elseif($pinfcoins >= 407015 && $pinfcoins <= 449428){
        $rank = 'Level 64';
    }elseif($pinfcoins >= 449428 && $pinfcoins <= 496254){
        $rank = 'Level 65';
    }elseif($pinfcoins >= 496254 && $pinfcoins <= 547953){
        $rank = 'Level 66';
    }elseif($pinfcoins >= 547953 && $pinfcoins <= 605032){
        $rank = 'Level 67';
    }elseif($pinfcoins >= 605032 && $pinfcoins <= 668051){
        $rank = 'Level 68';
    }elseif($pinfcoins >= 668051 && $pinfcoins <= 737627){
        $rank = 'Level 69';
    }elseif($pinfcoins >= 737627 && $pinfcoins <= 814445){
        $rank = 'Level 70';
    }elseif($pinfcoins >= 814445 && $pinfcoins <= 899257){
        $rank = 'Level 71';
    }elseif($pinfcoins >= 899257 && $pinfcoins <= 992895){
        $rank = 'Level 72';
    }elseif($pinfcoins >= 992895 && $pinfcoins <= 1096278){
        $rank = 'Level 73';
    }elseif($pinfcoins >= 1096278 && $pinfcoins <= 1210421){
        $rank = 'Level 74';
    }elseif($pinfcoins >= 1210421 && $pinfcoins <= 1336443){
        $rank = 'Level 75';
    }elseif($pinfcoins >= 1336443 && $pinfcoins <= 1475581){
        $rank = 'Level 76';
    }elseif($pinfcoins >= 1475581 && $pinfcoins <= 1629200){
        $rank = 'Level 77';
    }elseif($pinfcoins >= 1629200 && $pinfcoins <= 1798808){
        $rank = 'Level 78';
    }elseif($pinfcoins >= 1798808 && $pinfcoins <= 1986068){
        $rank = 'Level 79';
    }elseif($pinfcoins >= 1986068 && $pinfcoins <= 2192818){
        $rank = 'Level 80';
    }elseif($pinfcoins >= 2192818 && $pinfcoins <= 2421087){
        $rank = 'Level 81';
    }elseif($pinfcoins >= 2421087 && $pinfcoins <= 2673114){
        $rank = 'Level 82';
    }elseif($pinfcoins >= 2673114 && $pinfcoins <= 2951373){
        $rank = 'Level 83';
    }elseif($pinfcoins >= 2951373 && $pinfcoins <= 3258594){
        $rank = 'Level 84';
    }elseif($pinfcoins >= 3258594 && $pinfcoins <= 3597792){
        $rank = 'Level 85';
    }elseif($pinfcoins >= 3597792 && $pinfcoins <= 3972294){
        $rank = 'Level 86';
    }elseif($pinfcoins >= 3972294 && $pinfcoins <= 4385776){
        $rank = 'Level 87';
    }elseif($pinfcoins >= 4385776 && $pinfcoins <= 4842295){
        $rank = 'Level 88';
    }elseif($pinfcoins >= 4842295 && $pinfcoins <= 5346332){
        $rank = 'Level 89';
    }elseif($pinfcoins >= 5346332 && $pinfcoins <= 5902831){
        $rank = 'Level 90';
    }elseif($pinfcoins >= 5902831 && $pinfcoins <= 6517253){
        $rank = 'Level 91';
    }elseif($pinfcoins >= 6517253 && $pinfcoins <= 7195629){
        $rank = 'Level 92';
    }elseif($pinfcoins >= 7195629 && $pinfcoins <= 7944614){
        $rank = 'Level 93';
    }elseif($pinfcoins >= 7944614 && $pinfcoins <= 8771558){
        $rank = 'Level 94';
    }elseif($pinfcoins >= 8771558 && $pinfcoins <= 9684577){
        $rank = 'Level 95';
    }elseif($pinfcoins >= 9684577 && $pinfcoins <= 10692629){
        $rank = 'Level 96';
    }elseif($pinfcoins >= 10692629 && $pinfcoins <= 11805606){
        $rank = 'Level 97';
    }elseif($pinfcoins >= 11805606 && $pinfcoins <= 13034431){
        $rank = 'Level 98';
    }elseif($pinfcoins >= 13034431 && $pinfcoins <= 14391160){
        $rank = 'Level 99';
    }elseif($pinfcoins >= 14391160){
        $rank = 'Level 100';
    }

    return $rank;
}