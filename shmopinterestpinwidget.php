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
 *  @author    Shopmods
 *  @copyright 2016 Shopmods
 *  @license   license.txt
 */

if (!defined('_PS_VERSION_')) exit;

class ShmoPinterestPinWidget extends Module {

	protected $errors = array();

	protected $config = array(
		'SHMO_PINTEREST_PIN_WIDGET' => '',
		'SHMO_PINTEREST_PIN_WIDGET_URL' => '',
		'SHMO_PINTEREST_PIN_WIDGET_LANGUAGE' => '',
		'SHMO_PINTEREST_PIN_WIDGET_SIZE' => '',
		'SHMO_PINTEREST_PIN_WIDGET_HIDE_DESC' => ''
		);

	public function __construct()
	{
		$this->name = 'shmopinterestpinwidget';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Shopmods';
		$this->need_instance = 0;
		$this->bootstrap = true;
		parent::__construct();
		$this->displayName = $this->l('Pinterest Pin Widget by Shopmods');
		$this->description = $this->l('Adds a block with Pinterest Pin Widget');
		$this->confirmUninstall = $this->l('Are you sure you want to delete Pinterest Pin Widget by Shopmods?');
	}

	public function install()
	{
		if (Shop::isFeatureActive()) Shop::setContext(Shop::CONTEXT_ALL);
		if (!parent::install()
		|| !$this->installConfig()
		|| !$this->registerHook('displayHeader')
		|| !$this->registerHook('displayTop')
		|| !$this->registerHook('displayHome')
		|| !$this->registerHook('displayLeftColumn')
		|| !$this->registerHook('displayRightColumn')
		|| !$this->registerHook('displayFooter'))
			return false;
		return true;
	}

	public function uninstall()
	{
		if (!parent::uninstall()
		||	!$this->removeConfig())
			return false;
		return true;
	}

	private function installConfig()
	{
		foreach ($this->config as $keyname => $value)
			Configuration::updateValue(Tools::strtoupper($keyname), $value);
		return true;
	}

	private function removeConfig()
	{
		foreach ($this->config as $keyname)
			Configuration::deleteByName(Tools::strtoupper($keyname));
		return true;
	}

	public function getConfig()
	{
		$config_keys = array_keys($this->config);
		return Configuration::getMultiple($config_keys);
	}

	public function getContent()
	{
		$output = null;
		if (Tools::isSubmit('submitshmopinterestpinwidget'))
		{
			foreach (Tools::getValue('config') as $key => $value)
				Configuration::updateValue($key, $value);
			if ($this->errors)
				$output .= $this->displayError(implode($this->errors, '<br/>'));
			else
				$output .= $this->displayConfirmation($this->l('Settings updated'));
		}
		$vars = array();
		$vars['config'] = $this->getConfig();
		return $output.$this->displayForm($vars);
	}

	public function displayForm($vars)
	{
		extract($vars);
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$pinterest_pin_widget_form = null;
		$pinterest_pin_widget_form[0]['form'] = array(
			'legend' => array(
				'title' => $this->l('Settings'),
				'icon' => 'icon-cogs'
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'config[SHMO_PINTEREST_PIN_WIDGET]',
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
					'name' => 'config[SHMO_PINTEREST_PIN_WIDGET_URL]',
					'label' => $this->l('Pin Widget URL'),
					'hint' => 'e.g. https://www.pinterest.com/pin/99360735500167749/',
					'required' => false
				),
				array(
					'type' => 'select',
					'name' => 'config[SHMO_PINTEREST_PIN_WIDGET_LANGUAGE]',
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
					'name' => 'config[SHMO_PINTEREST_PIN_WIDGET_SIZE]',
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
					'name' => 'config[SHMO_PINTEREST_PIN_WIDGET_HIDE_DESC]',
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
		);
		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = $this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->title = $this->displayName;
		$helper->show_toolbar = true;
		$helper->toolbar_scroll = true;
		$helper->submit_action = 'submit'.$this->name;
		$helper->toolbar_btn = array(
			'save' =>
			array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
				'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'back' => array(
				'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
				'desc' => $this->l('Back to list')
			)
		);
		$helper->fields_value['config[SHMO_PINTEREST_PIN_WIDGET]'] = Configuration::get('SHMO_PINTEREST_PIN_WIDGET');
		$helper->fields_value['config[SHMO_PINTEREST_PIN_WIDGET_URL]'] = Configuration::get('SHMO_PINTEREST_PIN_WIDGET_URL');
		$helper->fields_value['config[SHMO_PINTEREST_PIN_WIDGET_LANGUAGE]'] = Configuration::get('SHMO_PINTEREST_PIN_WIDGET_LANGUAGE');
		$helper->fields_value['config[SHMO_PINTEREST_PIN_WIDGET_SIZE]'] = Configuration::get('SHMO_PINTEREST_PIN_WIDGET_SIZE');
		$helper->fields_value['config[SHMO_PINTEREST_PIN_WIDGET_HIDE_DESC]'] = Configuration::get('SHMO_PINTEREST_PIN_WIDGET_HIDE_DESC');

		return $helper->generateForm($pinterest_pin_widget_form);
	}

	public function hookDisplayLeftColumn()
	{
		$config = $this->getConfig();
		$this->context->smarty->assign(array(
			'shmoPntrstPnWdgt' => $config
		));
		if (Configuration::get('SHMO_PINTEREST_PIN_WIDGET'))
			$this->context->controller->addJS('//assets.pinterest.com/js/pinit.js');
		return $this->display(__FILE__, 'shmopinterestpinwidget.tpl');
	}

	public function hookDisplayRightColumn()
	{
		return $this->hookDisplayLeftColumn();
	}

	public function hookDisplayTop()
	{
		return $this->hookDisplayLeftColumn();
	}

	public function hookDisplayHome()
	{
		return $this->hookDisplayLeftColumn();
	}

	public function hookDisplayFooter()
	{
		return $this->hookDisplayLeftColumn();
	}

}