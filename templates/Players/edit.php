<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Player $player
 */
$this->assign('title', 'Uredi igralca – ' . $player->first_name . ' ' . $player->last_name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Uredi igralca
            </h1>
            <p class="bt-header-subtitle">
                <?= h($player->first_name . ' ' . $player->last_name) ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na seznam', ['action' => 'index'], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $player->id], [
                'confirm' => 'Res želiš izbrisati tega igralca?',
                'class' => 'bt-button-secondary text-rose-700 border-rose-300 hover:bg-rose-50',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->element('Players/form') ?>
        </div>
    </div>
</div>