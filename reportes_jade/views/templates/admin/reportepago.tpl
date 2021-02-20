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
                    Reporte de Pago Web
                </div>
                <form action="" method="POST" id="informe_notacredito">
                    <div class="form-group">
                        <label for="">Cedula: </label>
                        <select name="cedula" id="">
                            <option value="">Seleccione la Representante que desea consultar</option>
                            {foreach from=$cedula item=rowcedula}
                            <option value="{$rowcedula.id_customer}">{$rowcedula.siret}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success col-xs-3 col-xs-offset-4" name="consulta" id="consulta">Consultar</button>
                    </div>
                </form>
                 {if ($activate == True)}
                    <center>
                        <div style="margin-top: 3rem">
                            {foreach from=$representante item=rowrepresentante}
                            <h3 class="col-xs-6">Cedula Representante: <b>{$rowrepresentante.siret}</b></h3>
                            <h3 class="col-xs-6">Nombre Representante: <b>{$rowrepresentante.firstname} {$rowrepresentante.lastname}</b></h3>
                            {/foreach}
                        </div>
                        <div class="tabla" style="margin-top: 3rem">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center">Tipo de Operacion</th>
                                <th class="text-center">Banco</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Numero de Operacion</th>
                                <th class="text-center">Monto</th>
                            </tr>
                            {foreach from=$reporte item=rowreporte}
                            <tr>
                                <td style="text-align: center">{$rowreporte.tipo_operacion}</td>
                                <td style="text-align: center">{$rowreporte.nombre_banco}</td>
                                <td style="text-align: center">{$rowreporte.fecha}</td>
                                <td style="text-align: center">{$rowreporte.num_operacion}</td>
                                <td style="text-align: center">{$rowreporte.monto}</td>
                            </tr>
                            {/foreach}
                            </table>
                            </div>
                            </center>
                 {/if}
                </div>
                </div>
                </div>