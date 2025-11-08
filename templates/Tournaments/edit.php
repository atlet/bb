<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tournament $tournament
 */
$this->assign('title', 'Uredi turnir – ' . $tournament->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Uredi turnir</h1>
            <p class="bt-header-subtitle">
                <?= h($tournament->name) ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na seznam', ['action' => 'index'], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $tournament->id], [
                'confirm' => 'Res želiš izbrisati ta turnir?',
                'class' => 'bt-button-secondary text-rose-700 border-rose-300 hover:bg-rose-50',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->element('Tournaments/form') ?>
        </div>
    </div>
</div>