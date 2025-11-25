<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Player $player
 */
$this->assign('title', __('Dodaj igralca'));
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title"><?= __('Dodaj igralca') ?></h1>
            <p class="bt-header-subtitle">
                Vnos novega igralca v bazo
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na seznam', ['action' => 'index'], [
                'class' => 'bt-button-secondary',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->element('Players/form') ?>
        </div>
    </div>
</div>