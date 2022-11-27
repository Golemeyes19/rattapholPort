  <?php 
        $title = '';
        $author = '';
        $keywords = array('');
        $description = '';
    ?>


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="favicon.png" rel="icon">
  <meta name="theme-color" content="#00BFD5">
  <meta name="author" content="{{$author}}">
  <meta name="keywords" content="<?php foreach ($keywords as $value) {echo $value.', ';}?>">
  <meta name="description" content="{{$description}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,800,700,600|Montserrat:400,500,600,700|Raleway:100,300,600,700,800|Merriweather:300" rel="stylesheet" type="text/css" />

  <title>@yield('title', $title)</title>

</head>