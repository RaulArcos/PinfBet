<?php
include_once 'includesranking/config/functions.php';
$qRes = "SELECT * FROM users WHERE pinfcoins >= 0 ORDER BY pinfcoins DESC LIMIT 0, 100";
$qQuery = $mysqli->query($qRes);    
$i = 0;
$cont = 0;
echo '<ul class="list-group list-group-flush">';
if ($qQuery->num_rows > 0){
while($qRow = $qQuery->fetch_assoc() AND $cont < 10){ //Sirve para mostrar un top 10 en Ranking
//$qReplace = $qRow['pinfcoins']; //shows the pinfcoins as follows: 234252324
$qReplace = number_format($qRow['pinfcoins'], 0, '.', '.'); //shows the pinfcoins as follows: 234.252.324
$i++;
?>
<li>
	<a title = "Acceder a perfil"  style="text-decoration:none;" class="perfil" href = "<?php echo "main.php" . "?id=" . $qRow['id']; ?>"><mark><?php echo $qRow['name'];echo ", '";echo $qRow['username'];echo "'"; $cont++; ?></mark>
    <small class="badge badge-primary badge-pill">
		<span><?php echo levelRank($qRow['pinfcoins']); ?></span>
		&mdash;
		<?php echo $qReplace; ?> PinfCoins
	</small></a>
</li>
<?php 
}
	echo '</ul>';
}else{
	echo '<ul class="list-group"><li class="list-group-item text-center"><span>Ningún <b>usuario</b> ha sido clasificado.</span></li></ul>';
}
?>