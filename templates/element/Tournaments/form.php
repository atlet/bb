<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tournament $tournament
 */
?>

<?= $this->Form->create($tournament, ['class' => 'bt-form space-y-4']) ?>

<div class="bt-form-group">
    <?= $this->Form->control('name', [
        'label' => __('Ime turnirja'),
    ]) ?>
</div>

<div class="bt-form-group">
    <?= $this->Form->control('location', [
        'label' => __('Lokacija'),
    ]) ?>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('starts_on', [
            'label' => __('Začetek'),
            'type' => 'date',
            'empty' => true,
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('ends_on', [
            'label' => __('Konec'),
            'type' => 'date',
            'empty' => true,
        ]) ?>
    </div>
</div>

<div class="bt-form-group">
    <?= $this->Form->control('status', [
        'label' => __('Status'),
        'type' => 'select',
        'options' => [
            'draft' => __('osnutek'),
            'active' => __('aktiven'),
            'finished' => __('zaključen'),
        ],
    ]) ?>
</div>

<div class="mt-4 flex justify-end gap-2">
    <?= $this->Html->link(__('Prekliči'), ['action' => 'index'], [
        'class' => 'bt-button-secondary',
    ]) ?>
    <?= $this->Form->button(__('Shrani'), ['class' => 'bt-button']) ?>
</div>

<?= $this->Form->end() ?>