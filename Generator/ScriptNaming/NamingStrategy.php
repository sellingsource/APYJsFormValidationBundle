<?php
namespace APY\JsFormValidationBundle\Generator\ScriptNaming;

use Symfony\Component\Form\FormView;

/**
 * Defines a naming strategy to use for the script.
 *
 * @author Brian Feaver <brian.feaver@sellingsource.com>
 */
interface NamingStrategy
{
    /**
     * Returns the script's filename.
     *
     * Should not include any path information.
     *
     * @param FormView $formView
     * @return mixed
     */
    public function getScriptFilename(FormView $formView);

    /**
     * Returns the relative path to the script file.
     *
     * @param string $filename the name of the script to append to the path
     * @return string
     */
    public function getScriptPath($filename = '');

    /**
     * Returns the fully qualified script path.
     *
     * @param string $filename the name of the script to append to the path
     * @return string
     */
    public function getRealScriptPath($filename = '');
}
