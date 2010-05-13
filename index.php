<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><?php
    include('include.data.php');
?><html><head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
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
<?php foreach ($eventTypes as $eventType): ?>
.<?php echo htmlentities($eventType['nameKey']) ?> { 
    color: <?php echo htmlentities($eventType['textColor']) ?>;
    background-color: <?php echo htmlentities($eventType['bgColor']) ?>;
    border-color: <?php echo htmlentities($eventType['textColor']) ?>;
    border-width: <?php echo $borderWidth; ?>px;
}
<?php endforeach ?>

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
<?php foreach ($eventTypes as $eventType): ?>
            <td class="<?php echo htmlentities($eventType['nameKey']) ?>"><?php echo htmlentities($eventType['name']) ?></td>
<?php endforeach ?>
        </tr>
    </table>
    </body>
</html>
