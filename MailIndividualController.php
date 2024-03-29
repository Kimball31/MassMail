<?php

/**
* @package     Joomla.Administrator
* @subpackage  com_users
*
* @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

namespace Joomla\Component\Users\Administrator\Controller;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Router\Route;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
* Users "Own" MailIndividual controller.
*
* @since  1.6
*/
class MailIndividualController extends BaseController
{
    /**
    * Send the mail
    *
    * @return void
    *
    * @since 1.6
    */
    public function send()
    {
        // Redirect to admin index if mass mailer disabled in conf
        if ($this->app->get('massmailoff', 0) == 1) {
            $this->app->redirect(Route::_('index.php', false));
        }

        // Check for request forgeries.
        $this->checkToken('request');

        // REPLACED:
        $model = $this->getModel('MailIndividual');
        
        //die('stopped at getModel MailIndividual');

        if ($model->sendIndividual()) {   
            $type = 'message';
        } else {
            $type = 'error';
        }

        $msg = $model->getError();
        $this->setRedirect('index.php?option=com_users&view=mail', $msg, $type);
    }

    /**
    * Cancel the mail
    *
    * @return void
    *
    * @since 1.6
    */
    public function cancel()
    {
        // Check for request forgeries.
        $this->checkToken('request');

        // Clear data from session.
        $this->app->setUserState('com_users.display.mail.data', null);

        $this->setRedirect('index.php?option=com_users&view=users');
    }

    
}
