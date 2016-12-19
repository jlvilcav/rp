Select  z1.ticket_id, z1.created Fec_inicio, DATE(z1.created) fecha, DAY(z1.created) dia,  DATE_FORMAT(z1.created, "%H:%I:%S" ) hora, 
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
/*where z1.created BETWEEN '2016-11-28' AND '2016-12-02'*/
order by z1.created