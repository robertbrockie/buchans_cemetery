<div class="container">
	<?php if (empty($sites)) { ?>
		<p>Nothing found for '<?= $query ?>'</p>
	<?php } else { ?>
		<table class="table">
			<thead>
				<tr>
					<th>Row</th>
					<th>Plot</th>
					<th>Name</th>
					<th>Note</th>
					<th>Headstone</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($sites as $site) { ?>
				<tr>
					<td><?= $site->getRow() ?></td>
					<td><?= $site->getPlot() ?></td>
					<td><?= $site->getName() ?></td>
					<td><?= $site->getNote() ?></td>
					<td><img src='<?= CemeterySiteHelper::getThumbnailURL($site) ?>'/></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	<?php } ?>
</div>