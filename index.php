<?php

	include('CemeterySite.php');
	include('CemeterySiteDAO.php');
	include('CemeterySiteHelper.php');


	$query = '';

	if (!empty($_POST)) {
		$query = $_POST['query'];

		$sites = CemeterySiteDAO::search($query);
		// get the search results
	}
?>
<!doctype html>
	<head>
		<meta charset="utf-8" />
		<title>Buchans Community Cemetery</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>

	<body>

		<div class="container">
			<h1>Buchans Community Cemetery</h1>

			<form action="index.php" method="post">
				<p><input class="form-control" type="text" name="query" value="<?= $query ?>" /></p>
				<p><input class="btn btn-primary btn-lg" type="submit" value="Search"/></p>
			</form>
		</div>

		<?php if (!empty($_POST)) { ?>
			
			<div class="container">
				<?php if (empty($sites)) { ?>
					<p>Nothing found.</p>
				<?php } else { ?>
					<table border="1">
						<thead>
							<tr>
								<td>Row</td>
								<td>Plot</td>
								<td>Name</td>
								<td>Note</td>
								<td>Headstone</td>
							</tr>
						</thead>

						<?php foreach ($sites as $site) { ?>
							<tr>
								<td><?= $site->getRow() ?></td>
								<td><?= $site->getPlot() ?></td>
								<td><?= $site->getName() ?></td>
								<td><?= $site->getNote() ?></td>
								<td><img src='<?= CemeterySiteHelper::getThumbnailURL($site) ?>'/></td>
							</tr>
						<?php } ?>
					</table>
				<?php } ?>
			</div>
		<?php } ?>

	</body>
</html>