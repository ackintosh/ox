<?php
require_once 'bootstrap.php';

Game::run(function ($board) {
    echo $board->draw();

    echo 'choose.' . PHP_EOL . ' --> ';
    $input = trim(fgets(STDIN));

    if (!Command::isValid($input)) return;

    list($method, $args) = Command::parse($input);
    $board->call($method, $args);

});

