<?php 

$db = $data->db;
$list = (object)[
	'albums'=>[]
];

$q = "SELECT * FROM albums WHERE status='_special' ORDER BY date_modified DESC";
$res = $db->query($q);

if ($res->num_rows > 0)
{
	while ($row = $res->fetch_object()) {
		$list->albums[] = $row;
	}
}

$q = "SELECT id,title FROM albums WHERE status='published' ORDER BY date_modified DESC";
$res = $db->query($q);

if ($res->num_rows > 0)
{
	while ($row = $res->fetch_object()) {
		$list->albums[] = $row;
	}
}

echo json_encode($list);