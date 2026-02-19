<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Create messages table if not exists
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS messages (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `sender_id` INT NOT NULL,
        `receiver_id` INT NOT NULL,
        `conversation_id` VARCHAR(100),
        `message_text` TEXT NOT NULL,
        `is_read` TINYINT DEFAULT 0,
        `created_at` DATETIME,
        KEY `sender_id` (`sender_id`),
        KEY `receiver_id` (`receiver_id`),
        KEY `conversation_id` (`conversation_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
} catch (Exception $e) {}

$user_id = $_SESSION['user']['id'];
$action = $_GET['action'] ?? 'conversations';
$other_user_id = (int)($_GET['user'] ?? 0);

// Mark messages as read
if ($other_user_id && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'send_message') {
        $message = trim($_POST['message'] ?? '');
        if ($message) {
            $conv_id = min($user_id, $other_user_id) . '_' . max($user_id, $other_user_id);
            $stmt = $pdo->prepare('INSERT INTO messages (sender_id, receiver_id, conversation_id, message_text, created_at) VALUES (?, ?, ?, ?, NOW())');
            $stmt->execute([$user_id, $other_user_id, $conv_id, $message]);
        }
    }
}

// Get conversations
$conversations = [];
try {
    // Messages dikirim ke user
    $stmt = $pdo->prepare("SELECT DISTINCT 
        CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END as other_user_id,
        CASE WHEN sender_id = ? THEN (SELECT username FROM users WHERE id = receiver_id) ELSE (SELECT username FROM users WHERE id = sender_id) END as username,
        MAX(created_at) as last_message_time,
        (SELECT message_text FROM messages m2 WHERE 
            ((m2.sender_id = ? AND m2.receiver_id = other_user_id) OR 
             (m2.sender_id = other_user_id AND m2.receiver_id = ?))
         ORDER BY m2.created_at DESC LIMIT 1) as last_message,
        (SELECT COUNT(*) FROM messages WHERE receiver_id = ? AND sender_id = other_user_id AND is_read = 0) as unread_count
    FROM messages 
    WHERE sender_id = ? OR receiver_id = ?
    GROUP BY other_user_id
    ORDER BY last_message_time DESC");
    
    $stmt->execute([$user_id, $user_id, $user_id, $user_id, $user_id, $user_id, $user_id]);
    $conversations = $stmt->fetchAll();
} catch (Exception $e) {}

// Get messages dengan specific user
$messages = [];
$other_user = null;
if ($other_user_id) {
    try {
        // Get other user info
        $stmt = $pdo->prepare('SELECT id, username FROM users WHERE id = ?');
        $stmt->execute([$other_user_id]);
        $other_user = $stmt->fetch();
        
        // Get messages
        $stmt = $pdo->prepare("SELECT * FROM messages WHERE 
            (sender_id = ? AND receiver_id = ?) OR 
            (sender_id = ? AND receiver_id = ?)
         ORDER BY created_at ASC");
        $stmt->execute([$user_id, $other_user_id, $other_user_id, $user_id]);
        $messages = $stmt->fetchAll();
        
        // Mark as read
        $stmt = $pdo->prepare('UPDATE messages SET is_read = 1 WHERE receiver_id = ? AND sender_id = ?');
        $stmt->execute([$user_id, $other_user_id]);
    } catch (Exception $e) {}
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= $other_user_id ? 'Chat dengan ' . htmlspecialchars($other_user['username'] ?? '') : 'Chat' ?> - BirdKita</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .chat-view {
      display: grid;
      grid-template-columns: 300px 1fr;
      height: 600px;
      gap: 16px;
    }
    
    @media (max-width: 768px) {
      .chat-view {
        grid-template-columns: 1fr;
        height: auto;
      }
    }
    
    .chat-sidebar {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      display: flex;
      flex-direction: column;
    }
    
    .chat-sidebar-header {
      background: var(--primary);
      color: white;
      padding: 16px;
      font-weight: 700;
    }
    
    .conversations-list {
      flex: 1;
      overflow-y: auto;
    }
    
    .conversation-item {
      padding: 12px 16px;
      border-bottom: 1px solid #e0e0e0;
      cursor: pointer;
      transition: background 0.2s;
    }
    
    .conversation-item:hover {
      background: #f5f5f5;
    }
    
    .conversation-item.active {
      background: #e8f5e9;
      border-left: 4px solid var(--primary);
    }
    
    .conversation-name {
      font-weight: 600;
      color: var(--primary);
    }
    
    .conversation-preview {
      font-size: 12px;
      color: #666;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-top: 4px;
    }
    
    .conversation-unread {
      display: inline-block;
      background: var(--primary);
      color: white;
      padding: 2px 8px;
      border-radius: 12px;
      font-size: 11px;
      margin-left: 8px;
    }
    
    .chat-panel {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      display: flex;
      flex-direction: column;
    }
    
    .chat-panel-header {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      padding: 16px;
      font-weight: 700;
    }
    
    .chat-messages {
      flex: 1;
      overflow-y: auto;
      padding: 16px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      background: #f9f9f9;
    }
    
    .chat-message {
      display: flex;
      gap: 8px;
      align-items: flex-end;
    }
    
    .chat-message.sent {
      justify-content: flex-end;
    }
    
    .chat-message-bubble {
      max-width: 70%;
      padding: 12px 16px;
      border-radius: 12px;
      word-wrap: break-word;
    }
    
    .chat-message.received .chat-message-bubble {
      background: white;
      color: #333;
      border: 1px solid #e0e0e0;
    }
    
    .chat-message.sent .chat-message-bubble {
      background: var(--primary);
      color: white;
    }
    
    .chat-message-time {
      font-size: 11px;
      color: #999;
      margin-top: 4px;
    }
    
    .chat-input-area {
      padding: 16px;
      border-top: 1px solid #e0e0e0;
      display: flex;
      gap: 8px;
    }
    
    .chat-input-area textarea {
      flex: 1;
      padding: 12px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      resize: none;
      font-family: inherit;
      min-height: 40px;
      max-height: 80px;
    }
    
    .chat-input-area button {
      padding: 12px 20px;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.2s;
    }
    
    .chat-input-area button:hover {
      background: var(--primary-dark);
    }
    
    .empty-chat {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
      color: #999;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="site-wrap">
    <header class="site-header">
      <div class="nav-inner">
        <div class="brand">
          <img src="assets/logo.svg" alt="Logo" class="logo">
          <span class="brand-title">BirdKita</span>
        </div>
        <div style="flex:1"></div>
        <div class="user-actions">
          <a href="dashboard.php" class="btn" style="background:var(--accent);color:var(--text-dark)">← Kembali</a>
          <a href="logout.php" class="logout">Logout</a>
        </div>
      </div>
    </header>

    <main class="main">
      <h1 style="color:var(--primary);margin-bottom:20px">💬 Pesan & Chat</h1>
      
      <div class="chat-view">
        <!-- Sidebar - List Conversations -->
        <div class="chat-sidebar">
          <div class="chat-sidebar-header">Percakapan (<?= count($conversations) ?>)</div>
          
          <div class="conversations-list">
            <?php if (!$conversations): ?>
              <div style="padding:16px;text-align:center;color:#999">
                <p style="margin:0">Belum ada percakapan</p>
              </div>
            <?php else: ?>
              <?php foreach ($conversations as $conv): ?>
                <a href="messages.php?user=<?= $conv['other_user_id'] ?>" style="text-decoration:none">
                  <div class="conversation-item <?= $other_user_id === (int)$conv['other_user_id'] ? 'active' : '' ?>">
                    <div class="conversation-name">
                      <?= htmlspecialchars($conv['username']) ?>
                      <?php if ($conv['unread_count'] > 0): ?>
                        <span class="conversation-unread"><?= $conv['unread_count'] ?></span>
                      <?php endif; ?>
                    </div>
                    <div class="conversation-preview"><?= htmlspecialchars(substr($conv['last_message'] ?? '', 0, 40)) ?></div>
                  </div>
                </a>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

        <!-- Chat Panel -->
        <div class="chat-panel">
          <?php if ($other_user): ?>
            <div class="chat-panel-header">Chat dengan <?= htmlspecialchars($other_user['username']) ?></div>
            
            <div class="chat-messages">
              <?php foreach ($messages as $msg): ?>
                <div class="chat-message <?= $msg['sender_id'] === $user_id ? 'sent' : 'received' ?>">
                  <div>
                    <div class="chat-message-bubble"><?= htmlspecialchars($msg['message_text']) ?></div>
                    <div class="chat-message-time"><?= htmlspecialchars(date('H:i', strtotime($msg['created_at']))) ?></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            
            <form method="post" class="chat-input-area">
              <input type="hidden" name="action" value="send_message">
              <textarea name="message" placeholder="Ketik pesan Anda..." required></textarea>
              <button type="submit">Kirim</button>
            </form>
          <?php else: ?>
            <div class="empty-chat">
              <div>
                <p style="font-size:24px;margin:0">💬</p>
                <p>Pilih percakapan untuk mulai chat</p>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </main>

    <footer class="site-footer">
      <div class="footer-inner">🐦 BirdKita - Marketplace & Komunitas Burung Indonesia © 2026</div>
    </footer>
  </div>

  <script>
    // Auto scroll ke bottom
    const chatMessages = document.querySelector('.chat-messages');
    if (chatMessages) {
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
  </script>
</body>
</html>
