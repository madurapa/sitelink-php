<?php $this->load->view('inc/steps'); ?>
<?php if ($error_status == 1) { ?>
    <div class="row">
        <div class="col-lg-12 bs-example bs-example-bg-classes">
            <p class="bg-danger"><?= $error_message; ?></p>
        </div>
    </div>
<?php } ?>
<div class="row">
    <div class="col-lg-12">
        <h2>Storage Unit <?= $type_text; ?></h2>
        <p>To complete your <?= $type_text; ?>, please fill out all of the fields listed below and press the
            'Confirm <?= $type_text; ?>'
            button.</p>
        <p>* = required field</p>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default panel-payment">
            <div class="panel-heading">
                <h2 class="panel-title">Facility Information</h2>
            </div>
            <ul class="list-group">
                <li class="list-group-item clearfix">
                    <div class="col-md-4">Name:</div>
                    <div class="col-md-8"><strong><?php echo $site_information['sSiteName']; ?></strong></div>
                </li>
                <li class="list-group-item clearfix">
                    <div class="col-md-4">Address:</div>
                    <div class="col-md-8"><strong><?php echo $site_information['sSiteAddr1']; ?></strong></div>
                </li>
                <li class="list-group-item clearfix">
                    <div class="col-md-4">City/State/Postal:</div>
                    <div class="col-md-8"><strong><?php echo $site_information['sSiteCity']; ?>
                            /<?php echo $site_information['sSiteRegion']; ?>
                            /<?php echo $site_information['sSitePostalCode']; ?></strong></div>
                </li>
                <li class="list-group-item clearfix">
                    <div class="col-md-4">Phone:</div>
                    <div class="col-md-8"><strong><?php echo $site_information['sSitePhone']; ?></strong></div>
                </li>
                <!--<li class="list-group-item clearfix">
                    <div class="col-md-4">Office Hours:</div>
                    <div class="col-md-8"><strong><?php /*echo $site_information['sSiteName']; */ ?></strong></div>
                </li>-->
            </ul>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default panel-payment">
            <div class="panel-heading">
                <h2 class="panel-title">Unit &amp; Rate Information</h2>
            </div>
            <ul class="list-group">
                <li class="list-group-item clearfix">
                    <div class="col-md-4">Move-in Date:</div>
                    <div class="col-md-8"><strong><?php echo $this->session->date; ?></strong></div>
                </li>
                <li class="list-group-item clearfix">
                    <div class="col-md-4">Unit Type:</div>
                    <div class="col-md-8"><strong><?php echo $unit_information['sTypeName']; ?></strong></div>
                </li>
                <li class="list-group-item clearfix">
                    <div class="col-md-4">Unit Size:</div>
                    <div class="col-md-8"><strong><?php echo number_format($unit_information['dcWidth']); ?>
                            x <?php echo number_format($unit_information['dcLength']); ?></strong></div>
                </li>
                <li class="list-group-item clearfix">
                    <div class="col-md-4"><?= ($type == 1) ? 'Reservation Fee' : 'Unit Rate'; ?>:</div>
                    <div class="col-md-8">
                        <strong>
                            <?php if (number_format($price, 2) == 0.00) { ?>
                                Free
                            <?php } else { ?>
                                <?php echo number_format($price, 2); ?> CAD
                            <?php } ?>
                            <?php if ($type != 1) { ?> / 28 days (includes 15% tax) <?php } ?>
                        </strong>
                    </div>
                </li>
                <!--<li class="list-group-item clearfix">
                    <div class="col-md-4">Total Charge:</div>
                    <div class="col-md-8"><strong><?php /*echo $site_information['sSiteName']; */ ?></strong></div>
                </li>-->
            </ul>
        </div>
    </div>


</div>

<hr>

