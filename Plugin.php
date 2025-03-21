<?php
namespace Kanboard\Plugin\SetStartDateWhenTaskMovedToColumn;
use Kanboard\Core\Plugin\Base;

use Kanboard\Plugin\SetStartDateWhenTaskMovedToColumn\Action\SetStartDateWhenTaskMovedToColumn;

class Plugin extends Base
{
    public function initialize()
    {
        $this->actionManager->register(new SetStartDateWhenTaskMovedToColumn($this->container));
    }
    public function getPluginName()
    {
        return 'SetStartDateWhenTaskMovedToColumn';
    }
    public function getPluginDescription()
    {
        return t('Set the start date of a task to current time if it is moved to a given column');
    }

    public function getPluginAuthor()
    {
        return 'Ahcene Dahmane';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/ahcened/plugin-setDueDateWhenTaskMovedToColumn';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.19';
    }
}
