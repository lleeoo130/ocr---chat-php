
<?php
	include ('php/_debug.php');
    include ('php/_connexion.php');

    var_dump($_POST);

?>

<?php 

// Exemple de requête SQL basique, avec préparation
// http://php.net/manual/fr/pdo.prepared-statements.php
$stmt = $bdd->prepare("

INSERT INTO `message`   (`message_id`,
                             `message_auteur`, 
                                `message_contenu`, 
                                    `message_date`) 
VALUES                  (NULL, 
                            :messageAuteur,
                                 :messageContenu, 
                                    CURRENT_TIMESTAMP);

);");

// De cette manière, on est certain de ne pas ajouter de code malicieux dans le SQL
// :orderNumber sera remplacé par sa valeur 'assainie'
$stmt->bindParam(':messageAuteur', $messageAuteur);
$stmt->bindParam(':messageContenu', $messageContenu);


// Execution de la requête
$retourREQUETEORDERS = []; // tableau vide

try {
    // définition des variables à passer dans le SQL de manière saine
    $messageAuteur = $_POST['pseudo'];
    $messageContenu = $_POST['message'];

    // Execution du sql
    $stmt->execute();
}
catch (PDOException $e) {
    
    echo "Erreur lors de l'éxécution d'une requête SQL :";
    
    // Affichage plus classique PHP
    // var_dump($e);
    // echo "<table class=\"xdebug-error\">";
    // echo 	$e->xdebug_message;
    // echo "</table><br/>";

    // Affichage personnalisé
    // http://php.net/manual/fr/pdo.errorinfo.php
    
    $errorInfo = $stmt->errorInfo();
    // var_dump($errorInfo);
    
        // Affiche du message d'erreur uniquement
    echo "	<div class=\"sqlError\">
                <fieldset>
                    <legend>Erreur sql ¯\_(ツ)_/¯</legend>
                    <div class=\"content\">" . $errorInfo[2] . "</div>
                </fieldset>
            </div>
    ";

}

//Création d'un cookie "pseudo" pour pré-remplir le champs du chat.
setcookie('pseudo', $_POST['pseudo'] , time() + 365*24*3600, null, null, false, true);

//redirection sur l'index
header('refresh: 0,url=index.php');
?>
