<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentEvent $event
 * @var array $playerOptions
 */
$this->assign('title', 'Žreb parov – ' . $event->name);
?>

<div class="bt-page">
    <div class="bt-header">
        <div>
            <h1 class="bt-header-title">Žreb parov (dvojice)</h1>
            <p class="bt-header-subtitle">
                Dogodek: <?= h($event->name) ?>
            </p>
        </div>
        <div class="bt-actions">
            <?= $this->Html->link('Nazaj na dogodek', ['action' => 'view', $event->id], [
                'class' => 'bt-button-secondary',
            ]) ?>
        </div>
    </div>

    <div class="bt-card">
        <div class="px-4 py-4">
            <p class="text-xs text-slate-500 mb-3">
                Izberi igralce, ki bodo sodelovali v žrebu. Sistem jih bo naključno razdelil v dvojice
                in za vsak par ustvaril tekmovalca.
            </p>

            <?= $this->Form->create(null, ['class' => 'bt-form space-y-4']) ?>

            <div class="bt-form-group">
                <?= $this->Form->control('player_ids', [
                    'label' => 'Igralci',
                    'type' => 'select',
                    'multiple' => 'checkbox',
                    'options' => $playerOptions,
                ]) ?>
                <p class="text-[11px] text-slate-400 mt-1">
                    Izberi sodo število igralcev (2, 4, 6, 8, ...).
                </p>
            </div>

            <div class="mt-4 flex justify-end gap-2">
                <?= $this->Html->link('Prekliči', ['action' => 'view', $event->id], [
                    'class' => 'bt-button-secondary',
                ]) ?>
                <?= $this->Form->button('Naredi žreb parov', ['class' => 'bt-button']) ?>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>