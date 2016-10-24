<?php $this->load->view('inc/steps'); ?>

<div class="row">
    <div class="col-lg-12">
        <h2>Select <?= $type_text; ?> start date</h2>
        <p>Please click on the date that you would like to start your <?= $type_text; ?>, then press the "Continue" button below to
            enter your contact information.</p>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-6 sub-title">
        <h3><?php echo $this->session->lo_name; ?></h3>
    </div>
    <div class="col-lg-6 text-right mobile-text">
        <?php echo $this->session->lo_address; ?>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-8 col-md-offset-2">
        <div id="rental-date" data-date="<?php echo $date; ?>"></div>
    </div>
    <div class="col-lg-12">
        <p>
            <?php echo form_error('date', '<div class="text-danger text-right">', '</div>'); ?>
        </p>
        <?php
        echo form_open('step_three', array('class' => 'form-inline'));
        echo form_hidden('date', $date);
        echo form_hidden('is_submit', TRUE);
        echo form_submit('continue', 'Continue', array('class' => 'btn btn-primary pull-right'));
        echo form_close();
        ?>
    </div>
</div>