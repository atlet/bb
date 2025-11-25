<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface|\App\Model\Entity\Court[] $courts
 */
$this->assign('title', __('Igrišča'));
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title"><?= __('Igrišča') ?></h1>
            <p class="bt-header-subtitle">
                <?= __('Seznam vseh igrišč po turnirjih') ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link(__('Dodaj igrišče'), ['action' => 'add'], [
                'class' => 'bt-button',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-3 py-2 border-b border-border-soft bg-slate-50 flex justify-between items-center">
            <div class="text-xs font-semibold uppercase text-slate-500">
                <?= __('Seznam igrišč') ?>
            </div>
            <div class="text-[11px] text-slate-400">
                <?= $this->Paginator->counter(__('{{count}} zapisov')) ?>
            </div>
        </div>

        <div class="px-3 py-3 overflow-x-auto">
            <table class="bt-table">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id', __('ID')) ?></th>
                        <th><?= $this->Paginator->sort('name', __('Ime igrišča')) ?></th>
                        <th><?= $this->Paginator->sort('tournament_id', __('Turnir')) ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('sort_order', __('Vrstni red')) ?></th>
                        <th class="w-32 text-right"><?= __('Akcije') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($courts->isEmpty()): ?>
                        <tr>
                            <td colspan="5" class="text-center text-xs text-slate-400 py-4">
                                <?= __('Trenutno ni vnešenih igrišč.') ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($courts as $court): ?>
                            <tr>
                                <td><?= $this->Number->format($court->id) ?></td>
                                <td><?= h($court->name) ?></td>
                                <td>
                                    <?php if (!empty($court->tournament)): ?>
                                        <?= $this->Html->link(
                                            h($court->tournament->name),
                                            ['controller' => 'Tournaments', 'action' => 'view', $court->tournament->id],
                                            ['class' => 'text-xs text-primary-600 hover:underline']
                                        ) ?>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400">–</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center text-xs">
                                    <?= (int)$court->sort_order ?>
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-1">
                                        <?= $this->Html->link(__('Pogled'), ['action' => 'view', $court->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Html->link(__('Uredi'), ['action' => 'edit', $court->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Form->postLink(__('Izbriši'), ['action' => 'delete', $court->id], [
                                            'confirm' => __('Res želiš izbrisati to igrišče?'),
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