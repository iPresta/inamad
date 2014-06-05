<?php

if (!defined('_PS_VERSION_'))
    exit;

class PSPNamad extends Module
{
    public function __construct()
    {
        $this->name = 'pspnamad';
        $this->tab = 'payment_security';
        $this->version = '1.0';
        $this->author = 'PSI - PrestaShop.ir';
        $this->need_instance = 0;

        parent::__construct();

        $this->bootstrap = true;
		$this->displayName = $this->l('E_namad module');
        $this->description = $this->l('Displays E_namad in your shop.');
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        Configuration::updateValue('PSP_ENAMAD_IFRAME', '');
        Configuration::updateValue('PSP_ENAMAD_TEXT', '');
        Configuration::updateValue('PSP_ENAMAD_POSITION', 'right');
        Configuration::updateValue('PSP_ENAMAD_W', 125);
        Configuration::updateValue('PSP_ENAMAD_H', 140);
        Configuration::updateValue('PSP_ENAMAD_ZOOM', 0);



        if (!parent::install()
            || !$this->registerHook('displayHeader')
            || !$this->registerHook('displayHome')
            || !$this->registerHook('displayLeftColumn')
            || !$this->registerHook('displayRightColumn')
            || !$this->registerHook('displayTop')
			|| !$this->registerHook('displayFooter')
        )
            return false;
        return true;
    }

    public function uninstall()
    {
        parent::uninstall();
    }

    public function getContent()
    {
        $output = '';
        $iframe = '';
        if (Tools::getValue('submit'.$this->name))
        {
           
			$iframe = Tools::getValue('iframe_code');
			$text = Tools::getValue('namad_text');
			$width = (int)Tools::getValue('namad_width');
			$height = (int)Tools::getValue('namad_height');
			$position = Tools::getValue('namad_position');
			$zoom = Tools::getValue('namad_zoom');
			
			Configuration::updateValue('PSP_ENAMAD_IFRAME', $iframe, true);
			Configuration::updateValue('PSP_ENAMAD_TEXT', $text);
			Configuration::updateValue('PSP_ENAMAD_POSITION', $position);
			Configuration::updateValue('PSP_ENAMAD_W', $width);
			Configuration::updateValue('PSP_ENAMAD_H', $height);
			Configuration::updateValue('PSP_ENAMAD_ZOOM', $zoom);

			$output .= $this->displayConfirmation($this->l('Your settings have been updated.'));
        }
        return $output.$this->displayForm();
    }

    public function displayForm()
    {
        //@todo : adding description for fields
		//@todo: adding namad preview in admin
		//@todo: adding namad test picture for preview in front
		//@todo: adding padding setting fpr dive
		//@todo: adding an option to display namad in all pages
        // Get default language
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        // Init Fields form array
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Settings'),
            ),
            'input' => array(
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Iframe code'),
                    'name' => 'iframe_code',
                    'cols' => 60,
                    'rows' => 8,
                    'required' => true,
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Namad text'),
                    'name' => 'namad_text',
                    'size' => 80,
                    'required' => true
                ),
				array(
					'type' => 'text',
					'label' => $this->l('Namad Zoom out'),
					'name' => 'namad_text',
					'size' => 2,
					'required' => true
				),
                array(
                    'type' => 'text',
                    'label' => $this->l('Namad width'),
                    'name' => 'namad_width',
                    'size' => 20,
                    'required' => true
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Namad height'),
                    'name' => 'namad_height',
                    'size' => 20,
                    'required' => true
                ),
                array(
                    'type' => 'radio',
                    'label' => $this->l('Enamad position'),
                    'name' => 'namad_position',
                    'required' => true,
                    'br' => true,
                    'class' => 't',
                    'values' => array(
                        array(
                            'id' => 'pos_top',
                            'value' => 'top',
                            'label' => $this->l('Top position in home page')
                        ),
                        array(
                            'id' => 'pos_home',
                            'value' => 'home',
                            'label' => $this->l('Middle of home page')
                        ),
                        array(
                            'id' => 'pos_right',
                            'value' => 'right',
                            'label' => $this->l('right column of home page')
                        ),
                        array(
                            'id' => 'pos_left',
                            'value' => 'left',
                            'label' => $this->l('left column of home page')
                        ),
						array(
							'id' => 'pos_footer',
							'value' => 'footer',
							'label' => $this->l('footer position')
						),
                    )
                )
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
        );
        $helper = new HelperForm();
        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        // Language
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;
        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;      // false -> remove toolbar
        $helper->toolbar_scroll = true;     // yes - > Toolbar is always visible on the top of the screen.
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

        // Load current value
        $helper->fields_value['iframe_code'] = Configuration::get('PSP_ENAMAD_IFRAME');
        $helper->fields_value['namad_text'] = Configuration::get('PSP_ENAMAD_TEXT');
        $helper->fields_value['namad_width'] = Configuration::get('PSP_ENAMAD_W');
        $helper->fields_value['namad_height'] = Configuration::get('PSP_ENAMAD_H');
        $helper->fields_value['namad_position'] = Configuration::get('PSP_ENAMAD_POSITION');
		//$helper->fields_value['namad_zoom'] = Configuration::get('PSP_ENAMAD_ZOOM');

        return $helper->generateForm($fields_form);
    }

    public function hookDisplayHeader()
    {
		$zoom = 1 - (Configuration::get('PSP_ENAMAD_ZOOM') / 100);
		$this->context->smarty->assign('zoom', $zoom);
		return $this->display(__FILE__,'resizer.tpl');
    }

    public function hookDisplayHome()
    {
        if (Configuration::get('PSP_ENAMAD_POSITION') == 'home')
        {
            $this->setMedia();
            return $this->display(__FILE__,'namad.tpl');
        }
        return;
    }

    public function hookDisplayTop()
    {
        if (Configuration::get('PSP_ENAMAD_POSITION') == 'top')
        {
            $this->setMedia();
            return $this->display(__FILE__,'namad.tpl');
        }
        return;
    }

    public function hookDisplayLeftColumn()
    {
        if (Configuration::get('PSP_ENAMAD_POSITION') == 'left')
        {
            $this->setMedia();
            return $this->display(__FILE__,'namad.tpl');
        }
        return;
    }

    public function hookDisplayRightColumn()
    {
        if (Configuration::get('PSP_ENAMAD_POSITION') == 'right')
        {
            $this->setMedia();
            return $this->display(__FILE__,'namad.tpl');
        }
        return;
    }

	public function hookDisplayFooter()
	{
		if (Configuration::get('PSP_ENAMAD_POSITION') == 'footer')
		{
			$this->setMedia();
			return $this->display(__FILE__,'namad.tpl');
		}
		return;
	}
    public function setMedia()
    {
        //$this->context->controller->addJS($this->_path.'views/js/namad.js', 'media');
        $this->context->controller->addCSS($this->_path.'views/css/namad.css', 'media');
    }
}
