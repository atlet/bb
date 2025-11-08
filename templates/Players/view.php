<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Player $player
 */
$this->assign('title', 'Igralec – ' . $player->first_name . ' ' . $player->last_name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Igralec: <?= h($player->first_name . ' ' . $player->last_name) ?>
            </h1>
            <p class="bt-header-subtitle">
                ID: <?= $this->Number->format($player->id) ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na seznam', ['action' => 'index'], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?= $this->Html->link('Uredi', ['action' => 'edit', $player->id], [
                'class' => 'bt-button',
            ]) ?>
            <?= $this->Form->postLink('Izbriši', ['action' => 'delete', $player->id], [
                'confirm' => 'Res želiš izbrisati tega igralca?',
                'class' => 'bt-button-secondary text-rose-700 border-rose-300 hover:bg-rose-50',
            ]) ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Osnovni podatki -->
        <div class="lg:col-span-1">
            <div class="bt-card">
                <div class="px-4 py-3 border-b border-border-soft bg-slate-50">
                    <div class="text-xs font-semibold uppercase text-slate-500">
                        Osnovni podatki
                    </div>
                </div>
                <div class="px-4 py-4 text-sm space-y-3">
                    <div>
                        <div class="text-xs text-slate-500 mb-0.5">Ime</div>
                        <div class="font-medium text-slate-800">
                            <?= h($player->first_name) ?>
                        </div>
                    </div>

                    <div>
                        <div class="text-xs text-slate-500 mb-0.5">Priimek</div>
                        <div class="font-medium text-slate-800">
                            <?= h($player->last_name) ?>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500">Spol</span>
                        <span class="text-xs text-slate-800">
                            <?php if ($player->gender === 'M'): ?>
                                Moški
                            <?php elseif ($player->gender === 'F'): ?>
                                Ženska
                            <?php else: ?>
                                –
                            <?php endif; ?>
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-slate-500">Rating</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-primary-50 text-primary-600 text-xs font-semibold">
                            <?= $player->rating !== null ? $this->Number->format($player->rating, ['places' => 1]) : '–' ?>
                        </span>
                    </div>

                    <div class="border-t border-dashed border-border-soft pt-3 mt-2 text-[11px] text-slate-400">
                        Ustvarjen: <?= $player->created ? $player->created->format('d.m.Y H:i') : '–' ?><br>
                        Spremenjen: <?= $player->modified ? $player->modified->format('d.m.Y H:i') : '–' ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ekipe / pari, kjer nastopa -->
        <div class="lg:col-span-2">
            <div class="bt-card">
                <div class="px-4 py-3 border-b border-border-soft bg-slate-50 flex justify-between items-center">
                    <div class="text-xs font-semibold uppercase text-slate-500">
                        Ekipe / pari, kjer nastopa
                    </div>
                </div>
                <div class="px-4 py-3">
                    <?php if (empty($player->competitor_players)): ?>
                        <p class="text-xs text-slate-400">
                            Ta igralec trenutno ni dodeljen nobenemu paru / ekipi.
                        </p>
                    <?php else: ?>
                        <table class="bt-table">
                            <thead>
                                <tr>
                                    <th>Par / ekipa</th>
                                    <th>Pozicija</th>
                                    <th>Dogodek</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($player->competitor_players as $cp): ?>
                                    <?php $comp = $cp->competitor ?? null; ?>
                                    <tr>
                                        <td>
                                            <?php if ($comp): ?>
                                                <?= $this->Html->link(
                                                    h($comp->name),
                                                    ['controller' => 'Competitors', 'action' => 'view', $comp->id],
                                                    ['class' => 'text-xs text-primary-600 hover:underline']
                                                ) ?>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400">–</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="text-xs text-slate-700">
                                                <?= (int)$cp->position ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if (!empty($comp->tournament_event)): ?>
                                                <?= h($comp->tournament_event->name) ?>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400">–</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>