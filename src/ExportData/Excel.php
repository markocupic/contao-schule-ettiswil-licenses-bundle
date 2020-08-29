<?php

/**
 * This file is part of a markocupic Contao Bundle.
 *
 * (c) Marko Cupic 2020 <m.cupic@gmx.ch>
 *
 * @author     Marko Cupic
 * @package    Contao Schule Ettiswil Licenses
 * @license    GPL-3.0-or-later
 * @see        https://github.com/markocupic/contao-schule-ettiswil-licenses-bundle
 *
 */

declare(strict_types=1);

namespace Markocupic\ContaoSchuleEttiswilLicensesBundle\ExportData;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\Database;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class Excel
 *
 * @package Markocupic\ContaoSchuleEttiswilLicensesBundle\ExportData
 */
class Excel
{
    /** @var ContaoFramework */
    private $framework;

    /**
     * Excel constructor.
     *
     * @param ContaoFramework $framework
     */
    public function __construct(ContaoFramework $framework)
    {

        $this->framework = $framework;
    }

    /**
     * Send excel file to browser
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function excelExport()
    {

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle("Software Lizenzen " . date("Y"));
        $spreadsheet->setActiveSheetIndex(0);

        // Get data
        $arrData = $this->prepareData();

        foreach ($arrData as $intRow => $arrRow)
        {
            foreach ($arrRow as $intColumn => $strValue)
            {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($intColumn + 1, $intRow + 1, $strValue);
            }
        }

        // Send file to browser
        $objWriter = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"softwarelizenzen_schule_ettiswi_" . date("Y-m-d") . ".xlsx\"");
        header("Cache-Control: max-age=0");
        $objWriter->save("php://output");
        exit;
    }

    /**
     * @return array
     */
    private function prepareData(): array
    {

        /** @var Database $databaseAdapter */
        $databaseAdapter = $this->framework->getAdapter(Database::class);

        // Trainer Datenarray erstellen
        $rows = [];
        $db = $databaseAdapter->getInstance()
            /** @lang mysql */
            ->prepare('SELECT * FROM tl_schule_ettiswil_licenses ORDER BY department')
            ->execute();
        while ($db->next())
        {
            $rows[] = $db->fetchRow();
        }

        return $rows;
    }

}
