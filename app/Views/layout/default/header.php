<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title><?php if (isset($this->title)) echo $this->title; ?></title>
    <link rel="stylesheet" href="<?php echo $_layoutParams['root_css']; ?>"/>
    <script src="<?php echo BASE_URL; ?>public/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>public/js/jquery.validate.js" type="text/javascript"></script>
    <?php if(isset($_layoutParams['js']) && count($_layoutParams['js'])) : ?>
    <?php for ($i = 0; $i < count($_layoutParams['js']); $i++): ?>
    <script src="<?php echo $_layoutParams['js'][$i]; ?>" type="text/javascript"></script>
    <?php endfor; ?>
    <?php endif; ?>
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
        <noscript>Pro správnou funkci je vyžadován javascript</noscript>
        <?php if(isset($this->_error)): ?>
        <div id="error"><?php echo $this->_error; ?></div>
        <?php endif; ?>

        <?php if(isset($this->_message)): ?>
        <div id="message"><?php echo $this->_message; ?></div>
        <?php endif; ?>