<?php

class AdminAjustesModelsController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap   = true;
        
        parent::__construct();

    }

    public function processconsultas()
    {
        $gerente = $this->context->employee->id;

        $campana_actual = Db::getInstance()->executeS('SELECT `id_shop`, `name` FROM `'._DB_PREFIX_.'shop`, `'._DB_PREFIX_.'catalogo` WHERE (`name`=`catalogo`) and (`catalogoactivo`=1);');
        $this->context->smarty->assign('campana_actual', $campana_actual);

        $zona = Db::getInstance()->executeS('SELECT `CODIGOZONA`, `ID_ZONA` FROM '._DB_PREFIX_.'zonas WHERE id_employee = '.$gerente);
        $this->context->smarty->assign('zona', $zona);

        $campana_ajuste = Db::getInstance()->executeS('SELECT `id_shop`, `name` FROM `'._DB_PREFIX_.'shop` ORDER BY `id_shop` DESC LIMIT 2');
        $this->context->smarty->assign('campana_ajuste', $campana_ajuste);

        $motivo = Db::getInstance()->executeS('SELECT * FROM `'._DB_PREFIX_.'motivos`');
        $this->context->smarty->assign('motivo', $motivo);

        $id_nota = Db::getInstance()->executeS('SELECT * FROM `'._DB_PREFIX_.'ajustes` ORDER BY `id_ajustes` DESC LIMIT 1');
        $this->context->smarty->assign('id_nota', $id_nota);
    }

    public function processform()
    {
        $gerente = $this->context->employee->id;
        $url_actual = $_SERVER['REQUEST_URI'];
        if(Tools::isSubmit('boton'))
        {

            /* Primer GRID */

            $producto1 = Tools::getValue('producto1');
            $producto2 = Tools::getValue('producto2');
            $producto3 = Tools::getValue('producto3');
            $producto4 = Tools::getValue('producto4');
            $producto5 = Tools::getValue('producto5');
            $cantidad1 = Tools::getValue('cantidad1');
            $cantidad2 = Tools::getValue('cantidad2');
            $cantidad3 = Tools::getValue('cantidad3');
            $cantidad4 = Tools::getValue('cantidad4');
            $cantidad5 = Tools::getValue('cantidad5');
            $precio1 = Tools::getValue('precio1');
            $precio2 = Tools::getValue('precio2');
            $precio3 = Tools::getValue('precio3');
            $precio4 = Tools::getValue('precio4');
            $precio5 = Tools::getValue('precio5');
            $idmotivo1 = Tools::getValue('idmotivo1');
            $idmotivo2 = Tools::getValue('idmotivo2');
            $idmotivo3 = Tools::getValue('idmotivo3');
            $idmotivo4 = Tools::getValue('idmotivo4');
            $idmotivo5 = Tools::getValue('idmotivo5');

            /* Segundo GRID */

            $productod1 = Tools::getValue('productod1');
            $productod2 = Tools::getValue('productod2');
            $productod3 = Tools::getValue('productod3');
            $productod4 = Tools::getValue('productod4');
            $productod5 = Tools::getValue('productod5');
            $cantidadd1 = Tools::getValue('cantidadd1');
            $cantidadd2 = Tools::getValue('cantidadd2');
            $cantidadd3 = Tools::getValue('cantidadd3');
            $cantidadd4 = Tools::getValue('cantidadd4');
            $cantidadd5 = Tools::getValue('cantidadd5');
            $preciod1 = Tools::getValue('preciod1');
            $preciod2 = Tools::getValue('preciod2');
            $preciod3 = Tools::getValue('preciod3');
            $preciod4 = Tools::getValue('preciod4');
            $preciod5 = Tools::getValue('preciod5');

            $id_ajustesiguiente = (((int)(Tools::getValue('id_nota'))) + 1);
            $total = 0;
            $totald = 0;

            $camp_actual = Tools::getValue('camp_actual');
            $ced_rep = Tools::getValue('ced_rep');
            $zone = Tools::getValue('zone');
            $factura = Tools::getValue('factura');
            $camp_ajust = Tools::getValue('camp_ajust');
            $num_ajust = Tools::getValue('num_ajust');

            /* Procesamiento de DATA GRID */

            if(($producto1||$producto2||$producto3||$producto4||$producto5||$productod1||$productod2||$productod3||$productod4||$productod5) && (Tools::isInt($ced_rep)) and (Tools::isInt($num_ajust)) and (Tools::isInt($factura)))
            {
                if($producto1||$producto2||$producto3||$producto4||$producto5)
                {
                    if($producto1 && $cantidad1 && $precio1 && $idmotivo1)
                    {
                        $grid1 = array(
                            'id_ajustes' => (int)$id_ajustesiguiente,
                            'codigo_producto' => pSQL($producto1),
                            'cantidad' => (int)$cantidad1,
                            'precio' => (int)$precio1,
                            'id_motivo' => (int)$idmotivo1,
                        );

                        $total = ($total) + ($cantidad1 * $precio1);
                        Db::getInstance()->insert('detalles_ajustes', $grid1);
                    }
                    if($producto2 && $cantidad2 && $precio2 && $idmotivo2)
                    {
                        $grid2 = array(
                            'id_ajustes' => (int)$id_ajustesiguiente,
                            'codigo_producto' => pSQL($producto2),
                            'cantidad' => (int)$cantidad2,
                            'precio' => (int)$precio2,
                            'id_motivo' => (int)$idmotivo2,
                        );

                        $total = ($total) + ($cantidad2 * $precio2);
                        Db::getInstance()->insert('detalles_ajustes', $grid2);
                    }
                    if($producto3 && $cantidad3 && $precio3 && $idmotivo3)
                    {
                        $grid3 = array(
                            'id_ajustes' => (int)$id_ajustesiguiente,
                            'codigo_producto' => pSQL($producto3),
                            'cantidad' => (int)$cantidad3,
                            'precio' => (int)$precio3,
                            'id_motivo' => (int)$idmotivo3,
                        );

                        $total = ($total) + ($cantidad3 * $precio3);
                        Db::getInstance()->insert('detalles_ajustes', $grid3);
                    }
                    if($producto4 && $cantidad4 && $precio4 && $idmotivo4)
                    {
                        $grid4 = array(
                            'id_ajustes' => (int)$id_ajustesiguiente,
                            'codigo_producto' => pSQL($producto4),
                            'cantidad' => (int)$cantidad4,
                            'precio' => (int)$precio4,
                            'id_motivo' => (int)$idmotivo4,
                        );

                        $total = ($total) + ($cantidad4 * $precio4);
                        Db::getInstance()->insert('detalles_ajustes', $grid4);
                    }
                    if($producto5 && $cantidad5 && $precio5 && $idmotivo5)
                    {
                        $grid5 = array(
                            'id_ajustes' => (int)$id_ajustesiguiente,
                            'codigo_producto' => pSQL($producto5),
                            'cantidad' => (int)$cantidad5,
                            'precio' => (int)$precio5,
                            'id_motivo' => (int)$idmotivo5,
                        );

                        $total = ($total) + ($cantidad5 * $precio5);
                        Db::getInstance()->insert('detalles_ajustes', $grid5);
                    }
                }

                if($productod1||$productod2||$productod3||$productod4||$productod5)
                {
                    if($productod1 && $cantidadd1 && $preciod1)
                    {
                        $gridd1 = array(
                            'id_ajustes' => (int)$id_ajustesiguiente,
                            'codigo_producto' => pSQL($productod1),
                            'cantidad' => (int)$cantidadd1,
                            'precio' => (int)$preciod1,
                        );

                        $totald = ($totald) + ($cantidadd1 * $preciod1);
                        Db::getInstance()->insert('detalle_ajustedevuelto', $gridd1);
                    }
                    if($productod2 && $cantidadd2 && $preciod2)
                    {
                        $gridd2 = array(
                            'id_ajustes' => (int)$id_ajustesiguiente,
                            'codigo_producto' => pSQL($productod2),
                            'cantidad' => (int)$cantidadd2,
                            'precio' => (int)$preciod2,
                        );

                        $totald = ($totald) + ($cantidadd2 * $preciod2);
                        Db::getInstance()->insert('detalle_ajustedevuelto', $gridd2);
                    }
                    if($productod3 && $cantidadd3 && $preciod3)
                    {
                        $gridd3 = array(
                            'id_ajustes' => (int)$id_ajustesiguiente,
                            'codigo_producto' => pSQL($productod3),
                            'cantidad' => (int)$cantidadd3,
                            'precio' => (int)$preciod3,
                        );

                        $totald = ($totald) + ($cantidadd3 * $preciod3);
                        Db::getInstance()->insert('detalle_ajustedevuelto', $gridd3);
                    }
                    if($productod4 && $cantidadd4 && $preciod4)
                    {
                        $gridd4 = array(
                            'id_ajustes' => (int)$id_ajustesiguiente,
                            'codigo_producto' => pSQL($productod4),
                            'cantidad' => (int)$cantidadd4,
                            'precio' => (int)$preciod4,
                        );

                        $totald = ($totald) + ($cantidadd4 * $preciod4);
                        Db::getInstance()->insert('detalle_ajustedevuelto', $gridd4);
                    }
                    if($productod5 && $cantidadd5 && $preciod5)
                    {
                        $gridd5 = array(
                            'id_ajustes' => (int)$id_ajustesiguiente,
                            'codigo_producto' => pSQL($productod5),
                            'cantidad' => (int)$cantidadd5,
                            'precio' => (int)$preciod5,
                        );

                        $totald = ($totald) + ($cantidadd5 * $preciod5);
                        Db::getInstance()->insert('detalle_ajustedevuelto', $gridd5);
                    }
                }

                $diferencia = $total - $totald;
                $insert = array(
                    'id_employee' => (int)$gerente,
                    'camp_creado' => (int)$camp_actual,
                    'fecha_creado' => date('Y-m-d'),
                    'cedula_rep' => pSQL($ced_rep),
                    'id_zona' => (int)$zone,
                    'num_factura' => pSQL($factura),
                    'num_ajust' => pSQL($num_ajust),
                    'camp_factura' => (int)$camp_ajust,
                    'tot_ajuste' => (int)$total,
                    'tot_envio' => (int)$totald,
                    'tot_dif' => (int)$diferencia,

                );

                Db::getInstance()->insert('ajustes', $insert);
                header('location: ' .$url_actual);

            } else {

                $error = "Debe Ingresar Los Campos Solicitados correctamente y/o al menos 1 producto a ajustar";
                $this->context->smarty->assign('error', $error);

            }
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
        $this->processconsultas();
        $this->processform();
        $tpl = $this->createTemplate('content.tpl')->fetch();

    }
}

?>