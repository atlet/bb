<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentMatch $match
 * @var array $tournamentEvents
 * @var array $competitors
 * @var array $courts
 */
?>

<?= $this->Form->create($tournamentMatch, ['class' => 'bt-form space-y-4']) ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('tournament_event_id', [
            'label' => 'Dogodek',
            'options' => $tournamentEvents,
            'empty' => '-- izberi dogodek --',
        ]) ?>
    </div>

    <div class="bt-form-group">
        <?= $this->Form->control('court_id', [
            'label' => 'Igrišče',
            'options' => $courts,
            'empty' => '-- brez igrišča --',
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('competitor1_id', [
            'label' => 'Tekmovalec 1',
            'options' => $competitors,
            'empty' => '-- izberi --',
        ]) ?>
    </div>

    <div class="bt-form-group">
        <?= $this->Form->control('competitor2_id', [
            'label' => 'Tekmovalec 2',
            'options' => $competitors,
            'empty' => '-- izberi --',
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('status', [
            'label' => 'Status',
            'type' => 'select',
            'options' => [
                'scheduled' => 'planirana',
                'in_progress' => 'v teku',
                'finished' => 'končana',
            ],
        ]) ?>
    </div>

    <div class="bt-form-group">
        <?= $this->Form->control('winner_id', [
            'label' => 'Zmagovalec (opcijsko)',
            'options' => $competitors,
            'empty' => '-- avtomatsko iz rezultata --',
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('current_score1', [
            'label' => 'Dobljeni seti – tekmovalec 1',
            'type' => 'number',
            'min' => 0,
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('current_score2', [
            'label' => 'Dobljeni seti – tekmovalec 2',
            'type' => 'number',
            'min' => 0,
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('started_at', [
            'label' => 'Začetek',
            'type' => 'datetime',
            'empty' => true,
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('finished_at', [
            'label' => 'Konec',
            'type' => 'datetime',
            'empty' => true,
        ]) ?>
    </div>
</div>

<div class="mt-4 flex justify-end gap-2">
    <?= $this->Html->link('Prekliči', ['action' => 'index'], [
        'class' => 'bt-button-secondary',
    ]) ?>
    <?= $this->Form->button('Shrani', ['class' => 'bt-button']) ?>
</div>

<?= $this->Form->end() ?>