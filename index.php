<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include_once('_inc/include.data.php'); ?>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Schedule</title>
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <style text="text/css">
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
    <?php foreach ($days as $day): ?>
        <h3><?php echo date('l jS F Y', $day); ?></h3><br />
        <?php $totalHours = (($hourData[$day]['max']-$hourData[$day]['min'])/100); ?>
    
        <div style="margin-left: 25px">
            <?php foreach ($rooms as $room): ?>
                <div class="small roomHeader"><?php echo htmlentities($room) ?></div>
            <?php endforeach ?>
        </div>
        <div class="clear"></div>
   
        <?php foreach ($rooms as $room) 
        { ?>
            <div style="position: relative; float: left; margin-bottom: 25px">
                <div class="roomBlock" style="height: <?php echo (($totalHours+1)*$hourHeight)-2 ?>px; <?php if ($room == $rooms[0]): ?> margin-left: 50px<?php endif ?>">
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
        ?>
    <?php endforeach; ?>
    <br style="clear:both" />
    <table id="schedItemSelector">
        <tr>
            <?php foreach ($eventTypes as $eventType): ?>
                <td class="<?php echo htmlentities($eventType['nameKey']) ?>"><?php echo htmlentities($eventType['name']) ?></td>
        <?php endforeach ?>
        </tr>
    </table>
</body>
</html>
