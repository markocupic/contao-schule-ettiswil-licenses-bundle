<?php

declare(strict_types=1);

/*
 * This file is part of Contao Schule Ettiswil Licenses Bundle.
 *
 * (c) Marko Cupic 2023 <m.cupic@gmx.ch>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-schule-ettiswil-licenses-bundle
 */

namespace Markocupic\ContaoSchuleEttiswilLicensesBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Markocupic\ContaoSchuleEttiswilLicensesBundle\MarkocupicContaoSchuleEttiswilLicensesBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(MarkocupicContaoSchuleEttiswilLicensesBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
