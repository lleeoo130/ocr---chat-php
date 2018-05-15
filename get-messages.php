<?php

    include ('php/_connexion.php');
    include ('php/_debug.php');

    // Exemple de requête SQL basique, avec préparation
	// http://php.net/manual/fr/pdo.prepared-statements.php
	$getMessages = $bdd->prepare("
	
    SELECT message_auteur, message_contenu, DATE_FORMAT(message_date,'Le %d/%m/%Y à  %h:%i:%s') AS message_date
    FROM message
    ORDER BY `message`.`message_id` DESC"

    );


    // Execution de la requête
    $retourREQUETEORDERS = []; // tableau vide

    try {
        // Execution du sql
        $getMessages->execute();
        
        // Récupération des données
        while ($ligneSQL = $getMessages->fetch()) {
            // Chaque ligne SQL renvoyée par la base de donnée est stockée dans une nouvelle case de mon tableau de retour.
            $retourREQUETEORDERS[] = $ligneSQL;
        }
    }
    catch (PDOException $e) {
        
        echo "Erreur lors de l'éxécution d'une requête SQL :";
    
        $errorInfo = $getMessages->errorInfo();
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

?>
