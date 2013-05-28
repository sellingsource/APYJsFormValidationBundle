<?php
namespace APY\JsFormValidationBundle\Tests\Generator\ScriptNaming;


use APY\JsFormValidationBundle\Generator\ScriptNaming\DefaultNamingStrategy;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

class DefaultNamingStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DefaultNamingStrategy
     */
    private $strategy;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var FormView
     */
    private $formView;

    protected function setUp()
    {
        $this->container = new Container();
        $this->strategy = new DefaultNamingStrategy();
        $this->strategy->setContainer($this->container);
        $this->formView = new FormView();
        $this->formView->vars['name'] = 'myForm';
        $request = Request::create('http://localhost', 'GET', array('_route' => 'HomePage'));

        $this->container->setParameter('apy_js_form_validation.script_directory', 'bundles/jsformvalidation/js');
        $this->container->setParameter('assetic.write_to', '/../web');
        $this->container->set('request', $request);
    }

    public function testGetScriptFilenameFromRouteAndForm()
    {
        $this->assertEquals('homepage_myform.js', $this->strategy->getScriptFilename($this->formView));
    }

    public function testGetScriptPath()
    {
        $this->assertEquals(
            'bundles/jsformvalidation/js',
            $this->strategy->getScriptPath()
        );
    }

    public function testGetScriptPathWithFilename()
    {
        $this->assertEquals(
            'bundles/jsformvalidation/js/my.js',
            $this->strategy->getScriptPath('my.js')
        );
    }

    public function testGetRealScriptPath()
    {
        $this->assertEquals(
            '/../web/bundles/jsformvalidation/js',
            $this->strategy->getRealScriptPath()
        );
    }

    public function testGetRealScriptPathWithFilename()
    {
        $this->assertEquals(
            '/../web/bundles/jsformvalidation/js/my.js',
            $this->strategy->getRealScriptPath('my.js')
        );
    }
}
