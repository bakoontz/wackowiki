<?php

if (!defined('IN_WACKO'))
{
	exit;
}

$info = <<<EOD
Description:
	Add a new passage for a given resource that is attached to the parent of this page
Usage:
	{{vm_add_passage}}
EOD;

// set defaults
$help	??= 0;

if ($help)
{
	$tpl->help	= $this->help($info, 'vm_add_passage');
	return;
}

$get_last_insert_id = function() {
    $sql = "SELECT LAST_INSERT_ID()";
    $result = $this->db->load_single($sql);
    if(null != $result) {
        return $result['LAST_INSERT_ID()'];
    } else {
        return null;
    }
};

$get_passage = function() {
    $sql = "SELECT id FROM vm_passage
        WHERE book_id = (SELECT id FROM vm_book WHERE book_abbrev = '{$_POST['book']}')
        AND chapter_start = {$_POST['chapter_start']}
        AND verse_start = {$_POST['verse_start']}
        AND chapter_end = {$_POST['chapter_end']}
        AND verse_end = {$_POST['verse_end']}";
    $result = $this->db->load_single($sql);
    if(null != $result) {
        return $result['id'];
    } else {
        return null;
    }
};

$add_passage = function() {
    $sql = 'INSERT INTO ' . 'vm_passage SET ' .
        'book_id = (SELECT id FROM vm_book WHERE book_abbrev = \'' . $_POST['book'] . '\'), ' . 
        'chapter_start    = \'' . $_POST['chapter_start'] . '\', ' .
        'verse_start      = \'' . $_POST['verse_start']  . '\', ' .
        'chapter_end      = \'' . $_POST['chapter_end'] . '\', ' .
        'verse_end        = \'' . $_POST['verse_end'] . '\' ';
    if(null == $this->db->sql_query($sql, 2)) {
        $this->set_message($this->_t("Insert into vm_passage failed: ") . $sql, 'error');
        $this->reload_me();
    }
};

$add_passage_resource = function($passage_id, $parent_id) {
    $sql = 'INSERT INTO ' . 'vm_passage_resource SET ' .
        'passage_id       = \'' . $passage_id . '\', ' .
        'resource_id = (SELECT id FROM vm_resource WHERE page_id = \'' . $parent_id . '\'), ' . 
        'page             = \'' . $_POST['page']  . '\', ' .
        'notes            = \'' . $_POST['notes'] . '\' ';
    if(null == $this->db->sql_query($sql, 2)) {
        $this->set_message($this->_t("Insert into vm_passage_resource failed: ") . $sql, 'error');
        $this->reload_me();
    }
};

if(@$_POST['_action'] === 'vm_add_passage') {
    $parent_id = $this->get_parent_id();
    if(null == $parent_id) {
        $this->set_message($this->_t("Cannot find parent page"), 'error');
        $this->reload_me();
    }
    // By convention, a single verse will have identical start/end
    // chapter/verse
    $chapter_end = $_POST['chapter_end'];
    if(0 == $chapter_end || null == $chapter_end) {
        $_POST['chapter_end'] = $_POST['chapter_start'];
    }
    $verse_end = $_POST['verse_end'];
    if(0 == $verse_end || null == $verse_end) {
        $_POST['verse_end'] = $_POST['verse_start'];
    }
    // Create DB records (if needed)
    $passage_id = $get_passage();
    if(null == $passage_id) { 
        $add_passage($parent_id);
        $passage_id = $get_last_insert_id();
    }
    $add_passage_resource($passage_id, $parent_id);
    $this->reload_me();
} else {
	$tpl->l_href		= $this->href();
}
