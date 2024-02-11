<?php

/**
 * Suppressed wacko text on included page
 */

echo '<!--noinclude-->';

#include Ut::join_path(FORMATTER_DIR, 'wiki.php');
include $this->BuildFullpathFromMultipath('wiki.php', FORMATTER_DIR);

echo '<!--/noinclude-->';
