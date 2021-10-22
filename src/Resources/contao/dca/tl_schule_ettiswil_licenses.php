<?php

/*
 * This file is part of markocupic/contao-schule-ettiswil-licenses-bundle.
 *
 * (c) Marko Cupic
 *
 * @license MIT
 */

use Contao\Input;
use Contao\System;
use Markocupic\ContaoSchuleEttiswilLicensesBundle\ExportData\Excel;

/**
 * Table tl_schule_ettiswil_licenses
 */
$GLOBALS['TL_DCA']['tl_schule_ettiswil_licenses'] = array(
    // Config
    'config'      => array(
        'dataContainer'    => 'Table',
        'enableVersioning' => true,
        'sql'              => array(
            'keys' => array(
                'id' => 'primary',
            ),
        ),
        'onload_callback'  => array(
            array('tl_schule_ettiswil_licenses', 'route'),
        ),
    ),
    'list'        => array(
        'sorting'           => array(
            'mode'        => 2,
            'fields'      => array('title', 'userid', 'passphrase', 'expirationdate', 'department', 'topic'),
            'flag'        => 1,
            'panelLayout' => 'filter;sort,search,limit',
        ),
        'label'             => array(
            'fields' => array('title'),
            'format' => '%s',
        ),
        'global_operations' => array(
            'all'         => array(
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"',
            ),
            'excelExport' => array(
                'label'      => &$GLOBALS['TL_LANG']['tl_schule_ettiswil_licenses']['excelExport'],
                'href'       => 'action=excelExport',
                'class'      => 'header_icon header_excel_export',
                'icon'       => 'bundles/markocupiccontaoschuleettiswillicenses/excel.svg',
                'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="i"',
            ),
        ),
        'operations'        => array(
            'edit'   => array(
                'label' => &$GLOBALS['TL_LANG']['tl_schule_ettiswil_licenses']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif',
            ),
            'copy'   => array(
                'label' => &$GLOBALS['TL_LANG']['tl_schule_ettiswil_licenses']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif',
            ),
            'delete' => array(
                'label'      => &$GLOBALS['TL_LANG']['tl_schule_ettiswil_licenses']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
            'show'   => array(
                'label'      => &$GLOBALS['TL_LANG']['tl_schule_ettiswil_licenses']['show'],
                'href'       => 'act=show',
                'icon'       => 'show.gif',
                'attributes' => 'style="margin-right:3px"',
            ),
        ),
    ),
    // Palettes
    'palettes'    => array(
        '__selector__' => array('addSubpalette'),
        'default'      => '{title_legend},title,userid,passphrase,notice;{expirationDate_legend},expirationdate;{config_legend},department,topic',
    ),
    // Subpalettes
    'subpalettes' => array(
        'addSubpalette' => 'textareaField',
    ),
    // Fields
    'fields'      => array(
        'id'             => array(
            'sql' => 'int(10) unsigned NOT NULL auto_increment',
        ),
        'tstamp'         => array(
            'sql' => 'int(10) unsigned NOT NULL default ""',
        ),
        'title'          => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'userid'         => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'passphrase'     => array(
            'inputType' => 'text',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'notice'         => array(
            'inputType' => 'textarea',
            'default'   => '',
            'exclude'   => true,
            'search'    => true,
            'eval'      => array('tl_class' => 'clr'),
            'sql'       => "text NULL"
        ),
        'department'     => array(
            'inputType' => 'select',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'reference' => $GLOBALS['TL_LANG']['tl_schule_ettiswil_licenses'],
            'options'   => array('kg', 'ps', 'iss', 'if', 'all'),
            'eval'      => array('mandatory' => true, 'includeBlankOption' => false, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'topic'          => array(
            'inputType' => 'select',
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'sorting'   => true,
            'reference' => $GLOBALS['TL_LANG']['tl_schule_ettiswil_licenses'],
            'options'   => array('mt', 'de', 'en', 'fr', 'rzg', 'lk', 'pu', 'bus', 'nat', 'mu', 'mui', 'bg', 'ttg', 'misc'),
            'eval'      => array('mandatory' => true, 'includeBlankOption' => false, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
        'expirationdate' => array(
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('rgxp' => 'date', 'datepicker' => true, 'tl_class' => 'w50 wizard'),
            'sql'       => "varchar(255) NOT NULL default ''",
        ),
    ),
);

/**
 * Class tl_schule_ettiswil_licenses
 */
class tl_schule_ettiswil_licenses
{
    /**
     * tl_schule_ettiswil_licenses constructor.
     */
    public function route()
    {
        if (Input::get('action') == 'excelExport') {
            $objExport = System::getContainer()
                ->get(Excel::class);

            $objExport->excelExport();
        }
    }
}
