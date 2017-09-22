<?php
$this->breadcrumbs = [
    $moduleName,
];
$has_documentation = false;
$file_path = '';
$dir = Yii::app()->basePath;
if (is_dir($dir)) {
    $dir .= DIRECTORY_SEPARATOR . 'modules';
    if (is_dir($dir)) {
        $dir .= DIRECTORY_SEPARATOR . $moduleName;
        if (is_dir($dir)) {
            $dir .= DIRECTORY_SEPARATOR . 'data';
            if (is_dir($dir)) {
                $dh = opendir($dir);
                while (false !== ($filename = readdir($dh))) {
                    //first check if exists html readme file
                    if (in_array(strtolower($filename), ['readme.htm', 'readme.html'])) {
                        $has_documentation = true;
                        $file_path = $dir . DIRECTORY_SEPARATOR . $filename;
                        break;
                    }
                    if ($filename !== '.' && $filename !== '..') {
                        $file_w_ext = explode('.', $filename);
                        if (strtolower($file_w_ext[0]) === 'readme') {
                            $has_documentation = true;
                            $file_path = $dir . DIRECTORY_SEPARATOR . $filename;
                        }
                    }
                }
            }
        }
    }
}

echo $has_documentation ? file_get_contents($file_path) : 'no documentation';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$cs = Yii::app()->getClientScript();
$cs->registerScript(
    'readme-js',
    "
    $(window).load(function(){
        var navigation = $('<div class=\"readme-navigation\"></div>');
        navigation.append($('<h3 style=\"color: #37a6cd;\">Navigare Documentatie <i>&lt;&lt;" . $moduleName . "&gt;&gt;</i></h3>'));
        $('div.block').each(function(){
            var h = $(this).find('.title').first();
            var a = $('<a></a>');
            a.attr('href', '#' + $(this).attr('id'));
            var div = $('<div></div>');
            div.attr('class',$(this).attr('id'));
            a.text(h.text());
            div.append(a);
            var parent = $(this).parent();
            //console.log(parent);
            if(parent.hasClass('block'))
            {
                var id = parent.attr('id');
                navigation.find('.' + id).append(div);
                //console.log(id);
            }
            else
                navigation.append(div);
        });
        $('#content').prepend(navigation);
        $('div.block img').each(function(){
            var w = $(this).width();
            var h = $(this).height();
            if($(this).width() > $(this).parent().width())
            {
                $(this).css('width','100%');
                //$(this).css('height', (h * $(this).width() / w) + 'px' );
                $(this).css('height', 'auto' );
            }
        });
    });

  ", CClientScript::POS_END);
$cs->registerCss(
    'readme-css',
    "div.block{padding: 50px 0 0 30px; clear: both;}
   div.block .title{color: #575655; border-bottom: 1px solid #575655;}
   div.readme-navigation{position: fixed;right: 20px;top: 65px;background-color: #fafafa;padding: 20px;opacity: 0.4; -webkit-border-radius: 10px; border-radius: 10px; -webkit-box-shadow: 0 0 10px 1px #777; box-shadow: 0 0 10px 1px #777; z-index: 99999;}
   div.readme-navigation:hover{opacity:1;}
   div.readme-navigation div{margin-left:10px;}
   div.readme-navigation div a{font-size: 20px;}
   div.block img {-webkit-box-shadow: 0 0 20px 3px #777777; box-shadow: 0 0 20px 3px #777777; margin: 20px auto;}
   div#content p {font-size: 14px;}
   ");
?>