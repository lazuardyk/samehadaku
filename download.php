<?php 
set_time_limit(0);
error_reporting(0);
function getstringbetween($teks, $sebelum, $sesudah){
	$teks = ' ' . $teks;
	$ini = strpos($teks, $sebelum);
	if ($ini ==0) return '';
	$ini += strlen($sebelum);
	$panjang = strpos($teks, $sesudah, $ini) - $ini;
	return substr($teks, $ini, $panjang);
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Samehadaku</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><h2><span class="badge badge-primary">SAMEHADAKU</span></h2></li>
  </ol>
</nav>
</div>
	<?php
	if(isset($_POST['download'])) {
		$link = $_POST['link'];
		$judul = $_POST['judul'];
		$kualitas = $_POST['kualitas'];
		$format = $_POST['format'];
		$server = $_POST['server'];
		?>
		<center><h3><?php echo $judul; ?></h3>
		<?php echo "Kualitas: $kualitas, Format: $format, Server: $server<br>"; ?>
		<?php
		$req = file_get_contents($link);
		$gambar = getstringbetween($req, "aligncenter\" src=\"", "\""); ?>
		<br><img src="<?php echo $gambar ?>"><br><br>
		<?php
		$satu = getstringbetween($req, "$format", "</ul>");
		$dua = getstringbetween($satu, "$kualitas", "</li>");
		try {
			preg_match("@<a[^>]*href\s*=(?<HRef>[^>]+)>$server@", $dua, $tiga);
			preg_match("@\"(.*?)\" target=\"_blank\"@", $tiga[1], $empat);
			$req2 = file_get_contents($empat[1]);
			preg_match('@<a href="(.*?)" rel="nofollow" target=@', $req2, $tetew);
			$req3 = file_get_contents($tetew[1]);
			preg_match('@<a href="(.*?)" rel="nofollow" target=@', $req3, $greget);
			$url = $greget[1];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$a = curl_exec($ch); // $a will contain all headers
			$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL
		} catch (Exception $e) {
			echo "<h3>Link download tidak ditemukan!</h3>";}
		?>
		<a href="<?php echo $url; ?>" class="btn btn-success">DOWNLOAD</a></center> <?php } ?>
</body>
</html>