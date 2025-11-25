<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Court $court
 * @var array $tournaments
 */
?>

<?= $this->Form->create($court, ['class' => 'bt-form space-y-4']) ?>

<?= $this->Form->hidden('tournament_id') ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('name', [
            'label' => __('Ime igrišča'),
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('sort_order', [
            'label' => __('Vrstni red prikaza'),
            'type' => 'number',
            'min' => 0,
        ]) ?>
    </div>
</div>

<div class="mt-4 flex justify-end gap-2">
    <?= $this->Html->link(__('Prekliči'), ['controller' => 'Tournaments', 'action' => 'view', $tournament_id], [
        'class' => 'bt-button-secondary',
    ]) ?>
    <?= $this->Form->button(__('Shrani'), ['class' => 'bt-button']) ?>
</div>

<?= $this->Form->end() ?>