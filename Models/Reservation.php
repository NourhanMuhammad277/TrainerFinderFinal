<?

require_once __DIR__ . "/../db.php";
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Reservation implements Model
{

    public static function getAll(): array|null
    {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM reservation";
        $result = $conn->query($query);
        $subscribes = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $subscribes[] = $row;
            }
            return $subscribes;
        }
        return null;
    }
    public static function getById($id): array
    {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM reservation WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
    public static function create($data): bool
    {
        $conn = Database::getInstance()->getConnection();
        $query = "INSERT INTO reservation (trainer_id, user_id) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $data['trainer_id'], vars: $data['user_id']);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public static function update($id, $data): bool
    {

        return false;
    }
    public static function delete($id): bool
    {
        $conn = Database::getInstance()->getConnection();
        $query = "DELETE FROM reservation WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return true;
    }
}
