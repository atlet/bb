<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentMatch $match
 */
$this->assign('title', 'Dodaj tekmo');
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Dodaj tekmo</h1>
            <p class="bt-header-subtitle">
                Ročni vnos tekme (praviloma boš uporabljal “Naslednja tekma na igrišču”)
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
            <?= $this->element('TournamentMatches/form') ?>
        </div>
    </div>
</div>