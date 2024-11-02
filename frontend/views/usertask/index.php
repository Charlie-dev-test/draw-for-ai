<?
use backend\models\User;
use backend\models\Usertask;
use backend\models\Files;
use backend\models\Uploads;

//include("fancybox.php");

?>

<script>
document.title = "User Tasks";
</script>

<style>
table.usertask_table {
	border: 1px solid #000;
	background-color: #eee;
}
table.usertask_table td {
	padding: 10px;
}
table.usertask_table_internal td.no_padding {
	padding: 0;
}
.btn_red {
	background-color: #f00;
	color: #fff;
}
.btn_green {
	background-color: #0f0;
}
.btn_blue {
	background-color: #00f;
	color: #fff;
}
.btn_yellow {
	background-color: #ff0;
}
.usertask_status {
	text-align: right;
	font-weight: bold;
}
.usertask_status.color1 {
	color: #0f0; 
}
.usertask_status.color2 {
	color: #00f; 
}
.usertask_status.color3 {
	color: #f00; 
}
.usertask_status.color4 {
	color: #090; 
}
.userdata-result-block {
	background-color: #ffc;
	padding: 10px;
	border: 1px solid #999;
}
div.gray {
	background-color: #eee;
	padding: 10px
}
</style>

<br/>

<form name="user-task-form" method="post">
<?

if(!empty($_POST)) {
	?>
	<div class="userdata-result-block">
	<?
	$userId = null;
	$action = null;
	$userTaskId = null;
	$userTaskUser = null;
	foreach($_POST as $k => $v) {
		if($k === "user-id") {
			$userId = (int)$v;
		}
		if($k === "usertask_user") {
			$userTaskUser = (int)$v;
		}
		if(preg_match("{usertask\-btn\-(.*?)\-(\d+)}si", $k, $matches)) {
			//print_r($matches);
			$action = $matches[1];
			$userTaskId = (int)$matches[2];
		}
		//echo "$k => $v<br/>";
	}
	if((!empty($userId) || !empty($userTaskUser)) && !empty($action) && !empty($userTaskId)) {
		if($action !== "setuser") {
			echo "user: <b>".$userId."</b><br/>";
		}
		if($userTaskUser !== $userId) {
			echo "set user: <b>".$userTaskUser."</b><br/>";
		}
		echo "action: <b>".$action."</b><br/>";
		echo "task: <b>".$userTaskId."</b><br/>";

		if($action === "open") {
			$row = Usertask::getUserTask($userTaskId);
			echo "<hr/>";
			echo "<div class=\"gray\">";
				foreach($row as $k => $v) {
					echo "$k => $v<br/>";
				}
			echo "</div>";
		}
		
		if($action === "get") {
			$row = Usertask::getUserTask($userTaskId);
			$row->user_id = $userId;
			$row->status = Usertask::STATUS_EXECUTING;
			$row->update();
		}
		
		if($action === "cancel") {
			$row = Usertask::getUserTask($userTaskId);
			$row->user_id = 0;
			$row->status = Usertask::STATUS_AVAILABLE;
			$row->update();
		}
		
		if($action === "check") {
			$row = Usertask::getUserTask($userTaskId);
			$row->user_id = $userId;
			$row->status = Usertask::STATUS_CHECKING;
			$row->update();
		}

		if($action === "setuser" && !empty($userTaskUser)) {
			$user = User::findIdentity($userTaskUser);
		}

		if(!empty($userId)) {
			$user = User::findIdentity($userId);
		}
		if(!empty($userTaskUser)) {
			$user = User::findIdentity($userTaskUser);
		}
	}
	?>
	</div>
	<br/>
	<?
}
//$user = User::findByUsername('user');
//$user = User::findByUsername('petya_vasechkin');
//$user = User::findIdentity(142);
//\FB::log($user->fullname);

?>
<select name="usertask_user">
	<?
	$users = User::getUsersByRole(User::ROLE_USER);
	foreach($users as $usr) {
		$sel = "";
		if(!empty($user->id) && $usr->id === $user->id) {
			$sel = " selected";
		}
		?>
		<option value="<?=$usr->id?>"<?=$sel?>><?=$usr->fullname.", ".$usr->email?></option>
		<?
	}
	?>
