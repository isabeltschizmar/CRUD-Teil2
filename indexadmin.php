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

  <div class="content">
    <div class="container wow fadeInUp delay-03s">
      <div class="row">
        <div class="logo text-center">
          <h2>Und was machst du so?</h2>
        </div>
        <br>
        <br>
        <div class="subcription-info text-center">
          <form class="subscribe_form" action="#" method="get">
            <input required="" value="" placeholder = "   Name" id="name" name="name">
            
            <br>
            <br>
            <h4 class="subs-title text-center">Wählt aus und staunt ... !</h4> 
            <select name="phrase_01">
                <option selected>...</option>
                <option value="findet">findet</option>
                <option value="verspeist">verspeist</option>
                <option value="begeistert">begeistert</option>
                <option value="entdeckt">entdeckt</option>
                <option value="liebt">liebt</option>
            </select>
        
            <select name="phrase_02">
            <option selected>...</option>
            <option value="flutschige Ferkel">flutschige Ferkel</option>
            <option value="flauschige Faultiere">flauschige Faultiere</option>
            <option value="feminine Flamingos">feminine Flamingos</option>
            <option value="fette Flusskrokodile">fette Flusskrokodile</option>
            <option value="frustrierte Feldhasen">frustrierte Feldhasen</option>
            </select>
            <br>
            <br>
          <h4 class="subs-title text-center">Schickt das tolle Erlebnis euren Freunden!</h4>
          <input required="" value="" placeholder = "   E-Mail" id="email" name="email">
          <br>
          <br>
          <button type="submit" class="btn btn-default" name="btn-save" value="1">
            und LOS!
            </button>  
        </form>
        </div>
      </div>
    </div>
  </div>

<div class="logo text-center">
<h2 class="subs-title text-center">  
<?php
  /*if (!isset($_GET['password']) || $_GET['password'] != "GEHEIM"){
	die("Passwort incorrect");
  }*/
  include('../config.php'); 

  if(isset($_GET['btn-save'])&& isset ($_GET['email']))
     
  
  {
    $text = $_GET['name'] . " " . $_GET['phrase_01'] . " " . $_GET['phrase_02'] . "!";
    $email = $_GET ['email'];

    $sql = "INSERT INTO phrases (phrase, recipient) VALUES ('".$text."', '".$email."')" ;
    $result = $link->query($sql);  

    if (isset($_GET['email'])){
      $to      = urldecode($_GET['email']);
      $subject = 'I say YES to...';
      $message = $text;
      $headers = 'From: it020@hdm-stuttgart.de' . "\r\n" .
          'Reply-To: it020@hdm-stuttgart.de' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

      $mailSuccess = mail($to, $subject, $message, $headers); 
    }
  
  header('Location: '. $_SERVER['PHP_SELF']);
  die();
    
}
  ?> 
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
