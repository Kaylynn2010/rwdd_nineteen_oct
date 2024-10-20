<?php
require_once __DIR__ . '/../configuration/databaseConfig.php'; // leave my dir alone
require_once __DIR__ . '/../lib/Database.php';

class RegisterController
{

    private $db;

    public function __construct()
    {
        session_start(); // Start the session

        // Initialize the database connection
        $this->db = new Database($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    }

    public function register($data)
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $username = $data['username'] ?? '';
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';

            // validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                echo json_encode(['success' => false, 'message' => 'Password should be at least 8 characters in length and include at least one uppercase letter, one lowercase letter, one number, and one special character.']);
                return;
            }

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
                return;
            }


            // check if email existed
            $checkEmailStmt = $this->db->getConnection()->prepare("SELECT * FROM user WHERE email = ? OR username = ?");
            $checkEmailStmt->bind_param("ss", $email, $username); // Bind both email and username
            $checkEmailStmt->execute();
            $checkEmailStmt->store_result();

            if ($checkEmailStmt->num_rows > 0) {
                echo json_encode(['success' => false, 'message' => 'Email or username is already registered.']);
            } else {
                // Hash the password for security
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // move to register
                $stmt = $this->db->getConnection()->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $email, $hashedPassword); // 's' specifies the variable type => 'string'

                if ($stmt->execute()) {
                    // Registration successful
                    echo json_encode(['success' => true]);
                } else {
                    // Register fail
                    echo json_encode(['success' => false]);
                }

                $stmt->close(); // Close the statement
            }
            $checkEmailStmt->close(); // Close the statement
        } else {
            // Handle invalid request method
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
        }
        // // validate password strength
        // $uppercase = preg_match('@[A-Z]@', $password);
        // $lowercase = preg_match('@[a-z]@', $password);
        // $number = preg_match('@[0-9]@', $password);
        // $specialChars = preg_match('@[^\w]@', $password);

        // if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        //     echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        // }else{
        //     echo 'Strong password.';
        // }
        // // valid email
        // if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     echo "Email address is valid.";
        // } else {
        //     echo "Invalid email address.";
        // }

        // Close the database connection
        $this->db->closeConnection();
    }
}
