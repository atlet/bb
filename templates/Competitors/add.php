<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competitor $competitor
 */
$this->assign('title', 'Dodaj tekmovalca');
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Dodaj tekmovalca</h1>
            <p class="bt-header-subtitle">
                Ustvari nov par / ekipo za dogodek
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
            <?php
            // wins/losses naj bodo 0 pri novem tekmovalcu
            if ($competitor->isNew()) {
                $competitor->wins = $competitor->wins ?? 0;
                $competitor->losses = $competitor->losses ?? 0;
            }
            ?>
            <?= $this->element('Competitors/form') ?>
        </div>
    </div>
</div>