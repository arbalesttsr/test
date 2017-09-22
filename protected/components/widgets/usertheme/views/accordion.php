<div class="accordion" id="<?php echo $data['id']; ?>" style="margin-bottom: 0;">
    <div class="accordion-group">
        <?php foreach ($data['elements'] as $key => $accordion) { ?>
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#<?php echo $data['id']; ?>"
                   href="#<?php echo $key; ?>">
                    <?php echo $accordion['title']; ?>
                </a>
            </div>
            <div id="<?php echo $key; ?>" class="accordion-body collapse">
                <div class="accordion-inner">
                    <?php echo $accordion['content']; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>