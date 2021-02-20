<?php
/**
* 2007-2018 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*  Creado por Corcaribe Tecnologia C.A
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class lista_clientes extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'lista_clientes';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Corcaribe Tecnología C.A';
        $this->need_instance = 1;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Mi lista de clientes');
        $this->description = $this->l('Permite el control de las representantes para que administren sus clientes con los que interactuan en la zona');

        $this->confirmUninstall = $this->l('Desea Desinstalar este Módulo');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.7.2.2');
    }

    public function install()
    {
        Configuration::updateValue('lista_clientes_LIVE_MODE', false);

        include(dirname(__FILE__).'/sql/install.php');

        return parent::install() &&
            $this->registerHook('displayClientesHook');
    }

    public function uninstall()
    {
        Configuration::deleteByName('lista_clientes_LIVE_MODE');

        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall();
    }

    public function assignLista_clientesContent()
    {
        $representante = $this->context->customer->id;
		$comments = Db::getInstance()->executeS('
		SELECT * FROM `'._DB_PREFIX_.'lista_clientes`
        WHERE `id_customer` = '.(int)$representante);
        
    
        $this->context->smarty->assign('comments', $comments);
    }

    public function processClientesHook()
    {
        $representante = $this->context->customer->id;
        $url_actual = $_SERVER['REQUEST_URI'];
        if (Tools::isSubmit('mymod_PC_submmit_content')){
            $nombre = Tools::getValue('nombre');
            $apellido = Tools::getValue('apellido');
            $cedula = Tools::getValue('cedula');
            $email = Tools::getValue('email');
            $activo = Tools::getValue('activo');

            if ((Tools::isInt($cedula)) and (Tools::isMail($email))){

                $insert = array(
                'id_customer' => (int)$representante,
                'nombre' => pSQL($nombre),
                'apellido' => pSQL($apellido),
                'cedula' => (int)$cedula,
                'email' => pSQL($email),
                'activo' => (int)$activo,
                
            );

            Db::getInstance()->insert('lista_clientes', $insert);
            header('location:' . $url_actual);

            } else {

                $error = "Debe Ingresar Los Campos Solicitados correctamente y/o al menos 1 producto a ajustar";
                $this->context->smarty->assign('error', $error);
                
            }

            
        }

    }
    public function processBorrarHook()
    {

        $url_actual = $_SERVER['REQUEST_URI'];

        $tabla = "lista_clientes";
        
        if (Tools::isSubmit('borrar')){

            $seleccion = Tools::getValue('checkbox');
            foreach ($seleccion as $key) {
                Db::getInstance()->delete($tabla, 'id_lista_clientes = '.$key);
            }
            header('location:' . $url_actual);
        }
    }

    public function hookDisplayListaContent($params)
    {
        $this->processListaContent();
        
        return $this->display(__FILE__, 'displayClientesHook.tpl');
    }  


    public function hookDisplayClientesHook($params)
    { 
        if(tools::getValue('id_cms')!=6){
            return;
        }

        $this->processClientesHook();
        $this->assignLista_clientesContent();
        $this->processBorrarHook();
        return $this->display(__FILE__,'displayClientesHook.tpl');
    }
}
