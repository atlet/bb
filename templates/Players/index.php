<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface|\App\Model\Entity\Player[] $players
 */
$this->assign('title', __('Igralci'));
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title"><?= __('Igralci') ?></h1>
            <p class="bt-header-subtitle">
                <?= __('Seznam vseh registriranih igralcev') ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link(__('Dodaj igralca'), ['action' => 'add'], [
                'class' => 'bt-button',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-3 py-2 border-b border-border-soft bg-slate-50 flex justify-between items-center">
            <div class="text-xs font-semibold uppercase text-slate-500">
                <?= __('Seznam igralcev') ?>
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
                        <th><?= $this->Paginator->sort('last_name', __('Priimek')) ?></th>
                        <th><?= $this->Paginator->sort('first_name', __('Ime')) ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('gender', __('Spol')) ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('rating', __('Rating')) ?></th>
                        <th class="w-32 text-right"><?= __('Akcije') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($players->isEmpty()): ?>
                        <tr>
                            <td colspan="6" class="text-center text-xs text-slate-400 py-4">
                                <?= __('Trenutno ni vnešenih igralcev.') ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($players as $player): ?>
                            <tr>
                                <td><?= $this->Number->format($player->id) ?></td>
                                <td><?= h($player->last_name) ?></td>
                                <td><?= h($player->first_name) ?></td>
                                <td class="text-center">
                                    <?php if ($player->gender === 'M'): ?>
                                        <span class="text-xs text-slate-700"><?= __('M') ?></span>
                                    <?php elseif ($player->gender === 'F'): ?>
                                        <span class="text-xs text-slate-700"><?= __('Ž') ?></span>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400">–</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($player->rating !== null): ?>
                                        <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs rounded-full bg-primary-50 text-primary-600">
                                            <?= $this->Number->format($player->rating, ['places' => 1]) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400">–</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-1">
                                        <?= $this->Html->link('Pogled', ['action' => 'view', $player->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Html->link('Uredi', ['action' => 'edit', $player->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $player->id], [
                                            'confirm' => 'Res želiš izbrisati tega igralca?',
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