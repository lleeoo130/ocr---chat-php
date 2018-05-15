<?php
	include ('php/_debug.php');
	include ('templates/_header.php');
	include ('php/_connexion.php');
	include ('get-messages.php');

?>

	<main>

		<div class="jumbotron">
			<h1 class="display-5 mt-0">PHP Messenger</h1>
			<div class="float-right ">
				<a href="index.php"><i class="fas fa-sync fa-2x refresh"></i></a>
			</div>
			<div class="clear"></div>
			<hr class="my-4">
			<div class="display-messages">
				<?php

					foreach ($retourREQUETEORDERS as $key => $value) {
						echo 	"<div class='message'>
									<p>
										<span class='date'>-"
											.htmlspecialchars($value['message_date']).
										"-</span>
										<span class='pseudo'>"
											.htmlspecialchars($value['message_auteur']).
										" :</span>
										<span class='message-contenu'>\""
											.htmlspecialchars($value['message_contenu']).
										"\"</span>
									</p>
								</div>";
					}

				?>
			</div>

			<hr class="my-4">
			<form action="add-comment.php" method="post">
				<div class="form-group">
					<label for="pseudo">Ton Pseudo:</label>
					<input type="text" name="pseudo" 

						<?php
							//Si le cookie pseudo existe, utiliser cette valeur pour pré-remplir le champs.
							if(isset($_COOKIE['pseudo'])){
								echo ' value="'
											.$_COOKIE['pseudo']. '"';
							}

						?>
					>
					<label for="message">Ton Message:</label>
					<input type="text" name="message" required>
					<button type="submit" class="btn btn-secondary btn-sm">Envoyer</button>
				</div>
				

			</form>

		</div>

	</main>


<?php include ('templates/_footer.php'); ?>