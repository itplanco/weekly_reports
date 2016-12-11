<?php

header("Content-Type: application/json");
if ($model === NULL) {
    return;
}

print json_encode($model);
