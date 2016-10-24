<div class="row">
    <div class="col-lg-12">
        <ul class="steps">
            <li class="<?= ($step == 1) ? 'present' : 'future' ?>">
                <?php if ($step > 1) { ?>
                    <a href="<?= base_url() ?>"><span>
                            <strong>Step 1</strong>
                            Select Storage Location
                        </span><i></i></a>
                <?php } else { ?>
                    <span>
                            <strong>Step 1</strong>
                            Select Storage Location
                        </span><i></i>
                <?php } ?>
            </li>
            <li class="<?= ($step == 2) ? 'present' : 'future' ?>">
                <?php if ($step > 2) { ?>
                    <a href="<?= base_url() ?>step_two"><span>
                            <strong>Step 2</strong>
                            Select Unit size
                        </span><i></i></a>
                <?php } else { ?>
                    <span>
                            <strong>Step 2</strong>
                            Select Unit size
                        </span><i></i>
                <?php } ?>
            </li>
            <li class="<?= ($step == 3) ? 'present' : 'future' ?>">
                <?php if ($step > 3) { ?>
                    <a href="<?= base_url() ?>step_three">
                        <span>
                            <strong>Step 3</strong>
                            Select Date
                        </span><i></i></a>
                <?php } else { ?>
                    <span>
                            <strong>Step 3</strong>
                            Select Date
                        </span><i></i>
                <?php } ?>
            </li>
            <li class="<?= ($step == 4) ? 'present' : 'future' ?>">
                        <span>
                            <strong>Step 4</strong>
                            Confirmation
                        </span><i></i>
            </li>
        </ul>
    </div>
</div>

<hr/>