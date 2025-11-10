<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentEvent $event
 * @var \App\Model\Entity\Competitor[] $competitors
 */

$this->assign('title', 'Lestvica – ' . $event->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Lestvica – <?= h($event->name) ?>
            </h1>
            <p class="bt-header-subtitle">
                Razvrstitev po številu zmag in porazov (pri izenačenih je upoštevan medsebojni rezultat).
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na dogodek', "/tournament-events/view/{$event->id}", [
                'class' => 'bt-button-secondary',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?php if (empty($competitors)): ?>
                <p class="text-gray-500">
                    Za ta dogodek še ni vnesenih tekmovalcev.
                </p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm bt-table">
                        <thead>
                            <tr>
                                <th class="text-left px-2 py-2 w-16">Mesto</th>
                                <th class="text-left px-2 py-2">Ekipa / par</th>
                                <th class="text-right px-2 py-2 w-24">Zmage</th>
                                <th class="text-right px-2 py-2 w-24">Porazi</th>
                                <th class="text-right px-2 py-2 w-24">Tekme</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($competitors as $index => $competitor): ?>
                                <?php
                                $place = $index + 1;
                                $wins = (int)$competitor->wins;
                                $losses = (int)$competitor->losses;
                                $games = $wins + $losses;
                                ?>
                                <tr class="border-t border-gray-200">
                                    <td class="px-2 py-2 text-left">
                                        <?= $place ?>.
                                    </td>
                                    <td class="px-2 py-2">
                                        <?= h($competitor->name) ?>
                                    </td>
                                    <td class="px-2 py-2 text-right">
                                        <?= $wins ?>
                                    </td>
                                    <td class="px-2 py-2 text-right">
                                        <?= $losses ?>
                                    </td>
                                    <td class="px-2 py-2 text-right">
                                        <?= $games ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>