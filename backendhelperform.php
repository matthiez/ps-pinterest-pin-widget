<?php  if (!defined('_PS_VERSION_')) exit;

/**
 * Class BackendHelperForm
 */
class BackendHelperForm extends HelperForm {
    /**
     * BackendHelperForm constructor.
     * @param $name
     */
    public function __construct($name) {
        parent::__construct();

        $default_lang = Configuration::get('PS_LANG_DEFAULT');

        $this->module = $this;

        $this->name_controller = $name;

        $this->token = Tools::getAdminTokenLite('AdminModules');

        $this->currentIndex = AdminController::$currentIndex . '&configure=' . $name;

        $this->default_form_language = $default_lang;

        $this->allow_employee_form_lang = $default_lang;

        $this->title = $this->displayName;

        $this->show_toolbar = true;

        $this->toolbar_scroll = true;

        $this->submit_action = 'submit' . $name;

        $this->toolbar_btn = [
            'save' =>
                [
                    'desc' => $this->l('Save'),
                    'href' => AdminController::$currentIndex . '&configure=' . $name . '&save' . $name .
                        '&token=' . Tools::getAdminTokenLite('AdminModules'),
                ],
            'back' => [
                'href' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            ]
        ];

        $this->fields_value = [
            'config[PINTEREST_PIN_WIDGET]' => Configuration::get('PINTEREST_PIN_WIDGET'),
            'config[PINTEREST_PIN_WIDGET_URL]' => Configuration::get('PINTEREST_PIN_WIDGET_URL'),
            'config[PINTEREST_PIN_WIDGET_LANGUAGE]' => Configuration::get('PINTEREST_PIN_WIDGET_LANGUAGE'),
            'config[PINTEREST_PIN_WIDGET_SIZE]' => Configuration::get('PINTEREST_PIN_WIDGET_SIZE'),
            'config[PINTEREST_PIN_WIDGET_HIDE_DESC]' => Configuration::get('PINTEREST_PIN_WIDGET_HIDE_DESC')
        ];

        $this->fields_form = [ [ 'form' => [
            'legend' => [
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs'
            ],
            'input' => [
                [
                    'type' => 'switch',
                    'name' => 'config[PINTEREST_PIN_WIDGET]',
                    'label' => $this->l('Enable Pin Widget?'),
                    'hint' => $this->l('The Pin widget lets you show a Pin on your site.'),
                    'is_bool' => true,
                    'required' => false,
                    'values' => [
                        [
                            'id' => 'pin_widget_on',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ],
                        [
                            'id' => 'pin_widget_off',
                            'value' => 0,
                            'label' => $this->l('No')
                        ]
                    ]
                ],
                [
                    'type' => 'text',
                    'name' => 'config[PINTEREST_PIN_WIDGET_URL]',
                    'label' => $this->l('Pin Widget URL'),
                    'hint' => 'e.g. https://www.pinterest.com/pin/99360735500167749/',
                    'required' => false
                ],
                [
                    'type' => 'select',
                    'name' => 'config[PINTEREST_PIN_WIDGET_LANGUAGE]',
                    'label' => $this->l('Button Language'),
                    'hint' => $this->l('Determines the language of the button text'),
                    'required' => false,
                    'multiple' => false,
                    'options' => [
                        'query' => [
                            ['key' => 'en', 'name' => 'English'],
                            ['key' => 'cs', 'name' => 'Czech'],
                            ['key' => 'da', 'name' => 'Danish'],
                            ['key' => 'de', 'name' => 'German'],
                            ['key' => 'el', 'name' => 'Greek'],
                            ['key' => 'es', 'name' => 'Spanish'],
                            ['key' => 'fi', 'name' => 'Finnish'],
                            ['key' => 'fr', 'name' => 'French'],
                            ['key' => 'hi', 'name' => 'Hindu'],
                            ['key' => 'hu', 'name' => 'Hungarian'],
                            ['key' => 'id', 'name' => 'Indonesian'],
                            ['key' => 'it', 'name' => 'Italian'],
                            ['key' => 'ja', 'name' => 'Japanese'],
                            ['key' => 'ko', 'name' => 'Korean'],
                            ['key' => 'ms', 'name' => 'Malaysian'],
                            ['key' => 'nb', 'name' => 'Norwegian'],
                            ['key' => 'nl', 'name' => 'Dutch'],
                            ['key' => 'pl', 'name' => 'Polish'],
                            ['key' => 'pt', 'name' => 'Portuguese'],
                            ['key' => 'pt-br', 'name' => 'Portuguese (Brazil)'],
                            ['key' => 'ro', 'name' => 'Romanian'],
                            ['key' => 'ru', 'name' => 'Russian'],
                            ['key' => 'sk', 'name' => 'Slovak'],
                            ['key' => 'sv', 'name' => 'Swedish'],
                            ['key' => 'tl', 'name' => 'Tagalog'],
                            ['key' => 'th', 'name' => 'Thai'],
                            ['key' => 'tr', 'name' => 'Turkish'],
                            ['key' => 'uk', 'name' => 'Ukrainian'],
                            ['key' => 'vi', 'name' => 'Vietnamnese'],
                        ],
                        'id' => 'key',
                        'name' => 'name'
                    ]
                ],
                [
                    'type' => 'radio',
                    'name' => 'config[PINTEREST_PIN_WIDGET_SIZE]',
                    'label' => $this->l('Widget Width'),
                    'desc' => $this->l('Small: 236x317px - Medium: 345x398px - Large: 600x624px'),
                    'required' => false,
                    'values' => [
                        [
                            'id' => 'pin_widget_size_small',
                            'value' => '',
                            'label' => $this->l('Small')
                        ],
                        [
                            'id' => 'pin_widget_size_medium',
                            'value' => 'medium',
                            'label' => $this->l('Medium')
                        ],
                        [
                            'id' => 'pin_widget_size_large',
                            'value' => 'large',
                            'label' => $this->l('Large')
                        ],
                    ]
                ],
                [
                    'type' => 'switch',
                    'name' => 'config[PINTEREST_PIN_WIDGET_HIDE_DESC]',
                    'label' => $this->l('Hide Description?'),
                    'is_bool' => true,
                    'required' => false,
                    'values' => [
                        [
                            'id' => 'pin_widget_hide_desc_yes',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ],
                        [
                            'id' => 'pin_widget_hide_desc_no',
                            'value' => 0,
                            'label' => $this->l('No')
                        ]
                    ]
                ]
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right'
            ]
        ] ] ];
    }
}