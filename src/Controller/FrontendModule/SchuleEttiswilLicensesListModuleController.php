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

declare(strict_types=1);

namespace Markocupic\ContaoSchuleEttiswilLicensesBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\Date;
use Contao\FrontendUser;
use Contao\ModuleModel;
use Contao\PageModel;
use Contao\Template;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment as TwigEnvironment;

/**
 * Class SchuleEttiswilLicensesListModuleController
 *
 * @package Markocupic\ContaoSchuleEttiswilLicensesBundle\Controller\FrontendModule
 */
class SchuleEttiswilLicensesListModuleController extends AbstractFrontendModuleController
{
    /** @var TwigEnvironment */
    protected $twig;

    /**
     * SchuleEttiswilLicensesListModuleController constructor.
     *
     * @param TwigEnvironment $twig
     */
    public function __construct(TwigEnvironment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * This method extends the parent __invoke method,
     * its usage is usually not necessary
     *
     * @param Request $request
     * @param ModuleModel $model
     * @param string $section
     * @param array|null $classes
     * @param PageModel|null $page
     * @return Response
     */
    public function __invoke(Request $request, ModuleModel $model, string $section, array $classes = null, PageModel $page = null): Response
    {

        return parent::__invoke($request, $model, $section, $classes);
    }

    /**
     * Lazyload some services
     *
     * @return array
     */
    public static function getSubscribedServices(): array
    {
        $services = parent::getSubscribedServices();

        $services['contao.framework'] = ContaoFramework::class;
        $services['database_connection'] = Connection::class;

        return $services;
    }

    /**
     * @param Template $template
     * @param ModuleModel $model
     * @param Request $request
     * @return null|Response
     */
    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {


        /** @var Date $dateAdapter */
        $dateAdapter = $this->get('contao.framework')->getAdapter(Date::class);

        $arrLicenses = [];
        $stmt = $this->get('database_connection')
            ->executeQuery(
                'SELECT * FROM tl_schule_ettiswil_licenses ORDER BY department',
                ['female']
            );
        while (false !== ($objLicenses = $stmt->fetch(\PDO::FETCH_OBJ)))
        {
            $arrLicenses[] = $objLicenses;
        }

        $template->licenses = $arrLicenses;

        /**
         * Use twig template
         */
        return new Response($this->twig->render(
            '@MarkocupicContaoSchuleEttiswilLicenses/FrontendModule/SchuleEttiswilLicensesListModule/mod_schule_ettiswil_licenses_list_module.html.twig',
            [
                'data' => $template,
            ]
        ));
    }
}
