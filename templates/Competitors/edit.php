<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competitor $competitor
 */
$this->assign('title', 'Uredi tekmovalca – ' . $competitor->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Uredi tekmovalca
            </h1>
            <p class="bt-header-subtitle">
                <?= h($competitor->name) ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na seznam', ['action' => 'index'], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $competitor->id], [
                'confirm' => 'Res želiš izbrisati tega tekmovalca?',
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