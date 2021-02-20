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
                    Reporte de Cierre
                </div>
                <form action="" method="POST" id="informe_notacredito">
                    <div class="form-group">
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
                    <p style="margin-top: 3rem"><b>RESUMEN DE CIERRE FINAL</b></p>
                    <table class="table table-bordered" style="margin-bottom: 3rem">
                        <tr>
                            <th class="text-center">Contratos Recibidos</th>
                            <th class="text-center">Contratos Rechazados</th>
                            <th class="text-center">Ordenes Recibidas</th>
                            <th class="text-center">Ordenes Rechazadas</th>
                            <th class="text-center">Total Ordenes Facturadas</th>
                        </tr>

                        <tr>
                            <td class="text-center">
                                {foreach from=$contratostot item=rowcontrato}
                                {$rowcontrato.contador}
                                {/foreach}
                            </td>
                            <td class="text-center">
                                {foreach from=$contratostotr item=rowcontrato}
                                {$rowcontrato.contador}
                                {/foreach}
                            </td>
                            <td class="text-center">
                                {foreach from=$totordenes item=rowordenes}
                                {$rowordenes.contador}
                                {/foreach}
                            </td>
                            <td class="text-center">
                                {foreach from=$totordenesrechazadas item=rowordenes}
                                {$rowordenes.contador}
                                {/foreach}
                            </td>
                            <td class="text-center">
                                {foreach from=$totordenesfacturadas item=rowordenes}
                                {$rowordenes.contador}
                                {/foreach}
                            </td>
                        </tr>

                        </table>
                        <p><b>CONTRATOS RECHAZADOS</b></p>
                        <table class="table table-bordered" style="margin-bottom: 3rem">
                            <tr>
                                <th class="text-center">Cedula</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Observacion</th>
                            </tr>
                            {foreach from=$contratorechazo item=rowcontrato}

                            <tr>
                                <td style="text-align: center">{$rowcontrato.CV_CEDULA}</td>
                                <td style="text-align: center">{$rowcontrato.CV_NOMBRE}</td>
                                <td style="text-align: center">{$rowcontrato.CV_STATUS}</td>
                                <td style="text-align: center">{$rowcontrato.CV_OBSERVACION}</td>
                            </tr>

                            {/foreach}
                        </table>
                        <p><b>ORDENES FACTURADAS</b></p>
                        <table class="table table-bordered" style="margin-bottom: 3rem">
                            <tr>
                                <th class="text-center">Cedula</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Origen</th>
                                <th class="text-center">Status</th>
                            </tr>
                            {foreach from=$ordenesfacturadas item=rowordenes}
                            <tr>
                                <td style="text-align: center">{$rowordenes.dor_cedula}</td>
                                <td style="text-align: center">{$rowordenes.dor_nombre}</td>
                                <td style="text-align: center">{$rowordenes.dor_origen}</td>
                                <td style="text-align: center">{$rowordenes.dor_status}</td>
                            </tr>
                            {/foreach}
                        </table>
                        <p><b>ORDENES RECHAZADAS</b></p>
                        <table class="table table-bordered" style="margin-bottom: 3rem">
                            <tr>
                                <th class="text-center">Cedula</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Origen</th>
                                <th class="text-center">Status</th>
                            </tr>
                            {foreach from=$ordenesrechazadas item=rowordenes} 
                            <tr>
                                <td style="text-align: center">{$rowordenes.dor_cedula}</td>
                                <td style="text-align: center">{$rowordenes.dor_nombre}</td>
                                <td style="text-align: center">{$rowordenes.dor_origen}</td>
                                <td style="text-align: center">{$rowordenes.dor_status}</td>
                            </tr>
                            {/foreach}
                        </table>
                        </center>
                        {/if}
                        </div>
                        </div>
                        </div>