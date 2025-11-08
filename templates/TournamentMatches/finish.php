<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentMatch $match
 */
$this->assign('title', 'Rezultat tekme #' . $match->id);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">
                Rezultat tekme #<?= $this->Number->format($match->id) ?>
            </h1>
            <p class="bt-header-subtitle">
                <?= h($match->competitor1->name ?? 'TBD') ?>
                <span class="text-slate-400">vs</span>
                <?= h($match->competitor2->name ?? 'TBD') ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na kontrolni pogled', [
                'controller' => 'TournamentEvents',
                'action' => 'control',
                $match->tournament_event_id,
            ], ['class' => 'bt-button-secondary']) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <?= $this->Form->create($match, ['class' => 'bt-form space-y-4']) ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bt-form-group">
                    <?= $this->Form->control('current_score1', [
                        'label' => 'Dobljeni seti – ' . ($match->competitor1->name ?? 'Tekmovalec 1'),
                        'type' => 'number',
                        'min' => 0,
                        'required' => true,
                    ]) ?>
                </div>
                <div class="bt-form-group">
                    <?= $this->Form->control('current_score2', [
                        'label' => 'Dobljeni seti – ' . ($match->competitor2->name ?? 'Tekmovalec 2'),
                        'type' => 'number',
                        'min' => 0,
                        'required' => true,
                    ]) ?>
                </div>
            </div>

            <p class="text-[11px] text-slate-400">
                Igramo na 2 dobljeni tekmi – npr. 2 : 0 ali 2 : 1.
                Sistem iz večje številke določi zmagovalca.
            </p>

            <div class="mt-4 flex justify-end gap-2">
                <?= $this->Html->link('Prekliči', [
                    'controller' => 'TournamentEvents',
                    'action' => 'control',
                    $match->tournament_event_id,
                ], ['class' => 'bt-button-secondary']) ?>

                <?= $this->Form->button('Shrani rezultat', ['class' => 'bt-button']) ?>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
