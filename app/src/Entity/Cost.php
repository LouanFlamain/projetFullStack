<?php

namespace App\Entity;

use App\Traits\PreventEmpty;

class Cost extends BaseEntity
{
    use PreventEmpty;

    private ?int $id;
    private float $credit;
    private float $debit;
    private string $cost_type;
    private string $reference;
    private int $tenant_id;
    private array $relationships;
    private ?string $status = null;
    private ?\DateTime $created_at;

    /*
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /*
     * @param int|null $id
     * @return 
     */
    public function setId(?int $id): Cost
    {
        $this->id = $id;

        return $this;

    }

    /*
     * @return float
     */
    public function getCredit(): float
    {
        return $this->credit;
    }

    /*
     * @param float $credit
     */
    public function setCredit(float $credit): Cost
    {
        $this->credit = $credit;

        return $this;

    }

    /*
     * @return float
     */
    public function getDebit(): float
    {
        return $this->debit;
    }

    /*
     * @param float $debit
     */
    public function setDebit(float $debit): Cost
    {
        $this->debit = $debit;

        return $this;

    }

    /*
     * @return string
     */
    public function getCost_type(): string
    {
        return $this->cost_type;
    }

    /*
     * @param string $cost_type
     */
    public function setCost_type(string $cost_type): Cost
    {
        $this->cost_type = $cost_type;

        return $this;

    }

    /*
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /*
     * @param string $reference
     */
    public function setReference(string $reference): Cost
    {
        $this->reference = $reference;

        return $this;
    }

    /*
     * @return int
     */
    public function getTenant_id(): int
    {
        return $this->tenant_id;
    }

    /*
     * @param int $tenant_id
     */
    public function setTenant_id(int $tenant_id): Cost
    {
        $this->tenant_id = $tenant_id;

        return $this;

    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getRelationships(): array
    {
        return $this->relationships;
    }

    /**
     * @param array $relationships
     */
    public function setRelationships(array $relationships): Cost
    {
        $this->relationships = $relationships;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreated_At(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    /**
     * @param DateTime|string|null $created_at
     * @return Cost
     */
    public function setCreated_At(DateTime|string|null $created_at = 'now'): Cost
    {
        $this->created_at = new \DateTime($created_at);
        return $this;
    }
}


