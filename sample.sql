CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL,
    parent_id INT NULL,
    level INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE CASCADE,
    UNIQUE KEY (parent_id, slug)
);

CREATE TABLE articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    images VARCHAR(255),
	is_featured BOOLEAN DEFAULT FALSE,
    view_count INT DEFAULT 0,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE tags (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    slug VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE article_tag (
    article_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (article_id, tag_id),
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

CREATE TABLE article_category (
    article_id INT NOT NULL,
    category_id INT NOT NULL,
    is_primary BOOLEAN DEFAULT FALSE, 
    PRIMARY KEY (article_id, category_id),
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE videos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    youtube_id VARCHAR(20) NOT NULL,
	images VARCHAR(255),
    embed_code VARCHAR(100) NOT NULL, 
    description TEXT,
    youtube_published_at DATETIME, 
    is_featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE video_category (
    video_id INT NOT NULL,
    category_id INT NOT NULL,
    is_primary BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (video_id, category_id),
    FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE video_tag (
    video_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (video_id, tag_id),
    FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);
CREATE TABLE playlists (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE playlist_video (
    playlist_id INT NOT NULL,
    video_id INT NOT NULL,
    position INT NOT NULL,
    PRIMARY KEY (playlist_id, video_id),
    FOREIGN KEY (playlist_id) REFERENCES playlists(id) ON DELETE CASCADE,
    FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE
);

CREATE TABLE instagram_posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    article_id INT NOT NULL,
    instagram_id VARCHAR(100) UNIQUE, 
    caption TEXT,
    post_url VARCHAR(255),
    media_url VARCHAR(255),         
    media_type ENUM('IMAGE', 'VIDEO', 'CAROUSEL'),
    publish_status ENUM('SCHEDULED', 'PUBLISHED', 'FAILED') DEFAULT 'SCHEDULED',
    scheduled_time DATETIME,         
    published_time DATETIME,         
    like_count INT DEFAULT 0,
    comment_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
);

CREATE TABLE instagram_accounts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    account_id VARCHAR(100) NOT NULL,
    access_token TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE instagram_post_accounts (
    post_id INT NOT NULL,
    account_id INT NOT NULL,
    PRIMARY KEY (post_id, account_id),
    FOREIGN KEY (post_id) REFERENCES instagram_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (account_id) REFERENCES instagram_accounts(id) ON DELETE CASCADE
);


INSERT INTO categories (name, slug, parent_id, level) VALUES 
('Artikel', 'artikel', NULL, 1),
('Katakese', 'katakese', NULL, 1);

INSERT INTO categories (name, slug, parent_id, level) VALUES 
('All', 'all', 1, 2, 'article'),
('Dewasa', 'dewasa', 1, 2, 'article'),
('Film', 'film', 3, 3, 'article'),
('Sastra', 'sastra', 3, 3, 'article'),  
('Novel', 'novel', 5, 4, 'article');


INSERT INTO categories (name, slug, parent_id, level, type) VALUES 
('All', 'all', 2, 2, 'katakese'),
('Medium', 'medium', 2, 2, 'katakese'),
('Advanced', 'advanced', 8, 3, 'katakese'); 


INSERT INTO article_category VALUES (1, 3, TRUE), (1, 4, FALSE);
