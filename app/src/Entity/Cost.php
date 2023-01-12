<?php

namespace App\Entity;

class Cost extends BaseEntity
{
    private ?int $id;
    private int $credit;
    private int $debit;
    private string $cost_type;
    private string $reference;
    private int $tenant_id;

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
     * @return int
     */
    public function getCredit(): int
    {
        return $this->credit;
    }

    /*
     * @param int $credit
     */
    public function setCredit(int $credit): Cost
    {
        $this->credit = $credit;

        return $this;

    }

    /*
     * @return int
     */
    public function getDebit(): int
    {
        return $this->debit;
    }

    /*
     * @param int $debit
     */
    public function setDebit(int $debit): Cost
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

}


