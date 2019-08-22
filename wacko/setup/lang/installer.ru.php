<?php
$lang = [

/*
   Language Settings
*/
'Charset' => 'windows-1251',
'LangISO' => 'ru',
'LangName' => '�������',

/*
   Config Defaults
*/
'ConfigDefaults'	=> [
	// pages
	'category_page'		=> '���������',
	'groups_page'		=> '������',
	'users_page'		=> '������������',

	#'help_page'			=> '������',
	#'terms_page'		=> 'Terms',
	#'privacy_page'		=> 'Privacy',

	// time
	#'date_format'					=> 'd.m.Y',
	#'time_format'					=> 'H:i',
	#'time_format_seconds'			=> 'H:i:s',
],

/*
   Generic Page Text
*/
'Title' => '��������� WackoWiki',
'Continue' => '����������',
'Back' => '�����',
'Recommended' => '�������������',
'InvalidAction' => '������������ ��������',

/*
   Language Selection Page
*/
'lang' => '����� �����',
'PleaseUpgradeToR5' => '�� ����������� �������������� (�� 5.0.0) ������ WackoWiki. ��� ���������� �� ������� ������ ������ ��������� ��������� ������� �� <code class="version">5.0.x</code>.',
'UpgradeFromWacko' => '����� ���������� � WackoWiki! ������ �������� ���������� WackoWiki � <code class="version">%1</code> �� <code class="version">%2</code>.  ������� ���������� ����� ��������� ��������� �������.',
'FreshInstall' => '����� ���������� � WackoWiki! �� ������ ��� ��������� WackoWiki <code class="version">%1</code>.  ������� ��������� ����� ��������� ��������� �������.',
'PleaseBackup' => '�������� ��������� ����� ���� ������, ����������������� ����� � ������ ���������� ���� ������ (��������, ������ ����) �� ������ �������� ���������. ��� ����� ������ ��� �� ����� ���������� ��������.',
'LangDesc' => '����������, �������� ����. �� ����� �������������� � �������� ���������, � ����� ������ ������ �� ��������� ������������� WackoWiki.',

/*
   System Requirements Page
*/
'version-check' => '��������� ����������',
'PHPVersion' => '������ PHP',
'PHPDetected' => '��������� PHP',
'ModRewrite' => '���������� Apache Rewrite (�������������)',
'ModRewriteInstalled' => '������ ���������� (mod_rewrite) ����������?',
'Database' => '���� ������',
'PHPExtensions' => 'PHP ����������',
'Permissions' => '����� �������',
'ReadyToInstall' => '������ � ���������?',
'Requirements' => '��� ������ ������ ��������������� �����������, ������������� ����.',
'OK' => 'OK',
'Problem' => '��������',
'NotePHPExtensions' => '',
'ErrorPHPExtensions' => '���� ����������� PHP �� ������������ PHP ���������� ����������� ��� ������ WackoWiki.',
'PCREwithoutUTF8' => 'PCRE �� ������������� � ���������� UTF-8.',
'NotePermissions' => '��������� ��������� ���������� �������� ��������� � ���� %1, ������������� � �������� WackoWiki. ����� �� ������ �������, ���������, ��� ���-������ ����� ����� �� ������ � ������ ����. ���� ��� ����������, ��� ������� �������� ���� ������� (��������� ��������� ��������, ���).<br><br>��. <a href="https://wackowiki.org/doc/Doc/Russian/Installjacija" target="_blank">WackoWiki:Doc/Russian/�����������</a>.',
'ErrorPermissions' => '��� ����� ����������, ����� ��������� ��������� �� ����� ������������� ������ �����, ��������� ��� ���������� ������ WackoWiki. ����� �� ����� ��������� ��� ����� ���������� ��������� ������� ��������� ����� ������� � ������ �� �������.',
'ErrorMinPHPVersion' => '������ PHP ������ ���� ������ <strong>' . PHP_MIN_VERSION . '</strong>, � ������ ���������� ���� �� ���������� ������.  ��� ���������� ������ WackoWiki ����� �������� PHP �� ���� �� ��������� ������.',
'Ready' => '�����������, ��� ������ ����� ��� ������� WackoWiki. ������� � ��������� ����� ��������� ��������� �������.',

/*
   Site Config Page
*/
'site-config' => '��������� �����',
'SiteName' => '�������� Wiki',
'SiteNameDesc' => '����������, ������� ��� ������ ����� Wiki.',
'HomePage' => '������� ��������',
'HomePageDesc' => '������� ��� �������� ��������&nbsp;&mdash; ��� ����� �������� �� ���������, ������������ ������ � ������ ��� ��������� �����; ��� ������ <a href="https://wackowiki.org/doc/Doc/English/WikiName" title="View Help" target="_blank">����������</a>.',
'HomePageDefault' => '�������',
'MultiLang' => '����� ��������������',
'MultiLangDesc' => '����� �������������� ��������� ������� �������� �� ������ ������ � ����� ����. ���� ����� �������, ��������� ��������� ������� ��������� �������� ��� ���� ������, ���������� � �����������.',
'AllowedLang' => '����������� �����',
'AllowedLangDesc' => '������������� ������� ����� ������, ������� �� �������� ������������, ����� ����� ������� ���.',
'Admin' => '��� ��������������',
'AdminDesc' => '������� ��� ��������������, ��� ������ ���� <a href="https://wackowiki.org/doc/Doc/English/WikiName" title="View Help" target="_blank">����������</a> (��� ������� ����) (��������, <code>WikiAdmin</code>).',
'Password' => '������ ��������������',
'PasswordDesc' => '������� ������ (�� ����� %1 ��������).',
'Password2' => '������������� ������:',
'Mail' => '����� ����������� ����� ��������������',
'MailDesc' => '������� ����� ����������� ����� ��������������.',
'Base' => '������� URL',
'BaseDesc' => '������� URL ����� WackoWiki. � ���� ����� ����������� ����� �������; ���� ������������ mod_rewrite, ����� ������ ������������ ������ ����� ������, �.&nbsp;�.</p><ul><li><strong><code>http://example.com/</code></strong></li><li><strong><code>http://example.com/wiki/</code></strong></li></ul>',
'Rewrite' => 'Rewrite-�����',
'RewriteDesc' => 'Rewrite-����� ������ ���� �������, ���� �� ����������� mod_rewrite.',
'Enabled' => '�������:',
'ErrorAdminEmail' => '������� ���������� ����� ����������� �����!',
'ErrorAdminPasswordMismatch' => '������ �� ���������. ����������, ��������� ���� ������ ��������������',
'ErrorAdminPasswordShort' => '������ �������������� ������� ��������, ����������� ����� - %1 ��������!',
'WarningRewriteMode' => '��������!\n��������� �������� URL � Rewrite-������ �������� �������������. ������ ��� ���������� Rewrite �� ������ ����� ? � ������� URL, �� � ��� �� ����.\n\n��� ����������� ��������� � �������� ����������� ������� ��.\n��� ����, ����� ��������� � ����� � �� ���������, ������� ������.\n\n���� �� ������ ���� ������, �������, ��� ����� ��������� ����� �������� �������� ������������������� ����� ���������.',
'ModRewriteStatusUnknown' => '��������� ��������� �� ����� ���������, ������� �� mod_rewrite, �� ��� �� ��������, ��� �� ��������',

'LanguageArray'	=> [
	'bg' => '����������',
	'da' => '�������',
	'nl' => '�������������',
	'el' => '���������',
	'en' => '����������',
	'et' => '���������',
	'fr' => '�����������',
	'de' => '��������',
	'hu' => '����������',
	'it' => '�����������',
	'pl' => '��������',
	'pt' => '�������������',
	'ru' => '�������',
	'es' => '���������',
],

/*
   Database Config Page
*/
'database-config' => '��������� ���� ������',
'DBDriver' => '�������',
'DBDriverDesc' => '������� ���� ������, ������� �� ������ ������������. ����� ������� legacy-�������, ���� �� ������������ ������������� <a href="https://secure.php.net/pdo" target="_blank">PDO</a>.',
'DBCharset' => '���������',
'DBCharsetDesc' => '��������� ������� ���� ������.',
'DBEngine' => '������ ���� ������',
'DBEngineDesc' => '������ ���� ������ ������� ����� �����������. �� ������ ������� ������ MyISAM ���� �� ������� ������� MariaDB 10 ��� MySql 5.6 (��� ����) � ���������� InnoDB.',
'DBHost' => '��� �������',
'DBHostDesc' => '��� �������, �� ������� �������� ��. ������ <code>127.0.0.1</code> ��� <code>localhost</code> (�. �. �� ������, �� ������� ��������������� WackoWiki).',
'DBPort' => '���� (�������������)',
'DBPortDesc' => '����� �����, �� �������� �������� ������ ��, ��� ������������� ����� �� ��������� �������� ������.',
'DB' => '��� ���� ������',
'DBDesc' => '���� ������, ������� ����� ������������ WackoWiki. ��� ������ ������������, ����� ��������� ������������!',
'DBUserDesc' => '��� ������������ ��� ����������� � ���� ������.',
'DBUser' => '��� ������������ ���� ������',
'DBPasswordDesc' => '������ ������������ ��� ����������� � ���� ������.',
'DBPassword' => '������',
'PrefixDesc' => '������� ���� ������, ������������ WackoWiki. ��� �������� ��������� ��������� WackoWiki, ��������� ���� ��&nbsp;&mdash; ���������� ������� ��� ��� ������ �������� ������ (��������, wacko_).',
'Prefix' => '������� ������',
'ErrorNoDbDriverDetected' => '�������� ��� ������ �� ����������. ����������, �������� ������������� ���������� mysql, mysqli ��� pdo � ����� php.ini.',
'ErrorNoDbDriverSelected' => '�� ������ ������� ���� ������, �������� ���� �� ������.',
'DeleteTables' => '������� ������������ �������?',
'DeleteTablesDesc' => '��������! ��������� ����� ������ ������� � �������� ���� ������������ ������ �� ���� ����. �������� ��� �������� �� �������, ������ ����� ���� ������������� ������ ������� �� ��������� �����.',
'ConfirmTableDeletion' => '�� �������, ��� ������ ������� ��� ������������ ������� ����?',

/*
   Database Installation Page
*/
'database-install' => '��������� ���� ������',
'TestingConfiguration' => '������������ ��������',
'TestConnectionString' => '�������� ���������� ���������� � ��',
'TestDatabaseExists' => '�������� ������������� ��������� ��',
'InstallingTables' => '��������� ������',
'ErrorDBConnection' => '��������� ������ ��� ����������� � �� � ���������� �����������. ����������, ��������� � ��������� �� ������������.',
'ErrorDBExists' => '��������� �� �� ����������. ����������, ��������������, ��� ����� �� ����������!',
'To' => '->',
'AlterTable' => '��������� ��������� ������� %1',
'InsertRecord' => 'Inserting Record into %1 table',
'RenameTable' => '�������������� ������� %1',
'UpdateTable' => '���������� ������� %1',
'InstallingDefaultData' => '���������� ������ �� ���������',
'InstallingPagesBegin' => '���������� ������� �� ���������',
'InstallingPagesEnd' => '���������� ������� �� ��������� ���������',
'InstallingSystemAccount' => '���������� �����-������������ <code>System</code>',
'InstallingDeletedAccount' => '���������� �����-������������ <code>Deleted</code>',
'InstallingAdmin' => '���������� ������������-��������������',
'InstallingAdminSetting' => '���������� ������������-��������������',
'InstallingAdminGroup' => '���������� ������ Admins',
'InstallingAdminGroupMember' => '���������� ���������� � ������ Admins',
'InstallingEverybodyGroup' => '���������� ������ Everybody',
'InstallingModeratorGroup' => '���������� ������ Moderator',
'InstallingReviewerGroup' => '���������� ������ Reviewer',
'InstallingLogoImage' => '���������� �������� ��������',
'LogoImage' => '�������� ��������',
'InstallingConfigValues' => '���������� ���������� ������������',
'ConfigValues' => 'Config Values',
'ErrorInsertingPage' => '������ ������� �������� %1',
'ErrorInsertingPagePermission' => '������ ��������� ���� �������� %1',
'ErrorInsertingDefaultMenuItem' => '������ ��������� �������� %1��� ������ ���� �� ���������',
'ErrorPageAlreadyExists' => '�������� %1 ��� ����������',
'ErrorAlteringTable' => '������ ��������� ��������� ������� %1',
'ErrorInsertingRecord' => 'Error Inserting Record into %1 table',
'ErrorRenamingTable' => '������ �������������� ������� %1',
'ErrorUpdatingTable' => '������ ���������� ������� %1',
'CreatingTable' => '�������� ������� %1',
'ErrorAlreadyExists' => '%1 ��� ����������',
'ErrorCreatingTable' => '������ �������� ������� %1, ��� ��� ����������?',
'ErrorMovingRevisions' => '������ ����������� ������ ������',
'MovingRevisions' => '����������� ��� ������ ������ � ������� revisions',
'DeletingTables' => '�������� ������',
'DeletingTablesEnd' => '�������� ������ ���������',
'ErrorDeletingTable' => '������ �������� ������� %1, ��������� �������&nbsp;&mdash; ���������� ������� � ����, � ���� ������ �������������� ����� ���������������.',
'DeletingTable' => '�������� ������� %1',

/*
   Write Config Page
*/
'write-config' => '���������� ����������������� �����',
'FinalStep' => '��������� ���',
'Writing' => '���������� ����������������� �����',
'RemovingWritePrivilege' => '�������� ���������� �� ������',
'InstallationComplete' => '��������� ���������',
'ThatsAll' => '���! �� ������ �������. ������ �� ������ <a href="%1">���������� ���� ���� WackoWiki</a>.',
'SecurityConsiderations' => '����������� ������������',
'SecurityRisk' => '�� �������� ������ ����� �� ��������� ����� %1 ���-��������. ���� ����� �� �������, ��� ������ ��������!',
'RemoveSetupDirectory' => '������ �� ������ ������� ������� %1&nbsp;&mdash; ������� ��������� ��������.',
'ErrorGivePrivileges' => '���������������� ���� %1 �� ����� ���� ��������. ����� �������� ���� ���-������� ����� �� ������ ���� �� ������� WackoWiki, ���� �� ������ ���� %1<br>%2<br>; �� �������� ������ ��� ����� ����� ���������, �.&nbsp;e. %3.<br>����, ������-���� �� �� ������ ��������� ����� �����, ������� ����������� �����, ������������� ���� � ����� ���� � ��������� ��� �� ������ ��� ������ %1 � ������� WackoWiki. ����� ����� ��� ���� ������ ����������. ���� ���, �������� <a href="https://wackowiki.org/doc/Doc/Russian/Installjacija">WackoWiki:Doc/Russian/�����������</a>',
'NextStep' => '�� ��������� ���� ��������� ��������� ��������� ��������� ���������� ���������������� ����, %1. ����������, ���������, ��� ���-������ ����� ���������� ���� ��� ��������� �����; � ��������� ������ ��� ������� ��������� ��������� �������. �� �������� �����������, ��. <a href="https://wackowiki.org/doc/Doc/Russian/Installjacija" target="_blank">WackoWiki:Doc/Russian/�����������</a>.',
'WrittenAt' => '�������� ',
'DontChange' => '�� ������� wacko_version �������!',
'ConfigDescription' => '��������� �������� https://wackowiki.org/doc/Doc/Russian/FajjlKonfiguracii',
'TryAgain' => '���������� �����',

];
?>
