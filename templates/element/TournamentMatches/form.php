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

        <?= $this->Form->hidden('tournament_event_id') ?>

    <div class="bt-form-group">
        <?= $this->Form->control('court_id', [
            'label' => __('Igrišče'),
            'options' => $courts,
            'empty' => __('-- brez igrišča --'),
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('competitor1_id', [
            'label' => __('Tekmovalec 1'),
            'options' => $competitors,
            'empty' => __('-- izberi --'),
        ]) ?>
    </div>

    <div class="bt-form-group">
        <?= $this->Form->control('competitor2_id', [
            'label' => __('Tekmovalec 2'),
            'options' => $competitors,
            'empty' => __('-- izberi --'),
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('status', [
            'label' => __('Status'),
            'type' => 'select',
            'options' => [
                'scheduled' => __('planirana'),
                'in_progress' => __('v teku'),
                'finished' => __('končana'),
            ],
        ]) ?>
    </div>

    <div class="bt-form-group">
        <?= $this->Form->control('winner_id', [
            'label' => __('Zmagovalec (opcijsko)'),
            'options' => $competitors,
            'empty' => __('-- avtomatsko iz rezultata --'),
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('current_score1', [
            'label' => __('Dobljeni seti – tekmovalec 1'),
            'type' => 'number',
            'min' => 0,
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('current_score2', [
            'label' => __('Dobljeni seti – tekmovalec 2'),
            'type' => 'number',
            'min' => 0,
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('started_at', [
            'label' => __('Začetek'),
            'type' => 'datetime',
            'empty' => true,
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('finished_at', [
            'label' => __('Konec'),
            'type' => 'datetime',
            'empty' => true,
        ]) ?>
    </div>
</div>

<div class="mt-4 flex justify-end gap-2">
    <?= $this->Html->link(__('Prekliči'), ['controller' => 'TournamentEvents', 'action' => 'view', $tournament_event_id], [
        'class' => 'bt-button-secondary',
    ]) ?>
    <?= $this->Form->button(__('Shrani'), ['class' => 'bt-button']) ?>
</div>

<?= $this->Form->end() ?>