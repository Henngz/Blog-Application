<!------------------

    fullpost.php
    Name: Yuheng Zhu
    Date: 2022-07-28
    Description: The php file is used to create a website to show the full content of post.
	
-------------------->
<?php
	require('connect.php');

	$query = "SELECT * FROM blogs WHERE id = :id LIMIT 1";
	$statement = $db->prepare($query);

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	$statement->bindValue('id', $id, PDO::PARAM_INT);
    $statement->execute();

    $row = $statement->fetch();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="homepagestyle.css" />
	<title>My Blog - <?= $row['title'] ?></title>
</head>
<body>
	<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head"><a href="homepage.php">My Amazing Blog</a></h1>
	</div>

	<div class="title">
		<h2><?= $row['title'] ?></h2>
		<a href="update.php" class="edit">edit</a>
	</div>
	<p><?= $row['Date'] ?></p>
	<p><?= $row['content'] ?></p>
</body>
</html>