<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>I say Yes to...</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
  <link href='https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,400italic,300italic,300|Raleway:300,400,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="animate.css">
  <link rel="stylesheet" href="style.css">

</head>

<body>
<div class="logo text-center">
<h2 class="subs-title text-center">  
<?php
  /*if (!isset($_GET['password']) || $_GET['password'] != "GEHEIM"){
	die("Passwort incorrect");
  }*/
  include('../config.php'); 

  $update_result = 0;

  $db_query = "SELECT * FROM `phrases` WHERE `ID` = " . $_GET['edit-id'] ;
  $result = $link->query($db_query);
  $row = mysqli_fetch_row($result);
  $text = $row[1];

   if (isset($_GET['btn-save'])){
    $db_query = "UPDATE `phrases` SET `phrase` = '" . $_GET['phrase'] . "' WHERE `ID` = " . $_GET['edit-id'] ;
    $update_result = $link->query($db_query); 	
  }

  ?> 
  <?php if ($update_result == 1){ ?>
          <div class="logo text-center" role="alert">
            Update erfolgreich!
            <a href="indexadmin.php">Zurück</a>
          </div>
  <?php } ?>

 </div>

  <div class="content">
    <div class="container wow fadeInUp delay-03s">
      <div class="row">
        <div class="logo text-center">
          <h2>Ändere doch einfach hier ... </h2>
        </div>
        <br>
        <br>
        <div class="subcription-info text-center">
          <form class="subscribe_form" action="#" method="get">
            <input type="hidden" name="edit-id" value="<?php echo $_GET['edit-id']?>" >
            <input type="text" name="phrase" value="<?php echo $text ?>"></input>
            <br>
            <br>
          <button type="submit" class="btn btn-default" name="btn-save" value="1">
            Update!
            </button>  
          </form>
        </div>
      </div>
    </div>
  </div>



 <div class="contentphp">
  <table class="table">
        <th>Nr.</th>
        <th>Sätzchen</th>
        <th>Empfänger</th>

        <?php
        
        $stmt = "SELECT * FROM `phrases`";
        $result = $link->query($stmt); 

        if (isset($_GET['delete-id'])){
        $stmt_delete = "DELETE FROM `phrases` WHERE `ID` = " . $_GET['delete-id'] ;
        $delete_result = $link->query($stmt_delete); 
        }
        $result = $link->query('SELECT * FROM phrases');

        if ($result->num_rows > 0){
            while ($row = mysqli_fetch_row($result)){
            echo "<tr>\n";
            echo "<td>" . $row[0] . "</td>\n";
            echo "<td>" . $row[1] . "</td>\n";
            echo "<td>" . $row[2] . "</td>\n";
            echo "<td> <a href='?delete-id= " . $row[0] . " ' > löschen </a> </td>\n";
            echo "<td> <a href='phrase_edit.php?edit-id=" . $row[0] . "'> bearbeiten </a></td>\n";
            echo "</tr>";
            }
        }
        else {
            echo "<tr><td colspan='2'>No data found</td></tr>";
        }

        ?>
    </table>
  </div>

</body>

</html>
