<?php
defined('TOPS_PAGE') or die("not a valid hit");
isset($baseURL) or $baseURL = "./";
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title ?></title>
<style type="text/css" media="all">@import "<?php echo $baseURL; ?>css/layout.css";</style>
</head>

<body>

<div id="Header"><?php echo $title ?></div>

<div id="Content">
	<h1><?php echo (isset($contentTitle) ? $contentTitle : $title) ?></h1>

