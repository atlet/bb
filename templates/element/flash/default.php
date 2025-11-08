<?php

/**
 * @var string $message
 * @var array $params
 */

$type = $params['type'] ?? 'info';

$baseClass = 'mb-3 px-3 py-2 rounded border flex items-start gap-2 text-sm';
$map = [
    'info' => 'bg-sky-50 border-sky-200 text-sky-800',
    'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
];

$icon = [
    'info' => 'ℹ️',
    'warning' => '⚠️',
];

$key = $map[$type] ?? $map['info'];
$ico = $icon[$type] ?? $icon['info'];
?>
<div class="<?= $baseClass . ' ' . $key ?>" role="alert">
    <div class="flash-icon"><?= $ico ?></div>
    <div class="flash-message-text">
        <?= h($message) ?>
    </div>
</div>