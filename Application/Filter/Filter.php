<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/10/9
 * Time: 18:04
 */

namespace Application\Filter;

/**
 * 尽管过滤和验证操作经常一起执行，但有时也会分开执行
 * 因此，应为每种操作单独定义类
 *
 * Class Filter
 * @package Application\Filter
 */
class Filter extends AbstractFilter
{

    public function process(array $data)
    {
        if (!(isset($this->assignments) && count($this->assignments))) {
            return null;
        }

        foreach ($data as $key => $value) {
            $this->results[$key] = new Result($value, array());
        }

        $toDo = $this->assignments;
        if (isset($toDo["*"])) {
            $this->processGlobalAssignment($toDo['*'], $data);
            unset($toDo['*']);
        }

        foreach ($toDo as $key => $assignment) {
            $this->processAssigment($assignment, $key);
        }

    }

    protected function processAssigment($assignment, $key)
    {
        foreach ($assignment as $callback) {
            if ($callback === null) {
                continue;
            }
            $result = $this->callbacks[$callback['key']]($this->results[$key]->item, $callback['params']);
            $this->results[$key]->mergeResults($result);
        }
    }

    protected function processGlobalAssignment($assignment, $data)
    {
        foreach ($assignment as $callback) {
            if ($callback === null) {
                continue;
            }

            foreach ($data as $k => $value) {
                $result = $this->callbacks[$callback['key']]($this->results[$k]->item, $callback['params']);
                $this->results[$k]->mergeResults($result);
            }
        }
    }
}