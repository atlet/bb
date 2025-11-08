<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitorPlayer $competitorPlayer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Competitor Player'), ['action' => 'edit', $competitorPlayer->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Competitor Player'), ['action' => 'delete', $competitorPlayer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitorPlayer->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Competitor Players'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Competitor Player'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="competitorPlayers view content">
            <h3><?= h($competitorPlayer->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Competitor') ?></th>
                    <td><?= $competitorPlayer->hasValue('competitor') ? $this->Html->link($competitorPlayer->competitor->name, ['controller' => 'Competitors', 'action' => 'view', $competitorPlayer->competitor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Player') ?></th>
                    <td><?= $competitorPlayer->hasValue('player') ? $this->Html->link($competitorPlayer->player->first_name, ['controller' => 'Players', 'action' => 'view', $competitorPlayer->player->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($competitorPlayer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($competitorPlayer->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($competitorPlayer->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($competitorPlayer->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>