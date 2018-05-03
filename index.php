<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Задание №1 - Таблица сотрудников</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<form method="POST" class="filter_price-form">
		<input type="text" name="filter[min]" class="filter_price" placeholder="min" value=<?=$_POST['filter']['min']?>>
		<span class="filter_price-line">-</span>
		<input type="text" name="filter[max]" class="filter_price" placeholder="max" value=<?=$_POST['filter']['max']?>>
		<input type="submit" name="" value="Фильтр зарплате">
	</form>
	<table>
		<tr>
			<th>ID</th>
			<th>ФИО</th>
			<th>Возраст</th>
			<th>Зарплата</th>
		</tr>
		<form method="POST">
		<?php
			require_once('init.php');
			$table = new EmployeeTable();
			$table->del($_GET['del_id']);
			$table->mass_delete();
			$table->read();
		?>
	</table>
		<input id="mass_delete_button" class="delete_button" type="button" value="Массовое удаление">
		<input id="mass_delete_submit" type="submit" name="" class="delete_button hidden" value="Удалить">
	</form>
	<a href="add.php">
		<button>Новый сотрудник</button>	
	</a>
	<script type="text/javascript">
	var mass = document.getElementById('mass_delete_button');
	function start_delete(){
		document.getElementById('mass_delete_submit').classList.remove('hidden');
		document.getElementById('mass_delete_button').classList.add('hidden');
		var check = document.querySelectorAll('.chechbox_table');
		for (var i = 0; i < check.length; i++) {
    		check[i].classList.remove('hidden');
  		}
	}
	mass.addEventListener("click", start_delete, false);
	</script>
</body>
</html>