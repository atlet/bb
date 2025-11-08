<?php
/**
 * Default layout – Tailwind + isti stil kot prej narisani HTMLji
 *
 * @var \App\View\AppView $this
 */
?>
<!doctype html>
<html lang="sl">
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= h($this->fetch('title') ?: 'Badminton turnir') ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= $this->Html->css('output') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="bg-slate-100 text-slate-900">
<div class="min-h-screen flex flex-col">

    <!-- TOP BAR / HEADER - isti vibe kot prej -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-2xl bg-slate-900 text-white text-xs font-bold">
                    BT
                </span>
                <div>
                    <div class="text-sm font-semibold text-slate-800">
                        Badminton Tools
                    </div>
                    <div class="text-xs text-slate-500">
                        Turnirski nadzor · admin
                    </div>
                </div>
            </div>

            <nav class="flex items-center gap-4 text-xs text-slate-600">
                <?= $this->Html->link('Turnirji', ['controller' => 'Tournaments', 'action' => 'index'], [
                    'class' => 'hover:text-primary-600'
                ]) ?>
                <?= $this->Html->link('Igrišča', ['controller' => 'Courts', 'action' => 'index'], [
                    'class' => 'hover:text-primary-600'
                ]) ?>
                <?= $this->Html->link('Dogodki', ['controller' => 'TournamentEvents', 'action' => 'index'], [
                    'class' => 'hover:text-primary-600'
                ]) ?>
                <?= $this->Html->link('Igralci', ['controller' => 'Players', 'action' => 'index'], [
                    'class' => 'hover:text-primary-600'
                ]) ?>
                <?= $this->Html->link('Tekmovalci', ['controller' => 'Competitors', 'action' => 'index'], [
                    'class' => 'hover:text-primary-600'
                ]) ?>
                <?= $this->Html->link('Tekme', ['controller' => 'TournamentMatches', 'action' => 'index'], [
                    'class' => 'hover:text-primary-600'
                ]) ?>
            </nav>
        </div>
    </header>

    <!-- FLASH MESSAGES -->
    <div class="max-w-6xl mx-auto w-full px-4 mt-4">
        <?= $this->Flash->render() ?>
    </div>

    <!-- MAIN CONTENT -->
    <main class="flex-1 max-w-6xl mx-auto w-full px-4 py-4">
        <?= $this->fetch('content') ?>
    </main>

    <!-- FOOTER -->
    <footer class="mt-auto border-t border-slate-200 bg-white">
        <div class="max-w-6xl mx-auto px-4 py-3 text-[11px] text-slate-500 flex items-center justify-between">
            <span>© <?= date('Y') ?> Badminton Tools</span>
            <span>SQLite · CakePHP · Tailwind</span>
        </div>
    </footer>
</div>
</body>
</html>
