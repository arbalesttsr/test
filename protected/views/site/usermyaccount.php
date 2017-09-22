<?php $this->breadcrumbs = [
    'crumbs' => [
        ['name' => 'Set Account'],
    ],
]; ?>


<div class="widget widget-2">
    <div class="widget-head">
        <h4 class="heading glyphicons settings"><i></i>Setări cont</h4>
    </div>
    <div class="widget-body" style="padding-bottom: 0;">
        <div class="row-fluid">
            <div class="span3">
                <strong>Schimbă parolă</strong>
                <p class="muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="span9">
                <label for="inputUsername">Nume utilizator</label>
                <input type="text" id="inputUsername" class="span10" value="john.doe2012" disabled="disabled">
                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip"
                      data-placement="top" data-original-title="Username can't be changed"><i></i></span>
                <div class="separator"></div>

                <label for="inputPasswordOld">Parolă veche</label>
                <input type="password" id="inputPasswordOld" class="span10" value=""
                       placeholder="Leave empty for no change">
                <span style="margin: 0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip"
                      data-placement="top"
                      data-original-title="Leave empty if you don't wish to change the password"><i></i></span>
                <div class="separator"></div>

                <label for="inputPasswordNew">Parolă nouă</label>
                <input type="password" id="inputPasswordNew" class="span12" value=""
                       placeholder="Leave empty for no change">
                <div class="separator"></div>

                <label for="inputPasswordNew2">Repetă parolă nouă</label>
                <input type="password" id="inputPasswordNew2" class="span12" value=""
                       placeholder="Leave empty for no change">
                <div class="separator"></div>
            </div>
        </div>
        <hr class="separator bottom">
        <div class="row-fluid">
            <div class="span3">
                <strong>Detalii contact</strong>
                <p class="muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="span9">
                <div class="row-fluid">
                    <div class="span6">
                        <label for="inputPhone">Telefon</label>
                        <div class="input-prepend">
                            <span class="add-on glyphicons phone"><i></i></span>
                            <input type="text" id="inputPhone" class="input-large" placeholder="01234567897">
                        </div>
                        <div class="separator"></div>

                        <label for="inputEmail">E-mail</label>
                        <div class="input-prepend">
                            <span class="add-on glyphicons envelope"><i></i></span>
                            <input type="text" id="inputEmail" class="input-large" placeholder="contact@mosaicpro.biz">
                        </div>
                        <div class="separator"></div>

                        <label for="inputWebsite">Website</label>
                        <div class="input-prepend">
                            <span class="add-on glyphicons link"><i></i></span>
                            <input type="text" id="inputWebsite" class="input-large"
                                   placeholder="http://www.mosaicpro.biz">
                        </div>
                        <div class="separator"></div>
                    </div>
                    <div class="span6">
                        <label for="inputFacebook">Facebook</label>
                        <div class="input-prepend">
                            <span class="add-on glyphicons facebook"><i></i></span>
                            <input type="text" id="inputFacebook" class="input-large" placeholder="/mosaicpro">
                        </div>
                        <div class="separator"></div>

                        <label for="inputTwitter">Twitter</label>
                        <div class="input-prepend">
                            <span class="add-on glyphicons twitter"><i></i></span>
                            <input type="text" id="inputTwitter" class="input-large" placeholder="/mosaicpro">
                        </div>
                        <div class="separator"></div>

                        <label for="inputSkype">Skype ID</label>
                        <div class="input-prepend">
                            <span class="add-on glyphicons skype"><i></i></span>
                            <input type="text" id="inputSkype" class="input-large" placeholder="mySkypeID">
                        </div>
                        <div class="separator"></div>

                        <label for="inputYahoo">Yahoo ID</label>
                        <div class="input-prepend">
                            <span class="add-on glyphicons yahoo"><i></i></span>
                            <input type="text" id="inputYahoo" class="input-large" placeholder="myYahooID">
                        </div>
                        <div class="separator"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions" style="margin: 0; padding-right: 0;">
            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok pull-right"><i></i>Salvează
                modificări
            </button>
        </div>
    </div>
</div>