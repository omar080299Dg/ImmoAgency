<?php

namespace App\Entity;

class BienSearch {

    /**
     * @var int|null
     */
    private $prixMax;

    /**
     * @var int|null
     */
    private $surfaceMin;

    /**
     * @return int|null
     */
    public function getPrixMax(): ?int
    {
        return $this->prixMax;
    }

    /**
     * @param int|null $prixMax
     * @return BienSearch
     */
    public function setPrixMax(int $prixMax): BienSearch
    {
        $this->prixMax = $prixMax;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSurfaceMin(): ?int
    {
        return $this->surfaceMin;
    }

    /**
     * @param int|null $surfaceMin
     * @return BienSearch
     */
    public function setSurfaceMin(int $surfaceMin): BienSearch
    {
        $this->surfaceMin = $surfaceMin;
        return $this;
    }


}