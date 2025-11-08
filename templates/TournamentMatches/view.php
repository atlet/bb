<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentMatch $match
 */
$this->assign('title', 'Tekma #' . $tournamentMatch->id);
$event = $tournamentMatch->tournament_event ?? null;
$c1 = $tournamentMatch->competitor1->name ?? 'TBD';
$c2 = $tournamentMatch->competitor2->name ?? 'TBD';
$court = $tournamentMatch->court->name ?? '–';
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Tekma #<?= $this->Number->format($tournamentMatch->id) ?>
            </h1>
            <p class="bt-header-subtitle">
                <?= h($c1) ?>
                <span class="text-slate-400">vs</span>
                <?= h($c2) ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na seznam', ['action' => 'index'], [
                'class' => 'bt-button-secondary',
            ]) ?>
            <?php if ($event): ?>
                <?= $this->Html->link('Dogodek', [
                    'controller' => 'TournamentEvents',
                    'action' => 'view',
                    $event->id,
                ], ['class' => 'bt-button-secondary']) ?>
                <?= $this->Html->link('Kontrola dogodka', [
                    'controller' => 'TournamentEvents',
                    'action' => 'control',
                    $event->id,
                ], ['class' => 'bt-button-secondary']) ?>
            <?php endif; ?>
            <?= $this->Html->link('Uredi', ['action' => 'edit', $tournamentMatch->id], [
                'class' => 'bt-button',
            ]) ?>
            <?php if ($tournamentMatch->status !== 'finished'): ?>
                <?= $this->Html->link('Vnesi rezultat', [
                    'action' => 'finish',
                    $tournamentMatch->id
                ], ['class' => 'bt-button-secondary']) ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Osnovni podatki -->
        <div class="bt-card">
            <div class="px-4 py-3 border-b border-border-soft bg-slate-50">
                <div class="text-xs font-semibold uppercase text-slate-500">
                    Podrobnosti tekme
                </div>
            </div>
            <div class="px-4 py-4 text-sm space-y-2">
                <div class="flex justify-between items-center">
                    <span class="text-xs text-slate-500">Dogodek</span>
                    <span class="text-xs text-slate-800">
                        <?php if ($event): ?>
                            <?= h($event->name) ?>
                        <?php else: ?>
                            <span class="text-slate-400">–</span>
                        <?php endif; ?>
                    </span>
                </div>

                <div>
                    <div class="text-xs text-slate-500 mb-0.5">Tekmovalci</div>
                    <div class="flex items-center justify-between gap-2">
                        <span class="font-medium text-slate-800 truncate"><?= h($c1) ?></span>
                        <span class="text-slate-400 text-xs">vs</span>
                        <span class="font-medium text-slate-800 text-right truncate"><?= h($c2) ?></span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-slate-500">Igrišče</span>
                    <span class="text-xs text-slate-800"><?= h($court) ?></span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-slate-500">Status</span>
                    <span class="text-xs text-slate-800">
                        <?= h($tournamentMatch->status) ?>
                    </span>
                </div>

                <div>
                    <div class="text-xs text-slate-500 mb-0.5">Rezultat (seti)</div>
                    <?php if ($tournamentMatch->status === 'finished'): ?>
                        <div class="text-lg font-semibold">
                            <?= (int)$tournamentMatch->current_score1 ?> : <?= (int)$tournamentMatch->current_score2 ?>
                        </div>
                    <?php else: ?>
                        <span class="text-xs text-slate-400">Tekma še ni zaključena.</span>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-2 gap-2 text-[11px] text-slate-500 mt-2 border-t border-dashed border-border-soft pt-2">
                    <div>
                        <span class="block mb-0.5">Začetek</span>
                        <span class="text-slate-700">
                            <?= $tournamentMatch->started_at ? $tournamentMatch->started_at->format('d.m.Y H:i') : '–' ?>
                        </span>
                    </div>
                    <div>
                        <span class="block mb-0.5">Konec</span>
                        <span class="text-slate-700">
                            <?= $tournamentMatch->finished_at ? $tournamentMatch->finished_at->format('d.m.Y H:i') : '–' ?>
                        </span>
                    </div>
                </div>

                <div class="border-t border-dashed border-border-soft pt-3 mt-2 text-[11px] text-slate-400">
                    Ustvarjeno: <?= $tournamentMatch->created ? $tournamentMatch->created->format('d.m.Y H:i') : '–' ?><br>
                    Spremenjeno: <?= $tournamentMatch->modified ? $tournamentMatch->modified->format('d.m.Y H:i') : '–' ?>
                </div>
            </div>
        </div>

        <!-- (Opcijsko) Winner info -->
        <div class="bt-card">
            <div class="px-4 py-3 border-b border-border-soft bg-slate-50">
                <div class="text-xs font-semibold uppercase text-slate-500">
                    Zmagovalec
                </div>
            </div>
            <div class="px-4 py-4 text-sm">
                <?php if ($tournamentMatch->status === 'finished' && $tournamentMatch->winner): ?>
                    <div class="mb-2">
                        <div class="text-xs text-slate-500 mb-0.5">Zmagovalec tekme</div>
                        <div class="text-base font-semibold text-emerald-700">
                            <?= h($tournamentMatch->winner->name) ?>
                        </div>
                    </div>

                    <p class="text-[11px] text-slate-500">
                        Zmagovalec je določen glede na večje število dobljenih setov
                        (current_score1 / current_score2).
                    </p>
                <?php else: ?>
                    <p class="text-xs text-slate-400">
                        Zmagovalec še ni določen. Tekma še ni zaključena ali ni vnešen rezultat.
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>