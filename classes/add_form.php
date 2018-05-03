<?php 
	class add_form
	{
		public $name;
		public $age;
		public $salary;

		public function add(){
			if(isset($_POST['new'])){
				$this->add_employee();
			}
		}

		public function print_form(){
			echo "	
			<!DOCTYPE html>
				<html>
				<head>
					<meta charset='utf-8'>
					<title>Задание №1 - Таблица сотрудников</title>
					<link rel='stylesheet' href='../css/style.css'>
				</head>
				<body>
					<form method='POST' name='add_employee'>
						<label>Имя сотрудника<input type='name' name='new[name]' required></label>
						<label>Возраст<input type='name' name='new[age]' required></label>
						<label>Зарплата<input type='name' name='new[salary]' required></label>
						<input type='submit' name='' value='Добавить'>
					</form>
				</body>
				</html>
			";
		}

		private function add_employee(){
			$this->name = $_POST['new']['name'];
			$this->age = $_POST['new']['age'];
			$this->salary = $_POST['new']['salary'];
			$link = mysqli_connect('test.vz1','root','','ex1');
			$sql = 'INSERT INTO employees (`name`,`age`,`salary`) VALUES (?,?,?)';
			$stmt = mysqli_prepare($link, $sql);
			mysqli_stmt_bind_param($stmt, 'sii', $this->name,intval($this->age),intval($this->salary));
			if($add = mysqli_stmt_execute($stmt)){
				header('Location:/');
			}
		}
	}

	class edit_form
	{
		public $name;
		public $age;
		public $salary;

		public function print_form(){
			if(isset($_GET['edit_id'])){
				$id = intval($_GET['edit_id']);
				$link = mysqli_connect('test.vz1','root','','ex1');
				$sql = "SELECT * FROM employees WHERE id = '$id'";
				if($result = mysqli_query($link,$sql)){
					$row = mysqli_fetch_assoc($result);
					$this->name = $row['name'];
					$this->age = $row['age'];
					$this->salary = $row['salary'];
				}
				echo "	
				<!DOCTYPE html>
					<html>
					<head>
						<meta charset='utf-8'>
						<title>Задание №1 - Таблица сотрудников</title>
						<link rel='stylesheet' href='../css/style.css'>
					</head>
					<body>
						<form method='POST' name='add_employee'>
							<label>Имя сотрудника<input type='name' name='update[name]' required value='".$this->name."''></label>
							<label>Возраст<input type='name' name='update[age]' required value=".$this->age."></label>
							<label>Зарплата<input type='name' name='update[salary]' required value=".$this->salary."></label>
							<input type='submit' name='' value='Сохранить'>
						</form>
					</body>
					</html>
				";
			}else{
				header('Location:/');
			}
		}
		public function update_employee(){
			if(isset($_POST['update'])){
				$id = intval($_GET['edit_id']);
				$name = $_POST['update']['name'];
				$age = intval($_POST['update']['age']);
				$salary = intval($_POST['update']['salary']);
				$link = mysqli_connect('test.vz1','root','','ex1');
				$sql = "UPDATE employees SET name='$name', age='$age',salary='$salary' WHERE id = '$id'";
				if($result = mysqli_query($link,$sql)){
					header('Location:/');
				}
			}
		}
	}
?>