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

class Jk_Weather extends Module
{
    public function __construct()
    {
        $this->name = 'jk_weather';
        $this->tab = 'others';
        $this->version = '1.0.0';
        $this->author = 'Jorge Kassabji';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Weather JK API');
        $this->description = $this->l('Weather JK API Description');

        $this->confirmUninstall = $this->l('Are you sure?');
    }

    public function install()
    {
        if (!parent::install() || !$this->registerHook('displayNav1')) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }

        return true;
    }

    public function callApi($ip)
    {
        $url_ll = 'http://api.ipstack.com/'.$ip.'?access_key=cd1f64ee92bafa5e84e9ba06ece3e75c&format=1';
        $curl_ll = curl_init();

        curl_setopt($curl_ll, CURLOPT_URL, $url_ll);
        curl_setopt($curl_ll, CURLOPT_RETURNTRANSFER , true);

		$response_ll = curl_exec($curl_ll);

		curl_close($curl_ll);

        return json_decode($response_ll);
    }

    public function callApiLatitudeLongitude($latitude, $longitude)
    {

        $url = 'api.openweathermap.org/data/2.5/weather?lat='.$latitude.'&lon='.$longitude.'&appid=408f0dcb6b748342ae844e339cc76674';
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($curl);

		curl_close($curl);

        return json_decode($response);
    }

    public function hookDisplayNav1($params)
    {
        $ip = Tools::getRemoteAddr();

        $data_ll = $this->callApi($ip);

        $latitude = $data_ll->latitude;
        $longitude = $data_ll->longitude;

        $data_w = $this->callApiLatitudeLongitude($latitude, $longitude);

        $this->context->smarty->assign(array(
            'name' => $data_ll->city,
            'temp' => ($data_w->main->temp) - 273,
            'pressure' => $data_w->main->pressure,
            'humidity' => $data_w->main->humidity,
        ));

        return $this->display(__FILE__, 'nav.tpl');
    }
}