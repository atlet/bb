<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentEvent $event
 */
$this->assign('title', 'Dodaj dogodek');
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Dodaj dogodek</h1>
            <p class="bt-header-subtitle">
                Ustvari novo kategorijo / dogodek znotraj turnirja
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na seznam', ['controller' => 'Tournaments', 'action' => 'view', $tournament_id], [
                'class' => 'bt-button-secondary',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->element('TournamentEvents/form') ?>
        </div>
    </div>
</div>