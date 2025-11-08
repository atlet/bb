<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitorPlayer $competitorPlayer
 * @var string[]|\Cake\Collection\CollectionInterface $competitors
 * @var string[]|\Cake\Collection\CollectionInterface $players
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $competitorPlayer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $competitorPlayer->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Competitor Players'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="competitorPlayers form content">
            <?= $this->Form->create($competitorPlayer) ?>
            <fieldset>
                <legend><?= __('Edit Competitor Player') ?></legend>
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
