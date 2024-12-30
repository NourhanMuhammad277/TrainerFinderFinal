<?php
include_once '../db.php';

class User {

 //USING CRUD OPERATIONS 

 
  //read
    public static function getUserByEmail($email) {
          $db = Database::getInstance();
         $conn = $db->getConnection();
        if (!$conn) {
            die("Database connection failed.");
        }
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        if (!$stmt) {
            die("Statement preparation failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Close the statement and return the user data (if found)
        $stmt->close();

        // Check if user data exists
        if ($user) {
            return $user;
        }

        // Return null if no user found
        return null;
    }
    public static function getUserById($user_id) {
        // Get the database connection
        $db = Database::getInstance()->getConnection();

        // Prepare the query to fetch email, username, and password by ID
        $query = "SELECT username, email, password FROM users WHERE id = ?";

        // Prepare the statement
        if ($stmt = $db->prepare($query)) {
            // Bind parameters
            $stmt->bind_param("i", $user_id);

            // Execute the query
            $stmt->execute();

            // Bind the result to variables
            $stmt->bind_result($username, $email, $password);

            // Fetch the result
            if ($stmt->fetch()) {
                // Return the user data as an associative array
                return [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password
                ];
            } else {
                return null;  // Return null if no user found
            }
        } else {
            // If statement preparation fails
            return null;
        }
    }


   //create
    public static function createUser( $email, $password, $username) {
          $db = Database::getInstance();
         $conn = $db->getConnection();
   
        if (!$conn) {
            die("Database connection failed.");
        }

        // Insert user into the database using a prepared statement
        $stmt = $conn->prepare("INSERT INTO users (email, password, username) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Statement preparation failed: " . $conn->error);
        }

        $stmt->bind_param("sss", $email, $password, $username);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
//read
    public static function getAllUsers() {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        // Ensure the connection is valid
        if (!$conn) {
            die("Database connection failed.");
        }

        // Fetch all users
        $stmt = $conn->prepare("SELECT * FROM users");
        if (!$stmt) {
            die("Statement preparation failed: " . $conn->error);
        }

        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);

        // Close the statement and return the users
        $stmt->close();

        return $users;
    }
//update
    public static function updateUser($id, $email, $password, $username) {
          $db = Database::getInstance();
     $conn = $db->getConnection();
        if (!$conn) {
            die("Database connection failed.");
        }
        $stmt = $conn->prepare("UPDATE users SET email = ?, password = ?, username = ? WHERE id = ?");
        if (!$stmt) {
            die("Statement preparation failed: " . $conn->error);
        }

        $stmt->bind_param("sssi", $email, $password, $username, $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
     //delete
    public static function deleteUser( $id) {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        if (!$conn) {
            die("Database connection failed.");
        }
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        if (!$stmt) {
            die("Statement preparation failed: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
}
?>
