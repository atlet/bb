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
                // ---- GUMBI ----
                'button' => '<button class="inline-flex items-center rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 disabled:opacity-50" {{attrs}}>{{text}}</button>',

                // ---- CHECKBOXI ----
                'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
                'checkboxFormGroup' => '{{label}}',
                // 1 checkbox item
                'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
                // multi-checkbox skupina (okvir)
                'multicheckboxWrapper' => '<div class="bt-checkbox-group" {{attrs}}>{{content}}</div>',

                // ---- ERROR-JI ----
                'error' => '<div class="error-message" id="{{id}}">{{content}}</div>',
                'errorList' => '<ul>{{content}}</ul>',
                'errorItem' => '<li>{{text}}</li>',

                // ---- FILE ----
                'file' => '<input type="file" name="{{name}}"{{attrs}}>',

                // ---- FORMA ----
                'formStart' => '<form{{attrs}}>',
                'formEnd'   => '</form>',

                // label + input razpored
                'formGroup' => '{{label}}{{input}}',

                'hiddenBlock' => '<div{{attrs}}>{{content}}</div>',

                // ---- INPUT / SELECT / TEXTAREA ----
                'input' => '<input type="{{type}}" name="{{name}}" class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm focus:border-primary-500 focus:ring-primary-500" {{attrs}}>',
                'inputSubmit' => '<input type="{{type}}" class="inline-flex items-center rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 disabled:opacity-50" {{attrs}}>',
                'select' => '<select name="{{name}}" class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm focus:border-primary-500 focus:ring-primary-500" {{attrs}}>{{content}}</select>',
                'selectMultiple' => '<select name="{{name}}[]" multiple="multiple" class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm focus:border-primary-500 focus:ring-primary-500" {{attrs}}>{{content}}</select>',
                'textarea' => '<textarea name="{{name}}" class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm focus:border-primary-500 focus:ring-primary-500" {{attrs}}>{{value}}</textarea>',

                // ---- CONTAINERJI ----
                // uporabi containerClass + Tailwind ovitek
                'inputContainer' => '<div class="mb-4 {{containerClass}} {{type}}{{required}}" {{attrs}}>{{content}}</div>',
                'inputContainerError' => '<div class="mb-4 {{containerClass}} {{type}}{{required}} error">{{content}}{{error}}</div>',

                // ---- LABELI ----
                'label' => '<label class="block mb-1 text-sm font-medium text-slate-700" {{attrs}}>{{text}}</label>',
                'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',

                // ostalo pusti skoraj default:
                'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
                'legend' => '<legend>{{text}}</legend>',
                'multicheckboxTitle' => '<legend>{{text}}</legend>',
                'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
                'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
                'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
                'radioWrapper' => '{{label}}',
                'submitContainer' => '<div class="mt-4">{{content}}</div>',

                // JS za postLink
                'confirmJs' => '{{confirm}}',
                'postLinkJs'
                => 'document.getElementById("{{linkId}}").addEventListener("click", function(event) { {{content}} });',

                // classi (lahko ostanejo default ali jih potem po želji zamenjaš)
                'selectedClass' => 'selected',
                'requiredClass' => 'required',
                'errorClass' => 'form-error',
                'hiddenClass' => '',
                // pomembno: tukaj lahko dodaš recimo bt-form-group, če želiš:
                'containerClass' => 'input',
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
