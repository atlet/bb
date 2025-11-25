<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface|\App\Model\Entity\Competitor[] $competitors
 */
$this->assign('title', __('Tekmovalci'));
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title"><?= __('Tekmovalci') ?></h1>
            <p class="bt-header-subtitle">
                <?= __('Seznam parov / ekip v turnirjih') ?>
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
                <?= __('Seznam vseh tekmovalcev') ?>
            </div>
            <div class="text-[11px] text-slate-400">
                <?= $this->Paginator->counter('{{count}} zapisov') ?>
            </div>
        </div>

        <div class="px-3 py-3 overflow-x-auto">
            <table class="bt-table">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id', __('ID')) ?></th>
                        <th><?= $this->Paginator->sort('name', __('Ime para / ekipe')) ?></th>
                        <th><?= $this->Paginator->sort('tournament_event_id', __('Dogodek')) ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('wins', __('Zmage')) ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('losses', __('Porazi')) ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('is_team', __('Tip')) ?></th>
                        <th class="w-32 text-right"><?= __('Akcije') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($competitors->isEmpty()): ?>
                        <tr>
                            <td colspan="7" class="text-center text-xs text-slate-400 py-4">
                                <?= __('Trenutno ni vnešenih tekmovalcev.') ?>
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
                                        <span class="text-[11px] text-slate-600"><?= __('Dvojica / ekipa') ?></span>
                                    <?php else: ?>
                                        <span class="text-[11px] text-slate-600"><?= __('Posameznik') ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-1">
                                        <?= $this->Html->link(__('Pogled'), ['action' => 'view', $competitor->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Html->link(__('Uredi'), ['action' => 'edit', $competitor->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Form->postLink(__('Izbriši'), ['action' => 'delete', $competitor->id], [
                                            'confirm' => __('Res želiš izbrisati tega tekmovalca?'),
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
                        'format' => __('Stran {{page}} od {{pages}} · skupaj {{count}} zapisov')
                    ]) ?>
                </div>
                <div class="bt-pagination-links">
                    <?= $this->Paginator->first(__('« Prva')) ?>
                    <?= $this->Paginator->prev(__('‹ Nazaj')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('Naprej ›')) ?>
                    <?= $this->Paginator->last(__('Zadnja »')) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>