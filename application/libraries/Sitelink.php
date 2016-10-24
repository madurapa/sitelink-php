<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitelink
{

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->config->load('sitelink');
        $this->client = new SoapClient($this->CI->config->item('sitelink_url'));
        $this->params = new stdClass();
        $this->params->sCorpCode = $this->CI->config->item('sitelink_corp_code');
        $this->params->sCorpUserName = $this->CI->config->item('sitelink_corp_login');
        $this->params->sCorpPassword = $this->CI->config->item('sitelink_corp_pass');

    }

    function xml2array($xmlObject, $out = array())
    {
        foreach ((array)$xmlObject as $index => $node)
            $out[$index] = (is_object($node)) ? $this->xml2array($node) : $node;

        return $out;
    }

    public function get_storage_locations()
    {
        $this->params->sLocationCode = $this->CI->config->item('sitelink_loc_code');
        $this->params->iCountry = -999;
        $this->params->bMiles = false;
        $this->params->sPostalCode = '';

        try {
            $sites = array();
            $data = $this->client->SiteSearchByPostalCode($this->params);
            $result = $data->SiteSearchByPostalCodeResult;
            $xml_data = new SimpleXMLElement($result->any);
            $xml_data_table = $xml_data->NewDataSet->Table;
            if (count($xml_data_table) > 0) {
                foreach ($xml_data_table as $site) {
                    $sites[] = $this->xml2array($site);
                }
                usort($sites, function ($site1, $site2) {
                    if ($site1['SiteID'] == $site2['SiteID']) return 0;
                    return $site1['SiteID'] < $site2['SiteID'] ? -1 : 1;
                });
                return $sites;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage() . '<br />' . $e);
        }


    }

    public function get_units_by_location_code($lo_code = '')
    {
        $this->params->sLocationCode = $lo_code;
        try {
            $units = array();
            $data = $this->client->UnitTypePriceList_v2($this->params);
            $result = $data->UnitTypePriceList_v2Result;
            $xml_data = new SimpleXMLElement($result->any);
            $xml_data_table = $xml_data->NewDataSet->Table;

            if (count($xml_data_table) > 0) {
                foreach ($xml_data_table as $unit) {
                    $unit = $this->xml2array($unit);
                    if ($unit['iTotalVacant'] > 0) {
                        $units[] = $unit;
                    }
                }
                usort($units, function ($unit1, $unit2) {
                    if ($unit1['UnitTypeID'] == $unit2['UnitTypeID']) return 0;
                    return $unit1['UnitTypeID'] < $unit2['UnitTypeID'] ? -1 : 1;
                });
                return $units;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage() . '<br />' . $e);
        }
    }

    public function get_site_information($lo_code = '')
    {
        $this->params->sLocationCode = $lo_code;
        try {
            $site_information = array();
            $data = $this->client->SiteInformation($this->params);
            $result = $data->SiteInformationResult;
            $xml_data = new SimpleXMLElement($result->any);
            $xml_data_table = $xml_data->NewDataSet->Table;
            if (count($xml_data_table) > 0) {
                $site_information = $this->xml2array($xml_data_table);
                return $site_information;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage() . '<br />' . $e);
        }
    }

    public function get_units_information_by_unit_id($lo_code = '', $unit_id = '')
    {
        $this->params->sLocationCode = $lo_code;
        $this->params->UnitID = $unit_id;
        try {
            $unit = array();
            $data = $this->client->UnitsInformationByUnitID($this->params);
            $result = $data->UnitsInformationByUnitIDResult;
            $xml_data = new SimpleXMLElement($result->any);
            $xml_data_table = $xml_data->NewDataSet->Table;

            if (count($xml_data_table) > 0) {
                $unit = $this->xml2array($xml_data_table);
                return $unit;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage() . '<br />' . $e);
        }
    }

    public function add_tenant($tenant_data = array())
    {
        $this->params->sLocationCode = $tenant_data['lo_code'];
        $this->params->sWebPassword = $tenant_data['password'];
        $this->params->sMrMrs = '';
        $this->params->sFName = $tenant_data['first_name'];
        $this->params->sMI = '';
        $this->params->sLName = $tenant_data['last_name'];
        $this->params->sCompany = $tenant_data['company'];
        $this->params->sAddr1 = $tenant_data['address_1'];
        $this->params->sAddr2 = $tenant_data['address_2'];
        $this->params->sCity = $tenant_data['city'];
        $this->params->sRegion = $tenant_data['region'];
        $this->params->sPostalCode = $tenant_data['postal'];
        $this->params->sCountry = $tenant_data['country'];
        $this->params->sPhone = $tenant_data['phone'];
        $this->params->sMrMrsAlt = '';
        $this->params->sFNameAlt = '';
        $this->params->sMIAlt = '';
        $this->params->sLNameAlt = '';
        $this->params->sAddr1Alt = '';
        $this->params->sAddr2Alt = '';
        $this->params->sCityAlt = '';
        $this->params->sRegionAlt = '';
        $this->params->sPostalCodeAlt = '';
        $this->params->sCountryAlt = '';
        $this->params->sPhoneAlt = '';
        $this->params->sMrMrsBus = '';
        $this->params->sFNameBus = '';
        $this->params->sMIBus = '';
        $this->params->sLNameBus = '';
        $this->params->sCompanyBus = '';
        $this->params->sAddr1Bus = '';
        $this->params->sAddr2Bus = '';
        $this->params->sCityBus = '';
        $this->params->sRegionBus = '';
        $this->params->sPostalCodeBus = '';
        $this->params->sCountryBus = '';
        $this->params->sPhoneBus = '';
        $this->params->sFax = $tenant_data['fax'];
        $this->params->sEmail = $tenant_data['email'];
        $this->params->sPager = '';
        $this->params->sMobile = '';
        $this->params->bCommercial = FALSE;
        $this->params->bCompanyIsTenant = FALSE;
        $this->params->dDOB = date('c', time());
        $this->params->sTenNote = '';
        $this->params->sLicense = '';
        $this->params->sLicRegion = '';
        $this->params->sSSN = '';

        try {
            $tenant = array();
            $data = $this->client->TenantNewDetailed($this->params);
            $result = $data->TenantNewDetailedResult;
            $xml_data = new SimpleXMLElement($result->any);
            $xml_data_rt = $xml_data->NewDataSet->RT;
            $xml_data_table = $xml_data->NewDataSet->Tenants;
            $tenant['data'] = $this->xml2array($xml_data_table);
            $tenant['rt'] = $this->xml2array($xml_data_rt);
            return $tenant;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage() . '<br />' . $e);
        }
    }

    public function add_reservation($reservation_data = array())
    {
        $this->params->sLocationCode = $reservation_data['lo_code'];
        $this->params->sTenantID = $reservation_data['tenant_id'];
        $this->params->sUnitID1 = $reservation_data['unit_id'];
        $this->params->sUnitID2 = '';
        $this->params->sUnitID3 = '';
        $this->params->dNeeded = $reservation_data['date'];
        $this->params->sComment = $reservation_data['comment'];
        $this->params->iSource = 5;

        try {
            $reservation = array();
            $data = $this->client->ReservationNewWithSource($this->params);
            $result = $data->ReservationNewWithSourceResult;
            $xml_data = new SimpleXMLElement($result->any);
            $xml_data_rt = $xml_data->NewDataSet->RT;
            $xml_data_table = $xml_data->NewDataSet->Tenants;
            $reservation['data'] = $this->xml2array($xml_data_table);
            $reservation['rt'] = $this->xml2array($xml_data_rt);
            return $reservation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage() . '<br />' . $e);
        }
    }

    public function reservation_fee_retrieve($lo_code)
    {
        $this->params->sLocationCode = $lo_code;

        try {
            $reservation_fees = array();
            $data = $this->client->ReservationFeeRetrieve($this->params);
            $result = $data->ReservationFeeRetrieveResult;
            $xml_data = new SimpleXMLElement($result->any);
            $xml_data_table = $xml_data->NewDataSet->Table;
            if (count($xml_data_table) > 0) {
                foreach ($xml_data_table as $reservation_fee) {
                    $reservation_fees[] = $this->xml2array($reservation_fee);
                }
                return $reservation_fees;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage() . '<br />' . $e);
        }
    }

    public function add_reservation_fee($reservation_fee_data = array())
    {
        $this->params->sLocationCode = $reservation_fee_data['lo_code'];
        $this->params->iTenantID = $reservation_fee_data['tenant_id'];
        $this->params->iWaitingListID = $reservation_fee_data['waiting_list_id'];
        $this->params->iCreditCardType = $reservation_fee_data['card_type'];
        $this->params->sCreditCardNumber = $reservation_fee_data['card_number'];
        $this->params->sCreditCardCVV = $reservation_fee_data['card_cvv'];
        $this->params->dExpirationDate = $reservation_fee_data['expiration_date'];
        $this->params->sBillingName = $reservation_fee_data['card_name'];
        $this->params->sBillingAddress = $reservation_fee_data['card_address'];
        $this->params->sBillingZipCode = $reservation_fee_data['card_postal'];
        $this->params->bTestMode = $this->CI->config->item('sitelink_test_mode');

        try {
            $reservation_fee = array();
            $data = $this->client->ReservationFeeAdd($this->params);
            $result = $data->ReservationFeeAddResult;
            $xml_data = new SimpleXMLElement($result->any);
            $xml_data_rt = $xml_data->NewDataSet->RT;
            $xml_data_table = $xml_data->NewDataSet->Receipts;
            $reservation_fee['data'] = $this->xml2array($xml_data_table);
            $reservation_fee['rt'] = $this->xml2array($xml_data_rt);
            return $reservation_fee;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage() . '<br />' . $e);
        }
    }

    public function move_in_cost_retrieve($lo_code, $unit_id, $date)
    {
        $this->params->sLocationCode = $lo_code;
        $this->params->iUnitID = $unit_id;
        $this->params->dMoveInDate = $date;
        try {
            $move_in_costs = array();
            $data = $this->client->MoveInCostRetrieve($this->params);
            $result = $data->MoveInCostRetrieveResult;
            $xml_data = new SimpleXMLElement($result->any);
            $xml_data_table = $xml_data->NewDataSet->Table;
            if (count($xml_data_table) > 0) {
                foreach ($xml_data_table as $move_in_cost) {
                    $move_in_costs[] = $this->xml2array($move_in_cost);
                }
                return $move_in_costs;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage() . '<br />' . $e);
        }
    }

    public function move_in($move_in_data)
    {
        $this->params->sLocationCode = $move_in_data['lo_code'];
        $this->params->TenantID = $move_in_data['tenant_id'];
        $this->params->sAccessCode = $move_in_data['acc_id'];
        $this->params->UnitID = $move_in_data['unit_id'];
        $this->params->dStartDate = $move_in_data['start_date'];
        $this->params->dEndDate = $move_in_data['end_date'];
        $this->params->dcPaymentAmount = $move_in_data['amount'];
        $this->params->iCreditCardType = $move_in_data['card_type'];
        $this->params->sCreditCardNumber = $move_in_data['card_number'];
        $this->params->sCreditCardCVV = $move_in_data['card_cvv'];
        $this->params->dExpirationDate = $move_in_data['expiration_date'];
        $this->params->sBillingName = $move_in_data['card_name'];
        $this->params->sBillingAddress = $move_in_data['card_address'];
        $this->params->sBillingZipCode = $move_in_data['card_postal'];
        $this->params->bTestMode = $this->CI->config->item('sitelink_test_mode');

        try {
            $move_in = array();
            $data = $this->client->MoveIn($this->params);
            $result = $data->MoveInResult;
            $xml_data = new SimpleXMLElement($result->any);
            $xml_data_rt = $xml_data->NewDataSet->RT;
            $xml_data_table = $xml_data->NewDataSet->Receipts;
            $move_in['data'] = $this->xml2array($xml_data_table);
            $move_in['rt'] = $this->xml2array($xml_data_rt);
            return $move_in;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage() . '<br />' . $e);
        }
    }

}