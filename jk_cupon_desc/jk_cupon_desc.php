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

class Jk_Cupon_Desc extends Module
{
    public function __construct()
    {
        $this->name = 'jk_cupon_desc';
        $this->tab = 'others';
        $this->version = '1.0.0';
        $this->author = 'Jorge Kassabji';
        
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Cupon de Descuento');
        $this->description = $this->l('Descripcion Cupon de Descuento');

        $this->confirmUninstall = $this->l('Esta seguro que desea desinstalar?');
        
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        if (!parent::install() || !Configuration::updateValue('JK_RECURRENCIA', '0') || !Configuration::updateValue('JK_TIPO_IMPORTE', '') || !Configuration::updateValue('JK_IMPORTE', '0') || !$this->install_db() || !$this->registerhook('displayOrderConfirmation1'))
        {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() || !$this->uninstall_db() || !$this->unregisterhook('displayOrderConfirmation1')) {
            return false;
        }

        return true;
    }

    public function install_db()
    {
        Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'cupones_desc` (
                `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `user_id` INT(6) NOT NULL,
                `cupon_code` VARCHAR(30) NOT NULL,
                `cupon_date` DATE NOT NULL,
                `cupon_amount` INT(20) NOT NULL,
                `operation_type` INT(1) NOT NULL
            );
        ');

        return true;
    }

    public function uninstall_db()
    {
        Db::getInstance()->execute('
            DROP TABLE `'._DB_PREFIX_.'cupones_desc`
        ');

        return true;
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
                    'label' => $this->l('Recurrencia'),
                    'name' => 'recurrencia',
                    'size' => 20,
                ],
                [
                    'type' => 'select',
                    'label' => $this->l('Tipo de Importe'),
                    'desc' => $this->l('Seleccione un tipo de evaluacion'),
                    'name' => 'tipo_importe',
                    'required' => true,
                    'options' => array(
                        'query' => $idtipo = array(
                            array(
                                'idtipo' => 1,
                                'name' => 'Porcentaje',
                            ),
                            array(
                                'idtipo' => 2,
                                'name' => 'Importe Fijo',
                            ),
                        ),
                        'id' => 'idtipo',
                        'name' => 'name'
                    )
                ],
                [
                    'type' => 'text',
                    'label' => $this->l('Importe'),
                    'name' => 'importe',
                    'size' => 20,
                ]
            ],
            'submit' => [
                'title' => $this->l('Guardar'),
                'class' => 'btn btn-default pull-right'
            ],
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

        $helper->fields_value['recurrencia'] = Configuration::get('JK_RECURRENCIA');
        $helper->fields_value['tipo_importe'] = Configuration::get('JK_TIPO_IMPORTE');
        $helper->fields_value['importe'] = Configuration::get('JK_IMPORTE');

        #Consulta

        $cupones_otorgados = Db::getInstance()->executeS('
            select '._DB_PREFIX_.'customer.id_customer as user_id , '._DB_PREFIX_.'customer.firstname as nombre, '._DB_PREFIX_.'customer.lastname as apellido, '._DB_PREFIX_.'customer.email as correo, '._DB_PREFIX_.'cupones_desc.cupon_code as cupon, '._DB_PREFIX_.'cupones_desc.cupon_date as fecha
            from '._DB_PREFIX_.'cupones_desc, '._DB_PREFIX_.'customer
            where '._DB_PREFIX_.'cupones_desc.user_id = '._DB_PREFIX_.'customer.id_customer 
        ');

        $helper->context->smarty->assign('cupones', $cupones_otorgados);

        return $helper->generateForm($fieldsForm) . $this->display(__FILE__, '/views/templates/admin/config.tpl');
    }

    public function postProcess()
    {
        if (Tools::isSubmit('submit')) {
            $recurrencia = Tools::getValue('recurrencia');
            $tipo_importe = Tools::getValue('tipo_importe');
            $importe = Tools::getValue('importe');
            $error = 0;
            $error_txt = '';

            if (!Validate::isInt($importe)) {
                $error++;
                $error_txt .= (($error_txt != '')? ", ": "").$this->l('Importe no es Numero');
            } else{
                if ($importe < 0) {
                    $error++;
                    $error_txt .= (($error_txt != '')? ", ": "").$this->l('Importe Negativo');
                }
            }

            if (!Validate::isInt($recurrencia)) {
                $error++;
                $error_txt .= (($error_txt != '')? ", ": "").$this->l('Recurrencia no es Numero');
            } else{
                if ($recurrencia < 0) {
                    $error++;
                    $error_txt .= (($error_txt != '')? ", ": "").$this->l('Recurrencia Negativo');
                }
            }

            if ($error > 0) {
                return $this->displayError($this->l('Error mientras se realizaban las validaciones: ').$error_txt);
            } else {
                Configuration::updateValue('JK_RECURRENCIA', $recurrencia);
                Configuration::updateValue('JK_TIPO_IMPORTE', $tipo_importe);
                Configuration::updateValue('JK_IMPORTE', $importe);

                return $this->displayConfirmation($this->l('Actualizacion Exitosa'));
            }
        }
        
    }

    public function hookdisplayOrderConfirmation1($params)
        {
            $id_order = (int) Tools::getValue('id_order');
            $order = new Order($id_order);

            $customer = $order->id_customer;

            $cupon = Db::getInstance()->executeS('
                select cupon_code, cupon_amount, operation_type
                from '._DB_PREFIX_.'cupones_desc
                where user_id = '.$customer.';
            ');

            $operacion = $cupon[0]['operation_type'];

            $cupon_txt = '';

            if ($operacion == 1) {
                $cupon_txt = '%';
            } elseif ($operacion == 2) {
                $cupon_txt = 'USD';
            }

            $this->context->smarty->assign(array(
                'id_orden' => $id_order,
                'id_customer' => $order->id_customer,
                'codigo_cupon' => $cupon[0]['cupon_code'],
                'monto_cupon' => $cupon[0]['cupon_amount'],
                'operacion' => $cupon_txt,
            ));

            return $this->display(__FILE__, 'views/templates/hook/orderdetail.tpl');
        }

}