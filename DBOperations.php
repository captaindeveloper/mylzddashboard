<?php

class DBOperations
{


private $conn;

 function __construct() {
	 	$this->conn=new mysqli('localhost','root','','lazada');
		if($this->conn->connect_error)
		{
			die("Connection failed".$this->conn->connect_error);
		}
    }
function getQuery1()
{
	$sql = "select unit_price,name,sku,shipping_type from ims_sales_order_item 
where id_sales_order_item= 229884";
$result = $this->conn->query($sql);
return $result;
}
function getQuery2()
{
	$sql = "select id_sales_order_item, name, SKU, s.status from
ims_sales_order_item i 
inner join ims_sales_order_item_status s on i.fk_sales_order_item_status=s.id_sales_order_item_status
where shipping_type='warehouse' and s.status='delivered'";
$result = $this->conn->query($sql);
return $result;
}
function getQuery3()
{
	$sql = "select sum(unit_price) as total_price from ims_sales_order_item
where shipping_type= 'cross_docking'";
$result = $this->conn->query($sql);
return $result;
}
function getData($date)
{
	if($date)
	{
	$sql = "select * from ims_sales_order_item
where date(updated_at)=?";
	$stmt=$this->conn->prepare($sql);
	$stmt->bind_param('s', $date);
	}
	else 
	{
	$sql = "select * from ims_sales_order_item";
	$stmt=$this->conn->prepare($sql);
	}
	
$stmt->execute();
$result=$stmt->get_result();
return $result;
}
function getQuery6()
{
	$sql = "select 
fk_sales_order, id_sales_order_item, name, SKU,s.status from
(
select t2.fk_sales_order_item,max(sh2.fk_sales_order_item_status) as statusID from 
(
select
t1.fk_sales_order_item,max(sh.created_at) as maxCreated FROM 
(
SELECT  fk_sales_order_item,MAX(created_at) as maxCreated FROM ims_sales_order_item_status_history
group by fk_sales_order_item) t1
inner join
ims_sales_order_item_status_history sh
on sh.fk_sales_order_item=t1.fk_sales_order_item
and sh.created_at<t1.maxCreated
group by 1
) t2
left join
ims_sales_order_item_status_history sh2
on sh2.fk_sales_order_item=t2.fk_sales_order_item
and sh2.created_at=t2.maxCreated
group by 1 
) finalHist
left join
ims_sales_order_item i
on finalHist.fk_sales_order_item=i.id_sales_order_item
left join ims_sales_order_item_status s
on finalHist.statusID=s.id_sales_order_item_status";
$result = $this->conn->query($sql);
return $result;
}
}