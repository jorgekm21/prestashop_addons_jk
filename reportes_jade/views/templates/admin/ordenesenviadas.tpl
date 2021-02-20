{*
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
*}

    <div class="row">
        <div class="col-lg-12">
            <div class="form-horizontal panel">
                <div class="panel-heading">
                    <i class="icon-user"></i>
                    Reporte de Detalle de Ordenes Enviadas
                </div>
                <form action="" method="POST" id="informe_notacredito">
                    <div class="form-group col-xs-6">
                        <label for="">Cedula: </label>
                        <select name="cedula" id="">
                            <option value="">Seleccione la Representante que desea consultar</option>
                            {foreach from=$cedula item=rowcedula}
                            <option value="{$rowcedula.id_customer}">{$rowcedula.siret}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="">Campana: </label>
                        <select name="campana" id="">
                            <option value="">Seleccione la Campana que desea consultar</option>
                            {foreach from=$tienda item=campana}
                            <option value="{$campana.id_shop}">{$campana.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success col-xs-3 col-xs-offset-4" name="consulta" id="consulta">Consultar</button>
                    </div>
                </form>
                {if ($activate == True)}

                <center>
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center">Codigo del Producto</th>
                            <th class="text-center">Descripcion del Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Total</th>
                        </tr>
                        {foreach from=$reporte item=rowreporte}
                        <tr>
                            <td class="text-center">{$rowreporte.product_reference}</td>
                            <td class="text-center">{$rowreporte.product_name}</td>
                            <td class="text-center">{$rowreporte.product_quantity}</td>
                            <td class="text-center">{$rowreporte.total_price_tax_incl}</td>
                        </tr>
                        {/foreach}
                        </table>
                        </center>
                
                        {/if}
                        </div>
                        </div>
                        </div>