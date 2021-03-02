<<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

/**
 * Utilisez la base de données que vous avez utilisé dans l'exo 194.
 * Utilisez aussi le CSS que vous avez écris ( div contenant l'utilisateur ).
 * Pour chaque sélection, vous utiliserez un div par utilisateur:
 * ex:  <div class="classe-css-utilisateur">
 *          utilisateur 1, données ( nom, prenom, etc ... )
 *      </div>
 *      <div class="classe-css-utilisateur">
 *          utilisateur 2, données ( nom, prenom, etc ... )
 *      </div>
 *
 * -- Sélections complexes --
 * Une seule requête est permise pour chaque point de l'exo.
 */

// TODO Commencez par créer votre objet de connexion à la base de données, vous pouvez aussi utiliser l'objet statique ou autre qu'on a créé ensemble.
 $server = 'localhost';
 $user ='root';
 $password = 'dev';
 $db ='table_test_deux';

 try {
     $connect = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $password);
     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

     /* 1. Sélectionnez et affichez tous les utilisateurs dont le nom est 'Conor' */
     // TODO votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE nom ='Conor'");
     $result = $stmt->execute();
     echo "<div class='classe-css-utilisateur>" . $result . "</div>";

     /* 2. Sélectionnez et affichez tous les utilisateurs dont le prénom est différent de 'John' */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE prenom != 'John'");
     $result = $stmt->execute();
     if ($result) {
         foreach ($stmt->fetchAll() as $user) {
             echo "<div class='classe-css-utilisateur>" . "user: id-> " . $user['id'] . "nom->" . $user['nom'] . "prenom->" . $user['prenom'] . "</div>";
         }
     }

     /* 3. Sélectionnez et affichez tous les utilisateurs dont l'id est plus petit ou égal à 2 */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE id <= 2");
     $result = $stmt->execute();
     echo "<div class='classe-css-utilisateur>" . $result . "</div>";

     /* 4. Sélectionnez et affichez tous les utilisateurs dont l'id est plus grand ou égal à 2 */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE id >= 2");
     $result = $stmt->execute();
     echo "<div class='classe-css-utilisateur>" . $result . "</div>";

     /* 5. Sélectionnez et affichez tous les utilisateurs dont l'id est égal à 1 */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE id = 1");
     $result = $stmt->execute();
     echo "<div class='classe-css-utilisateur>" . $result . "</div>";

     /* 6. Sélectionnez et affichez tous les utilisateurs dont l'id est plus grand que 1 ET le nom est égal à 'Doe' */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE id > 1 AND nom='Doe'");
     $result = $stmt->execute();
     echo "<div class='classe-css-utilisateur>" . $result . "</div>";

     /* 7. Sélectionnez et affichez tous les utilisateurs dont le nom est 'Doe' ET le prénom est 'John'*/
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE nom='Doe' AND prenom='John'");
     $result = $stmt->execute();
     echo "<div class='classe-css-utilisateur>" . $result . "</div>";

     /* 8. Sélectionnez et affichez tous les utilisateurs dont le nom est 'Conor' OU le prénom est 'Jane' */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE  nom='Conor' OR prenom='Jane'");
     if ($result) {
         foreach ($stmt->fetchAll() as $user) {
             echo "<div class='classe-css-utilisateur>" . "user: id-> " . $user['id'] . "nom->" . $user['nom'] . "prenom->" . $user['prenom'] . "</div>";
         }
     }
     $result = $stmt->execute();

     /* 9. Sélectionnez et affichez tous les utilisateurs en limitant les réultats à 2 résultats */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user LIMIT 2");
     if ($result) {
         foreach ($stmt->fetchAll() as $user) {
             echo "<div class='classe-css-utilisateur>" . "user: id-> " . $user['id'] . "nom->" . $user['nom'] . "prenom->" . $user['prenom'] . "</div>";
         }
     }
     $result = $stmt->execute();

     /* 10. Sélectionnez et affichez tous les utilisateurs par ordre croissant, en limitant le résultat à 1 seul enregistrement */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user ORDER BY id DESC LIMIT 1");
     $result = $stmt->execute();
     echo "<div class='classe-css-utilisateur>" . $result . "</div>";

     /* 11. Sélectionnez et affichez tous les utilisateurs dont le nom commence par C, fini par r et contient 5 caractères ( voir LIKE )*/
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE nom LIKE 'C___r'");
     $result = $stmt->execute();
     echo "<div class='classe-css-utilisateur>" . $result . "</div>";

     /* 12. Sélectionnez et affichez tous les utilisateurs dont le nom contient au moins un 'e' */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE nom LIKE '%e%'");
     if ($result) {
         foreach ($stmt->fetchAll() as $user) {
             echo "<div class='classe-css-utilisateur>" . "user: id-> " . $user['id'] . "nom->" . $user['nom'] . "prenom->" . $user['prenom'] . "</div>";
         }
     }
     $result = $stmt->execute();

     /* 13. Sélectionnez et affichez tous les utilisateurs dont le prénom est ( IN ) (John, Sarah) ... voir IN , pas OR '' */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE prenom IN ('John', 'Sarah')");
     if ($result) {
         foreach ($stmt->fetchAll() as $user) {
             echo "<div class='classe-css-utilisateur>" . "user: id-> " . $user['id'] . "nom->" . $user['nom'] . "prenom->" . $user['prenom'] . "</div>";
         }
     }
     $result = $stmt->execute();

     /* 14. Sélectionnez et affichez tous les utilisateurs dont l'id est situé entre 2 et 4 */
     // TODO Votre code ici.
     $stmt = $connect->prepare("SELECT * FROM user WHERE id BETWEEN 2 AND 4");
     $result = $stmt->execute();
     echo "<div class='classe-css-utilisateur>" . $result . "</div>";
 }
 catch(PDOException $exception) {
     echo $exception->getMessage();
 }
 ?>
</body>
</html>




