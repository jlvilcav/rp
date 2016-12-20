<?php
class TicketModel
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

	public function Listarticket($fecIni, $fecFin, $idAgent )
	{
		try
		{
			$result = array();

			if ($idAgent > 0) 
			{
				$stm = $this->pdo->prepare("Select  z1.ticket_id, 
										z1.created Fec_inicio, 
										DATE(z1.created) fecha, DAY('%H:%I:%S' ) hora, 
										td.subject asunto,
										z1.number,
										CONCAT(st.firstname, ' ', st.lastname) as nombre,
										tst.name estado,
										topic.topic Tipo_Req,
										case when tst.id = 3 and eve.state = 'closed' then eve.timestamp end Fec_ciere
										from ost_ticket z1 
										inner join ost_ticket__cdata td on td.ticket_id = z1.ticket_id
										inner join ost_staff st on st.staff_id = z1.staff_id and st.isactive = 1
										inner join ost_ticket_status tst on tst.id = z1.status_id
										inner join ost_help_topic topic on topic.topic_id = z1.topic_id
										left join ost_ticket_event eve on eve.ticket_id = z1.ticket_id and eve.state = 'closed'
										where z1.created BETWEEN '".$fecIni."' AND '".$fecFin."' and st.staff_id =".$idAgent." 
										order by z1.created");
			} else {
					
				$stm = $this->pdo->prepare("Select  z1.ticket_id, 
										z1.created Fec_inicio, 
										DATE(z1.created) fecha, DAY('%H:%I:%S' ) hora, 
										td.subject asunto,
										z1.number,
										CONCAT(st.firstname, ' ', st.lastname) as nombre,
										tst.name estado,
										topic.topic Tipo_Req,
										case when tst.id = 3 and eve.state = 'closed' then eve.timestamp end Fec_ciere
										from ost_ticket z1 
										inner join ost_ticket__cdata td on td.ticket_id = z1.ticket_id
										inner join ost_staff st on st.staff_id = z1.staff_id and st.isactive = 1
										inner join ost_ticket_status tst on tst.id = z1.status_id
										inner join ost_help_topic topic on topic.topic_id = z1.topic_id
										left join ost_ticket_event eve on eve.ticket_id = z1.ticket_id and eve.state = 'closed'
										where z1.created BETWEEN '".$fecIni."' AND '".$fecFin."' order by z1.created");
			}/**/
			
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Ticket();

				$alm->__SET('ticket_id', $r->ticket_id);
				$alm->__SET('number', $r->number);
				$alm->__SET('asunto', $r->asunto);
				$alm->__SET('Tipo_Req', $r->Tipo_Req);
				$alm->__SET('estado', $r->estado);
				$alm->__SET('Fec_inicio', $r->Fec_inicio);
				$alm->__SET('Fec_ciere', $r->Fec_ciere);
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