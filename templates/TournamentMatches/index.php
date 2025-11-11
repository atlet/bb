<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface|\App\Model\Entity\TournamentMatch[] $tournamentMatches
 */
$this->assign('title', 'Tekme');
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Tekme</h1>
            <p class="bt-header-subtitle">
                Seznam vseh tekem v turnirjih
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Dodaj tekmo', ['action' => 'add'], [
                'class' => 'bt-button',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-3 py-2 border-b border-border-soft bg-slate-50 flex justify-between items-center">
            <div class="text-xs font-semibold uppercase text-slate-500">
                Seznam tekem
            </div>
            <div class="text-[11px] text-slate-400">
                <?= $this->Paginator->counter('{{count}} zapisov') ?>
            </div>
        </div>

        <div class="px-3 py-3 overflow-x-auto">
            <div class="bt-table-wrapper">
                <table class="bt-table">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                            <th><?= $this->Paginator->sort('tournament_event_id', 'Dogodek') ?></th>
                            <th>Tekmovalci</th>
                            <th><?= $this->Paginator->sort('court_id', 'Igrišče') ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('status', 'Status') ?></th>
                            <th class="text-center">Rezultat</th>
                            <th class="w-40 text-right">Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($tournamentMatches->isEmpty()): ?>
                            <tr>
                                <td colspan="7" class="text-center text-xs text-slate-400 py-4">
                                    Trenutno ni vnešenih tekem.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($tournamentMatches as $match): ?>
                                <?php
                                $e = $match->tournament_event ?? null;
                                $c1 = $match->competitor1->name ?? 'TBD';
                                $c2 = $match->competitor2->name ?? 'TBD';
                                $court = $match->court->name ?? '–';
                                ?>
                                <tr>
                                    <td>#<?= $this->Number->format($match->id) ?></td>
                                    <td>
                                        <?php if ($e): ?>
                                            <?= $this->Html->link(
                                                h($e->name),
                                                ['controller' => 'TournamentEvents', 'action' => 'view', $e->id],
                                                ['class' => 'text-xs text-primary-600 hover:underline']
                                            ) ?>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-400">–</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-1 text-xs">
                                            <span class="font-medium text-slate-800 truncate max-w-[140px]"><?= h($c1) ?></span>
                                            <span class="text-slate-400">vs</span>
                                            <span class="font-medium text-slate-800 truncate max-w-[140px]"><?= h($c2) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-xs text-slate-700"><?= h($court) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $status = $match->status;
                                        $statusLabel = $status;
                                        $statusClass = 'text-xs rounded-full px-2 py-0.5';

                                        switch ($status) {
                                            case 'in_progress':
                                                $statusLabel = 'v teku';
                                                $statusClass .= ' bg-amber-50 text-amber-700';
                                                break;
                                            case 'finished':
                                                $statusLabel = 'končana';
                                                $statusClass .= ' bg-emerald-50 text-emerald-700';
                                                break;
                                            default:
                                                $statusLabel = $status ?: 'planirana';
                                                $statusClass .= ' bg-slate-100 text-slate-600';
                                                break;
                                        }
                                        ?>
                                        <span class="<?= $statusClass ?>"><?= h($statusLabel) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($match->status === 'finished'): ?>
                                            <span class="text-sm font-semibold text-slate-800">
                                                <?= (int)$match->current_score1 ?> : <?= (int)$match->current_score2 ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-400">–</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right">
                                        <div class="flex justify-end gap-1">
                                            <?= $this->Html->link('Pogled', ['action' => 'view', $match->id], [
                                                'class' => 'bt-button-secondary text-[11px]',
                                            ]) ?>
                                            <?= $this->Html->link('Uredi', ['action' => 'edit', $match->id], [
                                                'class' => 'bt-button-secondary text-[11px]',
                                            ]) ?>
                                            <?php if ($match->status !== 'finished'): ?>
                                                <?= $this->Html->link('Rezultat', ['action' => 'finish', $match->id], [
                                                    'class' => 'bt-button-secondary text-[11px]',
                                                ]) ?>
                                            <?php endif; ?>
                                            <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $match->id], [
                                                'confirm' => 'Res želiš izbrisati to tekmo?',
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