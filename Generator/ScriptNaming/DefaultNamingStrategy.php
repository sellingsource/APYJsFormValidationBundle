<?php
namespace APY\JsFormValidationBundle\Generator\ScriptNaming;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

/**
 * The default naming strategy that originally came with the bundle.
 *
 * @author Brian Feaver <brian.feaver@sellingsource.com>
 */
class DefaultNamingStrategy implements NamingStrategy, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Generates and returns the script's filename.
     *
     * @param FormView $formView
     * @return string
     */
    public function getScriptFilename(FormView $formView)
    {
        $request = $this->getRequest();
        $formName = isset($formView->vars['name']) ? $formView->vars['name'] : 'form';
        $scriptFile = strtolower($request->get('_route')) . '_' . strtolower($formName) . ".js";
        return $scriptFile;
    }

    /**
     * @param string $filename
     * @return string
     */
    public function getScriptPath($filename = '')
    {
        if (empty($filename)) {
            return $this->container->getParameter('apy_js_form_validation.script_directory');
        }

        return implode('/', array(
            $this->container->getParameter('apy_js_form_validation.script_directory'),
            $filename
        ));
    }

    /**
     * @param string $filename
     * @return string
     */
    public function getRealScriptPath($filename = '')
    {
        return $this->container->getParameter('assetic.write_to') . '/' . $this->getScriptPath($filename);
    }

    /**
     * @return Request
     */
    private function getRequest()
    {
        return $this->container->get('request');
    }
}
