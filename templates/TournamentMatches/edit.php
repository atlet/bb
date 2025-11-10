<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentMatch $match
 */
$this->assign('title', 'Uredi tekmo #' . $tournamentMatch->id);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Uredi tekmo #<?= $this->Number->format($tournamentMatch->id) ?>
            </h1>
            <p class="bt-header-subtitle">
                <?= h($tournamentMatch->competitor1->name ?? 'TBD') ?>
                <span class="text-slate-400">vs</span>
                <?= h($tournamentMatch->competitor2->name ?? 'TBD') ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na seznam', ['controller' => 'TournamentEvents', 'action' => 'view', $tournamentMatch->tournament_event_id], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $tournamentMatch->id], [
                'confirm' => 'Res želiš izbrisati to tekmo?',
                'class' => 'bt-button-secondary text-rose-700 border-rose-300 hover:bg-rose-50',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->element('TournamentMatches/form') ?>
        </div>
    </div>
</div>