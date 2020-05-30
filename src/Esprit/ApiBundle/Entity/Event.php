<?php

namespace Esprit\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="Esprit\ApiBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="EvName", type="string", length=255)
     */
    private $evName;

    /**
     * @var string
     *
     * @ORM\Column(name="EvMonth", type="string", length=255)
     */
    private $evMonth;

    /**
     * @var string
     *
     * @ORM\Column(name="EvStart", type="string")
     */
    private $evStart;

    /**
     * @var string
     *
     * @ORM\Column(name="EvEnd", type="string")
     */
    private $evEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="EvPur", type="string", length=255)
     */
    private $evPur;

    /**
     * @var string
     *
     * @ORM\Column(name="EvDesc", type="text", length=2500)
     */
    private $evDesc;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set evName
     *
     * @param string $evName
     *
     * @return Event
     */
    public function setEvName($evName)
    {
        $this->evName = $evName;

        return $this;
    }

    /**
     * Get evName
     *
     * @return string
     */
    public function getEvName()
    {
        return $this->evName;
    }

    /**
     * Set evMonth
     *
     * @param string $evMonth
     *
     * @return Event
     */
    public function setEvMonth($evMonth)
    {
        $this->evMonth = $evMonth;

        return $this;
    }

    /**
     * Get evMonth
     *
     * @return string
     */
    public function getEvMonth()
    {
        return $this->evMonth;
    }

    /**
     * Set evStart
     *
     * @param string $evStart
     *
     * @return Event
     */
    public function setEvStart($evStart)
    {
        $this->evStart = $evStart;

        return $this;
    }

    /**
     * Get evStart
     *
     * @return string
     */
    public function getEvStart()
    {
        return $this->evStart;
    }

    /**
     * Set evEnd
     *
     * @param string $evEnd
     *
     * @return Event
     */
    public function setEvEnd($evEnd)
    {
        $this->evEnd = $evEnd;

        return $this;
    }

    /**
     * Get evEnd
     *
     * @return string
     */
    public function getEvEnd()
    {
        return $this->evEnd;
    }

    /**
     * Set evPur
     *
     * @param string $evPur
     *
     * @return Event
     */
    public function setEvPur($evPur)
    {
        $this->evPur = $evPur;

        return $this;
    }

    /**
     * Get evPur
     *
     * @return string
     */
    public function getEvPur()
    {
        return $this->evPur;
    }

    /**
     * Set evDesc
     *
     * @param string $evDesc
     *
     * @return Event
     */
    public function setEvDesc($evDesc)
    {
        $this->evDesc = $evDesc;

        return $this;
    }

    /**
     * Get evDesc
     *
     * @return string
     */
    public function getEvDesc()
    {
        return $this->evDesc;
    }
}

