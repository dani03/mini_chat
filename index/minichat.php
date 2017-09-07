<?php
session_start();



try {
      $bdd = new PDO("mysql:host=localhost;dbname=miniChat;charset=utf8", 'phpmyadmin','root');

} catch (Exception $e) {

  die('erreur au niveau '.$e->getMessage());
}

?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="../style/style.css">
      <title>le mini chat</title>
  </head>
  <body>
     <h1> le mini chat </h1>


     <form class="form" action="minichat_post.php" method="post">
       <div class="form-group form-actions">
         <label for="name"> nom :</label>
          <input type="text"  width="30%"name="name" value="" required=""><p><?php echo $nameError ; ?></p><br>
          <label for="message">message: </label>
          <textarea name="message" rows="5" cols="50" required=""></textarea>
          <p><?php echo $messageError ; ?>
          <input type="submit" class="btn btn-success" name="submit" value="envoyer">
       </div>
     </form>

     <table class="table table-striped table-bordered">
       <thead>
         <tr>
           <th>pseudo</th>
           <th>message</th>
         </tr>
       </thead>
       <tbody>
          <?php
          // on prend les donnée directement de la base de donnée
         $reponse = $bdd->query('SELECT name, message FROM users ORDER BY ID DESC LIMIT 0, 10');
         while ($donnees = $reponse->fetch()) {?>
           <tr>
             <td><?php echo htmlspecialchars($donnees['name'])?></td>
             <td><?php echo htmlspecialchars($donnees['message'])?></td>
           </tr>
        <?php
         }
        ?>
       </tbody>
     </table>
  </body>
</html>
