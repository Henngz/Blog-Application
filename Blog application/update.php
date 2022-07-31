<!------------------

    update.php
    Name: Yuheng Zhu
    Date: 2022-07-28
    Description: The php file is used to create a website to update or delete post.
	
-------------------->
<?php
	require('connect.php');
	require('authenticate.php');

	


	if(isset($_REQUEST['deletebtn'])){
		 $id=filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		 $query = "DELETE FROM blogs where id = :id LIMIT 1"; 
		 $statement = $db->prepare($query);
	     $statement->bindValue(':id', $id, PDO::PARAM_INT);
	     $statement->execute();
	      	
        // Redirect after update.
         header("Location:homepage.php?");
         exit;
    
	 }

	 if ($_POST && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['id'])) {

        // Sanitize user input to escape HTML entities and filter out dangerous characters.
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id= filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        // Build the parameterized SQL query and bind to the above sanitized values.
        $query = "UPDATE blogs SET title = :title, content = :content WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);        
        $statement->bindValue(':content', $content);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        // Execute the INSERT.
        if($statement->execute()){
        	echo"success";
        }
        
        // Redirect after update.
         header("Location: update.php?id={$id}");
         exit;

    }else if (isset($_GET['id'])) {
    	if(!filter_var($_GET['id'],FILTER_VALIDATE_INT)){
         header("Location:homepage.php?");
         exit;
	    }

		// Sanitize the id. Like above but this time from INPUT_GET.
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM blogs WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $row = $statement->fetch();
	}else if(!filter_var($_POST['id'],FILTER_VALIDATE_INT) || !strlen($_POST['title'])<1 || !strlen($_POST['content'])<1){
		echo"You do not input correct datas.";
	}
	else {
        $id = false; // False if we are not UPDATING or SELECTING.
    }

	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="updatestyle.css" />
		<title>My Blog - Editing <?= $row['title'] ?></title>
	</head>	
	<body>
		<div class="header">
			<img class="logo" src="image/logo.png" alt="" />
			<h1 class="head"><a href="homepage.php">My Amazing Blog</a></h1>
		</div>
		<?php if ($id): ?>
		<form method="post" action="update.php">
			<input type="hidden" name="id" value="<?= $row['id'] ?>">
			<ol>				
				<li><label for="title">Title</label></li>
				<li><input id="title" name="title" value="<?= $row['title'] ?>"></li>
				<li><label for="content">Content</label></li>
				<li><input id="content" name="content" value="<?= $row['content'] ?>"></li>				
			</ol>	
			<input type="submit" id="updatebutton" value='Update'>
			<input type='submit' name='deletebtn' id="deletebutton" value='Delete'>
		</form>
		<?php endif ?>
	</body>
</html>	