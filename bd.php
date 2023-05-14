<?php
require('libs/rb-mysql.php');
R::setup(
    'mysql:host=localhost;dbname=AWRB',
    'root',
    ''
);
session_start();
