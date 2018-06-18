<?php



define('AUTH', true);

include('includes/welive.Core.php');
include(BASEPATH . 'includes/welive.Admin.php');

if($userinfo['usergroupid'] != 1) exit();

$action = ForceIncomingString('action', 'displaysettings');


PrintHeader($userinfo['username'], 'settings');

//########### UPDATE SETTINGS ###########

if($action == 'updatesettings'){
	$filename = BASEPATH . "config/settings.php";

	if(!is_writeable($filename)) {
		$errors = '请将系统配置文件config/settings.php设置为可写, 即属性设置为: 777';
	}

	if(isset($errors)){
		PrintErrors($errors, '系统设置错误');
		$action = 'displaysettings';
	}else{
		$settings    = $_POST['settings'];
		$fp = @fopen($filename, 'rb');
		$contents = @fread($fp, filesize($filename));
		@fclose($fp);
		$contents =  trim($contents);
		$oldcontents =  $contents;

		foreach($settings as $key => $value){
			if($_CFG[$key] != $settings[$key]){
				switch ($key) {
					case 'cKillRobotCode':
						$value = ForceString($value, $_CFG[$key]);
						break;
					case 'cUpdate':
						$value = ForceInt($value, 6);
						if($value < 3 OR $value > 20) $value = 6;
						break;
					case 'cPanalHeight':
						$value = ForceInt($value, 20);
						break;
					default:
						$value = ForceString($value);
						break;
				}
				
				$code = ForceString($key);
				$contents = preg_replace("/[$]_CFG\['$code'\]\s*\=\s*[\"'].*?[\"'];/is", "\$_CFG['$code'] = \"$value\";", $contents);
			}
		}

		if($contents != $oldcontents){
			$fp = @fopen($filename, 'wb');
			@fwrite($fp, $contents);
			@fclose($fp);
		}

		GotoPage('admin.settings.php', 1);
	}
}

//########### PRINT DEFAULT ###########

if($action == 'displaysettings'){

	echo '<form method="post" action="admin.settings.php">
	<input type="hidden" name="action" value="updatesettings">
	<table id="welive_list" border="0" cellpadding="0" cellspacing="0" class="moreinfo">
	<thead>
	<tr>
	<th colspan="2">系统设置:</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td><B>前台默认语言</B><BR>当选择 \'<b>自动</b>\' 时, 将根据访客的浏览器语言自动选择语言, 中文浏览器进入中文, 其它语言浏览器自动进入英文.</td>
	<td>';
	$Langs = GetLangs();

	$Select = NewObject('Select');
	$Select->Name = 'settings[cLang]';
	$Select->SelectedValue = $_CFG['cLang'];
	$Select->AddOption('Auto', '自动');
	foreach($Langs as $val){
		$Select->AddOption($val, $val);
	}

	echo $Select->Get();
	echo '</td>
	</tr>

	<tr>
	<td><B>系统状态</B><BR>关闭或开启'.APP_NAME.'在线客服系统.</td>
	<td>';
	$Radio = NewObject('Radio');
	$Radio->Name = 'settings[cActived]';
	$Radio->SelectedID = $_CFG['cActived'];
	$Radio->AddOption(1, '开启', '&nbsp;&nbsp;');
	$Radio->AddOption(0, '关闭', '&nbsp;&nbsp;');

	echo $Radio->Get();
	
	echo '</td>
	</tr>

	<tr>
	<td><B>日期格式</B><BR>系统显示日期的格式.</td>
	<td>';
	$Select->Clear();
	$Select->Name = 'settings[cDateFormat]';
	$Select->SelectedValue = $_CFG['cDateFormat'];
	$Select->AddOption('Y-m-d', "2010-08-12");
	$Select->AddOption('Y-n-j', "2010-8-12");
	$Select->AddOption('Y/m/d', "2010/08/12");
	$Select->AddOption('Y/n/j', "2010/8/12");
	$Select->AddOption('Y年n月j日', "2010年8月12日");
	$Select->AddOption('m-d-Y', "08-12-2010");
	$Select->AddOption('m/d/Y', "08/12/2010");
	$Select->AddOption('M j, Y', "Aug 12, 2010");

	echo $Select->Get();
	echo '
	<tr>
	<td><B>中文页面标题</B><BR>当用户使用中文浏览器时, 显示在浏览器顶部的标题名称.</td>
	<td>
	<input type="text" size="40" name="settings[cTitle]" value="' . $_CFG['cTitle'] . '">
	</td>
	</tr>
	
	<tr>
	<td><B>英文页面标题</B><BR>当用户使用非中文浏览器时, 显示在浏览器顶部的标题名称.</td>
	<td>
	<input type="text" size="40" name="settings[cTitle_en]" value="' . $_CFG['cTitle_en'] . '">
	</td>
	</tr>

	<tr>
	<td><B>中文欢迎词</B><BR>客人进入客服系统后显示的中文欢迎词. <span class=note>允许HTML, 如换行插入&lt;br&gt;</span></td>
	<td><textarea name="settings[cWelcome]" rows="4" style="width:278px;">' . $_CFG['cWelcome'] . '</textarea></td>
	</tr>

	<tr>
	<td><B>英文欢迎词</B><BR>客人进入客服系统后显示的英文欢迎词. <span class=note>允许HTML, 如换行插入&lt;br&gt;</span></td>
	<td><textarea name="settings[cWelcome_en]" rows="4" style="width:278px;">' . $_CFG['cWelcome_en'] . '</textarea></td>
	</tr>

	<tr>
	<td><B>自动删除记录</B><BR>客服或管理员登录后是否自动删除对话记录. 自动删除记录有助于提高对话速度, 达到系统自我维护的目的.</td>
	<td>';
	$Select->Clear();
	$Select->Name = 'settings[cDeleteHistory]';
	$Select->SelectedValue = $_CFG['cDeleteHistory'];
	$Select->AddOption('0', "从不删除");
	$Select->AddOption('6', "6小时前");
	$Select->AddOption('12', "12小时前");
	$Select->AddOption('24', "24小时前");
	$Select->AddOption('48', "48小时前");
	$Select->AddOption('240', "10天前");
	$Select->AddOption('480', "20天前");
	$Select->AddOption('720', "30天前");

	echo $Select->Get();
	echo '</td>
	</tr>

	<tr>
	<td><B>禁止IP地址</B><BR>被禁止IP的访客无法进入客服或留言. 多个IP请用英文分号";" 隔开, 可使用通配符禁止IP地址段.<BR>如: <span class=note>168.192.*.*</span></td>
	<td><textarea name="settings[cBannedips]" rows="6" style="width:278px;">' . $_CFG['cBannedips'] . '</textarea></td>
	</tr>

	</tbody>
	</table>';

	PrintSubmit('保存设置');

}


?>

