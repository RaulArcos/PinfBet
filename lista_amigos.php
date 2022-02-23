<div class="CajaPerfil" style="max-height:256px">
	<div class="w3-container w3-padding" style = "text-align:center">
		<h2><b>Amigos</b></h2>
	<?php
		$lista_sql = "SELECT id, username, profile_image FROM users, amistades WHERE usuario1 = '$id_user' AND usuario2 = id AND amigos = 1 ORDER BY username ASC";
		$lista_amigos = mysqli_query($link, $lista_sql);

		if (mysqli_num_rows($lista_amigos) == 0)    // Si no se encuentran amigos
		{
			?><h2>¡Aún no hay amigos!</h2><?php
		}
		else if ($privacidad_user && !($amigos) && $id_user != $_SESSION['id'])
		{
			?><h2 style="color:tomato">Este Perfil es Privado</h2><?php
		}
		else
		{
	?>
		<div style="overflow:auto; max-height:211px;">
			<table class="tabla table-bordered" style = "margin-left:auto; margin-right:auto;">
			<?php
				while ($datos_amigo = mysqli_fetch_array($lista_amigos))    // Para cada amigo encontrado
				{
			?>
					<tr>
						<td style = "padding:5px;"> <a title = "Acceder a perfil" class="perfil" href = "<?php echo "main.php" . "?id=" . $datos_amigo['id']; ?>"><img src = "<?php echo 'imagenesperfil/' . $datos_amigo['profile_image'] ?>" width = "35" height = "35" alt = "Avatar de <?php echo $datos_amigo['username'] ?>"></a> </td>
						<td style = "padding:5px;"> <a title = "Acceder a perfil" clasS="perfil" href = "<?php echo "main.php" . "?id=" . $datos_amigo['id']; ?>"><?php echo $datos_amigo['username']; ?></a> </td>
			<?php
						if ($id_user == $_SESSION['id']) // Si el usuario está viendo su perfil
						{
			?>
						<td style = "padding:5px;"> <a title = "Chat" href = "<?php echo "chat.php?id=" . $datos_amigo['id']; ?>"><i class="far fa-comments fa-2x" style = "color: #ffffff;"></i></a> </td>
			<?php
						}
			?>
					</tr>
			<?php
				}
			?>
			</table>
		</div>
		<?php
			}
		?>
	</div>
</div>
