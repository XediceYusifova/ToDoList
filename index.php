<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>Todo List App</title>
</head>
<body>

    <?php
        require "db.php";

        if(isset($_POST["add"])){
            if(strlen(trim($_POST['task'])) == 0){
                echo "<script> alert('Tapşırıq boş ola bilməz!'); </script>";
            }
            else{
                $query = $db->prepare("SELECT COUNT(*) AS num FROM todo_app WHERE task = :task");
                $query->bindValue(':task', $_POST['task']);
                $query->execute();
                $row = $query->fetch(PDO::FETCH_ASSOC);
                if($row['num'] > 0){
                    echo "<script> alert('Tapşırıq əvvəlcədən əlavə edilib!'); </script>";
                } else{
                    $query = $db->prepare ("INSERT INTO todo_app SET task=:task");
                    $insert = $query->execute([
                        'task' => $_POST['task']
                    ]);
                    if ($insert) {
                        echo "<script> alert('Tapşırıq əlavə edildi!'); </script>";
                    } else {
                        echo "<script> alert('Bir xəta baş verdi!'); </script>";
                    }
                }
            }
        }

    ?>
    <div class="mainSection">
		<h2 class="title">Todo List App</h2>
		<form action="" method="POST"  autocomplete="off">
            <div class="inputFields">
		    	<input type="text" name="task" id="taskValue" placeholder="Tapşırığı əlavə edin.">
		    	<button type="submit" name="add" id="addBtn" class="btn"><i class="fa fa-plus"></i></button>
		    </div>
        </form>
		<div class="content">
			<ul id="tasks">
                <?php
                    $query = $db->prepare("SELECT * FROM todo_app");
                    $query->execute();
                    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rows as $row){ ?>
                        <li>
                            <span class="text"><?= $row['task']; ?></span>
                            <a href="delete.php?id=<?= $row['id'] ?>"><i id="removeBtn" class="icon fa fa-trash" data-id="<?php echo $row['id']; ?>"></i></a>
                        </li>
                <?php } ?>
			</ul>
		</div>
    </div>
    <script>
        function Delete(){

        }
    </script>
</body>
</html>




