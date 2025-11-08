<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentEvent $event
 * @var \App\Model\Entity\Court[] $courts
 */
$this->assign('title', 'Kontrola – ' . $event->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Kontrola dogodka: <?= h($event->name) ?>
            </h1>
            <p class="bt-header-subtitle">
                Turnir: <?= h($event->tournament->name ?? '') ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Lestvica', [
                'action' => 'standings',
                $event->id
            ], ['class' => 'bt-button-secondary']) ?>
            <?= $this->Html->link('Nazaj na dogodek', [
                'action' => 'view',
                $event->id
            ], ['class' => 'bt-button-secondary']) ?>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php foreach ($courts as $court): ?>
            <?php
            $activeMatch = null;
            foreach ($event->tournament_matches as $m) {
                if ($m->court_id === $court->id && $m->status === 'in_progress') {
                    $activeMatch = $m;
                    break;
                }
            }
            ?>
            <div class="bt-card">
                <div class="px-3 py-2 border-b border-border-soft bg-slate-50 flex justify-between items-center">
                    <div class="text-xs font-semibold uppercase text-slate-500">
                        <?= h($court->name) ?>
                    </div>
                    <div>
                        <?= $this->Html->link(
                            'Naslednja tekma',
                            ['controller' => 'TournamentMatches', 'action' => 'startNextOnCourt', $event->id, $court->id],
                            ['class' => 'bt-button-secondary text-[11px]']
                        ) ?>
                    </div>
                </div>
                <div class="px-3 py-3 text-sm">
                    <?php if ($activeMatch): ?>
                        <?php
                        $c1 = $activeMatch->competitor1->name ?? 'TBD';
                        $c2 = $activeMatch->competitor2->name ?? 'TBD';
                        ?>
                        <div class="mb-1 text-xs text-slate-500">
                            Tekma #<?= $activeMatch->id ?>
                        </div>
                        <div class="flex items-center justify-between gap-3 mb-2">
                            <div class="flex-1">
                                <div class="font-semibold text-slate-800 truncate">
                                    <?= h($c1) ?>
                                </div>
                            </div>
                            <div class="text-center min-w-[3.5rem]">
                                <div class="text-[11px] text-slate-400">Rezultat</div>
                                <div class="text-lg font-bold">
                                    <?= (int)$activeMatch->current_score1 ?> : <?= (int)$activeMatch->current_score2 ?>
                                </div>
                            </div>
                            <div class="flex-1 text-right">
                                <div class="font-semibold text-slate-800 truncate">
                                    <?= h($c2) ?>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mt-2">
                            <span class="text-[11px] text-slate-500">
                                Status: <span class="text-emerald-600">v teku</span>
                            </span>
                            <?= $this->Html->link('Rezultat', [
                                'controller' => 'TournamentMatches',
                                'action' => 'finish',
                                $activeMatch->id,
                            ], ['class' => 'bt-button-secondary text-[11px]']) ?>
                        </div>
                    <?php else: ?>
                        <div class="text-xs text-slate-400">
                            Trenutno ni tekme na tem igrišču.<br>
                            Klikni “Naslednja tekma”, da se dodeli nova.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>