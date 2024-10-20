<?php
require_once __DIR__ . '/../configuration/databaseConfig.php'; // leave my dir alone
require_once __DIR__ . '/../lib/Database.php'; 

class LoginController
{

    private $db;


    public function __construct()
    {
        session_start(); // Start the session

        // Initialize the database connection
        $this->db = new Database($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    }

    public function login($data)
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';

            // Prepare and execute the SQL query to verify user credentials
            $stmt = $this->db->getConnection()->prepare("SELECT id, password FROM user WHERE email = ?");
            $stmt->bind_param("s", $email); // 's' specifies the variable type => 'string'
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($userId, $hashedPassword);
                $stmt->fetch();

                // Verify the password using password_verify for better security
                if (password_verify($password, $hashedPassword)) {
                    // Login successful
                    // Store user info in session
                    $_SESSION['user_id'] = $userId; // Store user ID in session
                    $_SESSION['email'] = $email; // You can also store email if needed

                    echo json_encode(['success' => true]);
                } else {
                    // Invalid credentials
                    echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
                }
            } else {
                // User not found
                echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
            }

            $stmt->close(); // Close the statement
        } else {
            // Handle invalid request method
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
        }

        // Close the database connection
        $this->db->closeConnection();
    }
}