<?= isset($vote_prefix) ? $vote_prefix : 'A majority of MPs' ?> <?= preg_replace('/(voted\s+(?:for|against|not to|to|in favour))/', '<b>\1</b>', $division['text']) ?>
