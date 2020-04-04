<?php

/*
 * This file is part of the abgeo/covid19-cli package.
 *
 * (c) Temuri Takalandze <me@abgeo.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ABGEO\CovId\Command;

use ABGEO\CovId\Service\APIService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CountriesCommand.
 *
 * @categhory Command
 * @package   ABGEO\CovId
 */
class CountriesCommand extends Command
{
    protected static $defaultName = 'countries';

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setDescription('Display available countries.')
            ->setHelp('This command displays available countries.');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $service = new APIService();
        $countries = $service->getCountries();
        $table = new Table($output);
        $table->setHeaders(['Country', 'Slug']);

        foreach ($countries as $country) {
            $table->addRow([$country['Country'], $country['Slug']]);
        }

        $table->render();

        return 0;
    }
}
