<?php

class PSPNamad extends Module
{
	public function __construct()
	{
		$this->name = 'pspnamad';
		$this->displayName = 'E namad';
		$this->description = '';
		parent::__construct();
	}

	public function install()
	{

		parent::install();
	}

	public function getContent()
	{
		return $this->displayForm();
	}

	public function displayForm()
	{
		// Get default language
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		// Init Fields form array
		$fields_form[0]['form'] = array(
			'legend' => array(
				'title' => $this->l('Settings'),
			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Configuration value'),
					'name' => 'MYMODULE_NAME',
					'size' => 20,
					'required' => true
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
     $helper->fields_value['MYMODULE_NAME'] = Configuration::get('MYMODULE_NAME');

     return $helper->generateForm($fields_form);
}

	public function uninstall()
	{

	}

	public function hookDisplayHeader()
	{

	}

	public function hookDisplayHome()
	{

	}

	public function hookDisplayTop()
	{

	}

	public function hookDisplayLeftColumn()
	{
		$this->display(__FILE__,'namad.tpl');
	}

	public function hookDisplayRightColumn()
	{
		return $this->hookDisplayLeftColumn();
	}


}