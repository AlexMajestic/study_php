<?php
	class EmployeeTable
	{
		public function read(){
			return $this->print_table();
		}
		public function del($user_id){
			$this->delete_user($user_id);
		}
		//вывод таблицы
		private function print_table(){
			$link = mysqli_connect('test.vz1','root','','ex1');
			$sql = "SELECT * FROM employees";
			if($_POST['filter']['min']!=NULL && $_POST['filter']['min']!=""){
				$salary_min=intval($_POST['filter']['min']);
				$sql = "SELECT * FROM employees WHERE salary >= '$salary_min'";
			}
			if($_POST['filter']['max']!=NULL && $_POST['filter']['max']!=""){
				$salary_max=intval($_POST['filter']['max']);
				$sql = "SELECT * FROM employees WHERE salary <= '$salary_max'";
			}
			if($_POST['filter']['min']!=NULL && $_POST['filter']['min']!=""&&$_POST['filter']['max']!=NULL && $_POST['filter']['max']!=""){
				$salary_min=intval($_POST['filter']['min']);
				$salary_max=intval($_POST['filter']['max']);
				$sql = "SELECT * FROM employees WHERE salary >= '$salary_min' AND salary <= '$salary_max'";
			}
			$result = mysqli_query($link,$sql);
			while($row=mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>".$row['id']."</td>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['age']."</td>";
				echo "<td>".$row['salary']."</td>";
				echo "<td><a href='?del_id=".$row['id']."' class='delete_icon'></a></td>";
				echo "<td><a href='edit.php?edit_id=".$row['id']."' class='delete_icon delete_icon-edit'></a></td>";
				echo "<td id='mass_delete-check' class='hidden chechbox_table'><input id='mass_delete-check' type='checkbox' class='chechbox_table' value='".$row['id']."' name='mass_del[]'></td>";
				echo "</tr>";
			}
		}
		// удаление сотрудника из таблицы
		private function delete_user($user_id){
			$link = mysqli_connect('test.vz1','root','','ex1');
			$del_id = intval($user_id);
			$sql = "DELETE FROM employees WHERE id = '$del_id'";
			$result = mysqli_query($link,$sql);
		}

		//массовое удаление сотрудников
		public function mass_delete(){
			if($_POST['mass_del']!=NULL){
				foreach ($_POST['mass_del'] as $key) {
					$this->delete_user($key);
				}
			}
		}
	}
?>