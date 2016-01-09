<?php
/**
 * This file is part of the TestingBundle project.
 *
 * @project    TestingBundle
 * @author     Cosmin Voicu <cosmin.voicu@oconotech.com>
 * @copyright  2015 - ocono Tech GmbH
 * @license    http://www.ocono-tech.com proprietary
 * @link       http://www.ocono-tech.com
 * @date       29/12/15
 */

namespace TestCase\Traits;

use Symfony\Component\Console\Command\Command;

class CommandTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @see \Cosma\Bundle\TestingBundle\TestCase\Traits\CommandTrait::getConsoleApplication
     */
    public function testGetConsoleApplication()
    {
        $kernel = $this->prophesize('Symfony\Component\HttpKernel\KernelInterface');

        $testCaseTrait = $this->getMockBuilder('\Cosma\Bundle\TestingBundle\TestCase\Traits\CommandTrait')
                            ->disableOriginalConstructor()
                            ->setMethods(['getKernel'])
                            ->getMockForTrait()
        ;

        $testCaseTrait->expects($this->once())
                    ->method('getKernel')
                    ->will($this->returnValue($kernel->reveal()))
        ;

        $reflectionClass = new \ReflectionClass($testCaseTrait);

        $reflectionMethod = $reflectionClass->getMethod('getConsoleApplication');
        $reflectionMethod->setAccessible(true);
        $application = $reflectionMethod->invoke($testCaseTrait);

        $this->assertInstanceOf('\Symfony\Bundle\FrameworkBundle\Console\Application', $application);

        return [ $testCaseTrait, $reflectionClass, $application];
    }

    /**
     * @see \Cosma\Bundle\TestingBundle\TestCase\Traits\CommandTrait::executeCommand
     *
     * @depends testGetConsoleApplication
     */
    public function testExecuteCommand(array $options)
    {
        /** @type \ReflectionClass $reflectionClass */
        list($testCaseTrait, $reflectionClass, $application) = $options;


        $reflectionMethod = $reflectionClass->getMethod('getConsoleApplication');
        $reflectionMethod->setAccessible(true);

        /** @type \Symfony\Bundle\FrameworkBundle\Console\Application $application */
        $application = $reflectionMethod->invoke($testCaseTrait);

        $command = new Command('some:command');

        $application->add($command);

        $reflectionMethod = $reflectionClass->getMethod('executeCommand');
        $reflectionMethod->setAccessible(true);
        $reflectionMethod->invoke($testCaseTrait, 'some:command');
    }
}