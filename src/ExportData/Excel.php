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

namespace Markocupic\ContaoSchuleEttiswilLicensesBundle\ExportData;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\Database;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel
{
    private ContaoFramework $framework;

    public function __construct(ContaoFramework $framework)
    {
        $this->framework = $framework;
    }

    /**
     * Send MS Excel file to the browser.
     *
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function excelExport(): void
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle('Software Lizenzen '.date('Y'));
        $spreadsheet->setActiveSheetIndex(0);

        // Get data
        $arrData = $this->prepareData();

        if (\count($arrData) > 0) {
            $intColumn = 0;

            // Header
            foreach ($arrData[0] as $k => $strValue) {
                ++$intColumn;
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($intColumn, 1, $k);
            }

            // Data rows
            foreach ($arrData as $intRow => $arrRow) {
                $intColumn = 0;

                foreach ($arrRow as $key => $strValue) {
                    ++$intColumn;

                    if ('expirationdate' === $key || 'tstamp' === $key) {
                        if (!empty($strValue)) {
                            $strValue = date('Y-m-d', (int) $strValue);
                        }
                    }

                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($intColumn, $intRow + 2, $strValue);
                }
            }
        } else {
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'No value provided');
        }

        // Send file to browser
        $objWriter = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="softwarelizenzen_schule_ettiswi_'.date('Y-m-d').'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit;
    }

    private function prepareData(): array
    {
        /** @var Database $databaseAdapter */
        $databaseAdapter = $this->framework->getAdapter(Database::class);

        $rows = [];
        $db = $databaseAdapter->getInstance()
            /** @lang mysql */
            ->prepare('SELECT * FROM tl_schule_ettiswil_licenses ORDER BY department')
            ->execute()
        ;

        while ($db->next()) {
            $rows[] = $db->row();
        }

        return $rows;
    }
}
