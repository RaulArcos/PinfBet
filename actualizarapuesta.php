<?php
include_once 'config.php';


$user_actual = $_SESSION['id'];
$id_apuesta = $cantidad = $resultado = $cod_apuesta = "";
$cantidad_err = "";
$param_resultadofinal = $param_cantidadresultado= 0;
$pinfcoins_actualizado =0;

$qRes = "SELECT * FROM apuestas WHERE id_user = $id_user";
$qQuery = mysqli_query($link,$qRes);   

$qRes2 = "SELECT * FROM resultados";
$qQuery2 = mysqli_query($link,$qRes2);   

//Vamos a actualizar toda la informacion de la apuesta incluida la ganancia/perdida de pinfcoins


$i=0;
$j=0;
while($resultados = mysqli_fetch_array($qQuery2))
{
	$resultadoss[]=$resultados;
	$i++;
}
while($mostrar = mysqli_fetch_array($qQuery))
{
	$mostrars[]=$mostrar;
	$j++;
}

for($cont1 = 0; $cont1 < $i; $cont1++)
{                                                                                   
	$resultados = $resultadoss[$cont1];
	for($cont2 = 0; $cont2 < $j ; $cont2++)
	{	
		$mostrar = $mostrars[$cont2];	
		//echo $mostrar['resultado_final'];
		if($resultados['id_user'] == $mostrar['id_apostado'] && $resultados['id_apuesta'] == $mostrar['id_apuesta'] && $mostrar['resultado_final'] == 0) //Coincide el resultado guardado con alguna apuesta realizada
		{	
			$id_apuesta_actual = $resultados['id_apuesta'];
			$qRes3 = "SELECT * FROM apuestasdisponibles WHERE id_apuesta = $id_apuesta_actual";
			$qQuery3 = mysqli_query($link,$qRes3);
			$apuestasdisponibles = mysqli_fetch_array($qQuery3);

			if($resultados['resultado'] ==  1)  //Si el usuario ha aprobado y...
			{
				if($mostrar['resultado_user'] == 1) //El otro usuario aposto a que aprobara
				{
					$param_resultadofinal = 1;
					$param_cantidadresultado = $mostrar['cantidad_apostada'] * $apuestasdisponibles['cuota_aprobado'];
				}
				if($mostrar['resultado_user'] == -1) //EL otro usuario aposto al suspenso
				{ //POndria else pero mientras sea pendiente puede ser 0
					$param_resultadofinal = -1;
					$param_cantidadresultado = -$mostrar['cantidad_apostada'];
				}
			}else{ //En este caso se puede porque si el usuario no tiene la nota no aparece en la base de datos, si el usuario ha suspendido y...
				if($mostrar['resultado_user'] == 1) //aposto a que aprobaba
				{
					$param_resultadofinal = -1;
					$param_cantidadresultado = -$mostrar['cantidad_apostada'];
				}
				if($mostrar['resultado_user'] == -1) //POndria else pero mientras sea pendiente puede ser 0 //Aposto a que suspendia
				{
					$param_resultadofinal = 1;
					$param_cantidadresultado =  $mostrar['cantidad_apostada'] * $apuestasdisponibles['cuota_suspenso'];

				}
					
			}

				$pinfcoins_actualizado = $pinfcoins_actualizado + $param_cantidadresultado;
				$resultado_user = $resultados['id_user'];
				$sql = "UPDATE apuestas SET resultado_final = ?, cantidad_resultado = ? WHERE id_apuesta = $id_apuesta_actual AND id_user = $user_actual AND id_apostado = $resultado_user";
				$stmt = mysqli_prepare($link, $sql);
				mysqli_stmt_bind_param($stmt, "ii",$param_resultadofinal ,$param_cantidadresultado);
				mysqli_stmt_execute($stmt);
			
		}
			
	}
	
}	

if($param_cantidadresultado>0){
$pinfcoins_actualizado = $_SESSION['pinfcoins'] + $pinfcoins_actualizado;
$sql2 = "UPDATE users SET pinfcoins = $pinfcoins_actualizado WHERE id = $user_actual";
mysqli_query($link,$sql2);
}
	

