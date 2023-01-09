CREATE TABLE IF NOT EXISTS User
(
    id          INT            NOT NULL         PRIMARY KEY AUTO_INCREMENT,
    username    VARCHAR(255)   NOT NULL UNIQUE,
    password    VARCHAR(255)   NOT NULL,
    roles       INT            NOT NULL              
);

CREATE TABLE IF NOT EXISTS Posts
(
    id          INT             NOT NULL PRIMARY KEY AUTO_INCREMENT,
    post_title  TEXT            NOT NULL,
    content     TEXT            NOT NULL,
    username    VARCHAR(255)    NOT NULL,
    date        DATE            NOT NULL
);  
CREATE TABLE IF NOT EXISTS Comment
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    response VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    created_at timestamp NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES Post(id) ON DELETE CASCADE
);