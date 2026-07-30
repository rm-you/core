<?php
/*
 * Pre-cache item tooltips for known loot item names.
 *
 * Usage:
 *   php scripts/precache_item_tooltips.php --batch=50 --delay=3
 */

define('EQDKP_INC', true);
$eqdkp_root_path = dirname(__DIR__).'/';
$lite = true;
include_once($eqdkp_root_path.'common.php');

@set_time_limit(0);
@ignore_user_abort(true);

$batch_size = 30;
$delay_seconds = 3;
foreach($argv as $arg){
	if(preg_match('/^--batch=(\d+)$/', $arg, $matches)){
		$batch_size = intval($matches[1]);
	}
	if(preg_match('/^--delay=(\d+)$/', $arg, $matches)){
		$delay_seconds = intval($matches[1]);
	}
}

include_once($eqdkp_root_path.'infotooltip/infotooltip.class.php');
$itt = registry::register('infotooltip');
$stats = $itt->precache_batch($batch_size, $delay_seconds);

echo 'Item tooltip pre-cache complete.'."\n";
echo '  total items: '.$stats['total']."\n";
echo '  fetched: '.$stats['fetched']."\n";
echo '  skipped (cached): '.$stats['skipped']."\n";
echo '  failed: '.$stats['failed']."\n";
echo '  processed this run: '.$stats['processed']."\n";
echo '  next offset: '.$stats['next_offset']."\n";

?>
