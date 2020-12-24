<?php
include('lib/common.php');

if (isset($_GET['id'])) {
	$userpagedata = fetch("SELECT * FROM users WHERE id = ?", [$_GET['id']]);
} else if (isset($_GET['name'])) {
	$userpagedata = fetch("SELECT * FROM users WHERE name = ?", [$_GET['name']]);
} else {
	// todo: we should have a error function
	die("no user specified");
}

$page = (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1);
$forceuser = isset($_GET['forceuser']);

$limit = sprintf("LIMIT %s,%s", (($page - 1) * $lpp), $lpp);
$levels = query("SELECT l.id id,l.title title,u.id u_id,u.name u_name FROM levels l JOIN users u ON l.author = u.id WHERE l.author = ? ORDER BY l.id DESC $limit",
	[$userpagedata['id']]);
$count = result("SELECT COUNT(*) FROM levels l WHERE l.author = ?", [$userpagedata['id']]);

$twig = twigloader();
echo $twig->render('user.twig', [
	'id' => $_GET['id'],
	'name' => $userpagedata['name'],
	'levels' => fetchArray($levels),
	'forceuser' => $forceuser,
	'page' => $page,
	'level_count' => $count
]);