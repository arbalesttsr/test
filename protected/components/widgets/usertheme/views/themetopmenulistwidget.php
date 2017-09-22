<?php //$id = strtolower(str_replace(' ', '_', $this->label)); ?>
<a href="#" data-toggle="dropdown" class="glyphicons settings">
    <i></i><span class="hidden-phone"><?php echo $this->label ?></span>
</a>
<?php //die(var_dump('<pre>',$this->items,'</pre>')); ?>
<ul class="dropdown-menu pull-right all-modules-top">
    <?php foreach ($this->items as $item) { ?>
        <?php if ($item['visible']) { ?>
            <li id="top-list-module-<?php echo $item['id']; ?>" id-mod="<?php echo $item['id']; ?>"
                parent_id="<?php echo $item['parent_id']; ?>"><a href="<?php echo $item['url'][0]; ?>"
                                                                 title="<?php echo $item['label']; ?>"><?php echo Yii::t('mod_menu', $item['label']); ?></a>
            </li>
        <?php } ?>
    <?php } ?>
</ul>

<?php
$cs = Yii::app()->getClientScript();
$cs->registerScript(
    'reorder-top-modules',
    "$('ul.all-modules-top li').each(function(){
        var element = $(this);
        var p_id = element.attr('parent_id');
        if(parseInt(p_id) !== 0)
        {
                    //console.log(element);
            parent_el = $('ul.all-modules-top').find('li[id-mod=\"'+p_id+'\"]');
            var count_ul = parent_el.find('ul').size();
            if(count_ul == 0)
                {
                    var ul = $('<ul></ul>');
                    ul.css({'position': 'absolute','left': '101%','top': '0','min-width': '200px','display':'none'});
                    parent_el.find('a').first().append($('<i></i>'));
                    parent_el.append(ul);
                }
            parent_el.css('position','relative');
            parent_el.find('a').first().addClass('glyphicons chevron-right');
            parent_el.hover(function(){
                $(this).find('ul').first().show();
            }, function(){
                $(this).find('ul').first().hide();
            });
            //var last = $('ul.all-modules-top').find('li[id-mod=\"'+p_id+'\"]:last-child');
            //console.log(last)
                    //console.log(parent_el)
            element.detach().appendTo(parent_el.find('ul').first());
        }
  });", CClientScript::POS_END); ?>

<?php /* 
<ul style="position: absolute;left: 101%;top: 39px;min-width: 200px;" class="__web-inspector-hide-shortcut__">
    <li id="top-list-module-3" id-mod="3" parent_id="2"><a href="/modules_test_postgre/modules/Asd/default/administration" title="Asd">Asd</a></li>
    <li id="top-list-module-4" id-mod="4" parent_id="3"><a href="/modules_test_postgre/modules/Qwe/default/administration" title="Qwe">Qwe</a></li>
</ul>
 */ ?>