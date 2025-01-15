
<?php
// สร้างคลาส User
class User {
    private $id;
    private $username;
    private $email;

    // สร้าง constructor เพื่อกำหนดค่าเริ่มต้น
    public function __construct($id, $username, $email) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    // เมธอดในการดึงข้อมูลผู้ใช้
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    // เมธอดในการอัปเดตข้อมูลผู้ใช้
    public function updateEmail($newEmail) {
        $this->email = $newEmail;
    }
}

// สร้างคลาสสำหรับการจัดการข้อมูลผู้ใช้
class UserManager {
    private $users = [];

    // เมธอดสำหรับเพิ่มผู้ใช้
    public function addUser($user) {
        $this->users[$user->getId()] = $user;
    }

    // เมธอดสำหรับดึงข้อมูลผู้ใช้
    public function getUser($id) {
        return $this->users[$id] ?? null;
    }

    // เมธอดสำหรับลบผู้ใช้
    public function deleteUser($id) {
        unset($this->users[$id]);
    }
}

// ตัวอย่างการใช้งาน
$user1 = new User(1, 'john_doe', 'john@example.com');
$user2 = new User(2, 'jane_doe', 'jane@example.com');

$userManager = new UserManager();
$userManager->addUser($user1);
$userManager->addUser($user2);

// แสดงผลลัพธ์
echo $userManager->getUser(1)->getUsername(); // ผลลัพธ์: john_doe
$userManager->getUser(2)->updateEmail('jane_new@example.com');
echo $userManager->getUser(2)->getEmail(); // ผลลัพธ์: jane_new@example.com
?>

