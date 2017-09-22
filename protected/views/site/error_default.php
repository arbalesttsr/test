<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = [
    'Error',
];
?>
<div class="page-header">
    <h1>Error <?php echo $model->code; ?></h1>
</div>
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <p class="text-center">
                <span class="text-danger" style="font-size:4em;">Oops!</span>
            </p>
            <p class="text-center">
                <small>
                    <?php switch (true) {
                        case ($model->code <= 404):
                            echo 'Something went wrong.';
                            break;
                        default:
                            echo 'Something went terribly wrong.';
                            break;
                    } ?>
                </small>
            </p>

            <p class="text-center"><?php echo CHtml::encode($model->message); ?></p>
        </div>
    </div>

</div>
<div class="error">

</div>