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

if(@$_POST['_action'] === 'vm_new_resource') {
    $root_tag = "Resources";
    $resource_tag = Ut::join_path($root_tag, $_POST['title'] . " - " . $_POST['author_first'] . " " . $_POST['author_last']);
    if($error = $this->sanitize_new_page_tag($resource_tag)) {
            $this->set_message($error, 'error');
            $this->reload_me();
    }
    if(!$this->load_page($resource_tag)) {
        $body = "{{tree depth=1 title=0}}";
        if(null == $this->save_page($resource_tag, $body)) {
            $this->set_message($this->_t("Page save failed: ") . $resource_tag, 'error');
            $this->reload_me();
        }
    }

    $verses_tag = "Verses";
    $full_verses_tag = Ut::join_path($resource_tag, $verses_tag);
    if(!$this->load_page($full_verses_tag)) {
        // Create new page hierarchy
        // $body = "{{tree depth=2 title=0}}";
        $body = "{{vm_add_passage}}";
        if(null == $this->save_page($full_verses_tag, $body)) {
            $this->set_message($this->_t("Page save failed: ") . $full_verses_tag, 'error');
            $this->reload_me();
        }
    }
    // Create DB record
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
    if(null == $this->db->sql_query($sql, 2)) {
        $this->set_message($this->_t("Insert query failed: ") . $sql, 'error');
        $this->reload_me();
    }

    $this->set_message("Redirecting: " . $this->href('', $tag));
    $this->http->redirect($this->href('', $full_verses_tag));
} else {
	$tpl->l_href		= $this->href();
}

return;

// logout
if (@$_GET['action'] === 'logout')
{
	$this->context[++$this->current_context] = ''; // TODO ?!
	$this->logout_user();
	$this->go_back($this->db->root_page);
}

if ($user = $this->get_user())
{
	// user is logged in; display logout form
	$tpl->u_href	= $this->href();
	$tpl->u_link	= $this->compose_link_to_page($this->db->users_page . '/' . $user['user_name'], '', $user['user_name']);

	$message = null;

	// show last visit
	if (!$this->db->is_null_date($user['last_visit']))
	{
		$message .= $this->_t('LastVisit') .
			' <code>' .
			$this->sql_time_format($user['last_visit']) .
			'</code>' . "<br>\n";
	}

	// show IP address restriction for user session
	$message .= $this->_t('BindSessionIp') . ' ' .
		($user['validate_ip']
			? Ut::perc_replace($this->_t('BindSessionIpOn'), '<code>' . $user['ip'] . '</code>')
			: '<code>' . $this->_t('Off') . '</code>') .
		"<br>\n";

	// show traffic protection
	if ($this->db->tls)
	{
		// https://httpd.apache.org/docs/2.4/mod/mod_ssl.html#envvars
		$message .= $this->_t('TrafficProtection') .
			' <code>' .
			(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'
				? $this->_t('On') .
					(isset($_SERVER['SSL_PROTOCOL'])
						? ', '. $_SERVER['SSL_PROTOCOL'] . ' (' . ($_SERVER['SSL_CIPHER'] ?? '') . ')'
						: '')
				: $this->_t('Off')
			) .
			'</code>' . "<br>\n";
	}

	if (!empty($message))
	{
		$this->set_message($message , 'notice');
	}

	$tpl->u_logout	= $this->href('', '', 'action=logout');
	$tpl->u_account	= $this->compose_link_to_page($this->db->account_page, '', $this->_t('AccountText'));
	$tpl->u_cookies	= $this->href('', '', 'action=clearcookies');
}
else // login
{
	// user is not logged in
	$logins = &$this->sess->sticky_login_count;
	isset($logins) || $logins = 0;

	if (@$_POST['_action'] === 'login')
	{
		++$logins;

		$user_name	= Ut::strip_spaces(($_POST['user_name'] ?? ''));
		$password	= (string)	($_POST['password'] ?? '');
		$email		= (string)	($_POST['email'] ?? null);
		$persistent	= (bool)	($_POST['persistent'] ?? false);

		if ($this->sess->login_captcha && !$this->validate_captcha())
		{
			$error = $this->_t('CaptchaFailed');
		}
		else if (!preg_match('/^(' . self::PATTERN['USER_NAME'] . ')$/u', $user_name))
		{
			$error = $this->_t('InvalidUserName');
		}
		else
		{
			// let's begin pessimistically ;)
			$error = $this->_t('LoginIncorrect');

			// if username already exists, check password
			// check email dummy field in search for bots
			if (!$email && ($user = $this->load_user($user_name)))
			{
				if (($n = $user['failed_login_count']) > $logins)
				{
					$logins = $n;
				}

				// check password
				if (!$this->password_verify($user, $password))
				{
					$this->set_failed_login_count($user['user_id']);
				}
				else
				{
					$logins = 0;

					// check for disabled account
					if (!$user['enabled'] || $user['account_type'])
					{
						$error = $this->_t(($user['account_status'] == 1)? 'UserApprovalPending' : 'AccountDisabled');
					}
					else if ($this->db->email_confirmation && $user['email_confirm'])
					{
						$error =
							$this->_t('EmailNotVerified') . '<br>' .
							$this->_t('EmailConfirmRequired');
					}
					else
					{
						$this->login_user($user, $persistent);
						$this->context[++$this->current_context] = ''; // STS what for?

						$this->log(3, Ut::perc_replace($this->_t('LogUserLoginOK', SYSTEM_LANG), $user['user_name']));

						$this->go_back($this->db->users_page . '/' . $user['user_name']);
					}
				}
			}
		}

		$this->sess->login_username = $user_name;
		$this->log(2, Ut::perc_replace($this->_t('LogUserLoginFailed', SYSTEM_LANG), $user_name));
		$this->set_message($error, 'error');
		$this->login_page();
	}

	$this->sess->login_captcha = 0;

	if ($logins)
	{
		$this->login_delay();

		if ($this->db->max_login_attempts && $logins > $this->db->max_login_attempts
			&& ($cap = $this->show_captcha()))
		{
			$tpl->l_toomuch			= true;
			$tpl->l_show_captcha	= $cap;

			$this->sess->login_captcha = 1;
		}
	}

	$tpl->l_href		= $this->href();
	$tpl->l_pattern		= self::PATTERN['USER_NAME'];
	$tpl->l_only		=
		Ut::perc_replace($this->_t($this->db->disable_wikiname? 'NameAlphanumOnly' : 'NameCamelCaseOnly'),
			$this->db->username_chars_min,
			$this->db->username_chars_max);
	$tpl->l_pwhref		= $this->href('', $this->db->password_page);
	$tpl->l_username	= @$this->sess->login_username;

	if ($this->db->allow_registration)
	{
		$tpl->l_welcome			= true;
		$tpl->l_welcome_href	= $this->href('', $this->db->registration_page);
	}
}
