<?php

class AdminReporteCierreModelsController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap   = true;
        parent::__construct();

    }

    public function processForm()
    {
        $gerente = $this->context->employee->id;

        $tienda_select = Db::getInstance()->executeS('SELECT `id_shop`, `name` FROM `'._DB_PREFIX_.'shop`');
        $this->context->smarty->assign('tienda', $tienda_select);
    }

    public function processTable()
    {
        $gerente = $this->context->employee->id;
        if (Tools::isSubmit('consulta'))
        {
            $tienda_seleccionada = Tools::getValue('campana');

            $contratostot = Db::getInstance()->executeS('SELECT COUNT(`CV_CEDULA`) AS contador FROM `'._DB_PREFIX_.'reportecierre_valija`, `'._DB_PREFIX_.'employee`, `'._DB_PREFIX_.'zonas`, `'._DB_PREFIX_.'catalogo`, `'._DB_PREFIX_.'shop` WHERE (`id_shop` = '.$tienda_seleccionada.') AND (`'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'shop`.`name` = `'._DB_PREFIX_.'catalogo`.`catalogo`) AND (`CV_ID_CATALOGO` = `id_catalogo`) AND (`'._DB_PREFIX_.'employee`.`id_employee` = `'._DB_PREFIX_.'zonas`.`id_employee`) AND (`CV_ID_ZONA` = `'._DB_PREFIX_.'zonas`.`ID_ZONA`) AND (`CV_STATUS` like "%ACEPTADO%")');
            $this->context->smarty->assign('contratostot', $contratostot);

            $contratostotr = Db::getInstance()->executeS('SELECT COUNT(`CV_CEDULA`) AS contador FROM `'._DB_PREFIX_.'reportecierre_valija`, `'._DB_PREFIX_.'employee`, `'._DB_PREFIX_.'zonas`, `'._DB_PREFIX_.'catalogo`, `'._DB_PREFIX_.'shop` WHERE (`id_shop` = '.$tienda_seleccionada.') AND (`'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'shop`.`name` = `'._DB_PREFIX_.'catalogo`.`catalogo`) AND (`CV_ID_CATALOGO` = `id_catalogo`) AND (`'._DB_PREFIX_.'employee`.`id_employee` = `'._DB_PREFIX_.'zonas`.`id_employee`) AND (`CV_ID_ZONA` = `'._DB_PREFIX_.'zonas`.`ID_ZONA`) AND (`CV_STATUS` like "%RECHAZADO%")');
            $this->context->smarty->assign('contratostotr', $contratostotr);

            $contratorechazo = Db::getInstance()->executeS('SELECT `CV_CEDULA`, `CV_NOMBRE`, `CV_OBSERVACION`, `CV_STATUS` FROM `'._DB_PREFIX_.'reportecierre_valija`, `'._DB_PREFIX_.'employee`, `'._DB_PREFIX_.'zonas`, `'._DB_PREFIX_.'catalogo`, `'._DB_PREFIX_.'shop` WHERE (`id_shop` = '.$tienda_seleccionada.') AND (`'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'shop`.`name` = `'._DB_PREFIX_.'catalogo`.`catalogo`) AND (`CV_ID_CATALOGO` = `id_catalogo`) AND (`'._DB_PREFIX_.'employee`.`id_employee` = `'._DB_PREFIX_.'zonas`.`id_employee`) AND (`CV_ID_ZONA` = `'._DB_PREFIX_.'zonas`.`ID_ZONA`) AND (`CV_STATUS` like "%RECHAZADO%")');
            $this->context->smarty->assign('contratorechazo', $contratorechazo);

            $ordenesfacturadas = Db::getInstance()->executeS('SELECT `dor_cedula`, `dor_nombre`, `dor_origen`, `dor_status` FROM `'._DB_PREFIX_.'reportecierre_detordenesr`, `'._DB_PREFIX_.'employee`, `'._DB_PREFIX_.'zonas`, `'._DB_PREFIX_.'catalogo`, `'._DB_PREFIX_.'shop` WHERE (`id_shop` = '.$tienda_seleccionada.') AND (`'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'shop`.`name` = `'._DB_PREFIX_.'catalogo`.`catalogo`) AND (`dor_id_catalogo` = `id_catalogo`) AND (`'._DB_PREFIX_.'employee`.`id_employee` = `'._DB_PREFIX_.'zonas`.`id_employee`) AND (`dor_id_zona` = `'._DB_PREFIX_.'zonas`.`ID_ZONA`) AND (`dor_status` like "%Facturada%") ORDER BY `dor_origen`');
            $this->context->smarty->assign('ordenesfacturadas', $ordenesfacturadas);

            $ordenesrechazadas = Db::getInstance()->executeS('SELECT `dor_cedula`, `dor_nombre`, `dor_origen`, `dor_status` FROM `'._DB_PREFIX_.'reportecierre_detordenesr`, `'._DB_PREFIX_.'employee`, `'._DB_PREFIX_.'zonas`, `'._DB_PREFIX_.'catalogo`, `'._DB_PREFIX_.'shop` WHERE (`id_shop` = '.$tienda_seleccionada.') AND (`'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'shop`.`name` = `'._DB_PREFIX_.'catalogo`.`catalogo`) AND (`dor_id_catalogo` = `id_catalogo`) AND (`'._DB_PREFIX_.'employee`.`id_employee` = `'._DB_PREFIX_.'zonas`.`id_employee`) AND (`dor_id_zona` = `'._DB_PREFIX_.'zonas`.`ID_ZONA`) AND NOT (`dor_status` like "%Facturada%") ORDER BY `dor_origen`');
            $this->context->smarty->assign('ordenesrechazadas', $ordenesrechazadas);

            $totordenesfacturadas = Db::getInstance()->executeS('SELECT COUNT(`dor_cedula`) AS contador FROM `'._DB_PREFIX_.'reportecierre_detordenesr`, `'._DB_PREFIX_.'employee`, `'._DB_PREFIX_.'zonas`, `'._DB_PREFIX_.'catalogo`, `'._DB_PREFIX_.'shop` WHERE (`id_shop` = '.$tienda_seleccionada.') AND (`'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'shop`.`name` = `'._DB_PREFIX_.'catalogo`.`catalogo`) AND (`dor_id_catalogo` = `id_catalogo`) AND (`'._DB_PREFIX_.'employee`.`id_employee` = `'._DB_PREFIX_.'zonas`.`id_employee`) AND (`dor_id_zona` = `'._DB_PREFIX_.'zonas`.`ID_ZONA`) AND (`dor_status` like "%Facturada%") ORDER BY `dor_origen`');
            $this->context->smarty->assign('totordenesfacturadas', $totordenesfacturadas); 

            $totordenesrechazadas = Db::getInstance()->executeS('SELECT COUNT(`dor_cedula`) AS contador FROM `'._DB_PREFIX_.'reportecierre_detordenesr`, `'._DB_PREFIX_.'employee`, `'._DB_PREFIX_.'zonas`, `'._DB_PREFIX_.'catalogo`, `'._DB_PREFIX_.'shop` WHERE (`id_shop` = '.$tienda_seleccionada.') AND (`'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'shop`.`name` = `'._DB_PREFIX_.'catalogo`.`catalogo`) AND (`dor_id_catalogo` = `id_catalogo`) AND (`'._DB_PREFIX_.'employee`.`id_employee` = `'._DB_PREFIX_.'zonas`.`id_employee`) AND (`dor_id_zona` = `'._DB_PREFIX_.'zonas`.`ID_ZONA`) AND NOT (`dor_status` like "%Facturada%") ORDER BY `dor_origen`');
            $this->context->smarty->assign('totordenesrechazadas', $totordenesrechazadas);

            $totordenes = Db::getInstance()->executeS('SELECT COUNT(`dor_cedula`) AS contador FROM `'._DB_PREFIX_.'reportecierre_detordenesr`, `'._DB_PREFIX_.'employee`, `'._DB_PREFIX_.'zonas`, `'._DB_PREFIX_.'catalogo`, `'._DB_PREFIX_.'shop` WHERE (`id_shop` = '.$tienda_seleccionada.') AND (`'._DB_PREFIX_.'employee`.`id_employee` = '.$gerente.') AND (`'._DB_PREFIX_.'shop`.`name` = `'._DB_PREFIX_.'catalogo`.`catalogo`) AND (`dor_id_catalogo` = `id_catalogo`) AND (`'._DB_PREFIX_.'employee`.`id_employee` = `'._DB_PREFIX_.'zonas`.`id_employee`) AND (`dor_id_zona` = `'._DB_PREFIX_.'zonas`.`ID_ZONA`) ORDER BY `dor_origen`');
            $this->context->smarty->assign('totordenes', $totordenes);

            $this->context->smarty->assign('activate', True);
        }

    }

    /* Funcion que crea el Template (Generica) */
    
    public function createTemplate($tpl_name) {
        if (file_exists($this->getTemplatePath() . $tpl_name) && $this->viewAccess())
                return $this->context->smarty->createTemplate($this->getTemplatePath() . $tpl_name, $this->context->smarty);
            return parent::createTemplate($tpl_name);
    }

    public function initContent(){
        parent::initContent();
        $this->processForm();
        $this->processTable();
        $tpl = $this->createTemplate('content.tpl')->fetch();
        $this->setTemplate('content.tpl');

    }
}

?>