<?php echo form_open('step_four', array('class' => 'form-horizontal')); ?>
<div class="row">
    <div class="col-lg-6">
        <div class="title-info">
            <h3>Contact Information</h3>
            <p>The email address and password that you enter below will be used as the log-in information for your
                storage account.</p>
        </div>
        <div class="form-group <?= (form_error('first_name')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">* First Name</label>
            <div class="col-sm-9">
                <?php echo form_input('first_name', set_value('first_name'), array('class' => 'form-control', 'placeholder' => 'First Name')) ?>
            </div>
            <?php echo form_error('first_name', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
        <div class="form-group <?= (form_error('last_name')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">* Last Name</label>
            <div class="col-sm-9">
                <?php echo form_input('last_name', set_value('last_name'), array('class' => 'form-control', 'placeholder' => 'Last Name')) ?>
            </div>
            <?php echo form_error('last_name', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">&nbsp;&nbsp;Company</label>
            <div class="col-sm-9">
                <?php echo form_input('company', set_value('company'), array('class' => 'form-control', 'placeholder' => 'Company')) ?>
            </div>
        </div>
        <div class="form-group <?= (form_error('address_1')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">* Address 1</label>
            <div class="col-sm-9">
                <?php echo form_input('address_1', set_value('address_1'), array('class' => 'form-control', 'placeholder' => 'Address 1')) ?>
            </div>
            <?php echo form_error('address_1', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">&nbsp;&nbsp;Address 2</label>
            <div class="col-sm-9">
                <?php echo form_input('address_2', set_value('address_2'), array('class' => 'form-control', 'placeholder' => 'Address 2')) ?>
            </div>
        </div>
        <div class="form-group <?= (form_error('city')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">* City</label>
            <div class="col-sm-9">
                <?php echo form_input('city', set_value('city'), array('class' => 'form-control', 'placeholder' => 'City')) ?>
            </div>
            <?php echo form_error('city', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
        <div class="form-group <?= (form_error('state')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">&nbsp;&nbsp;State/Province</label>
            <div class="col-sm-4">
                <?php echo form_dropdown('state', $states, set_value('state', ''), array('class' => 'form-control')); ?>
            </div>
            <label class="col-sm-5 control-label info-label">Required for US & Canada</label>
            <?php echo form_error('state', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
        <div class="form-group <?= (form_error('country')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">* Country</label>
            <div class="col-sm-9">
                <?php echo form_dropdown('country', $countries, set_value('country', ''), array('class' => 'form-control')); ?>
            </div>
            <?php echo form_error('country', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
        <div class="form-group <?= (form_error('region')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">&nbsp;&nbsp;Country/Region</label>
            <div class="col-sm-4">
                <?php echo form_input('region', set_value('region'), array('class' => 'form-control', 'placeholder' => 'Region')) ?>
            </div>
            <label class="col-sm-5 control-label info-label">Required if not in US or Canada</label>
            <?php echo form_error('region', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
        <div class="form-group <?= (form_error('postal')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">* Postal/Zip</label>
            <div class="col-sm-9">
                <?php echo form_input('postal', set_value('postal'), array('class' => 'form-control', 'placeholder' => 'Postal')) ?>
            </div>
            <?php echo form_error('postal', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
        <div class="form-group <?= (form_error('phone')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">* Phone</label>
            <div class="col-sm-9">
                <?php echo form_input('phone', set_value('phone'), array('class' => 'form-control', 'placeholder' => 'Phone')) ?>
            </div>
            <?php echo form_error('phone', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">&nbsp;&nbsp;Fax</label>
            <div class="col-sm-9">
                <?php echo form_input('fax', set_value('fax'), array('class' => 'form-control', 'placeholder' => 'Fax')) ?>
            </div>
        </div>
        <div class="form-group <?= (form_error('email')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">* Email</label>
            <div class="col-sm-4">
                <?php echo form_input('email', set_value('email'), array('class' => 'form-control', 'placeholder' => 'Email')) ?>
            </div>
            <label class="col-sm-5 control-label info-label">The username for your account</label>
            <?php echo form_error('email', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
        <div class="form-group <?= (form_error('password')) ? 'has-error' : '' ?>">
            <label for="inputEmail3" class="col-sm-3 control-label">* Password</label>
            <div class="col-sm-4">
                <?php echo form_password('password', '', array('class' => 'form-control', 'placeholder' => 'Password')) ?>
            </div>
            <label class="col-sm-5 control-label info-label">Between 6 - 10 chars / numbers & letters only</label>
            <?php echo form_error('password', '<span class="help-block col-sm-offset-3 col-sm-9">', '</span>'); ?>
        </div>
    </div>
    <div class="col-lg-6">
        <?php if (number_format($price, 2) != 0.00) { ?>
            <div class="title-info">
                <h3>Billing Information</h3>
                <p>Enter your billing information. Make sure you have entered your credit card information
                    correctly.</p>
            </div>
            <div class="form-group <?= (form_error('card_name')) ? 'has-error' : '' ?>">
                <label for="inputEmail3" class="col-sm-4 control-label">* Name on Card</label>
                <div class="col-sm-8">
                    <?php echo form_input('card_name', set_value('card_name'), array('class' => 'form-control', 'placeholder' => 'Name on Card')) ?>
                </div>
                <?php echo form_error('card_name', '<span class="help-block col-sm-offset-4 col-sm-8">', '</span>'); ?>
            </div>
            <div class="form-group <?= (form_error('card_address')) ? 'has-error' : '' ?>">
                <label for="inputEmail3" class="col-sm-4 control-label">* Street Address</label>
                <div class="col-sm-8">
                    <?php echo form_input('card_address', set_value('card_address'), array('class' => 'form-control', 'placeholder' => 'Street Address')) ?>
                </div>
                <?php echo form_error('card_address', '<span class="help-block col-sm-offset-4 col-sm-8">', '</span>'); ?>
            </div>
            <div class="form-group <?= (form_error('card_postal')) ? 'has-error' : '' ?>">
                <label for="inputEmail3" class="col-sm-4 control-label">* Postal/Zip</label>
                <div class="col-sm-8">
                    <?php echo form_input('card_postal', set_value('card_postal'), array('class' => 'form-control', 'placeholder' => 'Postal/Zip')) ?>
                </div>
                <?php echo form_error('card_postal', '<span class="help-block col-sm-offset-4 col-sm-8">', '</span>'); ?>
            </div>
            <div class="form-group <?= (form_error('card_type')) ? 'has-error' : '' ?>">
                <label for="inputEmail3" class="col-sm-4 control-label">* Card Type</label>
                <div class="col-sm-8">
                    <?php echo form_dropdown('card_type', $card_types, set_value('card_type', ''), array('class' => 'form-control')); ?>
                </div>
                <?php echo form_error('card_type', '<span class="help-block col-sm-offset-4 col-sm-8">', '</span>'); ?>
            </div>
            <div class="form-group <?= (form_error('card_number')) ? 'has-error' : '' ?>">
                <label for="inputEmail3" class="col-sm-4 control-label">* Card Number</label>
                <div class="col-sm-8">
                    <?php echo form_input('card_number', set_value('card_number'), array('class' => 'form-control', 'placeholder' => 'Card Number')) ?>
                </div>
                <?php echo form_error('card_number', '<span class="help-block col-sm-offset-4 col-sm-8">', '</span>'); ?>
            </div>
            <div class="form-group <?= (form_error('card_cvv')) ? 'has-error' : '' ?>">
                <label for="inputEmail3" class="col-sm-4 control-label">* CVV Number</label>
                <div class="col-sm-8">
                    <?php echo form_input('card_cvv', set_value('card_cvv'), array('class' => 'form-control', 'placeholder' => 'CVV Number')) ?>
                </div>
                <?php echo form_error('', '<span class="help-block col-sm-offset-4 col-sm-8">', '</span>'); ?>
            </div>
            <div class="form-group <?= (form_error('card_month') || form_error('card_year')) ? 'has-error' : '' ?>">
                <label for="inputEmail3" class="col-sm-4 control-label">* Expire Date</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown('card_month', $card_months, set_value('card_month', ''), array('class' => 'form-control')); ?>
                </div>
                <div class="col-sm-4">
                    <?php echo form_dropdown('card_year', $card_years, set_value('card_year', ''), array('class' => 'form-control')); ?>
                </div>
                <?php echo form_error('card_month', '<span class="help-block col-sm-offset-4 col-sm-8">', '</span>'); ?>
                <?php echo form_error('card_year', '<span class="help-block col-sm-offset-4 col-sm-8">', '</span>'); ?>
            </div>
            <h3>&nbsp;</h3>
        <?php } ?>
        <div class="title-info">
            <h3>Comments / Other Information</h3>
            <p>
                24 hours security monitoring //
                No hidden fees //
                Trusted by over 50,000 renters over 35 years //
                Easily reserve and pay for storage units online.
            </p>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-5 control-label">&nbsp;&nbsp;Comment</label>
            <div class="col-sm-7">
                <?php echo form_textarea(array('name' => 'comment', 'rows' => 5), set_value('comment'), array('class' => 'form-control', 'placeholder' => 'Comment')) ?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-5 control-label">&nbsp;&nbsp;How did you hear about us?</label>
            <div class="col-sm-7">
                <?php echo form_dropdown('hear_about', $arr_hear_about, set_value('hear_about', ''), array('class' => 'form-control')); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-offset-6 col-lg-6">
        <?php echo form_submit('confirm_btn', 'Confirm ' . $type_text, array('class' => 'btn btn-primary pull-right')); ?>
    </div>
</div>
<?php echo form_hidden('is_submit', TRUE); ?>
<?php echo form_close(); ?>
