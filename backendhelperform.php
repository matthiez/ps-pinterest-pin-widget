<?php
/**
 * NOTICE OF LICENSE
 *
 * This file is licenced under the Software License Agreement.
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement.
 *
 * You must not modify, adapt or create derivative works of this source code
 *
 * @author    André Matthies
 * @copyright 2018-present André Matthies
 * @license   LICENSE
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class BackendHelperForm extends HelperForm
{
    public function __construct($name)
    {
        parent::__construct();

        $defaultLang = Configuration::get('PS_LANG_DEFAULT');

        $this->allow_employee_form_lang = $defaultLang;

        $this->currentIndex = AdminController::$currentIndex . "&configure=$name";

        $this->default_form_language = $defaultLang;

        $this->fields_form = array(array('form' => array(
            'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs'
            ),
            'input' => array(
                array(
                    'type' => 'switch',
                    'name' => 'config[EOO_PINTEREST_PIN_WIDGET]',
                    'label' => $this->l('Enable Pin Widget?'),
                    'hint' => $this->l('The Pin widget lets you show a Pin on your site.'),
                    'is_bool' => true,
                    'required' => false,
                    'values' => array(
                        array(
                            'id' => 'pin_widget_on',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ),
                        array(
                            'id' => 'pin_widget_off',
                            'value' => 0,
                            'label' => $this->l('No')
                        )
                    )
                ),
                array(
                    'type' => 'text',
                    'name' => 'config[EOO_PINTEREST_PIN_WIDGET_URL]',
                    'label' => $this->l('Pin Widget URL'),
                    'hint' => 'e.g. https://www.pinterest.com/pin/99360735500167749/',
                    'required' => true
                ),
                array(
                    'type' => 'select',
                    'name' => 'config[EOO_PINTEREST_PIN_WIDGET_LANGUAGE]',
                    'label' => $this->l('Button Language'),
                    'hint' => $this->l('Determines the language of the button text'),
                    'required' => false,
                    'multiple' => false,
                    'options' => array(
                        'query' => array(
                            array('key' => 'en', 'name' => 'English'),
                            array('key' => 'cs', 'name' => 'Czech'),
                            array('key' => 'da', 'name' => 'Danish'),
                            array('key' => 'de', 'name' => 'German'),
                            array('key' => 'el', 'name' => 'Greek'),
                            array('key' => 'es', 'name' => 'Spanish'),
                            array('key' => 'fi', 'name' => 'Finnish'),
                            array('key' => 'fr', 'name' => 'French'),
                            array('key' => 'hi', 'name' => 'Hindu'),
                            array('key' => 'hu', 'name' => 'Hungarian'),
                            array('key' => 'id', 'name' => 'Indonesian'),
                            array('key' => 'it', 'name' => 'Italian'),
                            array('key' => 'ja', 'name' => 'Japanese'),
                            array('key' => 'ko', 'name' => 'Korean'),
                            array('key' => 'ms', 'name' => 'Malaysian'),
                            array('key' => 'nb', 'name' => 'Norwegian'),
                            array('key' => 'nl', 'name' => 'Dutch'),
                            array('key' => 'pl', 'name' => 'Polish'),
                            array('key' => 'pt', 'name' => 'Portuguese'),
                            array('key' => 'pt-br', 'name' => 'Portuguese (Brazil)'),
                            array('key' => 'ro', 'name' => 'Romanian'),
                            array('key' => 'ru', 'name' => 'Russian'),
                            array('key' => 'sk', 'name' => 'Slovak'),
                            array('key' => 'sv', 'name' => 'Swedish'),
                            array('key' => 'tl', 'name' => 'Tagalog'),
                            array('key' => 'th', 'name' => 'Thai'),
                            array('key' => 'tr', 'name' => 'Turkish'),
                            array('key' => 'uk', 'name' => 'Ukrainian'),
                            array('key' => 'vi', 'name' => 'Vietnamnese'),
                        ),
                        'id' => 'key',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'radio',
                    'name' => 'config[EOO_PINTEREST_PIN_WIDGET_SIZE]',
                    'label' => $this->l('Widget Width'),
                    'desc' => $this->l('Small: 236x317px - Medium: 345x398px - Large: 600x624px'),
                    'required' => false,
                    'values' => array(
                        array(
                            'id' => 'pin_widget_size_small',
                            'value' => '',
                            'label' => $this->l('Small')
                        ),
                        array(
                            'id' => 'pin_widget_size_medium',
                            'value' => 'medium',
                            'label' => $this->l('Medium')
                        ),
                        array(
                            'id' => 'pin_widget_size_large',
                            'value' => 'large',
                            'label' => $this->l('Large')
                        ),
                    )
                ),
                array(
                    'type' => 'switch',
                    'name' => 'config[EOO_PINTEREST_PIN_WIDGET_HIDE_DESC]',
                    'label' => $this->l('Hide Description?'),
                    'is_bool' => true,
                    'required' => false,
                    'values' => array(
                        array(
                            'id' => 'pin_widget_hide_desc_yes',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ),
                        array(
                            'id' => 'pin_widget_hide_desc_no',
                            'value' => 0,
                            'label' => $this->l('No')
                        )
                    )
                )
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right'
            )
        )));

        $this->fields_value = array(
            'config[EOO_PINTEREST_PIN_WIDGET]' => Configuration::get('EOO_PINTEREST_PIN_WIDGET'),
            'config[EOO_PINTEREST_PIN_WIDGET_URL]' => Configuration::get('EOO_PINTEREST_PIN_WIDGET_URL'),
            'config[EOO_PINTEREST_PIN_WIDGET_LANGUAGE]' => Configuration::get('EOO_PINTEREST_PIN_WIDGET_LANGUAGE'),
            'config[EOO_PINTEREST_PIN_WIDGET_SIZE]' => Configuration::get('EOO_PINTEREST_PIN_WIDGET_SIZE'),
            'config[EOO_PINTEREST_PIN_WIDGET_HIDE_DESC]' => Configuration::get('EOO_PINTEREST_PIN_WIDGET_HIDE_DESC')
        );

        $this->module = $this;

        $this->name = $name;

        $this->name_controller = $name;

        $this->show_toolbar = true;

        $this->submit_action = "submit$name";

        $this->title = $name;

        $this->token = Tools::getAdminTokenLite('AdminModules');

        $this->toolbar_btn = array(
            'save' =>
                array(
                    'desc' => $this->l('Save'),
                    'href' => AdminController::$currentIndex . '&configure=' . $name . '&save' . $name .
                        '&token=' . Tools::getAdminTokenLite('AdminModules'),
                ),
            'back' => array(
                'href' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            )
        );

        $this->toolbar_scroll = true;
    }
}
