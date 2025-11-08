<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitorPlayer $competitorPlayer
 * @var \Cake\Collection\CollectionInterface|string[] $competitors
 * @var \Cake\Collection\CollectionInterface|string[] $players
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Competitor Players'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="competitorPlayers form content">
            <?= $this->Form->create($competitorPlayer) ?>
            <fieldset>
                <legend><?= __('Add Competitor Player') ?></legend>
                <?php
                    echo $this->Form->control('competitor_id', ['options' => $competitors]);
                    echo $this->Form->control('player_id', ['options' => $players]);
                    echo $this->Form->control('position');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
