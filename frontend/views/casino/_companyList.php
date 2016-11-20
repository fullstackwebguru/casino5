<?php

if (isset($fromLoad)) {
?>
<div class="casion-card-container">
<?php } else { ?>
<div class="casion-card-container lazy-wrapp">

<?php } ?>

<?php
foreach ($companies as $casino) {
echo $this->render('_casino_card', [
        'casino' => $casino
	]);
}

if ($more > 0)  { ?>
	<div class="col-md-12 load-more">
		<a class=" btn btn-danger more-btn " data-pos="<?= $startPos ?>">SHOW MORE</a>
	</div>
<?php } ?>

</div>