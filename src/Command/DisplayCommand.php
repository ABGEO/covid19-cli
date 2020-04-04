<?php

/*
 * This file is part of the abgeo/covid19-cli package.
 *
 * (c) Temuri Takalandze <me@abgeo.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ABGEO\COVID\Command;

use ABGEO\COVID\Exception\InvalidSlugException;
use ABGEO\COVID\Service\StatisticsService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class DisplayCommand.
 *
 * @categhory Command
 * @package   ABGEO\COVID
 */
class DisplayCommand extends Command
{
    protected static $defaultName = 'display';

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setDescription('Display COVID-19 Live statistic for given country.')
            ->setHelp('This command displays COVID-19 Live statistic for given country.')
            ->addArgument(
                'slug',
                InputArgument::REQUIRED,
                'Country slug. Use "countries" command for displaying all available slugs.'
            );
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $slug = $input->getArgument('slug');
        $service = new StatisticsService();
        $yesterday = null;
        $live = null;
        $confirmedDifference = null;
        $recoveredDifference = null;
        $deathDifference = null;
        $confirmedTemplate = null;
        $recoveredTemplate = null;
        $deathTemplate = null;

        try {
            $yesterday = $service->getCountryYesterday($slug);
            $live = $service->getCountryLive($slug);
        } catch (InvalidSlugException $e) {
            $io->error('Invalid slug was provided! Use "countries" command for displaying all available slugs.');

            return 1;
        }

        if ($yesterday && $live) {
            $io->title(
                'Statistics about COVID-19 in '.$live->getCountry().' for '.$live->getDate()->format('d/m/Y h:i')
            );

            $confirmedDifference = $live->getConfirmed() - $yesterday->getConfirmed();
            $recoveredDifference = $live->getRecovered() - $yesterday->getRecovered();
            $deathDifference = $live->getDeaths() - $yesterday->getDeaths();

            $confirmedTemplate = "<fg=blue>Confirmed Cases</>: \t<fg=yellow>{$live->getConfirmed()}</>";
            if ($confirmedDifference > 0) {
                $confirmedTemplate .= "\t(<fg=red>▲{$confirmedDifference}</>)";
            }

            $recoveredTemplate = "<fg=blue>Recovered Cases</>: \t<fg=yellow>{$live->getRecovered()}</>";
            if ($recoveredDifference > 0) {
                $recoveredTemplate .= "\t(<fg=green>▲{$recoveredDifference}</>)";
            }

            $deathTemplate = "<fg=blue>Death Cases</>: \t\t<fg=yellow>{$live->getDeaths()}</>";
            if ($deathDifference > 0) {
                $deathTemplate .= "\t(<fg=red>▲{$deathDifference}</>)";
            }

            $io->write([$confirmedTemplate, $recoveredTemplate, $deathTemplate], true);
        }

        return 0;
    }
}
