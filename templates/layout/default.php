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

        <!-- TOP BAR / HEADER - isti vibe, zdaj responsive -->
        <header class="bg-white shadow-sm">
            <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
                <!-- Logo + naslov -->
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

                <!-- DESKTOP NAV -->
                <nav class="hidden md:flex items-center gap-4 text-xs text-slate-600">
                    <?= $this->Html->link('Turnirji', ['controller' => 'Tournaments', 'action' => 'index'], [
                        'class' => 'hover:text-primary-600'
                    ]) ?>
                    <?= $this->Html->link('Igralci', ['controller' => 'Players', 'action' => 'index'], [
                        'class' => 'hover:text-primary-600'
                    ]) ?>
                </nav>

                <!-- MOBILE HAMBURGER -->
                <button
                    id="mobile-menu-toggle"
                    type="button"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-md border border-slate-200 text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-primary-500"
                    aria-controls="mobile-menu"
                    aria-expanded="false">
                    <span class="sr-only">Odpri meni</span>
                    <!-- ikona hamburger -->
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- MOBILE NAV (pod headerjem) -->
            <nav
                id="mobile-menu"
                class="hidden md:hidden border-t border-slate-200 bg-white">
                <div class="max-w-6xl mx-auto px-4 py-2 flex flex-col gap-1 text-xs text-slate-700">
                    <?= $this->Html->link('Turnirji', ['controller' => 'Tournaments', 'action' => 'index'], [
                        'class' => 'block px-1 py-1 rounded hover:bg-slate-100 hover:text-primary-600'
                    ]) ?>
                    <?= $this->Html->link('Igralci', ['controller' => 'Players', 'action' => 'index'], [
                        'class' => 'block px-1 py-1 rounded hover:bg-slate-100 hover:text-primary-600'
                    ]) ?>
                </div>
            </nav>
        </header>

        <!-- MAIN CONTENT -->
        <main class="flex-1">
            <div class="max-w-6xl mx-auto px-3 sm:px-4 py-4 sm:py-6">
                <!-- Flash -->
                <div class="mb-3">
                    <?= $this->Flash->render() ?>
                </div>

                <!-- Content -->
                <?= $this->fetch('content') ?>
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="mt-auto border-t border-slate-200 bg-white">
            <div class="max-w-6xl mx-auto px-4 py-3 text-[11px] text-slate-500 flex items-center justify-between">
                <span>© <?= date('Y') ?> Badminton Tools</span>
                <span>SQLite · CakePHP · Tailwind</span>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var btn = document.getElementById('mobile-menu-toggle');
            var menu = document.getElementById('mobile-menu');
            if (!btn || !menu) return;

            btn.addEventListener('click', function() {
                menu.classList.toggle('hidden');
                var expanded = btn.getAttribute('aria-expanded') === 'true';
                btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
            });
        });
    </script>

</body>

</html>