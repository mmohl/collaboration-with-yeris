
		<?php foreach ($sources as $year => $months): ?>
		<h2><?php echo $year?></h2>
		<?php foreach ($months as $month => $kodes):?>
		<h3><?php echo $month ?></h3>
		<ul>
		<?php foreach ($kodes as $kode => $value):?>
		  <li> <?php echo $kode?> = <?php echo $value ?></li>
		<?php endforeach;?>
		</ul>
		<?php endforeach;?>
		<?php endforeach;?>
