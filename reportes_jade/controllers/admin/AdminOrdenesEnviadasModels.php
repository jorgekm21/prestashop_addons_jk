<?php

class AdminOrdenesEnviadasModelsController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap   = true;
        parent::__construct();

    }

    public function processForm()
    {
        $gerente = $this->context->employee->id;

        $cedula = Db::getInstance()->executeS('SELECT `'._DB_PREFIX_.'customer`.`id_customer`, `'._DB_PREFIX_.'customer`.`siret` FROM `'._DB_PREFIX_.'customer`, `'._DB_PREFIX_.'employee`, `'._DB_PREFIX_.'asignaciongerente` WHERE   (`'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'employee`.`id_employee` = `'._DB_PREFIX_.'asignaciongerente`.`id_employee`) AND (`'._DB_PREFIX_.'asignaciongerente`.`id_customer` = `'._DB_PREFIX_.'customer`.`id_customer`)');
        $this->context->smarty->assign('cedula', $cedula);

        $tienda_select = Db::getInstance()->executeS('SELECT `id_shop`, `name` FROM `'._DB_PREFIX_.'shop`');
        $this->context->smarty->assign('tienda', $tienda_select);
    }

    public function processSelect()
    {
        $gerente = $this->context->employee->id;

        if(Tools::isSubmit('consulta'))
        {
            $cedula_select = Tools::getValue('cedula');
            $campana_select = Tools::getValue('campana');
            
            $reporte = Db::getInstance()->executeS('SELECT 	`product_reference`, `product_name`, `product_quantity`, `total_price_tax_incl` FROM `'._DB_PREFIX_.'order_detail`, `'._DB_PREFIX_.'orders`, `'._DB_PREFIX_.'shop`, `'._DB_PREFIX_.'asignaciongerente` WHERE  (`'._DB_PREFIX_.'asignaciongerente`.`id_customer` = '.$cedula_select.') AND (`'._DB_PREFIX_.'shop`.`id_shop` = '.$campana_select.') AND (`'._DB_PREFIX_.'shop`.`id_shop` = `'._DB_PREFIX_.'orders`.`id_shop`) AND (`'._DB_PREFIX_.'orders`.`id_order` = `'._DB_PREFIX_.'order_detail`.`id_order`) AND (`'._DB_PREFIX_.'asignaciongerente`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'orders`.`id_customer` = '.$cedula_select.')');
            $this->context->smarty->assign('reporte', $reporte);

            $this->context->smarty->assign('activate', TRUE);
        }
    }

    public function createTemplate($tpl_name) {
        if (file_exists($this->getTemplatePath() . $tpl_name) && $this->viewAccess())
                return $this->context->smarty->createTemplate($this->getTemplatePath() . $tpl_name, $this->context->smarty);
            return parent::createTemplate($tpl_name);
    }

    public function initContent(){
        parent::initContent();
        $this->processForm();
        $this->processSelect();
        $tpl = $this->createTemplate('ordenesenviadas.tpl')->fetch();
        $this->setTemplate('ordenesenviadas.tpl');

    }
}

?>