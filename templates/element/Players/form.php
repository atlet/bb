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
            'label' => 'Ime',
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('last_name', [
            'label' => 'Priimek',
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('gender', [
            'label' => 'Spol',
            'type' => 'select',
            'empty' => '-- ni podan --',
            'options' => [
                'M' => 'Moški',
                'F' => 'Ženska',
            ],
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('rating', [
            'label' => 'Rating (opcijsko)',
            'type' => 'number',
            'step' => '0.1',
            'min' => 0,
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