<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $msj = $_POST['muro'];

        $insertar_sql = "INSERT INTO muros (usuario_env, usuario_rec, mensaje) VALUES ('$user_actual', '$id_user', '$msj')";
        $insertar_consulta = mysqli_query($link, $insertar_sql);
    }
?>

<div class="CajaPerfil" style="max-height:700px;">
    <div class="w3-container w3-padding">
        <h2><b>Muro</b></h2>
        <?php
        if ($amigos || $id_user == $_SESSION['id'])
        {
        ?>
        <form action = "<?php echo "main.php?id=" . $id_user;?>" method = "post" style = "text-align:center">
            <label for = "muro">Escribir en el muro:</label>
            <textarea type="bio" id="bio" name="muro" class="form-control" placeholder="Escribe en el muro..." maxlength="300" required="" style="margin-top: 0px; margin-bottom: 10px; height: 58px;"></textarea>
            <input type = "submit" value = "Enviar">
        </form>
        <hr>
        <?php
        }
            $mensajes_sql = "SELECT usuario_env, mensaje, fecha FROM muros WHERE usuario_rec = '$id_user' ORDER BY fecha DESC";
            $mensajes_consulta = mysqli_query($link, $mensajes_sql);

        if (mysqli_num_rows($mensajes_consulta) == 0)
        {
        ?>
        <div style = "text-align:center"> 
            <h2>No hay mensajes en el muro </h2>
        </div>
        <?php
        }
		else if ($privacidad_user && !($amigos) && $id_user != $_SESSION['id'])
		{
			?><h2 style="color:tomato">Este Perfil es privado. Solo sus amigos pueden ver su muro</h2><?php
		}
		else
		{
        ?>
        <div style="overflow:auto; max-height:420px;">
            <table class="tabla table-bordered" style="border-spacing: 5px;">
                <?php
                while ($publicacion = mysqli_fetch_array($mensajes_consulta))
                {
                    $id_env = $publicacion['usuario_env'];
                    $nombre_env = mysqli_fetch_array(mysqli_query($link, "SELECT username FROM users WHERE id = '$id_env'"))['username'];
                ?>
                    <tr>
                        <td>
                            <h5><?php echo $publicacion['mensaje']; ?></h5>
                            <div style = "font-size:11px; color:tomato;">
                                <?php echo "Escrito por "?><a title = "Acceder a perfil" class="perfil" style="color:tomato" href = "<?php echo "main.php?id=" . $id_env; ?>"><?php echo $nombre_env; ?></a><?php echo " el " . $publicacion['fecha']; ?>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<script>
    // Para evitar el reenvío de formularios al actualizar o moverse por las páginas
    if (window.history.replaceState)
    {
        window.history.replaceState(null, null, window.location.href);
    }
</script>