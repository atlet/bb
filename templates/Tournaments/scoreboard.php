<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tournament $tournament
 */

$this->assign('title', 'Scoreboard – ' . $tournament->name);
?>

<div class="min-h-screen bg-slate-900 text-slate-100">
    <div class="max-w-6xl mx-auto px-4 py-4">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-2xl font-semibold">
                    🏸 <?= h($tournament->name) ?>
                </h1>
                <p class="text-xs text-slate-400">
                    Live scoreboard · <?= h($tournament->location ?? '') ?>
                </p>
            </div>

            <div class="text-right text-xs text-slate-400">
                <div>Posodobljeno: <?= $this->Time->i18nFormat(new \DateTime(), 'HH:mm:ss') ?></div>
                <!-- Če želiš auto-refresh (vsakih X sekund), lahko kasneje dodaš meta ali JS -->
            </div>
        </div>

        <!-- Grid igrišč -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php foreach ($tournament->courts as $court): ?>
                <?php
                    // Vzemi prvo aktivno tekmo na tem igrišču (če obstaja)
                    $activeMatch = null;
                    if (!empty($court->tournament_matches)) {
                        $activeMatch = $court->tournament_matches[0];
                    }
                ?>

                <div class="rounded-2xl border border-slate-700 bg-slate-800/80 shadow-md p-4 flex flex-col gap-3">
                    <!-- Court header -->
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-semibold text-slate-100">
                            <?= h($court->name) ?>
                        </div>
                        <div class="text-[11px] text-slate-400">
                            Igrišče #<?= (int)($court->sort_order ?? 0) ?>
                        </div>
                    </div>

                    <?php if ($activeMatch): ?>
                        <?php
                            $c1 = $activeMatch->competitor1->name ?? 'TBD';
                            $c2 = $activeMatch->competitor2->name ?? 'TBD';
                            $status = $activeMatch->status;
                            $stageLabel = ucfirst(str_replace('_', ' ', $activeMatch->stage));
                            $roundLabel = $activeMatch->round_name ?: ('Krog ' . (int)$activeMatch->round);
                        ?>

                        <div class="flex items-center justify-between text-[11px] text-slate-400">
                            <span><?= h($stageLabel) ?> · <?= h($roundLabel) ?></span>
                            <span>
                                <?php if ($status === 'in_progress'): ?>
                                    <span class="inline-flex items-center gap-1 text-emerald-400">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                        V teku
                                    </span>
                                <?php elseif ($status === 'scheduled'): ?>
                                    <span class="inline-flex items-center gap-1 text-sky-300">
                                        ● Planirano
                                    </span>
                                <?php elseif ($status === 'finished'): ?>
                                    <span class="inline-flex items-center gap-1 text-slate-300">
                                        ✔ Zaključeno
                                    </span>
                                <?php endif; ?>
                            </span>
                        </div>

                        <!-- Players + score -->
                        <div class="flex items-center justify-between gap-4 mt-1">
                            <div class="flex-1">
                                <div class="text-sm font-semibold truncate">
                                    <?= h($c1) ?>
                                </div>
                            </div>

                            <div class="flex flex-col items-center min-w-[4.5rem]">
                                <div class="text-[10px] text-slate-400 mb-1">
                                    Rezultat
                                </div>
                                <div class="text-xl font-bold">
                                    <?= (int)$activeMatch->current_score1 ?> : <?= (int)$activeMatch->current_score2 ?>
                                </div>
                                <div class="text-[10px] text-slate-400">
                                    Set <?= (int)$activeMatch->current_game ?>
                                </div>
                            </div>

                            <div class="flex-1 text-right">
                                <div class="text-sm font-semibold truncate">
                                    <?= h($c2) ?>
                                </div>
                            </div>
                        </div>

                        <!-- Čas / scheduled -->
                        <div class="mt-2 text-[11px] text-slate-400 flex justify-between">
                            <div>
                                <?php if ($activeMatch->scheduled_at): ?>
                                    Plan: <?= $this->Time->i18nFormat($activeMatch->scheduled_at, 'HH:mm') ?>
                                <?php else: ?>
                                    Plan: —
                                <?php endif; ?>
                            </div>
                            <div>
                                <?php if ($activeMatch->started_at): ?>
                                    Začetek: <?= $this->Time->i18nFormat($activeMatch->started_at, 'HH:mm') ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- Ni aktivne tekme -->
                        <div class="flex-1 flex items-center justify-center">
                            <div class="text-xs text-slate-500 text-center">
                                Trenutno ni aktivne tekme na tem igrišču.<br>
                                <span class="text-[10px] opacity-70">Naslednjo lahko dodeliš v admin pogledu.</span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
