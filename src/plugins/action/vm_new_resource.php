<?php

if (!defined('IN_WACKO'))
{
	exit;
}

$info = <<<EOD
Description:
	Create a new resource and new verses page for that resource
Usage:
	{{vm_new_resource}}
EOD;

// set defaults
$help	??= 0;

if ($help)
{
	$tpl->help	= $this->help($info, 'vm_new_resource');
	return;
}

// Functions
$get_resource = function() {
	$sql = "SELECT id FROM vm_resource
            WHERE resource_type_id = (SELECT id FROM vm_resource_type WHERE type = {$_POST['resource_type']})
			AND author_first = {$_POST['author_first']}
			AND author_last = {$_POST['author_last']}
			AND title = {$_POST['title']}
			AND year = {$_POST['year']}";
	return $this->db->load_single($sql);
};	

$add_resource = function($resource_tag) {
    $sql = 'INSERT INTO ' . 'vm_resource SET ' .
        'page_id          = ' . $this->get_page_id($resource_tag) . ', ' .
        'resource_type_id = (SELECT id FROM vm_resource_type WHERE type = \'' . $_POST['resource_type'] . '\'), ' . 
        'author_first     = \'' . $_POST['author_first'] . '\', ' .
        'author_last      = \'' . $_POST['author_last']  . '\', ' .
        'title            = \'' . $_POST['title'] . '\', ' .
        'ed               = \'' . $_POST['ed'] . '\', ' .
        'year             = \'' . $_POST['year'] . '\', ' .
        'volume           = \'' . $_POST['volume'] . '\', ' .
        'issue            = \'' . $_POST['issue'] . '\', ' .
        'url              = \'' . $_POST['url'] . '\' ';    
	return $this->db->sql_query($sql, 2);
};

if(@$_POST['_action'] === 'vm_new_resource') {
    $root_tag = "Resources";
    $resource_tag = Ut::join_path($root_tag, $_POST['title'] . " - " . $_POST['author_first'] . " " . $_POST['author_last']);
    if($error = $this->sanitize_new_page_tag($resource_tag)) {
            $this->set_message($error, 'error');
            $this->reload_me();
    }
    if(null == $this->similar_page_exists($resource_tag)) {
        $body = "{{tree depth=1 title=0}}";
        if(null == $this->save_page($resource_tag, $body)) {
            $this->set_message($this->_t("Page save failed: ") . $resource_tag, 'error');
            $this->reload_me();
        }

		$verses_tag = "Verses";
		$full_verses_tag = Ut::join_path($resource_tag, $verses_tag);
		if(!$this->load_page($full_verses_tag)) {
			// Create new page hierarchy
			// $body = "{{tree depth=2 title=0}}";
			$body = "{{vm_display_passages}}\n{{vm_add_passage}}";
			if(null == $this->save_page($full_verses_tag, $body)) {
				$this->set_message($this->_t("Page save failed: ") . $full_verses_tag, 'error');
				$this->reload_me();
			}
		}
		// Create DB record
		$result = $add_resource($resource_tag);
		if(null == $result) {
			$this->set_message($this->_t("Insert query failed: ") . $sql, 'error');
			$this->reload_me();
		}

	} 
	$this->set_message("Redirecting: " . $this->href('', $resource_tag));
	$this->http->redirect($this->href('', $resource_tag));
} else {
	$tpl->l_href = $this->href();
}
