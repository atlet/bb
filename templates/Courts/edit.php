<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Court $court
 */
$this->assign('title', __('Uredi igrišče') . ' – ' . $court->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title"><?= __('Uredi igrišče') ?></h1>
            <p class="bt-header-subtitle">
                <?= h($court->name) ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link(__('Nazaj na seznam'), ['controller' => 'Tournaments', 'action' => 'view', $tournament_id], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Form->postLink(__('Izbriši'), ['action' => 'delete', $court->id], [
                'confirm' => __('Res želiš izbrisati to igrišče?'),
                'class' => 'bt-button-secondary text-rose-700 border-rose-300 hover:bg-rose-50',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->element('Courts/form') ?>
        </div>
    </div>
</div>