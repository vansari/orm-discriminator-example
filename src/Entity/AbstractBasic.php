<?php
declare(strict_types=1);

namespace Vansari\OrmDiscriminatorExample\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'main', schema: 'public')]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn(name: 'is_broker', type: 'integer', generated: 'ALWAYS')]
#[DiscriminatorMap(
    [
        1 => Broker::class,
        0 => Customer::class,
    ]
)]
class AbstractBasic
{
    #[Id, Column(type: 'integer')]
    #[GeneratedValue(strategy: 'IDENTITY')]
    protected ?int $id = null;

    #[Column(type: 'string')]
    protected ?string $firstname = null;

    #[Column(type: 'string')]
    protected ?string $surname = null;

    #[Column(type: 'string')]
    protected ?string $company = null;

    #[Column(type: 'integer', nullable: false)]
    protected int $status = 3;

    protected int $isBroker = 0;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     */
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string|null $company
     */
    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getIsBroker(): ?int
    {
        return $this->isBroker;
    }
}