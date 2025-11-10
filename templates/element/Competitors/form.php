<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competitor $competitor
 * @var \Cake\Collection\CollectionInterface|string[] $tournamentEvents
 */
?>

<?= $this->Form->create($competitor, ['class' => 'bt-form space-y-4']) ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <?= $this->Form->hidden('tournament_event_id') ?>

    <div class="bt-form-group">
        <?= $this->Form->control('name', [
            'label' => 'Ime para / ekipe',
        ]) ?>
    </div>

    <div class="bt-form-group">
        <?= $this->Form->control('is_team', [
            'label' => 'Je dvojica / ekipa?',
            'type' => 'checkbox',
        ]) ?>
    </div>

    <div class="bt-form-group">
        <?= $this->Form->control('seed', [
            'label' => 'Seed (razvrstitev)',
            'type' => 'number',
            'min' => 1,
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('wins', [
            'label' => 'Zmage',
            'type' => 'number',
            'min' => 0,
            'readonly' => true,
            'templateVars' => ['help' => 'Samodejno se izračuna iz odigranih tekem.'],
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('losses', [
            'label' => 'Porazi',
            'type' => 'number',
            'min' => 0,
            'readonly' => true,
            'templateVars' => ['help' => 'Samodejno se izračuna iz odigranih tekem.'],
        ]) ?>
    </div>
</div>

<div class="mt-4 flex justify-end gap-2">
    <?= $this->Html->link('Prekliči', "/tournament-events/view/{$tournament_event_id}", [
        'class' => 'bt-button-secondary',
    ]) ?>
    <?= $this->Form->button(__('Shrani'), ['class' => 'bt-button']) ?>
</div>

<?= $this->Form->end() ?>