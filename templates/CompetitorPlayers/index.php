<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CompetitorPlayer> $competitorPlayers
 */
?>
<div class="competitorPlayers index content">
    <?= $this->Html->link(__('New Competitor Player'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Competitor Players') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('competitor_id') ?></th>
                    <th><?= $this->Paginator->sort('player_id') ?></th>
                    <th><?= $this->Paginator->sort('position') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competitorPlayers as $competitorPlayer): ?>
                <tr>
                    <td><?= $this->Number->format($competitorPlayer->id) ?></td>
                    <td><?= $competitorPlayer->hasValue('competitor') ? $this->Html->link($competitorPlayer->competitor->name, ['controller' => 'Competitors', 'action' => 'view', $competitorPlayer->competitor->id]) : '' ?></td>
                    <td><?= $competitorPlayer->hasValue('player') ? $this->Html->link($competitorPlayer->player->first_name, ['controller' => 'Players', 'action' => 'view', $competitorPlayer->player->id]) : '' ?></td>
                    <td><?= $this->Number->format($competitorPlayer->position) ?></td>
                    <td><?= h($competitorPlayer->created) ?></td>
                    <td><?= h($competitorPlayer->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $competitorPlayer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $competitorPlayer->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $competitorPlayer->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $competitorPlayer->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>