<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface|\App\Model\Entity\Tournament[] $tournaments
 */
$this->assign('title', 'Turnirji');
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Turnirji</h1>
            <p class="bt-header-subtitle">
                Seznam vseh turnirjev v sistemu
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Dodaj turnir', ['action' => 'add'], [
                'class' => 'bt-button',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-3 py-2 border-b border-border-soft bg-slate-50 flex justify-between items-center">
            <div class="text-xs font-semibold uppercase text-slate-500">
                Seznam turnirjev
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
                        <th><?= $this->Paginator->sort('name', 'Ime turnirja') ?></th>
                        <th><?= $this->Paginator->sort('location', 'Lokacija') ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('starts_on', 'Datum') ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('status', 'Status') ?></th>
                        <th class="w-32 text-right">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($tournaments->isEmpty()): ?>
                        <tr>
                            <td colspan="6" class="text-center text-xs text-slate-400 py-4">
                                Trenutno ni vnešenih turnirjev.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($tournaments as $tournament): ?>
                            <tr>
                                <td><?= $this->Number->format($tournament->id) ?></td>
                                <td>
                                    <?= $this->Html->link(
                                        h($tournament->name),
                                        ['action' => 'view', $tournament->id],
                                        ['class' => 'text-sm text-primary-600 hover:underline']
                                    ) ?>
                                </td>
                                <td><?= h($tournament->location ?? '–') ?></td>
                                <td class="text-center text-xs">
                                    <?php if ($tournament->starts_on || $tournament->ends_on): ?>
                                        <?= $tournament->starts_on ? $tournament->starts_on->format('d.m.Y') : '–' ?>
                                        –
                                        <?= $tournament->ends_on ? $tournament->ends_on->format('d.m.Y') : '–' ?>
                                    <?php else: ?>
                                        <span class="text-slate-400">–</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $status = $tournament->status ?? 'draft';
                                    $label = $status;
                                    $cls = 'text-xs rounded-full px-2 py-0.5 ';
                                    switch ($status) {
                                        case 'active':
                                            $label = 'aktiven';
                                            $cls .= 'bg-emerald-50 text-emerald-700';
                                            break;
                                        case 'finished':
                                            $label = 'zaključen';
                                            $cls .= 'bg-slate-200 text-slate-700';
                                            break;
                                        default:
                                            $label = 'osnutek';
                                            $cls .= 'bg-slate-100 text-slate-600';
                                            break;
                                    }
                                    ?>
                                    <span class="<?= $cls ?>"><?= h($label) ?></span>
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-1">
                                        <?= $this->Html->link('Pogled', ['action' => 'view', $tournament->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Html->link('Uredi', ['action' => 'edit', $tournament->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $tournament->id], [
                                            'confirm' => 'Res želiš izbrisati ta turnir?',
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