<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Schedule</title>
    <?php echo HTML::script('static/js/jquery.js', NULL, TRUE); ?>
    <?php echo HTML::script('static/js/main.js', NULL, TRUE); ?>
    <?php echo HTML::style('static/css/schedule.css', NULL, TRUE); ?>
    <link rel="stylesheet" href="css/style.css" />
    <style text="text/css">
        <?php
        /*
         *  It's best to use the following color (Pantone colors):
         *  #FCBBC4, #C4E3A1, #ADCFE6, #99DBDE, #D1A3CC, #F5ED59, #F0C49E
         */
        ?>
        <?php foreach ($eventTypes as $eventType): ?>
            .<?php echo htmlentities($eventType['nameKey']) ?> { 
                color: <?php echo htmlentities($eventType['textColor']) ?>;
                background-color: <?php echo htmlentities($eventType['bgColor']) ?>;
                border-color: <?php echo htmlentities($eventType['textColor']) ?>;
                border-width: <?php echo $borderWidth; ?>px;
            }
        <?php endforeach ?>
    </style>
</head>
<body>
    <div class="container">
        <?php
            //Calculate total width for content
            $totalWidth = 51; //50px + 1px border 
            foreach ($rooms as $room) {
                $totalWidth += 151; //150px + 1px border
            } 
        ?>
        <div id="scheduleContent" class="content" style="width: <?php echo $totalWidth ?>px">
            <?php foreach ($days as $day): ?>
                <h3><?php echo date('l jS F Y', $day); ?></h3><br />
                <?php $totalHours = (($hourData[$day]['maxHour']-$hourData[$day]['minHour'])); ?>
            
                <div style="margin-left: 25px">
                    <?php foreach ($rooms as $room): ?>
                        <div class="small roomHeader"><?php echo htmlentities($room) ?></div>
                    <?php endforeach ?>
                </div>
                <div class="clear"></div>
                <?php $lastRoom = $rooms[count($rooms)-1]; ?>
                <?php foreach ($rooms as $room) 
                { ?>
                    <div class="roomColumn">
                        <div class="roomBlock" style="height: <?php echo (($totalHours+1)*$hourHeight)-2 ?>px; <?php if ($room == $rooms[0]): ?> margin-left: 50px <?php elseif ($room == $lastRoom): ?> border-right: 1px solid #838383 <?php endif ?>">
                        <?php 
                            $timeOffset = 0;
                            if (isset($data[$room][$day]))
                            {
                                ksort($data[$room][$day]);
                                foreach ($data[$room][$day] as $startTime => $eventData) 
                                {
                                    $hour = date('H', $startTime);
                                    #echo "<pre>"; var_dump($eventData); echo "</pre>";
                                    $timeHeight = (floor($hourHeight/2)*($eventData['length']))-13 /* 12 = padding + border */;
                                    $timeOffset = $hourHeight*floor($hour-$hourData[$day]['minHour']);
                                    if (date('i', $eventData['startTime']))
                                        $timeOffset += $hourHeight/2; #to handle 30 min slots
                                    ?>
                                    <div style="margin-top: <?php echo $timeOffset; ?>px">
                                        <div style="height: <?php echo $timeHeight; ?>px;" class="schedItem <?php echo implode(' ', $eventData['type']) ?>">
                                            <?php echo htmlentities($eventData['name']); ?>
                                        </div>
                                    </div>
                                <?php
                                } 
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
                ?>
            <br style="clear:both" />
            <?php endforeach; ?>
        </div>
    </div>
    <div class="legend">
        <table id="schedItemSelector">
            <tr>
                <?php foreach ($eventTypes as $eventType): ?>
                    <td><div class="<?php echo htmlentities($eventType['nameKey']) ?>"><?php echo htmlentities($eventType['name']) ?></div></td>
                <?php endforeach ?>
            </tr>
        </table>
    </div>
</body>
</html>
