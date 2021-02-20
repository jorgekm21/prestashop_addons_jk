<?php
/**
* 2007-2021 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    Jorge Kassabji <jorgekm21@gmail.com>
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Popup_Jk extends Module
{
    public function __construct()
    {
        $this->name = 'popup_jk';
        $this->tab = 'others';
        $this->version = '1.0.0';
        $this->author = 'Jorge Kassabji';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Popup JK');
        $this->description = $this->l('Popup JK Descripcion');

        $this->confirmUninstall = $this->l('Esta seguro que desea desinstalar?');
        
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {

        if (!parent::install() || !$this->registerHook('displayHome') || !$this->registerHook('displayFooterBefore') || !Configuration::updateValue('JK_TITULO_HEADER', 'Bienvenidos a mi Tienda Virtual') || !Configuration::updateValue('JK_TEXTO_HEADER', 'Visite Nuestras Ofertas') || !Configuration::updateValue('JK_TITULO_FOOTER', 'Ofertas') || !Configuration::updateValue('JK_TEXTO_FOOTER', 'Obten un descuento por registro')) {
            return false;
        }

        $this->updateHookPosition('displayHome', 0 , 1);
        $this->updateHookPosition('displayFooterBefore', 0 , 1);

        return true;
    }

    public function updateHookPosition($hook_name, $way, $position) {
        $id_hook = Hook::getIdByName($hook_name);
    
        return $this->updatePosition($id_hook, $way, $position);
    }

    public function uninstall()
    {
        $this->unregisterHook('displayHome');
        $this->unregisterHook('displayFooterBefore');

        return parent::uninstall();
    }

    public function getContent()
    {
        return $this->postProcess() . $this->getForm();
    }

    public function getForm()
    {
        $fieldsForm[0]['form'] = [
        'legend' => [
            'title' => $this->displayName,
        ],
        'input' => [
            [
                'type' => 'text',
                'label' => $this->l('Titulo Header'),
                'name' => 'titulo_header',
                'size' => 20,
                'hint' => 'Titulo Mostrado en el Header',
            ],
            [
                'type' => 'text',
                'label' => $this->l('Texto Header'),
                'name' => 'texto_header',
                'size' => 100,
                'hint' => 'Texto Mostrado en el Header',
            ],
            [
                'type' => 'text',
                'label' => $this->l('Titulo Footer'),
                'name' => 'titulo_footer',
                'size' => 20,
                'hint' => 'Titulo Mostrado en el Footer',
            ],
            [
                'type' => 'text',
                'label' => $this->l('Texto Footer'),
                'name' => 'texto_footer',
                'size' => 100,
                'hint' => 'Texto Mostrado en el Footer',
            ],
        ],
        'submit' => [
            'title' => $this->l('Guardar'),
            'class' => 'btn btn-default pull-right'
        ]
    ];

    $helper = new HelperForm();

    $helper->module = $this;
    $helper->name_controller = $this->name;
    $helper->token = Tools::getAdminTokenLite('AdminModules');
    $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

    $helper->default_form_language = $defaultLang;
    $helper->allow_employee_form_lang = $defaultLang;

    $helper->title = $this->displayName;
    $helper->show_toolbar = true;
    $helper->toolbar_scroll = true;
    $helper->submit_action = 'submit';


    $helper->fields_value['titulo_header'] = Configuration::get('JK_TITULO_HEADER');
    $helper->fields_value['texto_header'] = Configuration::get('JK_TEXTO_HEADER');
    $helper->fields_value['titulo_footer'] = Configuration::get('JK_TITULO_FOOTER');
    $helper->fields_value['texto_footer'] = Configuration::get('JK_TEXTO_FOOTER');

    return $helper->generateForm($fieldsForm);

    }

    public function postProcess()
    {
        if (Tools::isSubmit('submit')) {
            $titulo_header = Tools::getValue('titulo_header');
            $texto_header = Tools::getValue('texto_header');
            $titulo_footer = Tools::getValue('titulo_footer');
            $texto_footer = Tools::getValue('texto_footer');

            Configuration::updateValue('JK_TITULO_HEADER', $titulo_header);
            Configuration::updateValue('JK_TEXTO_HEADER', $texto_header);
            Configuration::updateValue('JK_TITULO_FOOTER', $titulo_footer);
            Configuration::updateValue('JK_TEXTO_FOOTER', $texto_footer);

            return $this->displayConfirmation($this->l('Updated Succefully'));
        }
    }

    public function hookDisplayHome($params)
    {
        $titulo_header_display = Configuration::get('JK_TITULO_HEADER');
        $texto_header_display = Configuration::get('JK_TEXTO_HEADER');
        

        $this->context->smarty->assign(array(
            'titulo_header' => $titulo_header_display,
            'texto_header' => $texto_header_display,
        ));
        
        return $this->display(__FILE__, 'home.tpl');
    }

    public function hookDisplayFooterBefore($params)
    {
        $titulo_footer_display = Configuration::get('JK_TITULO_FOOTER');
        $texto_footer_display = Configuration::get('JK_TEXTO_FOOTER');

        $this->context->smarty->assign(array(
            'titulo_footer' => $titulo_footer_display,
            'texto_footer' => $texto_footer_display,
        ));

        return $this->display(__FILE__, 'footer.tpl');
    }
}