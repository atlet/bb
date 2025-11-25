<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competitor $competitor
 */
$this->assign('title', __('Tekmovalec') . ' – ' . $competitor->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                <?= __('Tekmovalec') ?>: <?= h($competitor->name) ?>
            </h1>
            <p class="bt-header-subtitle">
                <?= __('Dogodek') ?>:
                <?php if (!empty($competitor->tournament_event)): ?>
                    <?= h($competitor->tournament_event->name) ?>
                <?php else: ?>
                    <span class="text-slate-400"><?= __('neznan dogodek') ?></span>
                <?php endif; ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link(__('Dogodek'), [
                'controller' => 'TournamentEvents',
                'action' => 'view',
                $competitor->tournament_event_id,
            ], ['class' => 'bt-button-secondary']) ?>
            <?= $this->Html->link(
                __('Dodaj igralca'),
                ['controller' => 'CompetitorPlayers', 'action' => 'add', $competitor->id],
                ['class' => 'bt-button-secondary']
            ) ?>
            <?= $this->Html->link(__('Uredi'), ['action' => 'edit', $competitor->id], [
                'class' => 'bt-button',
            ]) ?>
            <?= $this->Form->postLink(__('Izbriši'), ['action' => 'delete', $competitor->id], [
                'confirm' => __('Res želiš izbrisati ta dogodek?'),
                'class' => 'bt-button-secondary text-rose-700 border-rose-300 hover:bg-rose-50',
            ]) ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Info kartica -->
        <div class="lg:col-span-1">
            <div class="bt-card">
                <div class="px-4 py-3 border-b border-border-soft bg-slate-50">
                    <div class="text-xs font-semibold uppercase text-slate-500">
                        <?= __('Osnovni podatki') ?>
                    </div>
                </div>
                <div class="px-4 py-4 text-sm space-y-2">
                    <div class="flex justify-between">
                        <span class="text-slate-500 text-xs"><?= __('ID') ?></span>
                        <span class="text-slate-800"><?= $this->Number->format($competitor->id) ?></span>
                    </div>

                    <div>
                        <div class="text-xs text-slate-500 mb-0.5"><?= __('Ime para / ekipe') ?></div>
                        <div class="font-medium text-slate-800">
                            <?= h($competitor->name) ?>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500"><?= __('Tip') ?></span>
                        <span class="text-xs text-slate-700">
                            <?= $competitor->is_team ? __('Dvojica / ekipa') : __('Posameznik') ?>
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500"><?= __('Seed') ?></span>
                        <span class="text-xs text-slate-800">
                            <?= $competitor->seed !== null ? $this->Number->format($competitor->seed) : '–' ?>
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500"><?= __('Zmage') ?></span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                            <?= (int)$competitor->wins ?>
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500"><?= __('Porazi') ?></span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-rose-50 text-rose-700 text-xs font-semibold">
                            <?= (int)$competitor->losses ?>
                        </span>
                    </div>

                    <div class="border-t border-dashed border-border-soft pt-3 mt-2 text-[11px] text-slate-400">
                        <?= __('Ustvarjen') ?>: <?= $competitor->created ? $competitor->created->format('d.m.Y H:i') : '–' ?><br>
                        <?= __('Spremenjen') ?>: <?= $competitor->modified ? $competitor->modified->format('d.m.Y H:i') : '–' ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Igralci v paru -->
        <div class="lg:col-span-2 space-y-4">
            <div class="bt-card">
                <div class="px-4 py-3 border-b border-border-soft bg-slate-50 flex justify-between items-center">
                    <div class="text-xs font-semibold uppercase text-slate-500">
                        <?= __('Igralci v paru / ekipi') ?>
                    </div>
                </div>
                <div class="px-4 py-3">
                    <?php if (empty($competitor->competitor_players)): ?>
                        <div class="text-xs text-slate-400">
                            <?= __('Ni dodeljenih igralcev.') ?>
                        </div>
                    <?php else: ?>
                        <table class="bt-table">
                            <thead>
                                <tr>
                                    <th><?= __('Pozicija') ?></th>
                                    <th><?= __('Igralec') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($competitor->competitor_players as $cp): ?>
                                    <tr>
                                        <td><?= (int)$cp->position ?></td>
                                        <td>
                                            <?php if (!empty($cp->player)): ?>
                                                <?= h($cp->player->first_name . ' ' . $cp->player->last_name) ?>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400"><?= __('neznan') ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>

            <!-- (opcijsko) Tekme tega tekmovalca -->
            <?php if (!empty($competitor->tournament_matches)): ?>
                <div class="bt-card">
                    <div class="px-4 py-3 border-b border-border-soft bg-slate-50 flex justify-between items-center">
                        <div class="text-xs font-semibold uppercase text-slate-500">
                            <?= __('Tekme tega tekmovalca') ?>
                        </div>
                    </div>
                    <div class="px-4 py-3">
                        <table class="bt-table">
                            <thead>
                                <tr>
                                    <th><?= __('ID') ?></th>
                                    <th><?= __('Nasprotnik') ?></th>
                                    <th><?= __('Rezultat') ?></th>
                                    <th><?= __('Status') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($competitor->tournament_matches as $m): ?>
                                    <?php
                                    $isC1 = $m->competitor1_id === $competitor->id;
                                    $opponent = $isC1 ? $m->competitor2 : $m->competitor1;
                                    ?>
                                    <tr>
                                        <td>#<?= $m->id ?></td>
                                        <td><?= h($opponent->name ?? __('TBD')) ?></td>
                                        <td>
                                            <?php if ($m->status === 'finished'): ?>
                                                <?= (int)$m->current_score1 ?> : <?= (int)$m->current_score2 ?>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400"><?= h($m->status) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="text-xs text-slate-600"><?= h($m->status) ?></span>
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