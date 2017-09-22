<!-- BEGIN SIDEBAR -->
<nav id="page-leftbar" role="navigation">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="acc-menu" id="sidebar">
        <?php if (isset(Yii::app()->modules['Search'])) { ?>
            <li id="search">
                <a href="javascript:;"><i class="fa fa-search opacity-control"></i></a>
                <form action="<?= Yii::app()->createUrl('Search/search/getSearchResults'); ?>">
                    <input name="text" type="text" class="search-query" placeholder="Căutare...">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </li>
            <li class="divider"></li>
        <?php } ?>

        <li><a href="<?= Yii::app()->homeUrl; ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>

        <?php if (isset(Yii::app()->modules['Business'])) { ?>
            <?php $user_businesses_categories = BusinessAccess::getUserBusinessesMenu(); ?>
            <?php foreach ($user_businesses_categories as $category_name => $user_businesses_category) { ?>
                <?php if (is_array($user_businesses_category) && !empty($user_businesses_category)) { ?>
                    <li class="divider"></li>
                    <li><a href="javascript:;"><i class="glyphicon glyphicon-chevron-right"></i>
                            <span><?= $category_name; ?></span></a>
                        <ul class="acc-menu">
                            <?php foreach ($user_businesses_category as $menu_item) { ?>
                                <?php if (is_array($menu_item) && isset($menu_item['url'], $menu_item['text'])) { ?>
                                    <li><a href="<?= $menu_item['url'] ?>"><span><?= $menu_item['text'] ?></span></a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <?php foreach ($menuarray as $moduleName => $menumodule) { ?>
            <?php $icon = 'th';
            if (isset(Yii::app()->modules[$moduleName])) {
                if (isset(Yii::app()->modules[$moduleName]["front_tiles"], Yii::app()->modules[$moduleName]["front_tiles"]["icon"]))
                    $icon = Yii::app()->modules[$moduleName]["front_tiles"]["icon"];
                }?>
                <li><a href="javascript:;"><i class="fa fa-<?= $icon ?>"></i> <span><?= Yii::t('mess',$moduleName) ?></span> </a>
                    <ul class="acc-menu" style="transition-property: -webkit-transform; transform-origin: 0px 0px 0px; transform: translate3d(0px, 0px, 0px);">
                        <?php foreach ($menumodule as $menu_item) { ?>
                            <?php if (is_array($menu_item) && isset($menu_item['url'], $menu_item['text'])) { ?>
                                <li>
                                    <a class="shortcut-tiles" href="<?= Yii::app()->createUrl($menu_item['url']) ?>">
                                            <i class="fa fa-<?= $menu_item["icon"] ?> pull-left"></i>
                                            <span><?= Yii::t('mess',$menu_item['text']) ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </li>
        <?php } ?>
    </ul>
    <!-- END SIDEBAR MENU -->
</nav>
