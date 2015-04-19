<?php

/*
	Wacko Wiki MySQL Table Updates Script

	These are all the updates that need to applied to earlier Wacko version to bring them up to 5.5 specs
*/

$pref		= $config['table_prefix'];
$charset	= 'DEFAULT CHARSET='.$config['database_charset'];
$engine		= 'ENGINE='.$config['database_engine'];

// ACL

// CACHE
$alter_cache_r5_1_0 = "ALTER TABLE {$pref}cache DROP INDEX timestamp, ADD INDEX idx_cache_time (cache_time)";
$alter_cache_r5_1_1 = "ALTER TABLE {$pref}cache ADD cache_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (cache_id)";
$alter_cache_r5_4_0 = "ALTER TABLE {$pref}cache CHANGE name name CHAR(40) NOT NULL  DEFAULT ''";

// CATEGORY
$alter_category_r5_4_0 = "ALTER TABLE {$pref}category CHANGE parent parent_id INT(10) UNSIGNED NOT NULL";

// CONFIG
$update_config_r5_4_0 = "UPDATE {$pref}config SET body_r = ''";

// LINK
$alter_link_r5_1_0 = "ALTER TABLE {$pref}link DROP INDEX from_tag, ADD INDEX idx_from_tag (from_page_id, to_tag(78))";

// LOG

// MENU

// PAGE
$alter_page_r5_1_0 = "ALTER TABLE {$pref}page ADD INDEX idx_deleted (deleted)";


$update_page_r5_1_0 = "UPDATE {$pref}page AS page SET noindex = '0' WHERE page.noindex IS NULL";
$update_page_r5_4_0 = "UPDATE {$pref}page SET body_toc = ''";
$update_page_r5_4_1 = "UPDATE {$pref}page SET body_r = ''";

// POLL

// RATING

// REFERRER

// REVISION
$alter_revision_r5_1_0 = "ALTER TABLE {$pref}revision ADD INDEX idx_deleted (deleted)";

$update_revision_r5_4_0 = "UPDATE {$pref}revision AS r, (SELECT page_id, lang FROM {$pref}page) AS p SET r.lang = p.lang WHERE r.page_id = p.page_id";

// SESSION
$table_session_r5_4_0 = "CREATE TABLE {$pref}session (".
							"cookie_token CHAR(40) COLLATE utf8_bin NOT NULL DEFAULT '',".
							"user_id INT(10) UNSIGNED NOT NULL DEFAULT '0',".
							"session_last_visit DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',".
							"session_start DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',".
							"session_time DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',".
							"session_ip VARCHAR(40) COLLATE utf8_bin NOT NULL DEFAULT '',".
							"session_browser VARCHAR(150) COLLATE utf8_bin NOT NULL DEFAULT '',".
							"session_forwarded_for VARCHAR(255) NOT NULL,".
							"session_admin TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',".
							"PRIMARY KEY (cookie_token),".
							"KEY session_time (session_time),".
							"KEY session_user_id (user_id)".
						") {$engine} COMMENT='' {$charset}";

// TAG

// UPLOAD
$alter_upload_r5_1_0 = "ALTER TABLE {$pref}upload ADD INDEX idx_deleted (deleted)";
$alter_upload_r5_1_1 = "ALTER TABLE {$pref}upload DROP INDEX page_id, ADD INDEX idx_page_id (page_id, file_name)";
$alter_upload_r5_1_2 = "ALTER TABLE {$pref}upload DROP INDEX page_id_2, ADD INDEX idx_page_id_2 (page_id, uploaded_dt)";
$alter_upload_r5_1_3 = "ALTER TABLE {$pref}upload CHANGE description file_description VARCHAR(250) NOT NULL DEFAULT ''";

// USER
$alter_user_r5_4_0 = "ALTER TABLE `{$pref}user` CHANGE `session_time` `last_visit` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'";

// USER SETTING

// USERGROUP
$alter_usergroup_r5_4_0 = "ALTER TABLE {$pref}usergroup CHANGE moderator moderator_id INT(10) UNSIGNED NOT NULL DEFAULT '0'";

// WATCH

/* $table_word_r5_4 = "CREATE TABLE {$pref}word (".
					"word_id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,".
					"word VARCHAR(255) NOT NULL DEFAULT '',".
					"replacement VARCHAR(255) NOT NULL DEFAULT '',".
					"PRIMARY KEY (word_id)".
				") {$engine} COMMENT='' {$charset}"; */

?>