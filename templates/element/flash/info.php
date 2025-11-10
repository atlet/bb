<?php

/**
 * Flash info message (npr. ob obvestilih, opozorilih ipd.)
 * @var string $message
 */
?>
<div class="flash-info bg-blue-50 border border-blue-200 text-blue-800 px-3 py-2 rounded mb-3 flex items-center gap-2 text-sm">
    <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <line x1="12" y1="16" x2="12" y2="12" />
        <line x1="12" y1="8" x2="12" y2="8" />
    </svg>
    <span><?= h($message) ?></span>
</div>