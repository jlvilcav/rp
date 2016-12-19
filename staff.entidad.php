<?php
class Staff
{
	private $staff_id;
	private $firstname;
	private $lastname;
	private $isactive;
	private $group_id;
	private $nombre;
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}