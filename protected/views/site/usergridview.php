<div class="separator"></div>
<h3 class="glyphicons display"><i></i>User Grid View Example</h3>

<?php
$model = new Actions;
$columns = [];
foreach ($model->attributeLabels() as $key => $attribute)
    $columns[] = $key;

$columns = array_merge($columns, [
    [
        'class' => 'CButtonColumn',
        'htmlOptions' => ['style' => 'width:85px'],
        'deleteButtonImageUrl' => false,
        'updateButtonImageUrl' => false,
        'viewButtonImageUrl' => false,
        'template' => '{view}{update}{delete}',
        'buttons' => [
            'view' => [
                'options' => [
                    'class' => "btn-action glyphicons eye_open btn-info",
                ],
                'label' => '<i></i>',
            ],
            'update' => [
                'options' => [
                    'class' => "btn-action glyphicons pencil btn-success",
                ],
                'label' => '<i></i>',
            ],
            'delete' => [
                'options' => [
                    'class' => "btn-action glyphicons remove_2 btn-danger",
                ],
                'label' => '<i></i>',
            ],
        ]
    ]]);

$this->widget('application.components.widgets.usertheme.UserGridView', [
    'id' => 'my-model-grid',
    'dataProvider' => $model->search(),
    'ajaxUpdate' => true,
    //'filter' => $model,
    'columns' => $columns,
    'pager' => ['class' => 'CLinkPager', 'header' => '', 'selectedPageCssClass' => 'active', 'hiddenPageCssClass' => 'disabled', 'htmlOptions' => ['class' => 'asd']],
]);
?>
<div class="separator"></div>
<h3 class="glyphicons qrcode"><i></i>Source</h3>
<pre>
&lt;?php 
$model = new Actions;
$columns = array();
foreach($model->attributeLabels() as $key => $attribute)
    $columns[] = $key;

$columns = array_merge($columns, array(array
(
    'class'=>'CButtonColumn',
    'htmlOptions' => array('style'=>'width:85px'),
    'deleteButtonImageUrl'=>false,
    'updateButtonImageUrl'=>false,
    'viewButtonImageUrl'=>false,
    'template'=>'{view}{update}{delete}',
    'buttons'=>array(
        'view'=>array(
            'options'=>array(
                'class'=>"btn-action glyphicons eye_open btn-info",
            ),
            'label'=>'<i></i>',
        ),
        'update'=>array(
            'options'=>array(
                'class'=>"btn-action glyphicons pencil btn-success",
            ),
            'label'=>'<i></i>',
        ),
        'delete'=>array(
            'options'=>array(
                'class'=>"btn-action glyphicons remove_2 btn-danger",
            ),
            'label'=>'<i></i>',
        ),
    )
)));

$this->widget('application.components.widgets.usertheme.UserGridView', array(
    'id' => 'my-model-grid',
    'dataProvider' => $model->search(),
    'ajaxUpdate'=>true,
    //'filter' => $model,
    'columns'=> $columns,
    'pager' => array('class' => 'CLinkPager', 'header' => '', 'selectedPageCssClass' => 'active','hiddenPageCssClass' => 'disabled', 'htmlOptions'=>array('class' => 'asd')),
));
?&gt;
</pre>
<script>
    $('.pager').removeClass('pager').addClass('pagination pagination-right pagination-small');
</script>