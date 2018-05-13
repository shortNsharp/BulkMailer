<?php
require_once 'BulkMailer.php';

/**
 * BulkMailer test case.
 */
class BulkMailerTest extends PHPUnit_Framework_TestCase
{
    
    /**
     *
     * @var BulkMailer
     */
    private $bulkMailer;
    
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->bulkMailer = new BulkMailer();
    }
    
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->bulkMailer = null;
        
        parent::tearDown();
    }
    
    /**
     * Test constructing email with invalid recipients' email address
     */
    public function testBulkEmailInvalid()
    {
        $recipients['Shafiraton Mardhiah'] = 'shafiraton';
        $recipients['Dandarawiyah Shafira'] = 'dandarawiyah.shafira';
        $recipients['Shafira Mardhiah'] = 'shafiraton.m';
        
        $sent = $this->bulkMailer->bulkEmail(
            'in-v3.mailjet.com',
            'da3b01077bcbdc20a81bcb8b6aa25844',
            '2c57db0b75ff75dbbab981f912f2743a',
            'shafiraton.m@gmail.com',
            'PHPUnitTest',
            $recipients,
            'Unit Test for Bulk Mailer',
            'This is just a test for bulk email'
            );
        $this->assertEquals("False", $sent);
    }
    
    /**
     * Test constructing email with valid recipients' email address
     */
    public function testBulkEmailValid()
    {
        $recipients['Shafiraton Mardhiah'] = 'shafiraton@gmail.com';
        $recipients['Dandarawiyah Shafira'] = 'dandarawiyah.shafira@gmail.com';
        $recipients['Shafira Mardhiah'] = 'shafiraton.m@gmail.com';
        
        $sent = $this->bulkMailer->bulkEmail(
            'in-v3.mailjet.com',
            'da3b01077bcbdc20a81bcb8b6aa25844',
            '2c57db0b75ff75dbbab981f912f2743a',
            'shafiraton.m@gmail.com',
            'PHPUnitTest',
            $recipients,
            'Unit Test for Bulk Mailer',
            'This is just a test for bulk email'
            );
        $this->assertEquals("True", $sent);
    }
}

