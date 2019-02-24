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
<div class="alert alert-primary" role="alert">
  Made with ❤ by <a href="https://facebook.com/lazuardyk" class="alert-link">Lazuardy Khatulistiwa</a>
</div>
</div>
<div class="container">
<form action="" method="post">
  <div class="form-group">
    <label for="query"><h5>Search:</h5></label>
    <input type="text" name="query" class="form-control" id="query" placeholder="Enter query">
  </div>
<button type="submit" class="btn btn-primary" name="submit">Submit!</button>
</div>
</form>
<br>
<?php 

if(isset($_POST["submit"])) {
	$query = $_POST['query'];
	$req = file_get_contents("https://www.samehadaku.tv//?s=".urlencode($query));
	preg_match_all('/<h3 class="post-title"><a href="(.*?)" title=/', $req, $links);
	preg_match_all('/<h3 class="post-title"><a href=".*?" title="(.*?)"/', $req, $judul);
	$arr = [];
	for($i = 0;$i < count($links[1]); $i++){
		$arr[$links[1][$i]] = $judul[1][$i];
	}
	?>
	<div class="container">
		<?php 
		foreach($arr as $key => $value){
			?>
			<div class="table-responsive">
  			<table class="table">
  				<tr>
  					<form action ="download.php" method="post" target="_blank">
  					<input type="hidden" name="link" value="<?php echo $key; ?>">
  					<input type="hidden" name="judul" value="<?php echo $value; ?>">
  					<td><?php echo $value; ?></td>
  					<td><select class="form-control" id="kualitas" name="kualitas" required><option value="">Kualitas/Resolusi</option><option value="360p">360p</option><option value="480p">480p</option><option value="720p">720p</option><option value="1080p">1080p</option></select></td>
  					<td><select class="form-control" id="format" name="format" required><option value="">Format Video</option><option value="MKV">MKV</option><option value="MP4">MP4</option><option value="x265">x265</option></select></td>
  					<td><select class="form-control" id="server" name="server" required><option value="">Server</option><option value="UF">Upfile</option><option value="CU">Clicknupload</option><option value="GD">Google Drive</option><option value="ZS">Zippyshare</option><option value="SC">Sendit</option><option value="MU">Megaup</option></td>
  					<td><button type="download" class="btn btn-success" name="download">Download</button></td>
  					</form>
  				</tr>
  			</table>
			</div>
		<?php
		}

}
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
