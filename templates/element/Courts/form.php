<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Court $court
 * @var array $tournaments
 */
?>

<?= $this->Form->create($court, ['class' => 'bt-form space-y-4']) ?>

<div class="bt-form-group">
    <?= $this->Form->control('tournament_id', [
        'label' => 'Turnir',
        'options' => $tournaments,
        'empty' => '-- izberi turnir --',
    ]) ?>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('name', [
            'label' => 'Ime igrišča',
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('sort_order', [
            'label' => 'Vrstni red prikaza',
            'type' => 'number',
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