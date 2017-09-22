<div id="language-select">
    <?php
    if (sizeof($language) < 4) { // если языков меньше четырех - отображаем в строчку
        // Если хотим видить в виде флагов то используем этот код
        echo '<div class = ' . $htmlOptions['class'] . '>';
        foreach ($language as $key => $lang) {
            if ($key != $currentLang) {
                echo CHtml::link(
                    '<img src="' . Yii::app()->baseURL . '/images/' . $key . '.gif" title="' . $lang . '" style="padding: 1px;" width=35 height=20>',
                    $this->getOwner()->createMultilanguageReturnUrl($key));
            };
        }
        echo '</div>';
        // Если хотим в виде текста то этот код

//        $lastElement = end($languages);
//        foreach($languages as $key=>$lang) {
//            if($key != $currentLang) {
//                echo CHtml::link(
//                     $lang,
//                     $this->getOwner()->createMultilanguageReturnUrl($key));
//            } else echo '<b>'.$lang.'</b>';
//            if($lang != $lastElement) echo ' | ';
//        }

    } else {
        // Render options as dropDownList
        echo CHtml::form();
        foreach ($language as $key => $lang) {
            echo CHtml::hiddenField(
                $key,
                $this->getOwner()->createMultilanguageReturnUrl($key));
        }
        echo CHtml::dropDownList('language', $currentLang, $language,
            array(
                'submit' => '',
            )
        );
        echo CHtml::endForm();
    }
    ?>
</div>