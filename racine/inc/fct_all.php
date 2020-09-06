<?php
// Modification de la date sous le format jj/mm/aaaa
function format_date_fr($v_date) {
	$v_date = explode('-', $v_date);
	$y = current($v_date);
	$m = $v_date[1];
	$d = end($v_date);

	$v_date = $d . '/' . $m . '/' . $y;

	return $v_date;
}
?>