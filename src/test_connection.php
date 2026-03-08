<?php
// Test database connection
require_once '/var/www/html/autoload.php';
require_once '/var/www/html/models/Database.php';

try {
    $conn = Database::getConnection();
    echo "✅ Conexão ao banco de dados: OK\n";
    
    // Try a simple query
    $stmt = $conn->prepare("SELECT 1");
    $stmt->execute();
    echo "✅ Query simples: OK\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
?>
