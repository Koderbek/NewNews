<?php
/**
 * Created by PhpStorm.
 * User: Profsoft
 * Date: 27.09.2018
 * Time: 12:02
 */

namespace App\Helper\Status;

use Symfony\Component\Validator\Constraints as Assert;

trait StatusTrait
{
    /**
     * @var integer
     * @ORM\Column(name="status", type="integer")
     *
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    protected function getStatusClass()
    {
        $function = new \ReflectionClass($this);
        $statusClassName = 'App\Helper\Status\\' . $function->getShortName() . "Status";
        $statusClass = new $statusClassName;
        return $statusClass;
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function getStatusName()
    {
        $statusClass = $this->getStatusClass();
        return $statusClass::getName($this->getStatus());
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function getStatusType()
    {
        return $this->getStatusClass()->getType($this->getStatus());
    }

    /**
     * @return bool
     */
    public function editAllowed()
    {
        return true;
    }
}