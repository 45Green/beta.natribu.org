<?
function counter ($lang) {

	mysql_connect('localhost', 'natribu', 'NahPass');
	mysql_select_db('natribu');
	//include($_SERVER["DOCUMENT_ROOT"]."/../lleo/mysql_.php"); //include($HOME."/lleo/mysql.php");


	//$lang="en";

	if (!mysql_num_rows(mysql_query("SELECT `lang` FROM nahui WHERE `lang`='".mysql_escape_string($lang)."'"))) {

		// �������� ����� ������� ���� �� ����
		mysql_query("INSERT INTO nahui
			(`lang`, `count`, `last_ip`)
			VALUES
			('".mysql_escape_string($lang)."','1','".mysql_escape_string($_SERVER["REMOTE_ADDR"])."')");
		//echo "\n�������� ����� ������� ��� �����:".$lang;
	} else {
		// ��������� �������
		mysql_query("UPDATE nahui SET count=count+1,
			last_ip='".mysql_escape_string($_SERVER["REMOTE_ADDR"])."'
			WHERE `lang`='".mysql_escape_string($lang)."' AND last_ip!='".mysql_escape_string($_SERVER["REMOTE_ADDR"])."'");
	}
	// ����� ��������� ��������
	$sql = mysql_query("SELECT * FROM nahui WHERE `lang`='".mysql_escape_string($lang)."'");
	if (mysql_num_rows($sql) == 1) {
		$p = mysql_fetch_assoc($sql);
		$count = $p["count"];
		//	$last_ip = $p["last_ip"];
	}
	return $count;
}

function counter_get ($lang) {
	// �������������
	mysql_connect('localhost', 'natribu', 'NahPass');
	mysql_select_db('natribu');
	// ����� ��������� ��������
	$sql = mysql_query("SELECT * FROM nahui WHERE `lang`='".mysql_escape_string($lang)."'");
	if (mysql_num_rows($sql) == 1) {
		$p = mysql_fetch_assoc($sql);
		$count = $p["count"];
		//	$last_ip = $p["last_ip"];
	}
	return $count;
}
