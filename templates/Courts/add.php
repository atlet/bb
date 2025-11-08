<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Court $court
 */
$this->assign('title', 'Dodaj igrišče');
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Dodaj igrišče</h1>
            <p class="bt-header-subtitle">
                Določi novo igrišče za turnir
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
            <?= $this->element('Courts/form') ?>
        </div>
    </div>
</div>