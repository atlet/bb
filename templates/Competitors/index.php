<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface|\App\Model\Entity\Competitor[] $competitors
 */
$this->assign('title', 'Tekmovalci');
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Tekmovalci</h1>
            <p class="bt-header-subtitle">
                Seznam parov / ekip v turnirjih
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Dodaj tekmovalca', ['action' => 'add'], [
                'class' => 'bt-button',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-3 py-2 border-b border-border-soft bg-slate-50 flex justify-between items-center">
            <div class="text-xs font-semibold uppercase text-slate-500">
                Seznam vseh tekmovalcev
            </div>
            <div class="text-[11px] text-slate-400">
                <?= $this->Paginator->counter('{{count}} zapisov') ?>
            </div>
        </div>

        <div class="px-3 py-3 overflow-x-auto">
            <table class="bt-table">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                        <th><?= $this->Paginator->sort('name', 'Ime para / ekipe') ?></th>
                        <th><?= $this->Paginator->sort('tournament_event_id', 'Dogodek') ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('wins', 'Zmage') ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('losses', 'Porazi') ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('is_team', 'Tip') ?></th>
                        <th class="w-32 text-right">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($competitors->isEmpty()): ?>
                        <tr>
                            <td colspan="7" class="text-center text-xs text-slate-400 py-4">
                                Trenutno ni vnešenih tekmovalcev.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($competitors as $competitor): ?>
                            <tr>
                                <td><?= $this->Number->format($competitor->id) ?></td>
                                <td><?= h($competitor->name) ?></td>
                                <td>
                                    <?php if (!empty($competitor->tournament_event)): ?>
                                        <?= $this->Html->link(
                                            h($competitor->tournament_event->name),
                                            ['controller' => 'TournamentEvents', 'action' => 'view', $competitor->tournament_event->id],
                                            ['class' => 'text-xs text-primary-600 hover:underline']
                                        ) ?>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400">–</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs rounded-full bg-emerald-50 text-emerald-700">
                                        <?= (int)$competitor->wins ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs rounded-full bg-rose-50 text-rose-700">
                                        <?= (int)$competitor->losses ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if ($competitor->is_team): ?>
                                        <span class="text-[11px] text-slate-600">Dvojica / ekipa</span>
                                    <?php else: ?>
                                        <span class="text-[11px] text-slate-600">Posameznik</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-1">
                                        <?= $this->Html->link('Pogled', ['action' => 'view', $competitor->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Html->link('Uredi', ['action' => 'edit', $competitor->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $competitor->id], [
                                            'confirm' => 'Res želiš izbrisati tega tekmovalca?',
                                            'class' => 'bt-button-secondary text-[11px] text-rose-700 border-rose-300 hover:bg-rose-50',
                                        ]) ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($this->Paginator->total() > 1): ?>
            <div class="bt-pagination">
                <div class="bt-pagination-info">
                    <?= $this->Paginator->counter([
                        'format' => 'Stran {{page}} od {{pages}} · skupaj {{count}} zapisov'
                    ]) ?>
                </div>
                <div class="bt-pagination-links">
                    <?= $this->Paginator->first('« Prva') ?>
                    <?= $this->Paginator->prev('‹ Nazaj') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next('Naprej ›') ?>
                    <?= $this->Paginator->last('Zadnja »') ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>