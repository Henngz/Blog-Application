<!------------------

    homepage.php
    Name: Yuheng Zhu
    Date: 2022-07-28
    Description: The php file is used to create a homepage and show five posts.
	
-------------------->
<?php
	require('connect.php');
	$query = "SELECT * FROM blogs";
	$statement = $db -> prepare($query);
	$statement -> execute();
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="homepagestyle.css" />
	<title>My Blog - Home Page</title>
</head>
<body>
	<div class="header">
		<img class="logo" src="image/logo.png" alt="" />
		<h1 class="head"><a href="homepage.php">My Amazing Blog</a></h1>
		<a href="newpost.php" class="newblog">New Blog</a>
	</div>
	
	<h2>Recently Posted Blog Entries</h2>
	<?php if ($statement -> rowCount() == 0): ?> 
     <h1> No tweets found</h1>

     <?php else: ?>
     
          <?php for ($i=0; $i < 5; $i++): ?>
          	<?php $row = $statement -> fetch() ?>
          	<div class="title">
          		<h2 ><?= $row['title'] ?></h2>
          		<a href="update.php?id=<?= $row['id']?>" class="edit">edit</a>
          	</div>
          	<p><?= $row['Date'] ?></p>
            <?php if(strlen($row['content']) >200): ?>
            <p><?= mb_strimwidth($row['content'],0,200,"...") ?><a href="fullpost.php?id=<?= $row['id']?>">Read Full Post</a></p>
            <?php else:  ?>
            <p><?= $row['content'] ?></p>          
            <?php endif; ?>            
          <?php endfor; ?>      
     <?php endif; ?>
</body>
</html>























