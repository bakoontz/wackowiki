<?php

/**
 * noautolinks formatter suppressed links detection in wacko text
 */

$this->noautolinks = true;

#include Ut::join_path(FORMATTER_DIR, 'wiki.php');
include $this->BuildFullpathFromMultipath('wiki.php', FORMATTER_DIR);

$this->noautolinks = false;
