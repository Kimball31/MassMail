<?php

/**
* @package     Joomla.Administrator
* @subpackage  com_users
*
* @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;


$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
->useScript('form.validate');

$comUserParams = ComponentHelper::getParams('com_users');

$app = Factory::getApplication();
$editor = $app->getInput()->getCmd('editor', '');

?>

<h2>Massmail Individuals - Override Template</h2>
<pre>/atum/html/com_users/mail/default.php</pre>

<?
$this->form->setFieldAttribute('disabled', 'default', '0');
$this->form->setFieldAttribute('disabled', 'type', 'raido');

$this->form->setFieldAttribute('group', 'label', 'Group To Email: ');
$this->form->setFieldAttribute('message', 'label', 'Message');
$this->form->setFieldAttribute('message', 'type', 'editor');

// Note: See hidden values at botton of form for:
//    <input type="hidden" name="task" value="MailIndividual">
//    <input type="hidden" name="jform[mode]" value="1"> 
//    <input type="hidden" name="jform[bcc]" value="0"> 

?>

<form action="<?php echo Route::_('index.php?option=com_users&view=mail'); ?>" name="adminForm" method="post" id="mail-form" aria-label="<?php echo Text::_('COM_USERS_MASSMAIL_FORM_NEW'); ?>" class="main-card p-4 form-validate">

    <!--div class="row">
    <div class="col-lg-3">
    </div>
    </div -->

    <div class="row">
        <div class="col-lg-4">

            <div class="control-group">
                <div class="control-label">
                    <?php echo $this->form->getLabel('group'); ?>
                </div>
                <div class="controls">
                    <?php echo $this->form->getInput('group'); ?>
                </div>
            </div>

            <div class="control-group radio">
                <div class="control-label"><label id="jform_disabled-lbl" for="jform_disabled" class="hasPopover" title="" data-content="Disable accounts or Active account. One or the other." data-original-title="Group Members Status">
                        Group Members Status</label>
                    <fieldset id="jform_disabled" class="radio">
                        <div style="margin-left: 1em">
                            <input type="radio" id="jform_disabled0" name="jform[disabled]" value="0" checked="checked">            
                            <label for="jform_disabled0">
                                Active accounts only </label>
                        </div>
                        <div style="margin-left: 1em">
                            <input type="radio" id="jform_disabled1" name="jform[disabled]" value="1">            
                            <label for="jform_disabled1">
                                Disable accounts only </label>
                        </div>
                    </fieldset>
                </div>
            </div>            


        </div>  
        <div class="col-lg-3">

            <div class="form-check">
                <?php echo $this->form->getInput('recurse'); ?>
                <?php echo $this->form->getLabel('recurse'); ?>
            </div>         


        </div>  
        <div class="col-lg-3">
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-lg-9">
            <div class="control-group">
                <?php echo $this->form->getLabel('subject'); ?>
                <span class="input-group">
                    <?php if (!empty($comUserParams->get('mailSubjectPrefix'))) : ?>
                        <span class="input-group-text"><?php echo $comUserParams->get('mailSubjectPrefix'); ?></span>
                    <?php endif; ?>
                    <?php echo $this->form->getInput('subject'); ?>
                </span>
            </div>    
            <div class="editor-group">

                <?php echo $this->form->getLabel('message'); ?>
                <?php echo $this->form->getInput('message'); ?>

            </div>
        </div>
        <div class="col-lg-3">
        </div>
    </div><!-- end row -->
    <input type="hidden" name="task" value="MailIndividual">
    <input type="hidden" name="jform[mode]" value="1"> <!-- as html - yes -->
    <input type="hidden" name="jform[bcc]" value="1"> <!-- self blind copy - yes -->    
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
