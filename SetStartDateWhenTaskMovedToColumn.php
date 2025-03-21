<?php

namespace Kanboard\Plugin\SetStartDateWhenTaskMovedToColumn\Action;

use Kanboard\Model\TaskModel;
use Kanboard\Action\Base;


/**
 * Set Start Date to Current Time When Task is Moved to a Specified Column
 *
 * @package action
 */

class SetStartDateWhenTaskMovedToColumn  extends Base
{
    
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Set the start date of a task to the current time when it is moved to a specified column');
    }

    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array(
            TaskModel::EVENT_MOVE_COLUMN,
        );
    }

    /**
     * Get the required parameters for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        // Dynamically populate column options
        $columns = $this->columnModel->getList($this->getProjectId());
        return array(
            'column_id' => array(
                'type' => 'dropdown',
                'label' => t('Target column'),
                'options' => $columns,
            ),
        );
    }

    /**
     * Get the required parameters for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return array(
            'task_id',
            'column_id',
        );
    }

    /**
     * Execute the action
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        if ($data['column_id'] == $this->getParam('column_id')) {
            $currentTime = time();

            return $this->taskModificationModel->update(array(
                'id'       => $data['task_id'],
                'date_started' => $currentTime,
            ));
        }

        return false;
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        return true;
    }
}
