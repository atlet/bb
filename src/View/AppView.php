<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/4/en/views.html#the-app-view
 */
class AppView extends View {
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like adding helpers.
     *
     * e.g. `$this->addHelper('Html');`
     *
     * @return void
     */
    public function initialize(): void {
        parent::initialize();

        $this->loadHelper('Html');
        // Tailwind-friendly Form helper
        $this->loadHelper('Form', [
            'templates' => [
                'formStart' => '<form{{attrs}}>',
                'formEnd'   => '</form>',

                'inputContainer' => '<div class="mb-4">{{content}}</div>',
                'inputContainerError' => '<div class="mb-4">{{content}}<p class="mt-1 text-xs text-red-600">{{error}}</p></div>',

                'label' => '<label class="block mb-1 text-sm font-medium text-slate-700" {{attrs}}>{{text}}</label>',

                'input' => '<input type="{{type}}" name="{{name}}"{{attrs}} class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm focus:border-primary-500 focus:ring-primary-500" />',

                'select' => '<select name="{{name}}"{{attrs}} class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm focus:border-primary-500 focus:ring-primary-500">{{content}}</select>',

                'textarea' => '<textarea name="{{name}}"{{attrs}} class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm focus:border-primary-500 focus:ring-primary-500">{{value}}</textarea>',

                'button' => '<button{{attrs}} class="inline-flex items-center rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 disabled:opacity-50">{{text}}</button>',

                'submitContainer' => '<div class="mt-4">{{content}}</div>',
            ],
        ]);

        $this->loadHelper('Paginator', [
            'templates' => [
                'number' => '<li><a href="{{url}}" class="bt-page-link">{{text}}</a></li>',
                'current' => '<li><span class="bt-page-link bt-page-link--current">{{text}}</span></li>',

                'prevActive' => '<li><a rel="prev" href="{{url}}" class="bt-page-link">«</a></li>',
                'prevDisabled' => '<li><span class="bt-page-link bt-page-link--disabled">«</span></li>',

                'nextActive' => '<li><a rel="next" href="{{url}}" class="bt-page-link">»</a></li>',
                'nextDisabled' => '<li><span class="bt-page-link bt-page-link--disabled">»</span></li>',
            ],
        ]);
    }
}
