<div id="page">

<h3><?php echo str_replace("%1",$this->Link("/".$this->GetPageTag()),$this->GetTranslation("SettingsFor")); ?></h3>
<br />

<?php

// redirect to show method if page don't exists
if (!$this->page) $this->Redirect($this->href('show'));

// deny for comment
if ($this->page['comment_on_id'])
	$this->Redirect($this->href('', $this->GetCommentOnTag($this->page["comment_on_id"]), 'show_comments=1').'#'.$this->page['tag']);
// and for forum page
else if ($this->forum === true && !$this->IsAdmin())
	$this->Redirect($this->href());

if ($this->UserIsOwner() || $this->HasAccess("write",$page["page_id"]))
{
	if ($_POST)
	{
		$options = array(
			'hide_comments'		=> (int)$_POST['hide_comments'],
			'hide_files'		=> (int)$_POST['hide_files'],
			'hide_rating'		=> (int)$_POST['hide_rating'],
			'hide_toc'			=> (int)$_POST['hide_toc'],
			'hide_index'		=> (int)$_POST['hide_index'],
			'lower_index'		=> ( $_POST['index_mode'] == 'l' ? 1 : 0 ),
			'upper_index'		=> ( $_POST['index_mode'] == 'u' ? 1 : 0 ),
		);

		if ($this->IsAdmin())
		{
			$options['allow_rawhtml']		= (int)$_POST['allow_rawhtml'];
			$options['disable_safehtml']	= (int)$_POST['disable_safehtml'];
		}

		$this->SaveMeta($this->page["page_id"], array(
			"lang" => $_POST["lang"],
			"more" => $this->ComposeOptions($options),
			"title" => $_POST["title"],
			"description" => $_POST["description"],
			"keywords" => $_POST["keywords"]
		));

		// log event
		$this->Log(4, str_replace("%1", $this->tag." ".$_POST["title"], $this->GetTranslation("LogPageMetaUpdated")));

		// reload page
		$this->SetMessage($this->GetTranslation("MetaUpdated")."!");
		$this->Redirect($this->Href("settings"));
	}
	else
	{
		// load settings

		$revs = $this->LoadSingle(
		"SELECT COUNT(tag) AS total ".
		"FROM {$this->config['table_prefix']}revisions ".
		"WHERE tag = '".quote($this->dblink, $this->tag)."' ".
		"GROUP BY tag");

		$rating = $this->LoadSingle(
			"SELECT page_id, value, voters ".
			"FROM {$this->config['table_prefix']}rating ".
			"WHERE page_id = {$this->page['page_id']} ".
			"LIMIT 1");

		if ($rating['voters'] > 0)			$rating['ratio'] = $rating['value'] / $rating['voters'];
		if (is_float($rating['ratio']))		$rating['ratio'] = round($rating['ratio'], 2);
		if ($rating['ratio'] > 0)			$rating['ratio'] = '+'.$rating['ratio'];
?>

<div class="page_settings">
<?php
		// show form
		echo $this->FormOpen("settings") ?>
<?php
		echo "<table class=\"form_tbl\">";
		echo "<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('SettingsID')."</th>";
		echo "<td class=\"form_right\">".$this->page['page_id']."</td>";
		echo "</tr>\n<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('Owner')."</th>";
		echo "<td class=\"form_right\">"."<a href=\"".$this->href("", $this->config["users_page"], "profile=".$this->GetUserNameById($this->page["owner_id"]))."\">".$this->GetUserNameById($this->page["owner_id"])."</a>"."</td>";
		echo "</tr>\n<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('SettingsCreated')."</th>";
		echo "<td class=\"form_right\">".$this->GetTimeStringFormatted($this->page['created'])."</td>";
		echo "</tr>\n<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('SettingsCurrent')."</th>";
		echo "<td class=\"form_right\">".$this->GetTimeStringFormatted($this->page['modified'])."</td>";
		echo "</tr>\n<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('SettingsSize')."&nbsp;&nbsp;</th>";
		echo "<td class=\"form_right\">".ceil(strlen($this->page['body']) / 1000).' kB / '.ceil(strlen($this->page['body_r']) / 1000)." kB"."</td>";
		echo "</tr>\n<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('SettingsTotalRevs')."</th>";
		echo "<td class=\"form_right\"><a href=\"".$this->href("revisions")."\" title=\"".$this->GetTranslation("RevisionTip")."\">".(int)$revs['total']."</a></td>";
		unset($revs);
		echo "</tr>\n<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('SettingsTotalComs')."</th>";
		echo "<td class=\"form_right\">".$this->page['comments']."</td>";
		echo "</tr>\n<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('SettingsHits')."</th>";
		echo "<td class=\"form_right\">".$this->page['hits']."</td>";
		echo "</tr>\n";
		if ($this->config['hide_rating'] != 1)
		{
			echo "<tr class=\"lined\">";
			echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('SettingsRating')."</th>";
			echo "<td class=\"form_right\">".$rating['ratio'].' ('.$this->GetTranslation('RatingVoters').': '.(int)$rating['voters'].')'."</td>";
	 			unset($rating);
			echo "</tr>\n";
		}

	// load settings (shows only if owner is current user or Admin)
	if ($this->UserIsOwner() || $this->IsAdmin())
	{
		echo "<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('MetaComments')."</th>";
		echo "<td class=\"form_right\">";
		echo "<input type=\"radio\" id=\"commentsOn\" name=\"hide_comments\" value=\"0\"".( !$this->config['hide_comments'] ? "checked=\"checked\"" : "" )."/><label for=\"commentsOn\">".$this->GetTranslation('MetaOn')."</label>";
		echo "<input type=\"radio\" id=\"commentsGuest\" name=\"hide_comments\" value=\"2\"".( $this->config['hide_comments'] == 2 ? "checked=\"checked\"" : "" )."/><label for=\"commentsGuest\">".$this->GetTranslation('MetaRegistered')."</label>";
		echo "<input type=\"radio\" id=\"commentsOff\" name=\"hide_comments\" value=\"1\"".( $this->config['hide_comments'] == 1 ? "checked=\"checked\"" : "" )."/><label for=\"commentsOff\">".$this->GetTranslation('MetaOff')."</label>";
		echo "</td>";
		echo "</tr>";
		echo "<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('MetaFiles')."</th>";
		echo "<td class=\"form_right\">";
		echo "<input type=\"radio\" id=\"filesOn\" name=\"hide_files\" value=\"0\"".( !$this->config['hide_files'] ? "checked=\"checked\"" : "" )."/><label for=\"filesOn\">".$this->GetTranslation('MetaOn')."</label>";
		echo "<input type=\"radio\" id=\"filesGuest\" name=\"hide_files\" value=\"2\"".( $this->config['hide_files'] == 2 ? "checked=\"checked\"" : "" )."/><label for=\"filesGuest\">".$this->GetTranslation('MetaRegistered')."</label>";
		echo "<input type=\"radio\" id=\"filesOff\" name=\"hide_files\" value=\"1\"".( $this->config['hide_files'] == 1 ? "checked=\"checked\"" : "" )."/><label for=\"filesOff\">".$this->GetTranslation('MetaOff')."</label>";
		echo "</td>";
		echo "</tr>";
		if ($this->config['hide_rating'] != 1)
		{
			echo "<tr class=\"lined\">";
			echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('MetaRating')."</th>";
			echo "<td class=\"form_right\">";
			echo "<input type=\"radio\" id=\"ratingOn\" name=\"hide_rating\" value=\"0\"".( !$this->config['hide_rating'] ? "checked=\"checked\"" : "" )."/><label for=\"ratingOn\">".$this->GetTranslation('MetaOn')."</label>";
			echo "<input type=\"radio\" id=\"ratingGuest\" name=\"hide_rating\" value=\"2\"".( $this->config['hide_rating'] == 2 ? "checked=\"checked\"" : "" )."/><label for=\"ratingGuest\">".$this->GetTranslation('MetaRegistered')."</label>";
			echo "<input type=\"radio\" id=\"ratingOff\" name=\"hide_rating\" value=\"1\"".( $this->config['hide_rating'] == 1 ? "checked=\"checked\"" : "" )."/><label for=\"ratingOff\">".$this->GetTranslation('MetaOff')."</label>";
			echo "</td>";
		}
		echo "</tr>";
		echo "<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('MetaToc')."</th>";
		echo "<td class=\"form_right\">";
		echo "<input type=\"radio\" id=\"tocOn\" name=\"hide_toc\" value=\"0\"".( !$this->config['hide_toc'] ? "checked=\"checked\"" : "" )."/><label for=\"tocOn\">".$this->GetTranslation('MetaOn')."</label>";
		echo "<input type=\"radio\" id=\"tocOff\" name=\"hide_toc\" value=\"1\"".( $this->config['hide_toc'] ? "checked=\"checked\"" : "" )."/><label for=\"tocOff\">".$this->GetTranslation('MetaOff')."</label>";
		echo "</td>";
		echo "</tr>";
		echo "<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('MetaIndex')."</th>";
		echo "<td class=\"form_right\">";
		echo "<input type=\"radio\" id=\"indexOn\" name=\"hide_index\" value=\"0\"".( !$this->config['hide_index'] ? "checked=\"checked\"" : "" )."/><label for=\"indexOn\">".$this->GetTranslation('MetaOn')."</label>";
		echo "<input type=\"radio\" id=\"indexOff\" name=\"hide_index\" value=\"1\"".( $this->config['hide_index'] ? "checked=\"checked\"" : "" )."/><label for=\"indexOff\">".$this->GetTranslation('MetaOff')."</label>";
		echo "</td>";
		echo "</tr>";
		echo "<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('MetaIndexMode')."</th>";
		echo "<td class=\"form_right\">";
		echo "<input type=\"radio\" id=\"indexmodeF\" name=\"index_mode\" value=\"f\"".( !$this->config['lower_index'] && !$this->config['upper_index'] ? "checked=\"checked\"" : "" )."/><label for=\"indexmodeF\">".$this->GetTranslation('MetaIndexFull')."</label>";
		echo "<input type=\"radio\" id=\"indexmodeL\" name=\"index_mode\" value=\"l\"".( $this->config['lower_index'] ? "checked=\"checked\"" : "" )."/><label for=\"indexmodeL\">".$this->GetTranslation('MetaIndexLower')."</label>";
		echo "<input type=\"radio\" id=\"indexmodeU\" name=\"index_mode\" value=\"u\"".( $this->config['upper_index'] ? "checked=\"checked\"" : "" )."/><label for=\"indexmodeU\">".$this->GetTranslation('MetaIndexUpper')."</label>";
		echo "</td>";
		echo "</tr>";


		?>

<?php
	if ($this->IsAdmin())
	{

		echo "<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('MetaHtml')."</th>";
		echo "<td class=\"form_right\">";
		echo "<input type=\"radio\" id=\"htmlOn\" name=\"allow_rawhtml\" value=\"1\"".( $this->config['allow_rawhtml'] ? "checked=\"checked\"" : "" )."/><label for=\"htmlOn\">".$this->GetTranslation('MetaOn')."</label>";
		echo "<input type=\"radio\" id=\"htmlOff\" name=\"allow_rawhtml\" value=\"0\"".( !$this->config['allow_rawhtml'] ? "checked=\"checked\"" : "" )."/><label for=\"htmlOff\">".$this->GetTranslation('MetaOff')."</label>";
		echo "</td>";
		echo "</tr>";
		echo "<tr class=\"lined\">";
		echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation('MetaSafeHtml')."</th>";
		echo "<td class=\"form_right\">";
		echo "<input type=\"radio\" id=\"safehtmlOn\" name=\"disable_safehtml\" value=\"0\"".( !$this->config['disable_safehtml'] ? "checked=\"checked\"" : '' )."/><label for=\"safehtmlOn\">".$this->GetTranslation('MetaOn')."</label>";
		echo "<input type=\"radio\" id=\"safehtmlOff\" name=\"disable_safehtml\" value=\"1\"".( $this->config['disable_safehtml'] ? "checked=\"checked\"" : '' )."/><label for=\"safehtmlOff\">".$this->GetTranslation('MetaOff')."</label>";
		echo "</td>";
		echo "</tr>";

	}
		// show form
?>
<?php

?>

		<?php echo "<tr class=\"lined\">"; ?>
		<th class="form_left" scope="row"><label for="title"><?php echo $this->GetTranslation("MetaTitle"); ?></label></th>
		<td class="form_right"><input id="title" name="title" value="<?php echo $this->page["title"] ?>" size="60" maxlength="100" /></td>

		<?php echo "</tr>\n<tr class=\"lined\">"; ?>
		<th class="form_left" scope="row"><label for="keywords"><?php echo $this->GetTranslation("MetaKeywords"); ?></label></th>
		<td class="form_right"><textarea id="keywords" name="keywords" rows="4" cols="51"><?php echo $this->page["keywords"] ?></textarea></td>

		<?php echo "</tr>\n<tr class=\"lined\">"; ?>
		<th class="form_left" scope="row"><label for="description"><?php echo $this->GetTranslation("MetaDescription"); ?></label></th>
		<td class="form_right"><textarea id="description" name="description" rows="4" cols="51"><?php echo $this->page["description"] ?></textarea></td>

		<?php echo "</tr>\n<tr class=\"lined\">"; ?>
		<th class="form_left" scope="row"><label for="lang"><?php echo $this->GetTranslation("SetLang"); ?></label></th>
		<td class="form_right"><select id="lang" name="lang">
		<?php
		if (!($clang = $this->page["lang"]))
		$clang = $this->GetConfigValue("language");

		if ($langs = $this->AvailableLanguages())
		{
			foreach ($langs as $lang)
			{
				print("<option value=\"".$lang."\" ".($clang==$lang ? "selected=\"selected\"" : "").">".$lang."</option>\n");
			}
		}
		?>
		</select>

		<div class="BewareChangeLang"> <?php echo $this->GetTranslation("BewareChangeLang"); ?></div></td>

		<?php echo "</tr>\n<tr class=\"lined\">"; ?>
		<th class="form_left"></td>
		<td class="form_right"><input type="submit" value="<?php echo $this->GetTranslation("MetaStoreButton"); ?>" style="width: 120px" accesskey="s" />
		&nbsp;
		<input type="button" value="<?php echo $this->GetTranslation("MetaCancelButton"); ?>" onclick="history.back();" style="width: 120px" /></td>

<?php

		}
		else
		{
			echo "<tr class=\"lined\">";
			echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation("MetaTitle")."</th>";
			echo "<td class=\"form_right\">".$this->page["title"]."</td>";
			echo "</tr>\n<tr class=\"lined\">";
			echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation("MetaKeywords")."</th>";
			echo "<td class=\"form_right\">".$this->page["keywords"]."</td>";
			echo "</tr>\n<tr class=\"lined\">";
			echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation("MetaDescription")."</th>";
			echo "<td class=\"form_right\">".$this->page["description"]."</td>";
			echo "</tr>\n<tr class=\"lined\">";
			echo "<th class=\"form_left\" scope=\"row\">".$this->GetTranslation("SetLang")."</th>";
			echo "<td class=\"form_right\">".$this->page["lang"]."</td>";
		}
		echo "</tr>\n</table>";
		echo $this->FormClose();
		echo "</div>";
}
?>


<div class="page_tools">
<?php echo "<div class=\"layout-box\"><p class=\"layout-box\"><span> ".$this->GetTranslation("SettingsPortal")."  </span></p>";?>
<ul>
	<li><a href="<?php echo $this->href("edit");?>"><?php echo $this->GetTranslation("SettingsEdit"); ?></a></li>
	<li><a href="<?php echo $this->href("revisions");?>"><?php echo $this->GetTranslation("SettingsRevisions"); ?></a></li>
	<?php
	// Rename link (shows only if owner is current user or Admin)
	if ($this->UserIsOwner() || $this->IsAdmin())
	{
		echo("<li><a href=\"".$this->href("rename")."\">".$this->GetTranslation("SettingsRename")."</a>
	</li>");
	}
	?>
<?php // Remove link (shows only for page owner if allowed)
	if ($this->UserIsOwner() && !$this->GetConfigValue("remove_onlyadmins") || $this->IsAdmin())
	{
		echo("<li><a href=\"".$this->href("remove")."\">".$this->GetTranslation("SettingsRemove")."</a></li>");
		echo("<li><a href=\"".$this->href("purge")."\">".$this->GetTranslation("SettingsPurge")."</a></li>");
	}
	?>
<?php
	// ACL link (shows only if owner is current user or Admin)
	if ($this->UserIsOwner() || $this->IsAdmin())
	{
		echo("<li><a href=\"".$this->href("acls")."\">".$this->GetTranslation("SettingsAcls")."</a></li>");
	}
	?>
	<li><a href="<?php echo $this->href("keywords"); ?>"><?php echo $this->GetTranslation("SettingsKeywords"); ?></a></li>
	<li><a href="<?php echo $this->href("upload"); ?>"><?php echo $this->GetTranslation("SettingsUpload"); ?></a></li>
	<li><a href="<?php echo $this->href("referrers"); ?>"><?php echo $this->GetTranslation("SettingsReferrers"); ?></a></li>
	<li><a href="<?php echo $this->href("watch"); ?>"><?php echo ($this->iswatched === true ? $this->GetTranslation("RemoveWatch") : $this->GetTranslation("SetWatch")); ?></a></li>
	<li><a href="<?php echo $this->href("print");?>"><?php echo $this->GetTranslation("SettingsPrint"); ?></a></li>
	<li><a href="<?php echo $this->href("msword");?>"><?php echo $this->GetTranslation("SettingsMsword"); ?></a></li>
	<li><a href="<?php echo $this->href("latex");?>"><?php echo $this->GetTranslation("SettingsLatex"); ?></a></li>
	<li><a href="<?php echo $this->href("export.xml");?>"><?php echo $this->GetTranslation("SettingsXML"); ?></a></li>
</ul>
</div></div>
<?php
}
else
{
	print($this->GetTranslation("ReadAccessDenied"));
}
?>
<br style="clear: both;">
</div>