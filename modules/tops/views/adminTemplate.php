<?php
$menuLinks = array(
        'index' => array(
            'title' => 'Home',
            'img'   => 'home',
            'desc'  => 'Site Root. Latest News, Updates.',
        ),
        'rooms' => array(
            'title' => 'Manage Rooms',
            'img'   => 'manage',
            'desc'  => 'Add, edit, remove and view rooms.',
        ),
        'days' => array(
            'title' => 'Manage Days',
            'img'   => 'manage',
            'desc'  => 'Add, edit, remove and view days.',
        ),
        'types' => array(
            'title' => 'Manage Types',
            'img'   => 'manage',
            'desc'  => 'Add, edit, remove and view types.',
        ),
);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <title>The Online Programming Schedule (TOPS)<?php echo $title ? "::$title" : "" ?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="designer" content="stt@sfu.ca" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/ui-darkness/jquery-ui.css" />
    
    <?php echo HTML::style('static/css/a1.css', NULL, TRUE); ?>
    <?php echo HTML::style('static/css/jquery_bar.css', NULL, TRUE); ?>
    <?php echo HTML::script('static/js/jquery_bar.js', NULL, TRUE); ?>
</head>

<body>
    <div id="container">
        <div id="user_login">
            <p><?php echo htmlentities($account->displayName); ?> (<?php echo htmlentities($account->email); ?>) (<?php echo html::anchor('auth/logout', 'Logout') ?>)</p>
        </div>

        <div id="header">
            <h1>The Online Programming Schedule (TOPS)</h1>
            <h2>&gt; <?php echo htmlentities($menuLinks[$currentPage]['title']) ?></h2>
        </div>

        <div id="menu">
            <ul>
            <?php foreach ($menuLinks as $url=>$link): ?>
                <?php if ($url == $currentPage): /* I hate this duplication, but littering it with ifs suck alot more */ ?>
                <li class="current">
                    <?php echo html::image('static/img/22_'.$link['img'].'.png', array('alt'=>$link['title']), TRUE); ?>
                    <?php echo htmlentities($link['title']) ?> 
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo url::site("admin/$url"); ?>">
                        <?php echo html::image('static/img/16_'.$link['img'].'.png', array('alt'=>$link['title']), TRUE); ?>
                        <?php echo htmlentities($link['title']) ?>
                        <span><?php echo htmlentities($link['desc']) ?></span>
                    </a>
                </li>
                <?php endif ?>
            <?php endforeach ?>
            </ul>
        </div>
        
        <div id="content">  
        <?php echo $content ?>
        </div>
        
        <div id="footer">
            <a href="http://validator.w3.org/check?uri=referer">XHTML 1.1 Validated</a> |
            <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS 2.1 Validated</a> |
            Design by: stt@sfu.ca
        </div>
    </div>
<script type="text/javascript">
<!--
	$.fn.bar.defaults.container = '#content';
-->
</script>
</body>
</html>
