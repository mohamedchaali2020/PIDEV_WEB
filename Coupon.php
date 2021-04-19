<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coupon
 *
 * @ORM\Table(name="coupon")
 * @ORM\Entity
 */
class Coupon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="coupon_id", type="integer", nullable=false)
     */
    public $couponId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="coupon_key", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    public $couponKey = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    public $value;


}
