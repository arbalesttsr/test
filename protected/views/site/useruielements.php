<div class="separator"></div>
<h3 class="glyphicons display"><i></i>User UI Elements Example</h3>
<div class="separator"></div>
<h4>Buttons</h4>
<div class="well">
    <?php $this->widget('application.components.widgets.usertheme.UserButton', [
        'type' => 'default',
        'label' => 'Default Medium Button',
    ]); ?>
    <div class="separator"></div>
    <?php $this->widget('application.components.widgets.usertheme.UserButton', [
        'type' => 'primary',
        'size' => 'small',
        'label' => 'Primary Small Button',
    ]); ?>
    <div class="separator"></div>
    <?php $this->widget('application.components.widgets.usertheme.UserButton', [
        'type' => 'info',
        'size' => 'mini',
        'label' => 'Info Mini Button',
    ]); ?>
    <div class="separator"></div>
    <?php $this->widget('application.components.widgets.usertheme.UserButton', [
        'type' => 'success',
        'icon' => 'circle_exclamation_mark',
        'label' => 'Success Medium Button with icon',
    ]); ?>
    <div class="separator"></div>
    <?php $this->widget('application.components.widgets.usertheme.UserButton', [
        'type' => 'inverse',
        'size' => 'large',
        'label' => 'Inverse Large Button',
    ]); ?>
    <div class="separator"></div>
    <h3 class="glyphicons qrcode"><i></i>Source</h3>
<pre>
&lt;?php $this->widget('application.components.widgets.usertheme.UserButton', array(
    'type' => 'default',
    'label' => 'Default Medium Button',
)); ?&gt;

&lt;?php $this->widget('application.components.widgets.usertheme.UserButton', array(
    'type' => 'primary',
    'size'=>'small',
    'label' => 'Primary Small Button',
)); ?&gt;

&lt;?php $this->widget('application.components.widgets.usertheme.UserButton', array(
    'type' => 'info',
    'size'=>'mini',
    'label' => 'Info Mini Button',
)); ?&gt;

&lt;?php $this->widget('application.components.widgets.usertheme.UserButton', array(
    'type' => 'success',
    'icon'=>'circle_exclamation_mark',
    'label' => 'Success Medium Button with icon',
)); ?&gt;

&lt;?php $this->widget('application.components.widgets.usertheme.UserButton', array(
    'type' => 'inverse',
    'size'=>'large',
    'label' => 'Inverse Large Button',
)); ?&gt;
</pre>
</div>


<div class="separator"></div>
<h4>Accordion</h4>
<div class="well">
    <?php $this->widget('application.components.widgets.usertheme.AccordionWidget', ['data' => [
        'id' => 'acc-id',
        'elements' => [
            'elem1' => [
                'title' => 'title elem 1',
                'content' => 'Lorem ipsum dollore sit amet'
            ],
            'elem2' => [
                'title' => 'title elem 2',
                'content' => 'Lorem ipsum dollore sit amet 2'
            ]
        ]
    ]]); ?>
    <div class="separator"></div>
    <h3 class="glyphicons qrcode"><i></i>Source</h3>
<pre>
&lt;?php $this->widget('application.components.widgets.usertheme.AccordionWidget',array('data' => array(
    'id' => 'acc-id',
    'elements'=>array(
        'elem1' => array(
            'title' => 'title elem 1',
            'content' => 'Lorem ipsum dollore sit amet'
        ),
        'elem2' => array(
            'title' => 'title elem 2',
            'content' => 'Lorem ipsum dollore sit amet 2'
        )
    )
))); ?&gt;
</pre>
</div>


<div class="separator"></div>
<h4>User Custom Text Box</h4>
<div class="well">
    <h4>Simple input</h4>
    <?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox', [
        'id' => 'inp-id1'
    ]); ?>
    <div class="separator"></div>
    <h4>Input with placeholder</h4>
    <?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox', [
        'id' => 'inp-id',
        'name' => 'name-inp',
        'placeholder' => 'type your text here'
    ]); ?>
    <div class="separator"></div>
    <h4>Input with addon</h4>
    <?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox', [
        'id' => 'inp-id2',
        'name' => 'name-inp',
        'placeholder' => 'type your email here',
        'addon' => '@',
    ]); ?>
    <div class="separator"></div>
    <h4>Disabled Input</h4>
    <?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox', [
        'id' => 'inp-id3',
        'name' => 'name-inp',
        'placeholder' => 'this input is disabled',
        'disabled' => true,
    ]); ?>
    <div class="separator"></div>
    <h4>Input with value</h4>
    <?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox', [
        'id' => 'inp-id4',
        'name' => 'name-inp',
        'placeholder' => 'type your text here',
        'value' => 'this input has value',
    ]); ?>
    <div class="separator"></div>
    <h4>Input with addon and tooltip</h4>
    <?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox', [
        'id' => 'inp-id5',
        'name' => 'name-inp',
        'placeholder' => 'type your text here',
        'addon_glyph' => 't-shirt',
        'tooltip' => 'Enter your name',
    ]); ?>
    <div class="separator"></div>
    <h3 class="glyphicons qrcode"><i></i>Source</h3>
<pre>
&lt;?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox',array(
    'id' => 'inp-id',
    'name' => 'name-inp',
    'placeholder' => 'type your text here'
)); ?&gt;

&lt;?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox',array(
    'id' => 'inp-id2',
    'name' => 'name-inp',
    'placeholder' => 'type your email here',
    'addon' => '@',
    )); ?&gt;

&lt;?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox',array(
    'id' => 'inp-id3',
    'name' => 'name-inp',
    'placeholder' => 'this input is disabled',
    'disabled' => true,
    )); ?&gt;

&lt;?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox',array(
    'id' => 'inp-id4',
    'name' => 'name-inp',
    'placeholder' => 'type your text here',
    'value' => 'this input has value',
)); ?&gt;

&lt;?php $this->widget('application.components.widgets.usertheme.UserCustomTextBox',array(
    'id' => 'inp-id5',
    'name' => 'name-inp',
    'placeholder' => 'type your text here',
    'addon_glyph' => 't-shirt',
    'tooltip' => 'Enter your name',
)); ?&gt;
</pre>
</div>