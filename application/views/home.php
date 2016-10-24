<?php if ($this->session->flashdata('done')) { ?>
    <div class="row">
        <div class="col-lg-12 bs-example bs-example-bg-classes">
            <p class="bg-success text-center"><?= $this->session->flashdata('done'); ?></p>
        </div>
    </div>
<?php } ?>

<?php $this->load->view('inc/steps'); ?>

<div class="row">
    <div class="col-lg-12">

        <?php foreach ($sites as $site) { ?>
            <div class="list-group">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-lg-5">
                            <h4 class="title-site"><?php echo $site['sSiteName'] ?></h4>
                        </div>
                        <div class="col-lg-5">
                            <?php echo $site['sSiteAddr1'] ?><br/>
                            <?php echo $site['sSiteCity'] ?> <?php echo $site['sSiteRegion'] ?> <?php echo $site['sSitePostalCode'] ?>
                            <br/>
                            <strong>Tel: <?php echo $site['sSitePhone'] ?></strong>
                        </div>
                        <div class="col-lg-2 text-right">
                            <?php
                            echo form_open('step_two');
                            echo form_hidden('lo_code', $site['sLocationCode']);
                            echo form_hidden('lo_name', $site['sSiteName']);
                            echo form_hidden('lo_address', $site['sSiteCity'] . ', ' . $site['sSiteRegion'] . ', ' . $site['sSitePostalCode'] . '<br/><strong>Tel: ' . $site['sSitePhone'] . '</strong>');
                            echo form_submit('continue', 'Continue', array('class' => 'btn btn-primary btn-site'));
                            echo form_close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
