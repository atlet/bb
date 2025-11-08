<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface|\App\Model\Entity\TournamentEvent[] $tournamentEvents
 */
$this->assign('title', 'Dogodki / kategorije');
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Dogodki / kategorije</h1>
            <p class="bt-header-subtitle">
                Seznam dogodkov znotraj turnirjev (npr. MS, MD, MXD …)
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Dodaj dogodek', ['action' => 'add'], [
                'class' => 'bt-button',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-3 py-2 border-b border-border-soft bg-slate-50 flex justify-between items-center">
            <div class="text-xs font-semibold uppercase text-slate-500">
                Seznam dogodkov
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
                        <th><?= $this->Paginator->sort('name', 'Ime dogodka') ?></th>
                        <th><?= $this->Paginator->sort('code', 'Koda') ?></th>
                        <th><?= $this->Paginator->sort('tournament_id', 'Turnir') ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('status', 'Status') ?></th>
                        <th class="text-center"><?= $this->Paginator->sort('best_of_games', 'Best of') ?></th>
                        <th class="w-48 text-right">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($tournamentEvents->isEmpty()): ?>
                        <tr>
                            <td colspan="7" class="text-center text-xs text-slate-400 py-4">
                                Trenutno ni vnešenih dogodkov.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($tournamentEvents as $event): ?>
                            <tr>
                                <td><?= $this->Number->format($event->id) ?></td>
                                <td>
                                    <?= $this->Html->link(
                                        h($event->name),
                                        ['action' => 'view', $event->id],
                                        ['class' => 'text-sm text-primary-600 hover:underline']
                                    ) ?>
                                </td>
                                <td><?= h($event->code ?? '–') ?></td>
                                <td>
                                    <?php if (!empty($event->tournament)): ?>
                                        <?= $this->Html->link(
                                            h($event->tournament->name),
                                            ['controller' => 'Tournaments', 'action' => 'view', $event->tournament->id],
                                            ['class' => 'text-xs text-primary-600 hover:underline']
                                        ) ?>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400">–</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <span class="text-xs text-slate-700">
                                        <?= h($event->status ?? 'active') ?>
                                    </span>
                                </td>
                                <td class="text-center text-xs">
                                    <?= (int)$event->best_of_games ?> (do <?= intdiv($event->best_of_games, 2) + 1 ?> dobljenih)
                                </td>
                                <td class="text-right">
                                    <div class="flex justify-end gap-1 flex-wrap">
                                        <?= $this->Html->link('Pogled', ['action' => 'view', $event->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Html->link('Kontrola', ['action' => 'control', $event->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Html->link('Lestvica', ['action' => 'standings', $event->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Html->link('Uredi', ['action' => 'edit', $event->id], [
                                            'class' => 'bt-button-secondary text-[11px]',
                                        ]) ?>
                                        <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $event->id], [
                                            'confirm' => 'Res želiš izbrisati ta dogodek?',
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
