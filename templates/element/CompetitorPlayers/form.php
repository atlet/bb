<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitorPlayer $competitorPlayer
 * @var \App\Model\Entity\Competitor $competitor
 * @var array $players
 */

?>

<?= $this->Form->create($competitorPlayer, ['class' => 'bt-form space-y-4']) ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <?= $this->Form->hidden('competitor_id', [
        'value' => $competitor->id,
    ]) ?>

    <div class="bt-form-group md:col-span-2">
        <?= $this->Form->control('player_id', [
            'label'   => __('Igralec'),
            'options' => $players,
            'empty'   => __('-- Izberi igralca --'),
        ]) ?>
    </div>

    <div class="bt-form-group">
        <?= $this->Form->control('position', [
            'label'   => __('Pozicija v paru'),
            'type'    => 'number',
            'min'     => 1,
            'max'     => 2, // za dvojice; po želji spremeni
            'default' => 1,
            'templateVars' => [
                'help' => __('Za dvojice uporabi 1 in 2; pri single turnirjih pusti 1.'),
            ],
        ]) ?>
    </div>
</div>

<div class="mt-4 flex justify-end gap-2">
    <?= $this->Html->link(__('Prekliči'), "/competitors/view/{$competitor->id}", [
        'class' => 'bt-button-secondary',
    ]) ?>
    <?= $this->Form->button(__('Shrani'), ['class' => 'bt-button']) ?>
</div>

<?= $this->Form->end() ?>
