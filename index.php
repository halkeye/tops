<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Schedule</title>
    <script type="text/javascript" src="jquery-1.4.1.min.js"></script>
    <style text="text/css">
<!--
.clear {
    clear:both;
}
.small {
    font-size: 8pt;
}
.roomHeader {
    float: left; text-align: center; margin-bottom: 5px; width: 163px; padding: 0px 5px
}
.roomBlock {
    position: relative; width: 173px; border: 1px solid; border-color: #838383; background-image: url(img/calendar_bg2.gif); background-position: 0 -2px; 
}
.timeHeader { 
    position: absolute; margin-top: 0; width: 50px; text-align: left; margin-left: 0;
}
.timeBlock { 
    position:absolute; top: 0; width: 50px; border-color: #838383; background-image: url(img/calendar_bg2.gif); font-family: Tahoma, Verdana; font-size: 8pt; color: #838383; border-top: 1px solid; border-color: #838383; background-position: 0 -2px
}

.schedItem {
    position: absolute; width: 161px; padding: 5px 5px; border: 1px solid; 
    font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden;
    border-color: #000000;
    opacity: 0.80;  -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; 
}
/* Types */

.closed {
    background-color: #4c4c4c; 
    color: #EEEEEE;
}
.performance { 
    color: #111111;
    background-color: #FF7F47;
}
.game_contests { 
    color: #3A3939;
    background-color: #75FF62;
}
.art_creative { 
    color: #000000;
    background-color: #017CFD;
}
.academic { 
    color: #000000;
    background-color: #FB0000;
}
.jap_culture { 
    color: #000000;
    background-color: #9B9B9B;
}
/* Selectors */

    .selectedSchedButton { background-image: url("img/stripe_055054a09acd87998a982c5166b45075.png"); font-weight: bold; color: white;}
    #schedItemSelector { 
        padding-left: 20%;
        padding-right: 20%;
    }
    #schedItemSelector td { 
        cursor: pointer;
        padding: 2em;
        width: 8em; 
        height: 2em;
        border-width: .7em;
        border-style: solid;
    }

--></style>
    <script type="text/javascript"><!--
    var firstClick = 1;
    function clearAllOnFirstClick() { 
        if (!firstClick) { return; }
        firstClick = 0;

        jQuery("#schedItemSelector td").each( function(a, obj) {
                var className = jQuery(obj).attr('class');
                jQuery('.schedItem.'+className).addClass(className+'Offline').removeClass(className);
        })
    }
    jQuery(document).ready(function() {
            jQuery("#schedItemSelector td").toggle( function() {
                clearAllOnFirstClick();
                var obj = jQuery(this);
                obj.addClass('selectedSchedButton');
                var className = obj.attr('class').replace(' selectedSchedButton', '');
                jQuery('.schedItem.'+className+'Offline').removeClass(className+'Offline').addClass(className);
            }, function() {
                var obj = jQuery(this);
                obj.removeClass('selectedSchedButton');
                var className = obj.attr('class').replace(' selectedSchedButton', '');
                jQuery('.schedItem.'+className).addClass(className+'Offline').removeClass(className);
            });

    });
    --></script>
</head>
<body>
<?php

date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
$hourHeight = 50;

$day1 = mktime(0,0,0,2,19,2010);

$data = array(
    'Main Events 1' => array(
        $day1 => array(
            '1000' => array(
                'name'   => 'Gavin says its closed sucka',
                'length' => 3,
                'type'   => array('closed'),
            ),
            '1200' => array(
                'name'   => 'The Final Fantasy Fight Tournament',
                'length' => 2,
                'type'   => array('performance', 'game_contests'),
            ),
            '1300' => array(
                'name' => 'The Gauntlet - Round 1',
                'length' => 2,
                'type'   => array('game_contests'),
            ),
            '1400' => array(
                'name'   => 'Charity Auction',
                'length' => 2,
                'type'   => array('performance'),
            ),
            '1500' => array(
                'name'   => 'The Beautiful Losers - Concert',
                'length' => 2,
                'type'   => array('performance', 'jap_culture'),
            ),
            '1600' => array(
                'name'   => 'AMV Contest',
                'length' => 2,
                'type'   => array('art_creative'),
            ),
        ),
    ),
    'Panel Room 1' => array(
        $day1 => array(
            '1000' => array(
                'name'   => 'Dolphin claims this room',
                'length' => 3,
                'type'   => array('closed'),
            ),
            '1200' => array(
                'name'   => 'Anime Debate',
                'length' => 2,
                'type'   => array('performance', 'academic'),
            ),
            '1300' => array(
                'name'   => 'Cosplay Swimsuit Contest',
                'length' => 2,
                'type'   => array('performance', 'game_contests'),
            ),
            '1400' => array(
                'name'   => 'Anime Physics',
                'length' => 2,
                'type'   => array('academic'),
            ),
            '1500' => array(
                'name'   => 'Magic The Gathering - Draft Tournament',
                'length' => 2,
                'type'   => array('game_contests'),
            ),
            '1500' => array(
                'name'   => 'King for a Day - Cosplay Guide',
                'length' => 2,
                'type'   => array('art_creative'),
            ),
        ),
    ),
    'Panel Room 2' => array(
        $day1 => array(
            '1000' => array(
                'name'   => 'this one is up for grabs',
                'length' => 4,
                'type'   => array('closed'),
            ),
            '1200' => array(
                'name'   => 'The history of manga',
                'length' => 2,
                'type'   => array('academic'),
            ),
            '1300' => array(
                'name'   => 'Anime Idol',
                'length' => 2,
                'type'   => array('performance', 'game_contests'),
            ),
            '1400' => array(
                'name'   => 'Left for Dead 2 - Tournament',
                'length' => 2,
                'type'   => array('game_contests'),
            ),
            '1500' => array(
                'name'   => 'Cosplay Chess',
                'length' => 2,
                'type'   => array('performance', 'game_contests'),
            ),
        ),
    ),
);

