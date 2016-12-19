<?php
class Ticket
{
	private $ticket_id;
	private $number;
	private $asunto;
	private $Tipo_Req;
	private $Estado;
	private $Fec_inicio;
	private $Fec_ciere;
	private $nombre;
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}