?>
<hr>

<?php
	if (mysqli_num_rows($qQuery) == 0)	// Comprobar que se han hecho apuestas
	{
		
?>		<div style = "text-align:center"> <h2>No hay apuestas que mostrar </h2></div>
<?php
	}
	else if ($privacidad_user && !($amigos) && $id_user != $_SESSION['id'])
	{
		?><h2 style="color:tomato">Este Perfil es privado. Solo sus amigos pueden ver las apuestas.</h2><?php
	}
	else
	{
?>
	<div style="overflow:auto; max-height:532px;">
		<table class="tabla table-bordered">
				<tr>
					<td>Asignatura</td>
					<td>Apostado a</td>
					<td>Predicción</td>
					<td>Cantidad</td>
					<td>Fecha</td>
					<td>Resultado</td>
					<td>Ganancia/Pérdida</td>
					<?php
						if ($id_user == $_SESSION['id'])
						{
					?>
							<td>Compartir</td>
					<?php
						}
					?>
				</tr>

				<?php 
				$qQuery = mysqli_query($link,$qRes);    
				while($mostrar=mysqli_fetch_array($qQuery))
				{
					//Sacamos el nombre de la asignatura a partir de su id.
					$id_apuesta = $mostrar['id_apuesta'];
					$nombre_apuesta_sql = "SELECT nombre_resumido FROM apuestasdisponibles WHERE id_apuesta = $id_apuesta"; 
					$nombre_apuesta_result = mysqli_query($link, $nombre_apuesta_sql);
					$nombre_apuesta = $nombre_apuesta_result->fetch_array()['nombre_resumido'];

					//Sacamos el nombre de la persona a la que apuesta a partir de su id.
					$id_apostado = $mostrar['id_apostado'];
					$user_apostado_sql = "SELECT `name`, username FROM users WHERE id = $id_apostado"; 
					$user_apostado_result = mysqli_fetch_array(mysqli_query($link, $user_apostado_sql));

					$user_apostado = $user_apostado_result['username'];
					
					if($mostrar['id_apostado'] == $_SESSION['id'])	// Si el objetivo de la apuesta es el cliente
					{
						$nombre_apostado = "yo";
					} 
					else	// Si no
					{
						$nombre_apostado = $user_apostado_result['name'];
					}

					//En funcion de la informacion sacada anteriormente mostramos la informacion en la pantalla principal de usuario
					if($mostrar['resultado_user'] == 1)
					{
						$resultado_user = "Aprueba";
					} 
					else $resultado_user = "Suspende";

					if($mostrar['resultado_final'] == 0)
					{
						$resultado = "Pendiente";
					}
					else if($mostrar['resultado_final'] == 1)
					{
						$resultado = "Ganada";
					}
					else $resultado = "Perdida";

					if($mostrar['cantidad_resultado'] == 0)
					{
						$cantidad_resultado = "Pendiente";
					}
					else $cantidad_resultado = $mostrar['cantidad_resultado'];
					
				?>

				<tr>
					<td><?php echo $nombre_apuesta ?></td>
					<td><a title = "Acceder a perfil" class="perfil" href = "<?php echo "main.php" . "?id=" . $mostrar['id_apostado']; ?>"><?php echo $user_apostado; ?></a></td>
					<td><?php echo $resultado_user; ?></td>
					<td><?php echo $mostrar['cantidad_apostada'] . " PinfCoins"; ?></td>
					<td><?php echo $mostrar['fecha_apuesta']; ?></td>
					<td><?php echo $resultado; ?></td>
					<td><?php echo $cantidad_resultado; ?></td>
					<?php
						if ($id_user == $_SESSION['id'])
						{
					?>
							<td>
								<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-text="<?php
									echo "Acabo de apostar a que $user_apostado ($nombre_apostado) " . strtoupper($resultado_user) . " $nombre_apuesta en #5&Bet"; 
									?>" data-lang="es" data-dnt="true" data-show-count="false">Tweet</a>
								<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
							</td>
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