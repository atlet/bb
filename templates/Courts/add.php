<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Court $court
 */
$this->assign('title', __('Dodaj igrišče'));
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title"><?= __('Dodaj igrišče') ?></h1>
            <p class="bt-header-subtitle">
                <?= __('Določi novo igrišče za turnir') ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link(__('Nazaj na seznam'), ['controller' => 'Tournaments', 'action' => 'view', $tournament_id], [
                'class' => 'bt-button-secondary',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->element('Courts/form') ?>
        </div>
    </div>
</div>