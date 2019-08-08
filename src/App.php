<?php

declare(strict_types=1);

namespace App;

use App\Persistence\Model\PommIssue\PommSchema\CountryModel;
use PommProject\Foundation\Pomm;
use function iterator_to_array;

class App
{
    /**
     * @var Pomm
     */
    private $pomm;

    public function __construct(Pomm $pomm)
    {
        $this->pomm = $pomm;
    }

    public function __invoke()
    {
        /** @var Session $session */
        $session = $this->pomm->getSession('pomm_issue');

        /** @var CountryModel $countryModel */
        $countryModel = $session->getModel(CountryModel::class);

        return iterator_to_array($countryModel->findAllWithCities());
    }
}
