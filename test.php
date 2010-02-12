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
.timeHeader { 
    position: absolute; margin-top: 0; width: 50px; text-align: left; margin-left: 0;
}
.timeBlock { 
    position:absolute; top: 0; width: 50px; height: 600px; border-color: #838383; background-image: url(img/calendar_bg2.gif); font-family: Tahoma, Verdana; font-size: 8pt; color: #838383; border-top: 1px solid; border-color: #838383; background-position: 0 -2px
}
.schedItem {
    position: absolute; width: 161px; padding: 5px 5px; border: 1px solid; 
    opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden
}

--></style>
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
                'length' => 8,
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
            '1500' => array(
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
                'length' => 6,
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
    
    <div style="margin-left: 25px">
        <?php foreach ($rooms as $room): ?>
        <div class="small roomHeader"><?php echo htmlentities($room) ?></div>
        <?php endforeach ?>
    </div>
    <div class="clear"></div>
   
    <div style="position: relative; float: left; margin-bottom: 25px">
        <div style="position: relative; width: 173px; height: 598px; border: 1px solid; border-color: #838383; background-image: url(img/calendar_bg2.gif); background-position: 0 -2px; margin-left: 50px">
            <?php 
                $timeOffset = 0;
                foreach ($data[$room][$day] as $hour => $eventData) {
                    $timeHeight = ($hourHeight/2)*$eventData['length']-13 /* 12 = padding + border */;
            ?>
            <div style="margin-top: <?php echo $timeOffset; ?>px">
                <div style="height: <?php echo $timeHeight; ?>px; background-color: #4c4c4c; border-color: #000000;" class="schedItem">
                    <?php echo htmlentities($eventData['name']); ?>
                </div>
            </div>
            <?php
                    $timeOffset += $timeHeight + 13;
            } 
            ?>
            <!--
        <div style="position: absolute; margin-top: -1px; width: 173px; height: <?php echo ($hourHeight/2)*$eventData['length'] ?>px">
            <div style="position: absolute; margin-top: 149px; width: 173px; height: 50px">
                <div style="position: absolute; width: 161px; height: 38px; padding: 5px 5px; background-color: #a55dff; border: 1px solid; border-color: #6107d1; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                    Opening ceremonies
                </div>
            </div>
            <div style="position: absolute; margin-top: 199px; width: 173px; height: 25px">
                <div style="position: absolute; width: 161px; height: 13px; padding: 5px 5px; background-color: #75ff62; border: 1px solid; border-color: #1dc705; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #3a3939; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                    Con Etiquette
                </div>
            </div>
            <div style="position: absolute; margin-top: 224px; width: 173px; height: 75px">
                <div style="position: absolute; width: 161px; height: 63px; padding: 5px 5px; background-color: #a9a9a9; border: 1px solid; border-color: #767676; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #3a3939; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                    Lolita Fashion Show Setup
                </div>
            </div>
                    
            <div style="position: absolute; margin-top: 299px; width: 173px; height: 75px">
                <div style="position: absolute; width: 161px; height: 63px; padding: 5px 5px; background-color: #ffdf2c; border: 1px solid; border-color: #d3b50b; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #3a3939; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                    Lolita Fashion Show
                </div>
            </div>
                    
            <div style="position: absolute; margin-top: 374px; width: 173px; height: 225px">
                <div style="position: absolute; width: 161px; height: 213px; padding: 5px 5px; background-color: #ffdf2c; border: 1px solid; border-color: #d3b50b; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #3a3939; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                    Fan Parodies
                </div>
            </div>
            -->
        </div>
                
        <div class="timeBlock">
            <?php $count=0; foreach (range($hourData[$day]['minHour'], $hourData[$day]['maxHour']) as $hour): ?>
            <div class="timeHeader" style="margin-top: <?php echo $hourHeight*$count++ ?>px;">
                <?php echo date('g:i A', mktime($hour,0)); ?>
            </div>
        <?php endforeach ?>
        </div>
    </div>
    <div style="position: relative; float: left; margin-bottom: 25px">
            
                <div style="position: relative; width: 173px; height: 598px; border: 1px solid; border-color: #838383; background-image: url(img/calendar_bg2.gif); background-position: 0 -2px; border-left: 0px">
                    
                        <div style="position: absolute; margin-top: -1px; width: 173px; height: 200px" onmouseover="document.getElementById('148').style.display='block'" onmouseout="document.getElementById('148').style.display='none'">
                            <div style="position: absolute; width: 161px; height: 188px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                /Closed/
                            </div>
                        </div>
                    
                        <div style="position: absolute; margin-top: 249px; width: 173px; height: 50px">
                            <div style="position: absolute; width: 161px; height: 38px; padding: 5px 5px; background-color: #75ff62; border: 1px solid; border-color: #1dc705; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #3a3939; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                Step up your game! (DDR)
                            </div>
                        </div>
                    </div>
                
                
            </div><div style="position: relative; float: left; margin-bottom: 25px">
            
                <div style="position: relative; width: 173px; height: 598px; border: 1px solid; border-color: #838383; background-image: url(img/calendar_bg2.gif); background-position: 0 -2px; border-left: 0px">
                    
                        <div style="position: absolute; margin-top: -1px; width: 173px; height: 200px" onmouseover="document.getElementById('147').style.display='block'" onmouseout="document.getElementById('147').style.display='none'">
                            <div style="position: absolute; width: 161px; height: 188px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                /Closed/
                            </div>
                            <div style="position: absolute; top: 0px; right: 0px; width: 14px; height: 14px; background: url(img/attendingevent.png) top left no-repeat; display: none" title="In your planner" id="plannerlabel147">
                                <!-- -->
                            </div>
                        </div>
                        <div style="display: none; z-index: 1; position: absolute; margin-top: -1px; width: 173px" onmouseover="document.getElementById('147').style.display='block'" onmouseout="document.getElementById('147').style.display='none'" id="147">
                            <div style="position: absolute; width: 161px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; font-family: Tahoma, Verdana; font-size: 8pt; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px">
                                <span style="color: #FFFFFF"><b>/Closed/</b><br />11:00 AM - 3:00 PM</span>
                                <a href="#" onclick="showalert('1','2','<h2>Registered attendees only!</h2><br />Only registered attendees can create a planner. If you are already registered, please log in and link your badge via the <b>My badge</b> page.'); return false">
                                <div class="buttons-planneradd" onmouseover="this.className='buttons-planneradd-hover'" onmouseout="this.className='buttons-planneradd'" style="margin-top: 5px">
                                    Add to planner
                                </div>
                                </a><a href="#" onclick="showattendees('147'); return false">
                                <div class="buttons-attendees" onmouseover="this.className='buttons-attendees-hover'" onmouseout="this.className='buttons-attendees'" style="margin-top: 5px">
                                    Attendees
                                </div>
                                </a>
                            </div>
                            <div style="position: absolute; top: 0px; right: 0px; width: 14px; height: 14px; background: url(img/attendingevent.png) top left no-repeat; display: none" title="In your planner" id="plannerlabel2147">
                                <!-- -->
                            </div>
                        </div>
                    
                        <div style="position: absolute; margin-top: 374px; width: 173px; height: 75px">
                            <div style="position: absolute; width: 161px; height: 63px; padding: 5px 5px; background-color: #75ff62; border: 1px solid; border-color: #1dc705; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #3a3939; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                The Vocaloid Panel
                            </div>
                        </div>
                    
                        <div style="position: absolute; margin-top: 449px; width: 173px; height: 50px">
                            <div style="position: absolute; width: 161px; height: 38px; padding: 5px 5px; background-color: #75ff62; border: 1px solid; border-color: #1dc705; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #3a3939; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                Randomness of the internets
                            </div>
                        </div>
                    </div>
            </div>
            <div style="position: relative; float: left; margin-bottom: 25px">
            
                <div style="position: relative; width: 173px; height: 598px; border: 1px solid; border-color: #838383; background-image: url(img/calendar_bg2.gif); background-position: 0 -2px; border-left: 0px">
                    
                        <div style="position: absolute; margin-top: -1px; width: 173px; height: 200px">
                            <div style="position: absolute; width: 161px; height: 188px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                /Closed/
                            </div>
                        </div>
                    
                        <div style="position: absolute; margin-top: 249px; width: 173px; height: 200px">
                            <div style="position: absolute; width: 161px; height: 188px; padding: 5px 5px; background-color: #ffac62; border: 1px solid; border-color: #da6701; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #3a3939; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                Ul-Zaorith Demo RPG
                            </div>
                        </div>
                    
                        <div style="position: absolute; margin-top: 449px; width: 173px; height: 150px">
                            <div style="position: absolute; width: 161px; height: 138px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                The Room of Shame
                            </div>
                        </div>
                    </div>
                
                
            </div>
            
            <div style="position: relative; float: left; margin-bottom: 25px">
            
                <div style="position: relative; width: 173px; height: 598px; border: 1px solid; border-color: #838383; background-image: url(img/calendar_bg2.gif); background-position: 0 -2px; border-left: 0px">
                    
                        <div style="position: absolute; margin-top: -1px; width: 173px; height: 200px">
                            <div style="position: absolute; width: 161px; height: 188px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                /Closed/
                            </div>
                        </div>
                    
                        <div style="position: absolute; margin-top: 249px; width: 173px; height: 200px">
                            <div style="position: absolute; width: 161px; height: 188px; padding: 5px 5px; background-color: #ffac62; border: 1px solid; border-color: #da6701; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #3a3939; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                Tsukino-Con’s Card-gaming Room
                            </div>
                        </div>
                        
                        <div style="position: absolute; margin-top: 449px; width: 173px; height: 150px">
                            <div style="position: absolute; width: 161px; height: 138px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                The Room of Great Shame
                            </div>
                        </div>
                    </div>
            </div>
<?php endforeach; ?>
    </body>
</html>
