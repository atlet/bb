<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MatchGame> $matchGames
 */
?>
<div class="matchGames index content">
    <?= $this->Html->link(__('New Match Game'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Match Games') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('match_id') ?></th>
                    <th><?= $this->Paginator->sort('sequence') ?></th>
                    <th><?= $this->Paginator->sort('score1') ?></th>
                    <th><?= $this->Paginator->sort('score2') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($matchGames as $matchGame): ?>
                <tr>
                    <td><?= $this->Number->format($matchGame->id) ?></td>
                    <td><?= $matchGame->hasValue('match') ? $this->Html->link($matchGame->match->stage, ['controller' => 'Matches', 'action' => 'view', $matchGame->match->id]) : '' ?></td>
                    <td><?= $this->Number->format($matchGame->sequence) ?></td>
                    <td><?= $this->Number->format($matchGame->score1) ?></td>
                    <td><?= $this->Number->format($matchGame->score2) ?></td>
                    <td><?= h($matchGame->created) ?></td>
                    <td><?= h($matchGame->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $matchGame->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $matchGame->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $matchGame->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $matchGame->id),
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