$hourData = array();
$days = array();
foreach (array_keys($data) as $room)
{
    foreach (array_keys($data[$room]) as $day)
    {
        if (!isset($hourData["$day"])) { $hourData["$day"] = array('max'=>0, 'min'=> 2500); }
        $hourData["$day"]['max'] = (int) @max($hourData[$day]['max'], max(array_keys($data[$room][$day])));
        $hourData["$day"]['min'] = (int) @min($hourData[$day]['min'], min(array_keys($data[$room][$day])));
        array_push($days, $day);
    }
    $matches = array();
    preg_match('/(\d{2})(\d{2})/', $hourData[$day]['max'], $matches);
    list($junk, $hourData[$day]['maxHour'], $hourData[$day]['maxMin']) = $matches;
    preg_match('/(\d{2})(\d{2})/', $hourData[$day]['min'], $matches);
    list($junk, $hourData[$day]['minHour'], $hourData[$day]['minMin']) = $matches;
}
$days = array_unique($days);
$rooms = array_keys($data);
sort($rooms);

foreach ($days as $day):
?>
    <h3><?php echo date('l jS F Y', $day); ?></h3><br />
    <?php 
        $totalHours = (($hourData[$day]['max']-$hourData[$day]['min'])/100);
    ?>
    
    <div style="margin-left: 25px">
        <?php foreach ($rooms as $room): ?>
        <div class="small roomHeader"><?php echo htmlentities($room) ?></div>
        <?php endforeach ?>
    </div>
    <div class="clear"></div>
   
    <?php 
    foreach ($rooms as $room)
    {
    ?>
    <div style="position: relative; float: left; margin-bottom: 25px">
        <div  class="roomBlock" style="height: <?php echo (($totalHours+1)*$hourHeight)-2 ?>px; <?php if ($room == $rooms[0]): ?> margin-left: 50px<?php endif ?>">
            <?php 
                $timeOffset = 0;
                foreach ($data[$room][$day] as $hour => $eventData) 
                {
                    $timeHeight = floor($hourHeight/2)*$eventData['length']-12 /* 12 = padding + border */;
                    $timeOffset = -1;
                    if ($hour != $hourData[$day]['min'])
                        $timeOffset = $hourHeight*floor(($hour-$hourData[$day]['min'])/100);
                    if ($timeOffset > 0) $timeOffset -= 1;
                    ?>
                    <div style="margin-top: <?php echo $timeOffset; ?>px">
                        <div style="height: <?php echo $timeHeight; ?>px;" class="schedItem <?php echo implode(' ', $eventData['type']) ?>">
                            <?php echo htmlentities($eventData['name']); ?>
                        </div>
                    </div>
                    <?php
                } 
            ?>
        </div>
                
        <?php if ($room == $rooms[0]): ?>
        <div class="timeBlock" style="height: <?php echo (($totalHours+1)*$hourHeight) ?>px">
            <?php $count=0; foreach (range($hourData[$day]['minHour'], $hourData[$day]['maxHour']) as $hour): ?>
            <div class="timeHeader" style="margin-top: <?php echo $hourHeight*$count++ ?>px;">
                <?php echo date('g:i A', mktime($hour,0)); ?>
            </div>
            <?php endforeach ?>
        </div>
        <?php endif; ?>
    </div>
<?php 
    } 
    endforeach; 
?>
    <br style="clear:both" />
    <table id="schedItemSelector">
        <tr>
            <td class="art_creative">Art / Creative</td>
            <td class="game_contests">Game / Contests</td>
            <td class="jap_culture">Jap. Culture</td>
            <td class="performance">Performance</td>
            <td class="academic">Academic</td>
        </tr>
    </table>
    </body>
</html>
