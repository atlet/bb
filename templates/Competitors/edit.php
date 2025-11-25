<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competitor $competitor
 */
$this->assign('title', __('Uredi tekmovalca') . ' – ' . $competitor->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                <?= __('Uredi tekmovalca') ?>
            </h1>
            <p class="bt-header-subtitle">
                <?= h($competitor->name) ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link(__('Nazaj na seznam'), "/tournament-events/view/{$tournament_event_id}", [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Form->postLink(__('Izbriši'), ['action' => 'delete', $competitor->id], [
                'confirm' => __('Res želiš izbrisati tega tekmovalca?'),
                'class' => 'bt-button-secondary text-rose-700 border-rose-300 hover:bg-rose-50',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->element('Competitors/form') ?>
        </div>
    </div>
</div>