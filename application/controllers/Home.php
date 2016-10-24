<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->sess_destroy();
        $this->load->library('sitelink');
        $data['sites'] = $this->sitelink->get_storage_locations();
        $data['step'] = 1;
        $data['main_content'] = 'home';
        $this->load->view('layout', $data);
    }

    public function step_two()
    {
        if ($this->input->post('lo_code')) {
            $this->session->set_userdata('lo_code', $this->input->post('lo_code'));
            $this->session->set_userdata('lo_name', $this->input->post('lo_name'));
            $this->session->set_userdata('lo_address', $this->input->post('lo_address'));
            redirect($this->uri->uri_string());
        }

        if (!isset($this->session->lo_code)) {
            redirect('/');
        }

        $this->load->library('sitelink');
        $data['units'] = $this->sitelink->get_units_by_location_code($this->session->lo_code);
        $data['step'] = 2;
        $data['main_content'] = 'step_two';
        $this->load->view('layout', $data);
    }

    function step_three()
    {

        if ($this->input->post('is_submit') == TRUE) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_message('required', '* Please select rental start date.');
            if ($this->form_validation->run() == TRUE) {
                $this->session->set_userdata('date', $this->input->post('date'));
                redirect('step_four');
            }
        } else {

            $redirect = FALSE;

            if ($this->input->post('unit_id')) {
                $this->session->set_userdata('unit_id', $this->input->post('unit_id'));
                $redirect = TRUE;
            }
            if ($this->input->post('reserve')) {
                $this->session->set_userdata('type', 'reserve');
                $redirect = TRUE;
            } elseif ($this->input->post('rent')) {
                $this->session->set_userdata('type', 'rent');
                $redirect = TRUE;
            }

            if ($redirect == TRUE) {
                redirect($this->uri->uri_string());
            }
        }

        if (!isset($this->session->lo_code) || !isset($this->session->unit_id) || !isset($this->session->type)) {
            redirect('/');
        }

        if ($this->session->type == 'reserve') {
            $data['type'] = 1;
            $data['type_text'] = 'Reservation';
        } else {
            $data['type'] = 2;
            $data['type_text'] = 'Rental';
        }

        $this->load->library('sitelink');
        $data['date'] = $this->session->date;
        $data['step'] = 3;
        $data['main_content'] = 'step_three';
        $this->load->view('layout', $data);
    }

    function step_four()
    {
        if (!isset($this->session->lo_code) || !isset($this->session->date) || !isset($this->session->unit_id) || !isset($this->session->type)) {
            redirect('/');
        }


        $this->load->library('sitelink');
        $this->load->library('data');

        $data['error_status'] = false;
        $data['error_message'] = '';
        $data['date'] = $this->session->date;
        $data['step'] = 4;
        $data['price'] = 0;
        $formatted_date = date('Y-m-d', strtotime($this->session->date)) . 'T' . date('H:i:s', strtotime($this->session->date));
        if ($this->session->type == 'reserve') {
            $data['type'] = 1;
            $data['type_text'] = 'Reservation';
            $reservation_fee_retrieve_return = $this->sitelink->reservation_fee_retrieve($this->session->lo_code);
            foreach ($reservation_fee_retrieve_return as $reservation_fee) {
                $data['price'] = $data['price'] + $reservation_fee['dcTotal'];
            }
        } else {
            $data['type'] = 2;
            $data['type_text'] = 'Rental';
            $move_in_cost_retrieve_return = $this->sitelink->move_in_cost_retrieve($this->session->lo_code, $this->session->unit_id, $formatted_date);
            foreach ($move_in_cost_retrieve_return as $move_in_fee) {
                $data['price'] = $data['price'] + $move_in_fee['dcTotal'];
                $data['start_date_array'][] = strtotime($move_in_fee['StartDate']);
                $data['end_date_array'][] = strtotime($move_in_fee['EndDate']);
            }
            $start_date = date('Y-m-d', min($data['start_date_array'])) . 'T' . date('H:i:s', min($data['start_date_array']));
            $end_date = date('Y-m-d', max($data['end_date_array'])) . 'T' . date('H:i:s', max($data['end_date_array']));
        }

        $data['site_information'] = $this->sitelink->get_site_information($this->session->lo_code);
        $data['unit_information'] = $this->sitelink->get_units_information_by_unit_id($this->session->lo_code, $this->session->unit_id);
        $data['countries'] = array_merge(array('' => 'Select Country'), $this->data->get_countries());
        $data['states'] = array_merge(array('' => 'Select State'), $this->data->get_states());
        $data['card_types'] = $this->data->get_card_types();
        $data['card_months'] = array_merge(array('' => 'Select Month'), $this->data->get_months());
        $data['card_years'] = array_merge(array('' => 'Select Year'), $this->data->get_years());
        $data['arr_hear_about'] = array('Select Source', 'Printed Yellow Pages', 'Google Search', 'Referral', 'Other', 'Yahoo/Bing', 'Kijiji Ads', 'YellowPages.ca', 'Twitter', 'Facebook Ads', 'Previous/Existing Tenant', 'Drive-By/Signs', 'Ambassador');

        if ($this->input->post('is_submit') == TRUE) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('company', 'Company', 'trim');
            $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
            $this->form_validation->set_rules('address_2', 'Address 2', 'trim');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            if ($this->input->post('country') == 37 || $this->input->post('country') == 224) {
                $this->form_validation->set_rules('state', 'State', 'trim|required');
                $region = $data['states'][$this->input->post('state')];
            } else {
                $this->form_validation->set_rules('state', 'State', 'trim');
            }
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            if ($this->input->post('country') != 37 && $this->input->post('country') != 224) {
                $this->form_validation->set_rules('region', 'Country/Region', 'trim|required');
                $region = $this->input->post('region');
            } else {
                $this->form_validation->set_rules('region', 'Country/Region', 'trim');
            }
            $this->form_validation->set_rules('postal', 'Postal/Zip', 'trim|required');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('fax', 'Fax', 'trim');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric|min_length[6]|max_length[10]');

            if (number_format($data['price'], 2) > 0.00) {
                $this->form_validation->set_rules('card_name', 'Name On Card', 'trim|required');
                $this->form_validation->set_rules('card_address', 'Street Address', 'trim|required');
                $this->form_validation->set_rules('card_postal', 'Postal/Zip', 'trim|required');
                $this->form_validation->set_rules('card_type', 'Card Type', 'trim|required');
                $this->form_validation->set_rules('card_number', 'Card Number', 'trim|required|numeric');
                $this->form_validation->set_rules('card_cvv', 'CVV Number', 'trim|required|numeric');
                $this->form_validation->set_rules('card_month', 'Expire Month', 'trim|required');
                $this->form_validation->set_rules('card_year', 'Expire Year', 'trim|required');
            }

            $this->form_validation->set_rules('comment', 'comment', 'trim');
            $this->form_validation->set_rules('hear_about', 'hear_about', 'trim');

            if ($this->form_validation->run() == TRUE) {

                $tenant_data['lo_code'] = $this->session->lo_code;
                $tenant_data['first_name'] = $this->input->post('first_name');
                $tenant_data['last_name'] = $this->input->post('last_name');
                $tenant_data['company'] = $this->input->post('company');
                $tenant_data['address_1'] = $this->input->post('address_1');
                $tenant_data['address_2'] = $this->input->post('address_2');
                $tenant_data['city'] = $this->input->post('city');
                $tenant_data['country'] = $data['countries'][$this->input->post('country')];
                $tenant_data['region'] = $region;
                $tenant_data['postal'] = $this->input->post('postal');
                $tenant_data['phone'] = $this->input->post('phone');
                $tenant_data['fax'] = $this->input->post('fax');
                $tenant_data['email'] = $this->input->post('email');
                $tenant_data['password'] = $this->input->post('password');

                $tenant_return = $this->sitelink->add_tenant($tenant_data);

                if ($tenant_return['rt']['Ret_Code'] > 0) {

                    if ($data['type'] == 1) {
                        $reservation_data['lo_code'] = $this->session->lo_code;
                        $reservation_data['tenant_id'] = $tenant_return['data']['TenantID'];
                        $reservation_data['unit_id'] = $this->session->unit_id;
                        $reservation_data['date'] = $formatted_date;
                        $reservation_data['comment'] = $this->input->post('comment');

                        $reservation_return = $this->sitelink->add_reservation($reservation_data);

                        if ($reservation_return['rt']['Ret_Code'] > 0) {

                            if (number_format($data['price'], 2) > 0.00) {
                                $reservation_fee_data['lo_code'] = $this->session->lo_code;
                                $reservation_fee_data['tenant_id'] = $tenant_return['data']['TenantID'];
                                $reservation_fee_data['waiting_list_id'] = $reservation_return['rt']['Ret_Code'];
                                $reservation_fee_data['card_name'] = $this->input->post('card_name');
                                $reservation_fee_data['card_address'] = $this->input->post('card_address');
                                $reservation_fee_data['card_postal'] = $this->input->post('card_postal');
                                $reservation_fee_data['card_number'] = $this->input->post('card_number');
                                $reservation_fee_data['card_cvv'] = $this->input->post('card_cvv');
                                $reservation_fee_data['expiration_date'] = date('Y-m-t', strtotime('1 ' . $data['card_months'][$this->input->post('card_month')] . ' ' . $data['card_years'][$this->input->post('card_year')]));
                                $reservation_fee_data['card_type'] = $this->input->post('card_type');

                                $reservation_fee_return = $this->sitelink->add_reservation_fee($reservation_fee_data);

                                if ($reservation_fee_return['rt']['Ret_Code'] > 0) {

                                } else {
                                    $data['error_status'] = true;
                                    $data['error_message'] = $tenant_return['rt']['Ret_Msg'];
                                }
                            }

                        } else {
                            $data['error_status'] = true;
                            $data['error_message'] = $tenant_return['rt']['Ret_Msg'];
                        }

                    } else {

                        $move_in_data['lo_code'] = $this->session->lo_code;
                        $move_in_data['tenant_id'] = $tenant_return['data']['TenantID'];
                        $move_in_data['acc_id'] = $tenant_return['data']['sAccessCode'];
                        $move_in_data['unit_id'] = $this->session->unit_id;
                        $move_in_data['start_date'] = $start_date;
                        $move_in_data['end_date'] = $end_date;
                        $move_in_data['amount'] = $data['price'];
                        $move_in_data['card_name'] = $this->input->post('card_name');
                        $move_in_data['card_address'] = $this->input->post('card_address');
                        $move_in_data['card_postal'] = $this->input->post('card_postal');
                        $move_in_data['card_number'] = $this->input->post('card_number');
                        $move_in_data['card_cvv'] = $this->input->post('card_cvv');
                        $move_in_data['expiration_date'] = date('Y-m-t', strtotime('1 ' . $data['card_months'][$this->input->post('card_month')] . ' ' . $data['card_years'][$this->input->post('card_year')]));
                        $move_in_data['card_type'] = $this->input->post('card_type');

                        $move_in_return = $this->sitelink->move_in($move_in_data);

                        if ($move_in_return['rt']['Ret_Code'] > 0) {

                        } else {
                            $data['error_status'] = true;
                            $data['error_message'] = $move_in_return['rt']['Ret_Msg'];
                        }
                    }

                } else {
                    $data['error_status'] = true;
                    $data['error_message'] = $tenant_return['rt']['Ret_Msg'];
                }

                if ($data['error_status'] == false) {
                    $this->load->library('email');

                    $this->email->from('no-reply@test.com', 'Name');
                    $this->email->to($this->config->item('sitelink_emails'));

                    $this->email->subject('New ' . $data['type_text']);
                    $body = $this->load->view('emails/admin', $data, TRUE);
                    $this->email->message($body);

                    $this->email->send();

                    $this->session->set_flashdata('done', 'You have successfully booked your ' . $data['type_text']);
                    redirect('/');
                }

            }

        }

        $data['main_content'] = 'step_four';
        $this->load->view('layout', $data);
    }

}
