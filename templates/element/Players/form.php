<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Player $player
 */
?>

<?= $this->Form->create($player, ['class' => 'bt-form space-y-4']) ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('first_name', [
            'label' => __('Ime'),
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('last_name', [
            'label' => __('Priimek'),
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('gender', [
            'label' => __('Spol'),
            'type' => 'select',
            'empty' => __('-- ni podan --'),
            'options' => [
                'M' => __('Moški'),
                'F' => __('Ženska'),
            ],
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('rating', [
            'label' => __('Rating (opcijsko)'),
            'type' => 'number',
            'step' => '0.1',
            'min' => 0,
        ]) ?>
    </div>
</div>

<div class="mt-4 flex justify-end gap-2">
    <?= $this->Html->link(__('Prekliči'), ['action' => 'index'], [
        'class' => 'bt-button-secondary',
    ]) ?>
    <?= $this->Form->button(__('Shrani'), ['class' => 'bt-button']) ?>
</div>

<?= $this->Form->end() ?>