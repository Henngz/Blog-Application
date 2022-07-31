<!------------------

    newpost.php
    Name: Yuheng Zhu
    Date: 2022-07-28
    Description: The php file is used to create a new post page for user to uplaod new post.
	
-------------------->
<?php
	require('connect.php');
	require('authenticate.php');

	if(!empty($_POST['title']) && !empty($_POST['content'])){	

		 if(empty($_POST['title']) && empty($_POST['content'])){
			echo "<h1>"."Please input contents."."</h1>";
			}
		//  Sanitize user input to escape HTML entities and filter out dangerous characters.
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		//Build the parameterized SQL query and bind with values
		$query = "INSERT INTO blogs (title, content) VALUE (:title, :content)";
		$statement = $db -> prepare($query);

		//Bind values
		$statement->bindValue(':title', $title);
		$statement->bindValue(':content', $content);

		//Execute the insert
		$statement->execute();        
	}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="newpoststyle.css" />
	<title>My Blog - Post a New Blog</title>
</head>
<body>
	<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head"><a href="homepage.php">My Amazing Blog</a></h1>
	</div>

	<form method="post" action="newpost.php">
		<ol>
			<li><label for="title">Title</label></li>
			<li><input id="title" name="title"></li>
			<li><label for="content">Content</label></li>
			<li><input id="content" name="content"></li>
			<li id="submit"><input type="submit" id="submitbutton"></li>
			
		</ol>
	</form>
</body>
</html>