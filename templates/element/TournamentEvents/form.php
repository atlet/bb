<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentEvent $event
 * @var array $tournaments
 */
?>

<?= $this->Form->create($tournamentEvent, ['class' => 'bt-form space-y-4']) ?>

<?= $this->Form->hidden('tournament_id') ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('name', [
            'label' => __('Ime dogodka'),
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('code', [
            'label' => __('Koda (npr. MS, MD, MXD)'),
        ]) ?>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bt-form-group">
        <?= $this->Form->control('status', [
            'label' => __('Status'),
            'type' => 'select',
            'options' => [
                'active' => __('aktiven'),
                'finished' => __('zaključen'),
            ],
        ]) ?>
    </div>
    <div class="bt-form-group">
        <?= $this->Form->control('best_of_games', [
            'label' => __('Best of (št. setov)'),
            'type' => 'number',
            'min' => 1,
            'templateVars' => [
                'help' => __('3 = igra se do 2 dobljenih; 5 = do 3 dobljenih.'),
            ],
        ]) ?>
    </div>
</div>

<div class="bt-form-group">
    <?= $this->Form->control('points_per_game', [
        'label' => __('Točke na set'),
        'type' => 'number',
        'min' => 1,
    ]) ?>
</div>

<div class="mt-4 flex justify-end gap-2">
    <?= $this->Html->link(__('Prekliči'), ['controller' => 'Tournaments', 'action' => 'view', $tournament_id], [
        'class' => 'bt-button-secondary',
    ]) ?>
    <?= $this->Form->button(__('Shrani'), ['class' => 'bt-button']) ?>
</div>

<?= $this->Form->end() ?>