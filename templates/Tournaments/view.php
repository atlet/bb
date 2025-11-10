<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tournament $tournament
 */
$this->assign('title', 'Turnir – ' . $tournament->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Turnir: <?= h($tournament->name) ?>
            </h1>
            <p class="bt-header-subtitle">
                Lokacija: <?= h($tournament->location ?? '–') ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na seznam', ['action' => 'index'], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Html->link('Uredi', ['action' => 'edit', $tournament->id], [
                'class' => 'bt-button',
            ]) ?>
            <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $tournament->id], [
                'confirm' => 'Res želiš izbrisati ta turnir?',
                'class' => 'bt-button-secondary text-rose-700 border-rose-300 hover:bg-rose-50',
            ]) ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Osnovni podatki -->
        <div class="lg:col-span-1">
            <div class="bt-card">
                <div class="px-4 py-3 border-b border-border-soft bg-slate-50">
                    <div class="text-xs font-semibold uppercase text-slate-500">
                        Osnovni podatki
                    </div>
                </div>
                <div class="px-4 py-4 text-sm space-y-3">
                    <div>
                        <div class="text-xs text-slate-500 mb-0.5">Ime turnirja</div>
                        <div class="font-medium text-slate-800">
                            <?= h($tournament->name) ?>
                        </div>
                    </div>

                    <div>
                        <div class="text-xs text-slate-500 mb-0.5">Lokacija</div>
                        <div class="text-slate-800">
                            <?= h($tournament->location ?? '–') ?>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500">Datum</span>
                        <span class="text-xs text-slate-800">
                            <?php if ($tournament->starts_on || $tournament->ends_on): ?>
                                <?= $tournament->starts_on ? $tournament->starts_on->format('d.m.Y') : '–' ?>
                                –
                                <?= $tournament->ends_on ? $tournament->ends_on->format('d.m.Y') : '–' ?>
                            <?php else: ?>
                                <span class="text-slate-400">–</span>
                            <?php endif; ?>
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500">Status</span>
                        <span class="text-xs text-slate-800">
                            <?= h($tournament->status ?? 'draft') ?>
                        </span>
                    </div>

                    <div class="border-t border-dashed border-border-soft pt-3 mt-2 text-[11px] text-slate-400">
                        Ustvarjen: <?= $tournament->created ? $tournament->created->format('d.m.Y H:i') : '–' ?><br>
                        Spremenjen: <?= $tournament->modified ? $tournament->modified->format('d.m.Y H:i') : '–' ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dogodki + Igrišča -->
        <div class="lg:col-span-2 space-y-4">
            <!-- Dogodki -->
            <div class="bt-card">
                <div class="px-4 py-3 border-b border-border-soft bg-slate-50 flex justify-between items-center">
                    <div class="text-xs font-semibold uppercase text-slate-500">
                        Dogodki / kategorije
                    </div>
                    <div>
                        <?= $this->Html->link('Dodaj dogodek', [
                            'controller' => 'TournamentEvents',
                            'action' => 'add',
                            $tournament->id,
                        ], ['class' => 'bt-button-secondary text-[11px]']) ?>
                    </div>
                </div>
                <div class="px-4 py-3">
                    <?php if (empty($tournament->tournament_events)): ?>
                        <p class="text-xs text-slate-400">
                            Ta turnir še nima dodanih dogodkov / kategorij.
                        </p>
                    <?php else: ?>
                        <table class="bt-table">
                            <thead>
                                <tr>
                                    <th>Ime dogodka</th>
                                    <th>Koda</th>
                                    <th>Status</th>
                                    <th class="w-32 text-right">Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tournament->tournament_events as $event): ?>
                                    <tr>
                                        <td><?= h($event->name) ?></td>
                                        <td><?= h($event->code ?? '–') ?></td>
                                        <td>
                                            <span class="text-xs text-slate-700">
                                                <?= h($event->status ?? 'active') ?>
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <div class="flex justify-end gap-1">
                                                <?= $this->Html->link('Pogled', [
                                                    'controller' => 'TournamentEvents',
                                                    'action' => 'view',
                                                    $event->id,
                                                ], ['class' => 'bt-button-secondary text-[11px]']) ?>
                                                <?= $this->Html->link('Kontrola', [
                                                    'controller' => 'TournamentEvents',
                                                    'action' => 'control',
                                                    $event->id,
                                                ], ['class' => 'bt-button-secondary text-[11px]']) ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Igrišča -->
            <div class="bt-card">
                <div class="px-4 py-3 border-b border-border-soft bg-slate-50 flex justify-between items-center">
                    <div class="text-xs font-semibold uppercase text-slate-500">
                        Igrišča
                    </div>
                    <div>
                        <?= $this->Html->link('Dodaj igrišče', [
                            'controller' => 'Courts',
                            'action' => 'add',
                            $tournament->id,
                        ], ['class' => 'bt-button-secondary text-[11px]']) ?>
                    </div>
                </div>
                <div class="px-4 py-3">
                    <?php if (empty($tournament->courts)): ?>
                        <p class="text-xs text-slate-400">
                            Ta turnir še nima dodanih igrišč.
                        </p>
                    <?php else: ?>
                        <table class="bt-table">
                            <thead>
                                <tr>
                                    <th>Ime igrišča</th>
                                    <th class="text-center">Vrstni red</th>
                                    <th class="w-32 text-right">Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tournament->courts as $court): ?>
                                    <tr>
                                        <td><?= h($court->name) ?></td>
                                        <td class="text-center text-xs">
                                            <?= (int)$court->sort_order ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="flex justify-end gap-1">                                                
                                                <?= $this->Html->link('Uredi', ['controller' => 'Courts', 'action' => 'edit', $court->id], [
                                                    'class' => 'bt-button-secondary text-[11px]',
                                                ]) ?>
                                                <?= $this->Form->postLink('Izbriši', ['controller' => 'Courts', 'action' => 'delete', $court->id], [
                                                    'confirm' => 'Res želiš izbrisati to igrišče?',
                                                    'class' => 'bt-button-secondary text-[11px] text-rose-700 border-rose-300 hover:bg-rose-50',
                                                ]) ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>