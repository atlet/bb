<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentEvent $event
 * @var \Cake\Collection\CollectionInterface|\App\Model\Entity\Competitor[] $competitors
 */
$this->assign('title', 'Lestvica – ' . $event->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Končna razvrstitev – <?= h($event->name) ?>
            </h1>
            <p class="bt-header-subtitle">
                Zmage in porazi (2 poraza = izpad).
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na dogodek', ['action' => 'view', $event->id], [
                'class' => 'bt-button-secondary',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <table class="bt-table">
            <thead>
                <tr>
                    <th>Mesto</th>
                    <th>Tekmovalec / par</th>
                    <th class="text-right">Zmage</th>
                    <th class="text-right">Porazi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $place = 1; ?>
                <?php foreach ($competitors as $c): ?>
                    <tr>
                        <td><?= $place++ ?>.</td>
                        <td><?= h($c->name) ?></td>
                        <td class="text-right"><?= (int)$c->wins ?></td>
                        <td class="text-right"><?= (int)$c->losses ?></td>
                        <td>
                            <?php if ($c->losses >= 2): ?>
                                <span class="text-xs text-slate-500">Izpadel</span>
                            <?php else: ?>
                                <span class="text-xs text-emerald-600 font-semibold">V igri / Zmagovalec</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>