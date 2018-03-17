<?php if (!defined('_PS_VERSION_')) exit;

require_once __DIR__ . '/backendhelperform.php';

/**
 * Class PinterestPinWidget
 */
class PinterestPinWidget extends Module
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var array
     */
    protected $config = [
        'PINTEREST_PIN_WIDGET' => '',
        'PINTEREST_PIN_WIDGET_URL' => '',
        'PINTEREST_PIN_WIDGET_LANGUAGE' => '',
        'PINTEREST_PIN_WIDGET_SIZE' => '',
        'PINTEREST_PIN_WIDGET_HIDE_DESC' => ''
    ];

    /**
     * PinterestPinWidget constructor.
     */
    public function __construct() {
        $this->name = 'pinterestpinwidget';
        $this->tab = 'front_office_features';
        $this->version = '1.0.2';
        $this->author = 'Andre Matthies';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Pinterest Pin Widget');
        $this->description = $this->l('Adds a block with Pinterest Pin Widget');
    }

    /**
     * @return bool
     */
    public function install() {
        if (Shop::isFeatureActive()) Shop::setContext(Shop::CONTEXT_ALL);
        return parent::install()
            && $this->installConfig()
            && $this->registerHook('displayFooter');
    }

    /**
     * @return bool
     */
    public function uninstall() {
        return parent::uninstall()
            && $this->removeConfig();
    }

    /**
     * @return bool
     */
    private function installConfig() {
        foreach ($this->config as $k => $v) Configuration::updateValue($k, $v);
        return true;
    }

    /**
     * @return bool
     */
    private function removeConfig() {
        foreach ($this->config as $k => $v) Configuration::deleteByName($k);
        return true;
    }

    /**
     * @return mixed
     */
    public function getConfig() {
        return Configuration::getMultiple(array_keys($this->config));
    }

    /**
     * @return string
     */
    public function getContent() {
        $output = null;
        if (Tools::isSubmit('submitpinterestpinwidget')) {
            foreach (Tools::getValue('config') as $key => $value) Configuration::updateValue($key, $value);
            if ($this->errors) $output .= $this->displayError(implode($this->errors, '<br/>'));
            else $output .= $this->displayConfirmation($this->l('Settings updated'));
        }
        return $output . $this->displayForm();
    }

    /**
     * @return mixed
     */
    public function displayForm() {
        return (new BackendHelperForm($this->name))->generate();
    }

    /**
     * @return mixed
     */
    public function hookDisplayFooter() {
        $this->context->smarty->assign($this->getConfig());
        if (Configuration::get('PINTEREST_PIN_WIDGET')) $this->context->controller->addJS('//assets.pinterest.com/js/pinit.js');
        return $this->display(__FILE__, 'pinterestpinwidget.tpl');
    }

    /**
     * @return mixed
     */
    public function hookDisplayLeftColumn() {
        return $this->hookDisplayFooter();
    }

    /**
     * @return mixed
     */
    public function hookDisplayRightColumn() {
        return $this->hookDisplayFooter();
    }

    /**
     * @return mixed
     */
    public function hookDisplayTop() {
        return $this->hookDisplayFooter();
    }

    /**
     * @return mixed
     */
    public function hookDisplayHome() {
        return $this->hookDisplayFooter();
    }
}