<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MatchGame $matchGame
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Match Game'), ['action' => 'edit', $matchGame->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Match Game'), ['action' => 'delete', $matchGame->id], ['confirm' => __('Are you sure you want to delete # {0}?', $matchGame->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Match Games'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Match Game'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="matchGames view content">
            <h3><?= h($matchGame->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Match') ?></th>
                    <td><?= $matchGame->hasValue('match') ? $this->Html->link($matchGame->match->stage, ['controller' => 'Matches', 'action' => 'view', $matchGame->match->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($matchGame->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sequence') ?></th>
                    <td><?= $this->Number->format($matchGame->sequence) ?></td>
                </tr>
                <tr>
                    <th><?= __('Score1') ?></th>
                    <td><?= $this->Number->format($matchGame->score1) ?></td>
                </tr>
                <tr>
                    <th><?= __('Score2') ?></th>
                    <td><?= $this->Number->format($matchGame->score2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($matchGame->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($matchGame->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>