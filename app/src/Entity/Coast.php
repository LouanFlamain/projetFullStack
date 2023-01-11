<?php

namespace App\Entity;

class Coast
{
 private ?int $id;
 private int $credit;
 private int $debit;
 private string $cost_type;

 private string $reference;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCredit(): int
    {
        return $this->credit;
    }

    /**
     * @param int $credit
     */
    public function setCredit(int $credit): void
    {
        $this->credit = $credit;
    }

    /**
     * @return int
     */
    public function getDebit(): int
    {
        return $this->debit;
    }

    /**
     * @param int $debit
     */
    public function setDebit(int $debit): void
    {
        $this->debit = $debit;
    }

    /**
     * @return string
     */
    public function getCostType(): string
    {
        return $this->cost_type;
    }

    /**
     * @param string $cost_type
     */
    public function setCostType(string $cost_type): void
    {
        $this->cost_type = $cost_type;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return int
     */
    public function getTenantId(): int
    {
        return $this->tenant_id;
    }

    /**
     * @param int $tenant_id
     */
    public function setTenantId(int $tenant_id): void
    {
        $this->tenant_id = $tenant_id;
    }

 private int $tenant_id;




}