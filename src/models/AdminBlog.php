<?php
class AdminBlog
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    // --- 1. LOGIC BÀI VIẾT (POSTS) ---
    public function countAllPosts($search = '')
    {
        $sql = "SELECT COUNT(*) as total FROM blog_posts WHERE 1=1";
        $params = [];
        if (!empty($search)) {
            $sql .= " AND (title LIKE :s OR summary LIKE :s)";
            $params[':s'] = "%$search%";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch()['total'];
    }

    public function getAllPosts($limit, $offset, $search = '')
    {
        $sql = "SELECT p.*, c.name as category_name, a.name as author_name, a.avatar as author_avatar
                FROM blog_posts p
                LEFT JOIN blog_categories c ON p.category_id = c.id
                LEFT JOIN blog_authors a ON p.author_id = a.id
                WHERE 1=1";

        $params = [];
        if (!empty($search)) {
            $sql .= " AND (p.title LIKE :s OR p.summary LIKE :s)";
            $params[':s'] = "%$search%";
        }

        $sql .= " ORDER BY p.is_featured DESC, p.created_at DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $value) $stmt->bindValue($key, $value);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // --- 2. LOGIC DANH MỤC (CATEGORIES) ---
    public function getCategoriesWithStats()
    {
        $sql = "SELECT c.*, COUNT(p.id) as total_posts 
                FROM blog_categories c 
                LEFT JOIN blog_posts p ON c.id = p.category_id 
                GROUP BY c.id ORDER BY c.name ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // --- 3. LOGIC TÁC GIẢ (AUTHORS) ---
    public function getAuthorsWithStats()
    {
        $sql = "SELECT a.*, COUNT(p.id) as total_posts 
                FROM blog_authors a 
                LEFT JOIN blog_posts p ON a.id = p.author_id 
                GROUP BY a.id ORDER BY total_posts DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPostById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM blog_posts WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function createPost($data)
    {
        $sql = "INSERT INTO blog_posts (category_id, author_id, title, slug, summary, content, thumbnail, reading_time, is_featured, status) 
            VALUES (:cat, :auth, :title, :slug, :sum, :cont, :thumb, :read, :feat, :stat)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':cat' => $data['category_id'],
            ':auth' => $data['author_id'],
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':sum' => $data['summary'],
            ':cont' => $data['content'],
            ':thumb' => $data['thumbnail'],
            ':read' => $data['reading_time'],
            ':feat' => $data['is_featured'],
            ':stat' => $data['status']
        ]);
    }

    public function updatePost($id, $data)
    {
        $sql = "UPDATE blog_posts SET category_id=:cat, author_id=:auth, title=:title, slug=:slug, 
            summary=:sum, content=:cont, thumbnail=:thumb, reading_time=:read, is_featured=:feat, status=:stat 
            WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        // Bind các tham số tương tự hàm create, thêm :id
        return $stmt->execute([
            ':id' => $id,
            ':cat' => $data['category_id'],
            ':auth' => $data['author_id'],
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':sum' => $data['summary'],
            ':cont' => $data['content'],
            ':thumb' => $data['thumbnail'],
            ':read' => $data['reading_time'],
            ':feat' => $data['is_featured'],
            ':stat' => $data['status']
        ]);
    }

    public function deletePost($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM blog_posts WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Hàm lấy list đơn giản cho dropdown
    public function getCategoriesSimple()
    {
        $stmt = $this->conn->query("SELECT id, name FROM blog_categories ORDER BY name ASC");
        return $stmt->fetchAll();
    }
    public function getAuthorsSimple()
    {
        $stmt = $this->conn->query("SELECT id, name FROM blog_authors ORDER BY name ASC");
        return $stmt->fetchAll();
    }

    public function resetFeatured() {
        $stmt = $this->conn->prepare("UPDATE blog_posts SET is_featured = 0");
        return $stmt->execute();
    }
}
