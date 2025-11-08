<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tournament $tournament
 */
?>

<?= $this->Form->create($tournament, ['class' => 'bt-form space-y-4']) ?>

<div class="bt-form-group">
    <?= $this->Form->control('name', [
        'label' => 'Ime turnirja',
    ]) ?>
</div>

<div class="bt-form-group">
    <?= $this->Form->control('location', [
        'label' => 'Lokacija',
    ]) ?>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('starts_on', [
            'label' => 'Začetek',
            'type' => 'date',
            'empty' => true,
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('ends_on', [
            'label' => 'Konec',
            'type' => 'date',
            'empty' => true,
        ]) ?>
    </div>
</div>

<div class="bt-form-group">
    <?= $this->Form->control('status', [
        'label' => 'Status',
        'type' => 'select',
        'options' => [
            'draft' => 'osnutek',
            'active' => 'aktiven',
            'finished' => 'zaključen',
        ],
    ]) ?>
</div>

<div class="mt-4 flex justify-end gap-2">
    <?= $this->Html->link('Prekliči', ['action' => 'index'], [
        'class' => 'bt-button-secondary',
    ]) ?>
    <?= $this->Form->button('Shrani', ['class' => 'bt-button']) ?>
</div>

<?= $this->Form->end() ?>