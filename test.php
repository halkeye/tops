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
--></style>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
$hourHeight = 50;
$day1 = mktime(0,0,0,2,19,2010);
$rooms = array(
        'Main auditorium (123)',
        'Secondary Auditorium (125)',
        'Large panel room (124)',
        'Small panel room (130)',
        'The flexible room (128)',
);
$data = array(
        $day1 => array(
            '1100' => array(
                array(
                    'name'   => '/Closed/',
                    'length' => 6,
                    'type'   => 'closed'
                ),
                array(
                    'name'   => '/Closed/',
                    'length' => 8,
                    'type'   => 'closed'
                ),
                array(
                    'name'   => '/Closed/',
                    'length' => 8,
                    'type'   => 'closed'
                ),
                array(
                    'name'   => '/Closed/',
                    'length' => 8,
                    'type'   => 'closed'
                ),
                array(
                    'name'   => '/Closed/',
                    'length' => 8,
                    'type'   => 'closed'
                ),
            ),
            '1400' => array(
                array(
                    'name' => 'Opening ceremonies',
                    'length' => 2,
                ),
            ),
            '1500' => array(
                array(
                    'name' => 'Con Etiquette',
                    'length' => 1,
                ),
            ),
            '1530' => array(
                array(
                    'name' => 'Lolita Fashion Show Setup',
                    'length' => 3,
                ),
            ),
            '1600' => array(
                null,
                array(
                    'name' => 'Step up your game! (DDR)',
                    'length' => 2,
                ),
            ),

        )
);
?>
    <h3>Friday 19th February 2010</h3><br />
    
    <div>
        <div class="small roomHeader" style="margin-left: 50px">Main auditorium (123)</div>
        <div class="small roomHeader">Secondary Auditorium (125)</div>
        <div class="small roomHeader">Large panel room (124)</div>
        <div class="small roomHeader">Small panel room (130)</div>
        <div class="small roomHeader">The flexible room (128)</div>
    </div>
    <div class="clear"></div>
   
    <div style="position: relative; float: left; margin-bottom: 25px">
        <div style="position: relative; width: 173px; height: 598px; border: 1px solid; border-color: #838383; background-image: url(img/calendar_bg2.gif); background-position: 0 -2px; margin-left: 50px">
            <div style="position: absolute; margin-top: -1px; width: 173px; height: 150px">
                <div style="position: absolute; width: 161px; height: 138px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                    /Closed/
                </div>
            </div>
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
        </div>
                
        <div style="position: absolute; top: 0; width: 50px; height: 600px; border-color: #838383; background-image: url(img/calendar_bg2.gif); font-family: Tahoma, Verdana; font-size: 8pt; color: #838383; border-top: 1px solid; border-color: #838383; background-position: 0 -2px"><div style="position: absolute; margin-top: 0px; width: 45px; text-align: right">
            11:00 AM
        </div>
                        
        <?php $count=1; foreach (range(12, 22) as $hour): ?>
        <div style="position: absolute; margin-top: <?php echo $hourHeight*$count++ ?>px; width: 45px; text-align: right">
            <?php echo date('g:i A', mktime($hour,0)); ?>
        </div>
        <?php endforeach ?>
    </div>
            </div><div style="position: relative; float: left; margin-bottom: 25px">
            
                <div style="position: relative; width: 173px; height: 598px; border: 1px solid; border-color: #838383; background-image: url(img/calendar_bg2.gif); background-position: 0 -2px; border-left: 0px">
                    
                        <div style="position: absolute; margin-top: -1px; width: 173px; height: 200px" onmouseover="document.getElementById('148').style.display='block'" onmouseout="document.getElementById('148').style.display='none'">
                            <div style="position: absolute; width: 161px; height: 188px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                /Closed/
                            </div>
                            <div style="position: absolute; top: 0px; right: 0px; width: 14px; height: 14px; background: url(img/attendingevent.png) top left no-repeat; display: none" title="In your planner" id="plannerlabel148">
                                <!-- -->
                            </div>
                        </div>
                        <div style="display: none; z-index: 1; position: absolute; margin-top: -1px; width: 173px" onmouseover="document.getElementById('148').style.display='block'" onmouseout="document.getElementById('148').style.display='none'" id="148">
                            <div style="position: absolute; width: 161px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; font-family: Tahoma, Verdana; font-size: 8pt; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px">
                                <span style="color: #FFFFFF"><b>/Closed/</b><br />11:00 AM - 3:00 PM</span>
                                <a href="#" onclick="showalert('1','2','<h2>Registered attendees only!</h2><br />Only registered attendees can create a planner. If you are already registered, please log in and link your badge via the <b>My badge</b> page.'); return false">
                                <div class="buttons-planneradd" onmouseover="this.className='buttons-planneradd-hover'" onmouseout="this.className='buttons-planneradd'" style="margin-top: 5px">
                                    Add to planner
                                </div>
                                </a><a href="#" onclick="showattendees('148'); return false">
                                <div class="buttons-attendees" onmouseover="this.className='buttons-attendees-hover'" onmouseout="this.className='buttons-attendees'" style="margin-top: 5px">
                                    Attendees
                                </div>
                                </a>
                            </div>
                            <div style="position: absolute; top: 0px; right: 0px; width: 14px; height: 14px; background: url(img/attendingevent.png) top left no-repeat; display: none" title="In your planner" id="plannerlabel2148">
                                <!-- -->
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
                            <div style="position: absolute; top: 0px; right: 0px; width: 14px; height: 14px; background: url(img/attendingevent.png) top left no-repeat; display: none" title="In your planner" id="plannerlabel91">
                                <!-- -->
                            </div>
                        </div>
                    
                        <div style="position: absolute; margin-top: 449px; width: 173px; height: 150px">
                            <div style="position: absolute; width: 161px; height: 138px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                The Room of Shame
                            </div>
                        </div>
                    </div>
                
                
            </div><div style="position: relative; float: left; margin-bottom: 25px">
            
                <div style="position: relative; width: 173px; height: 598px; border: 1px solid; border-color: #838383; background-image: url(img/calendar_bg2.gif); background-position: 0 -2px; border-left: 0px">
                    
                        <div style="position: absolute; margin-top: -1px; width: 173px; height: 200px">
                            <div style="position: absolute; width: 161px; height: 188px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                /Closed/
                            </div>
                            <div style="position: absolute; top: 0px; right: 0px; width: 14px; height: 14px; background: url(img/attendingevent.png) top left no-repeat; display: none" title="In your planner" id="plannerlabel145">
                                <!-- -->
                            </div>
                        </div>
                    
                        <div style="position: absolute; margin-top: 249px; width: 173px; height: 200px">
                            <div style="position: absolute; width: 161px; height: 188px; padding: 5px 5px; background-color: #ffac62; border: 1px solid; border-color: #da6701; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #3a3939; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                Tsukino-Con’s Card-gaming Room
                            </div>
                            <div style="position: absolute; top: 0px; right: 0px; width: 14px; height: 14px; background: url(img/attendingevent.png) top left no-repeat; display: none" title="In your planner" id="plannerlabel92">
                                <!-- -->
                            </div>
                        </div>
                        
                        <div style="position: absolute; margin-top: 449px; width: 173px; height: 150px">
                            <div style="position: absolute; width: 161px; height: 138px; padding: 5px 5px; background-color: #4c4c4c; border: 1px solid; border-color: #000000; opacity: .80; filter: alpha(opacity=80); -moz-opacity: 0.8; font-family: Tahoma, Verdana; font-size: 8pt; color: #FFFFFF; font-weight: bold; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; overflow: hidden">
                                The Room of Great Shame
                            </div>
                            <div style="position: absolute; top: 0px; right: 0px; width: 14px; height: 14px; background: url(img/attendingevent.png) top left no-repeat; display: none" title="In your planner" id="plannerlabel58">
                                <!-- -->
                            </div>
                        </div>
                    </div>
            </div>
    </body>
</html>
