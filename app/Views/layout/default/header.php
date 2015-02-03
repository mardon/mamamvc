<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title><?php if (isset($this->title)) echo $this->title; ?></title>
    <link rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>"/>
</head>
<body>
    <h1><?php echo APP_NAME; ?></h1>
    <div id ="menu">
        <?php if(isset($_layoutParams['menu'])): ?>
        <?php for( $i = 0 ; $i < count($_layoutParams['menu']) ; $i++): ?>
        <?php

            if ($item && $_layoutParams['menu'][$i]['id'] == $item ) {
                $_item_style = 'current';
            } else {
                $_item_style = '';
            }

        ?>

            <li id="<?php echo $_item_style; ?>"><a href ="<?php echo $_layoutParams['menu'][$i]['link']; ?>"><?php echo $_layoutParams['menu'][$i]['titulek']; ?></a></li>
        <?php endfor; ?>
        <?php endif; ?>
    </div>
    <div id="content">
        <div id="error"><?php if(isset($this->_error)) echo $this->_error; ?></div>