</select>&nbsp;&nbsp;&nbsp;<input type="submit" name="usertask-btn-setuser-111222333" value="Выбрать юзера"/>
<?

$result = null;
if(!empty($user)) {
	$result = \Yii::$app->user->login($user, 0);
}
//\FB::log($result);


if($result && !empty($user->id)) {
	$files = new Files();
	$uploads = new Uploads();
	$imgFiles = ['jpg','jpeg','gif','png'];
	?>
	<h1><?=$user->fullname?></h1>
	<input type="hidden" name="user-id" value="<?=$user->id?>"/>
	<?
	$rows = Usertask::getUserTasks();
	if(is_array($rows) && count($rows) > 0) {
		foreach($rows as $row) {
			if($row->status === Usertask::STATUS_CHECKING) {
				//-- admin function!
				continue;
			}
			$strStatus = Usertask::getStatus()[$row->status];
			$strDate = date("d.m.Y", strtotime($row->date));
			?>
			<table class="usertask_table">
				<tr>
					<td><b>Задание № <?=str_pad($row->id, 5, "0", STR_PAD_LEFT)?> <?=$strDate?></b></td>
					<td  class="usertask_status color<?=$row->status?>"><?=$strStatus?></td>
				</tr>
				<tr>
					<td colspan="2"><?=$row->desc?></td>
				</tr>
				<tr>
					<td colspan="2">
						<?
						$LANGUAGE_ID = null;
						$picsRows = $files->getFiles($row->id, $LANGUAGE_ID, "usertask");
						foreach($picsRows as $picsRow) {
							if(!empty($picsRow->pics)) {
								$title = $picsRow->title;
								$picsData = $uploads->getFile($picsRow->pics);
								$picsFileName = $picsData->getFullFileName();
								if(!empty($picsFileName)) {
									$url = $picsData->getFullUrl();
									//\FB::log($url);
									$pathInfo = pathinfo($picsData->realname);
									$ext = $pathInfo['extension'];
									if(!in_array($ext, $imgFiles)) {
										$txt = !empty($title) ? $title : $picsData->realname;
										?>
										<a href="<?=$url?>" data-fancybox="admin_pics" target="_blank"><?=$txt?></a>
										<?
									} else {
										$txt = !empty($title) ? $title : "<img src=\"".$url."\" height=\"50\"/>";
										?>
										<a href="<?=$url?>" data-fancybox="admin_pics" target="_blank"><?=$txt?></a>
										<?
									}
									?>
									<br/>
									<?
								}
							}
						}
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">Количество: <?=$row->num?></td>
				</tr>
				<tr>
					<td colspan="2">
						<table class="usertask_table_internal">
							<tr>
								<td class="no_padding">Оценочная длительность: <?=$row->duration?></td>
								<td>Стоимость: <?=$row->price?></td>
								<?
								switch($row->status) {
									case Usertask::STATUS_AVAILABLE:
										?>
										<td><input type="submit" name="usertask-btn-get-<?=$row->id?>" class="btn_green" value="Взять в работу"/></td>
										<td><input type="submit" name="usertask-btn-open-<?=$row->id?>" class="btn_blue" value="Открыть"/></td>
										<?
										break;
									case Usertask::STATUS_EXECUTING:
										?>
										<td><input type="submit" name="usertask-btn-check-<?=$row->id?>" class="btn_yellow" value="На проверку"/></td>
										<td><input type="submit" name="usertask-btn-cancel-<?=$row->id?>" class="btn_red" value="Отказаться"/></td>
										<td><input type="submit" name="usertask-btn-open-<?=$row->id?>" class="btn_blue" value="Открыть"/></td>
										<?
										break;
									case Usertask::STATUS_CHECKING:
										?>
										<td><input type="submit" name="usertask-btn-accept-<?=$row->id?>" class="btn_green" value="Принять"/></td>
										<td><input type="submit" name="usertask-btn-open-<?=$row->id?>" class="btn_blue" value="Открыть"/></td>
										<?
										break;
									case Usertask::STATUS_PAID:
										?>
										<td><input type="submit" name="usertask-btn-open-<?=$row->id?>" class="btn_blue" value="Открыть"/></td>
										<?
										break;
								}
								?>
							</td>
						</table>
					</td>
				</tr>
			</table>
			<br/>
			<?
		}
	}
}
?>
</form>
