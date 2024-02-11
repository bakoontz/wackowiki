<?php

/**
 * Suppressed typografica in formatted text.
 */

echo '<!--notypo-->';

$typo = $this->db->typografica;
$this->db->typografica = false;

#include Ut::join_path(FORMATTER_DIR, 'wiki.php');
include $this->BuildFullpathFromMultipath('wiki.php', FORMATTER_DIR);

$this->db->typografica = $typo;

echo '<!--/notypo-->';
