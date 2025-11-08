<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentEvent $event
 */
$this->assign('title', 'Dogodek – ' . $tournamentEvent->name);
$tournament = $tournamentEvent->tournament ?? null;
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Dogodek: <?= h($tournamentEvent->name) ?>
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
        <div class="bt-actions flex flex-wrap gap-2">
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
            <?= $this->Html->link('Kontrola', ['action' => 'control', $tournamentEvent->id], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Html->link('Lestvica', ['action' => 'standings', $tournamentEvent->id], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Html->link('Žreb parov', ['action' => 'drawPairs', $tournamentEvent->id], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Html->link('Uredi', ['action' => 'edit', $tournamentEvent->id], [
                'class' => 'bt-button',
            ]) ?>
            <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $tournamentEvent->id], [
                'confirm' => 'Res želiš izbrisati ta dogodek?',
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
                        <div class="text-xs text-slate-500 mb-0.5">Ime dogodka</div>
                        <div class="font-medium text-slate-800">
                            <?= h($tournamentEvent->name) ?>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500">Koda</span>
                        <span class="text-xs text-slate-800">
                            <?= h($tournamentEvent->code ?? '–') ?>
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500">Status</span>
                        <span class="text-xs text-slate-800">
                            <?= h($tournamentEvent->status ?? 'active') ?>
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500">Best of</span>
                        <span class="text-xs text-slate-800">
                            <?= (int)$tournamentEvent->best_of_games ?> setov
                            <span class="text-[10px] text-slate-400">
                                (do <?= intdiv($tournamentEvent->best_of_games, 2) + 1 ?> dobljenih)
                            </span>
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500">Točke na set</span>
                        <span class="text-xs text-slate-800">
                            <?= (int)$tournamentEvent->points_per_game ?>
                        </span>
                    </div>

                    <div class="border-t border-dashed border-border-soft pt-3 mt-2 text-[11px] text-slate-400">
                        Ustvarjen: <?= $tournamentEvent->created ? $tournamentEvent->created->format('d.m.Y H:i') : '–' ?><br>
                        Spremenjen: <?= $tournamentEvent->modified ? $tournamentEvent->modified->format('d.m.Y H:i') : '–' ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tekmovalci -->
        <div class="lg:col-span-2">
            <div class="bt-card">
                <div class="px-4 py-3 border-b border-border-soft bg-slate-50 flex justify-between items-center">
                    <div class="text-xs font-semibold uppercase text-slate-500">
                        Tekmovalci / pari
                    </div>
                    <div class="flex gap-2">
                        <?= $this->Html->link('Žreb parov', [
                            'action' => 'drawPairs',
                            $tournamentEvent->id,
                        ], ['class' => 'bt-button-secondary text-[11px]']) ?>
                        <?= $this->Html->link('Dodaj tekmovalca', [
                            'controller' => 'Competitors',
                            'action' => 'add',
                            '?' => ['tournament_event_id' => $tournamentEvent->id],
                        ], ['class' => 'bt-button-secondary text-[11px]']) ?>
                    </div>
                </div>
                <div class="px-4 py-3">
                    <?php if (empty($tournamentEvent->competitors)): ?>
                        <p class="text-xs text-slate-400">
                            Ta dogodek še nima tekmovalcev. Uporabi “Žreb parov” ali “Dodaj tekmovalca”.
                        </p>
                    <?php else: ?>
                        <table class="bt-table">
                            <thead>
                                <tr>
                                    <th>Ime para / ekipe</th>
                                    <th class="text-center">Seed</th>
                                    <th class="text-center">Zmage</th>
                                    <th class="text-center">Porazi</th>
                                    <th class="w-28 text-right">Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tournamentEvent->competitors as $c): ?>
                                    <tr>
                                        <td><?= h($c->name) ?></td>
                                        <td class="text-center text-xs">
                                            <?= $c->seed !== null ? (int)$c->seed : '–' ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs rounded-full bg-emerald-50 text-emerald-700">
                                                <?= (int)$c->wins ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs rounded-full bg-rose-50 text-rose-700">
                                                <?= (int)$c->losses ?>
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <div class="flex justify-end gap-1">
                                                <?= $this->Html->link('Pogled', [
                                                    'controller' => 'Competitors',
                                                    'action' => 'view',
                                                    $c->id,
                                                ], ['class' => 'bt-button-secondary text-[11px]']) ?>
                                                <?= $this->Html->link('Uredi', [
                                                    'controller' => 'Competitors',
                                                    'action' => 'edit',
                                                    $c->id,
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

            <!-- (opcijsko) kratek pregled tekem -->
            <?php if (!empty($tournamentEvent->tournament_matches)): ?>
                <div class="bt-card mt-4">
                    <div class="px-4 py-3 border-b border-border-soft bg-slate-50 flex justify-between items-center">
                        <div class="text-xs font-semibold uppercase text-slate-500">
                            Tekme v tem dogodku
                        </div>
                        <div>
                            <?= $this->Html->link('Vse tekme', [
                                'controller' => 'TournamentMatches',
                                'action' => 'index',
                                '?' => ['tournament_event_id' => $tournamentEvent->id],
                            ], ['class' => 'bt-button-secondary text-[11px]']) ?>
                        </div>
                    </div>
                    <div class="px-4 py-3">
                        <table class="bt-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Igrišče</th>
                                    <th>Tekmovalci</th>
                                    <th>Status</th>
                                    <th>Rezultat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tournamentEvent->tournament_matches as $m): ?>
                                    <?php
                                        $c1 = $m->competitor1->name ?? 'TBD';
                                        $c2 = $m->competitor2->name ?? 'TBD';
                                        $courtName = $m->court->name ?? '–';
                                    ?>
                                    <tr>
                                        <td>#<?= $m->id ?></td>
                                        <td><?= h($courtName) ?></td>
                                        <td class="text-xs">
                                            <?= h($c1) ?> <span class="text-slate-400">vs</span> <?= h($c2) ?>
                                        </td>
                                        <td class="text-xs">
                                            <?= h($m->status) ?>
                                        </td>
                                        <td class="text-xs">
                                            <?php if ($m->status === 'finished'): ?>
                                                <?= (int)$m->current_score1 ?> : <?= (int)$m->current_score2 ?>
                                            <?php else: ?>
                                                <span class="text-slate-400">–</span>
                                            <?php endif; ?>
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
</div>
