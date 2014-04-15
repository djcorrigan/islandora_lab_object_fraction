<?php
/**
 * @file
 * This is the template file for the fraction object page.
 *
 * Here we build an html page using the variables passed in by
 * the islandora_bioinformatics_fraction_preprocess_islandora_fraction
 * function.  Elements such as labels and buttons can be added here
 */

$path = drupal_get_path('module', 'islandora_bioinformatics_fraction');
?>

<div class="fraction-info">
	<table>
		<tbody>
			<tr><td class="fraction-info-label">Fraction ID</td><td><?php echo $variables['id'];?></td></tr>
			<tr><td class="fraction-info-label">Lab ID</td><td><?php echo $variables['lab_id'];?></td></tr>
			<tr><td class="fraction-info-label">Plate</td><td><?php echo $variables['plate'];?></td></tr>
			<tr><td class="fraction-info-label">Weight</td><td><?php echo $variables['weight'];?></td></tr>
			<tr><td class="fraction-info-label">Location</td><td><?php echo $variables['location'];?></td></tr>
			<tr><td class="fraction-info-label">Notes</td><td><?php echo $variables['notes'];?></td></tr>
		</tbody>
	</table>

</div>

<div class="fraction-inhibitors">
	<div class="m-btn-group">
	<a href="/islandora/object/islandora:422/manage/overview/ingest" class="m-btn green">Add a New Fraction</a>
	</div>

	<div class="m-btn-group">
	<a href="<?php echo $variables['edit_url']; ?>" class="m-btn blue">Edit This Fraction</a>
	</div>

	<table>
		<thead>
			<tr>
				<th class="fraction-info-label">Inhibitor</th><th class="fraction-info-label">Result</th><th class="fraction-info-label">Comment</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$row_count = 1;
				foreach ($variables['assays'] as $assay):
					$row_class = ($row_count++ % 2 == 0 ? 'even' : 'odd'); ?>
					<tr class="<?php echo $row_class;?>">
						<td><?php echo $assay['name'];?></td><td><?php echo $assay['result'];?></td><td><?php echo $assay['comment'];?></td>
					</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>