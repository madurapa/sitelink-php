<?php $this->load->view('inc/estimator'); ?>

<?php $this->load->view('inc/steps'); ?>

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
    <div class="col-lg-12">
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="javascript:void(0);" role="button" class="btn btn-info btn-filter disabled" data-all="all"
                   data-sizefrom="0" data-sizeto="0"><h1>All Sizes</h1></a>
            </div>
            <div class="btn-group" role="group">
                <a href="javascript:void(0);" role="button" class="btn btn-info btn-filter" data-all=""
                   data-sizefrom="0" data-sizeto="100"><h1>Small</h1></a>
            </div>
            <div class="btn-group" role="group">
                <a href="javascript:void(0);" role="button" class="btn btn-info btn-filter" data-all=""
                   data-sizefrom="101" data-sizeto="200"><h1>Medium</h1></a>
            </div>
            <div class="btn-group" role="group">
                <a href="javascript:void(0);" role="button" class="btn btn-info btn-filter" data-all=""
                   data-sizefrom="201" data-sizeto="300"><h1>Large</h1></a>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12">
        <table class="table" id="mprDetailDataTable">
            <thead>
            <tr>
                <th class="text-center">Unit Size</th>
                <th>Storage Type</th>
                <th class="text-center">Floor Level</th>
                <th class="text-center">Climate Controlled</th>
                <th class="text-center">Located Inside</th>
                <th class="text-right">Monthly Rate (CAD)</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($units as $unit) { ?>
                <tr data-size="<?php echo number_format($unit['dcWidth']) * number_format($unit['dcLength']); ?>">
                    <td class="text-center">
                        <h2><?php echo number_format($unit['dcWidth']); ?>
                            x <?php echo number_format($unit['dcLength']); ?></h2>
                    </td>
                    <td><span><?php echo $unit['sTypeName']; ?></span></td>
                    <td class="text-center"><span><?php echo $unit['iFloor']; ?></span></td>
                    <td class="text-center"><span><?php echo ($unit['bClimate'] == true) ? 'Yes' : 'No'; ?></span></td>
                    <td class="text-center"><span><?php echo ($unit['bInside'] == true) ? 'Yes' : 'No'; ?></span></td>
                    <td class="text-right"><span><?php echo number_format($unit['dcStdRate'], 2); ?> </span></td>
                    <td class="text-right">
                        <?php
                        echo form_open('step_three', array('class' => 'form-inline'));
                        echo form_hidden('unit_id', $unit['UnitID_FirstAvailable']);
                        echo form_submit('reserve', 'Reserve', array('class' => 'btn btn-primary'));
                        echo form_submit('rent', 'Rent Now', array('class' => 'btn btn-primary'));
                        echo form_close();
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>