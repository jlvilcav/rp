<?php
class StaffModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=ost', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listarcombo()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT st.staff_id, CONCAT(st.firstname, ' ', st.lastname) as nombre FROM `ost_staff` st where st.isactive = 1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Staff();

				$alm->__SET('staff_id', $r->staff_id);
				$alm->__SET('nombre', $r->nombre);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}