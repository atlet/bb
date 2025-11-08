<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MatchGame $matchGame
 * @var string[]|\Cake\Collection\CollectionInterface $matches
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $matchGame->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $matchGame->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Match Games'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="matchGames form content">
            <?= $this->Form->create($matchGame) ?>
            <fieldset>
                <legend><?= __('Edit Match Game') ?></legend>
                <?php
                    echo $this->Form->control('match_id', ['options' => $matches]);
                    echo $this->Form->control('sequence');
                    echo $this->Form->control('score1');
                    echo $this->Form->control('score2');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
