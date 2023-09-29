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

use Markocupic\ContaoSchuleEttiswilLicensesBundle\Model\SchuleEttiswilLicensesModel;

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['schule_ettiswil']['licenses'] = [
    'tables' => ['tl_schule_ettiswil_licenses'],
];

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_schule_ettiswil_licenses'] = SchuleEttiswilLicensesModel::class;
