<?php

class PaymentModule extends PaymentModuleCore
{
    public function validateOrder(
        $id_cart,
        $id_order_state,
        $amount_paid,
        $payment_method = 'Unknown',
        $message = null,
        $extra_vars = [],
        $currency_special = null,
        $dont_touch_amount = false,
        $secure_key = false,
        Shop $shop = null
    ) {

        parent::validateOrder(
                $id_cart,
                $id_order_state,
                $amount_paid,
                $payment_method,
                $message,
                $extra_vars,
                $currency_special,
                $dont_touch_amount,
                $secure_key,
                $shop);

        $total_compras = Db::getInstance()->executeS('
            select sum('._DB_PREFIX_.'orders.total_paid) as monto
            from '._DB_PREFIX_.'cart, '._DB_PREFIX_.'orders
            where '._DB_PREFIX_.'cart.id_customer = '._DB_PREFIX_.'orders.id_customer and '._DB_PREFIX_.'cart.id_cart = '.$id_cart.'
            ');

        $correo_comprador = Db::getInstance()->executeS('
            select distinct '._DB_PREFIX_.'customer.email as correo, '._DB_PREFIX_.'customer.id_customer as id
            from '._DB_PREFIX_.'cart, '._DB_PREFIX_.'orders, '._DB_PREFIX_.'customer
            where '._DB_PREFIX_.'cart.id_customer = '._DB_PREFIX_.'orders.id_customer and '._DB_PREFIX_.'cart.id_cart = '.$id_cart.' and '._DB_PREFIX_.'cart.id_customer = '._DB_PREFIX_.'customer.id_customer and '._DB_PREFIX_.'orders.id_customer = '._DB_PREFIX_.'customer.id_customer 
        ');

        $acumulado_total = $total_compras[0]['monto'];
        $importe_maximo = Configuration::get('JK_IMPORTE');
        $correo_customer = $correo_comprador[0]['correo'];
        $id_comprador = $correo_comprador[0]['id'];

        # Correo que envia el total gastado en la tienda
        Mail::Send(
            (int)(Configuration::get('PS_LANG_DEFAULT')), // defaut language id
            'contact', // email template file to be use
            'Gastos en Tienda', // email subject
            array(
                '{email}' => Configuration::get('PS_SHOP_EMAIL'), // sender email address
                '{message}' => 'Usted a gastado un total de ' . $acumulado_total . ' en la tienda gracias a su ultimo pedido' // email content
            ),
            Configuration::get('PS_SHOP_EMAIL'), // receiver email address
            $correo_customer, //receiver name
            NULL, //from email address
            NULL
        );

        if ($acumulado_total > $importe_maximo) {

            $cupon = rand(100001, 999999);
            $operacion = Configuration::get('JK_TIPO_IMPORTE');
            $monto = Configuration::get('JK_RECURRENCIA');

            # Detector de cupones otorgados

            $cliente_con_cupon = Db::getInstance()->executeS('
                select count(cupon_code) as total from '._DB_PREFIX_.'cupones_desc where '._DB_PREFIX_.'cupones_desc.user_id = '.$id_comprador.' ');

            if ($cliente_con_cupon[0]['total'] == 0)
            {
                $lista_cupones = Db::getInstance()->executeS('
                    select cupon_code as cupon from '._DB_PREFIX_.'cupones_desc');

                do {
                    $cupon = rand(100001, 999999);
                } while (in_array($cupon, $lista_cupones['cupon']));

                PrestaShopLogger::addLog('Merece Cupon', 1, null, 'Cart', (int) $id_cart, true);

                Db::getInstance()->execute('
                insert into '._DB_PREFIX_.'cupones_desc (user_id, cupon_code, cupon_amount, cupon_date, operation_type)
                values ('. $id_comprador .', '. $cupon .', '. $monto .', CURRENT_DATE, ' . $operacion .')
                ');

                if ($operacion == 1) {
                    $operacion_txt = '%';
                } else {
                    $operacion_txt = 'USD';
                }


                # Correo que envia el cupon
                Mail::Send(
                    (int)(Configuration::get('PS_LANG_DEFAULT')), // defaut language id
                    'contact', // email template file to be use
                    'Gastos en Tienda', // email subject
                    array(
                        '{email}' => Configuration::get('PS_SHOP_EMAIL'), // sender email address
                        '{message}' => 'Usted ha ganado un cupon gracias a su ultima compra por un valor de ' . $monto . $operacion_txt . ' aplicable a su proxima compra. El codigo de su cupon es: ' . $cupon // email content
                    ),
                    Configuration::get('PS_SHOP_EMAIL'), // receiver email address
                    $correo_customer, //receiver name
                    NULL, //from email address
                    NULL
                );

            } else {
                PrestaShopLogger::addLog('No Merece Cupon', 1, null, 'Cart', (int) $id_cart, true);
            }

        }

        return true;
    }
}