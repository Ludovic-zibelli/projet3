<?php $title='Modifier le commentaire' ?>

<?php ob_start(); ?>
	<body>
		
		<h2>Modifier un commentiare</h2>
		<p><a href="index.php?action=post&id=<?php echo $comment['post_id']; ?>">Retour a la liste des billets</a></p>

			<div class="date_comment"><p>Commentaire publier le : <?= htmlspecialchars($comment['comment_date_fr']) ?> </p></div>
			<form action="index.php?action=updateComment&id=<?php echo $comment['id']; ?>&postid=<?php echo $comment['post_id'] ?>" method="POST">

			<div class="editComment">
				<table>
					<tr>
						<td>Auteur : </td>
						<td><strong><?= htmlspecialchars($comment['author']) ?></strong></td>
					</tr>
					<tr>
						<td><label for="comment">Commentaire : </label></td>
						<td><textarea for="comment" name="comment" rows="10" cols="20"><?= htmlspecialchars($comment['comment']) ?></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="modifier" value="Modifier"></td>
				</table>
			</form>
			</div>

        <?php $content = ob_get_clean(); ?>
        <?php require('view/frontend/template.php'); ?>
	</body>
</html>