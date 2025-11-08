<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Court $court
 */
$this->assign('title', 'Igrišče – ' . $court->name);
$tournament = $court->tournament ?? null;
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Igrišče: <?= h($court->name) ?>
            </h1>
            <p class="bt-header-subtitle">
                Turnir:
                <?php if ($tournament): ?>
                    <?= h($tournament->name) ?>
                <?php else: ?>
                    <span class="text-slate-400">–</span>
                <?php endif; ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na seznam', ['action' => 'index'], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?php if ($tournament): ?>
                <?= $this->Html->link('Nazaj na turnir', [
                    'controller' => 'Tournaments',
                    'action' => 'view',
                    $tournament->id,
                ], ['class' => 'bt-button-secondary']) ?>
            <?php endif; ?>
            <?= $this->Html->link('Uredi', ['action' => 'edit', $court->id], [
                'class' => 'bt-button',
            ]) ?>
            <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $court->id], [
                'confirm' => 'Res želiš izbrisati to igrišče?',
                'class' => 'bt-button-secondary text-rose-700 border-rose-300 hover:bg-rose-50',
            ]) ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Osnovni podatki -->
        <div class="bt-card">
            <div class="px-4 py-3 border-b border-border-soft bg-slate-50">
                <div class="text-xs font-semibold uppercase text-slate-500">
                    Osnovni podatki
                </div>
            </div>
            <div class="px-4 py-4 text-sm space-y-3">
                <div>
                    <div class="text-xs text-slate-500 mb-0.5">Ime igrišča</div>
                    <div class="font-medium text-slate-800">
                        <?= h($court->name) ?>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-slate-500">Turnir</span>
                    <span class="text-xs text-slate-800">
                        <?php if ($tournament): ?>
                            <?= h($tournament->name) ?>
                        <?php else: ?>
                            <span class="text-slate-400">–</span>
                        <?php endif; ?>
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-slate-500">Vrstni red</span>
                    <span class="text-xs text-slate-800">
                        <?= (int)$court->sort_order ?>
                    </span>
                </div>

                <div class="border-t border-dashed border-border-soft pt-3 mt-2 text-[11px] text-slate-400">
                    Ustvarjeno: <?= $court->created ? $court->created->format('d.m.Y H:i') : '–' ?><br>
                    Spremenjeno: <?= $court->modified ? $court->modified->format('d.m.Y H:i') : '–' ?>
                </div>
            </div>
        </div>

        <!-- (opcijsko): tekme na tem igrišču -->
        <?php if (!empty($court->tournament_matches)): ?>
            <div class="bt-card">
                <div class="px-4 py-3 border-b border-border-soft bg-slate-50">
                    <div class="text-xs font-semibold uppercase text-slate-500">
                        Tekme na tem igrišču
                    </div>
                </div>
                <div class="px-4 py-3">
                    <table class="bt-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Dogodek</th>
                                <th>Tekmovalci</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($court->tournament_matches as $m): ?>
                                <?php
                                $c1 = $m->competitor1->name ?? 'TBD';
                                $c2 = $m->competitor2->name ?? 'TBD';
                                ?>
                                <tr>
                                    <td>#<?= $m->id ?></td>
                                    <td><?= h($m->tournament_event->name ?? '–') ?></td>
                                    <td>
                                        <span class="text-xs">
                                            <?= h($c1) ?> <span class="text-slate-400">vs</span> <?= h($c2) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-xs text-slate-700">
                                            <?= h($m->status) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>