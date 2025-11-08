<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentEvent $event
 */
$this->assign('title', 'Uredi dogodek – ' . $tournamentEvent->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Uredi dogodek</h1>
            <p class="bt-header-subtitle">
                <?= h($tournamentEvent->name) ?>
            </p>
        </div>
        <div class="bt-actions flex flex-wrap gap-2">
            <?= $this->Html->link('Nazaj na seznam', ['action' => 'index'], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $tournamentEvent->id], [
                'confirm' => 'Res želiš izbrisati ta dogodek?',
                'class' => 'bt-button-secondary text-rose-700 border-rose-300 hover:bg-rose-50',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->element('TournamentEvents/form') ?>
        </div>
    </div>
</div>