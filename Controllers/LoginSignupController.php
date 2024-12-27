<?php
include_once '../db.php';  
include_once '../Models/User.php';
include_once '../Models/Admin.php';
use PHPUnit\Framework\TestCase;

class LoginSignupControllerTest extends TestCase
{
    private $controller;
    private $mockDb;
    private $mockUser;

    protected function setUp(): void
    {
        // Mocking the Database and User model (assuming these are classes you're using)
        $this->mockDb = $this->createMock(Database::class);
        $this->mockUser = $this->createMock(User::class);
        
        // Setting up the controller with mocked dependencies
        $this->controller = new LoginSignupController($this->mockDb, $this->mockUser);
    }

    // Test for valid signup
    public function testValidSignup()
    {
        $_POST['email'] = 'test@example.com';
        $_POST['pswd'] = 'validPassword123';
        $_POST['confirm_pswd'] = 'validPassword123';
        $_POST['txt'] = 'testuser';
        $_POST['signup'] = true;

        // Mock the behavior of User::createUser()
        $this->mockUser->method('createUser')
            ->willReturn(true);
        
        $this->controller->handleRequest();

        $this->assertEquals('Location: ../Views/myProfile.php', headers_list()[0]);
    }

    // Test for invalid email format
    public function testInvalidEmailFormat()
    {
        $_POST['email'] = 'invalidemail';
        $_POST['pswd'] = 'validPassword123';
        $_POST['confirm_pswd'] = 'validPassword123';
        
        $this->controller->handleRequest();

        $this->assertContains('Please enter a valid email address.', $this->getErrorMessages());
    }

    // Test for password mismatch
    public function testPasswordMismatch()
    {
        $_POST['email'] = 'test@example.com';
        $_POST['pswd'] = 'validPassword123';
        $_POST['confirm_pswd'] = 'differentPassword123';
        
        $this->controller->handleRequest();

        $this->assertContains('Passwords do not match.', $this->getErrorMessages());
    }

    // Test for existing user signup
    public function testExistingEmailSignup()
    {
        $_POST['email'] = 'existinguser@example.com';
        $_POST['pswd'] = 'validPassword123';
        $_POST['confirm_pswd'] = 'validPassword123';
        $_POST['txt'] = 'existinguser';
        
        $this->mockUser->method('getUserByEmail')
            ->willReturn(true); // Mock that the email already exists

        $this->controller->handleRequest();

        $this->assertContains('Email already exists.', $this->getErrorMessages());
    }

    // Test for successful login
    public function testSuccessfulLogin()
    {
        $_POST['email'] = 'user@example.com';
        $_POST['pswd'] = 'correctPassword';
        $_POST['login'] = true;

        $this->mockUser->method('getUserByEmail')
            ->willReturn(['id' => 1, 'username' => 'user']);
        $this->mockUser->method('password_verify')
            ->willReturn(true);

        $this->controller->handleRequest();

        $this->assertEquals('Location: ../Views/myProfile.php', headers_list()[0]);
    }

    // Test for invalid login credentials
    public function testInvalidLoginCredentials()
    {
        $_POST['email'] = 'user@example.com';
        $_POST['pswd'] = 'wrongPassword';
        $_POST['login'] = true;

        $this->mockUser->method('getUserByEmail')
            ->willReturn(['id' => 1, 'username' => 'user']);
        $this->mockUser->method('password_verify')
            ->willReturn(false);

        $this->controller->handleRequest();

        $this->assertContains('Invalid email or password.', $this->getErrorMessages());
    }

    // Helper to capture error messages from view
    private function getErrorMessages()
    {
        ob_start();
        include '../Views/LoginSignupView.php'; // Mock view rendering to capture messages
        return ob_get_clean();
    }
}
