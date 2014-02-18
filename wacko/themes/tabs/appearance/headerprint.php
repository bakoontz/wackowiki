<?php
header('Content-Type: text/html; charset='.$this->get_charset());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->page['lang'] ?>" lang="<?php echo $this->page['lang'] ?>">
<head>
<title><?php echo htmlspecialchars($this->config['site_name'], ENT_COMPAT | ENT_HTML401, HTML_ENTITIES_CHARSET).' : '.(isset($this->page['title']) ? $this->page['title'] : $this->tag); ?></title>
<?php // do not index alternative print pages
echo "<meta name=\"robots\" content=\"noindex, nofollow\" />\n";?>
<meta http-equiv="content-type" content="text/html; charset=<?php echo $this->get_charset(); ?>" />
<meta name="keywords" content="<?php echo $this->config['meta_keywords'] ?>" />
<meta name="description" content="<?php echo $this->config['meta_description'] ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->config['theme_url'] ?>css/print.css" />
</head>

<body>

<div class="header">
<h1><?php echo $this->config['site_name'] ?>: <?php echo $this->compose_link_to_page($this->translit($this->tag), '', (isset($this->page['title']) ? $this->page['title'] : $this->tag)); ?>
 (<?php echo $this->get_translation('PrintVersion');?>)</h1>
</div>