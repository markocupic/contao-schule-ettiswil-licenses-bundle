<?php

/**
 * This file is part of a markocupic Contao Bundle.
 *
 * (c) Marko Cupic 2020 <m.cupic@gmx.ch>
 * @author     Marko Cupic
 * @package    Contao Schule Ettiswil Licenses
 * @license    GPL-3.0-or-later
 * @see        https://github.com/markocupic/contao-schule-ettiswil-licenses-bundle
 *
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
