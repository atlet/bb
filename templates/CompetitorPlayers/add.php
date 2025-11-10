<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitorPlayer $competitorPlayer
 * @var \App\Model\Entity\Competitor $competitor
 * @var array $players
 */

$this->assign('title', 'Dodaj igralca v ekipo');
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Dodaj igralca v ekipo</h1>
            <p class="bt-header-subtitle">
                Dodaj novega igralca v par / ekipo:
                <strong><?= h($competitor->name) ?></strong>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na ekipo', "/competitors/view/{$competitor->id}", [
                'class' => 'bt-button-secondary',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->element('CompetitorPlayers/form') ?>
        </div>
    </div>
</div>
