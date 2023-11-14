<?php

declare(strict_types=1);

/**
 * This file is part of a Marko Cupic Contao Schule Ettiswil Licenses Bundle.
 *
 * (c) Marko Cupic 2023 <m.cupic@gmx.ch>
 *
 * @license    GPL-3.0-or-later
 *
 * @see        https://github.com/markocupic/contao-schule-ettiswil-licenses-bundle
 */

namespace Markocupic\ContaoSchuleEttiswilLicensesBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\ModuleModel;
use Contao\PageModel;
use Contao\Template;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as TwigEnvironment;

class SchuleEttiswilLicensesListModuleController extends AbstractFrontendModuleController
{
    private Connection $connection;
    private TwigEnvironment $twig;

    public function __construct(Connection $connection, TwigEnvironment $twig)
    {
        $this->connection = $connection;
        $this->twig = $twig;
    }

    /**
     * This method extends the parent __invoke method,
     * its usage is usually not necessary.
     */
    public function __invoke(Request $request, ModuleModel $model, string $section, array $classes = null, PageModel $page = null): Response
    {
        return parent::__invoke($request, $model, $section, $classes);
    }

    protected function getResponse(Template $template, ModuleModel $model, Request $request): Response
    {
        $arrLicenses = [];
        $results = $this->connection
            ->executeQuery(
                'SELECT * FROM tl_schule_ettiswil_licenses ORDER BY department',
                [],
            )
        ;

        while (false !== ($row = $results->fetchAssociative())) {
            if (!empty($row['expirationdate'])) {
                $row['expirationdate'] = date('Y-m-d', (int) $row['expirationdate']);
            }

            if (!empty($row['tstamp'])) {
                $row['tstamp'] = date('Y-m-d', (int) $row['tstamp']);
            }

            $arrLicenses[] = $row;
        }

        $template->licenses = $arrLicenses;

        return $template->getResponse();
    }
}
