<?php

require 'setup.php';

$projection = $projectionManager->createProjection('workshop_projection');

$projection
    ->fromAll()
    ->when([""=>function ($state, $event) {
       dump($event);
    }])
    ->run(false);