DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS sessions;


CREATE TABLE users (
	id SERIAL,
	email VARCHAR(128) UNIQUE,
	username VARCHAR(64) UNIQUE,
	password VARCHAR(128),
	nickname VARCHAR(64),
	PRIMARY KEY (id)
);

CREATE INDEX idx_users_email ON users (email);
CREATE INDEX idx_users_username ON users (username);
CREATE INDEX idx_users_nickname ON users (nickname);


CREATE TABLE posts (
	id SERIAL,
	content TEXT NOT NULL,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	user_id INTEGER,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE INDEX idx_posts_timestamp ON posts (timestamp);


CREATE TABLE comments (
	id SERIAL,
	content TEXT NOT NULL,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	post_id INTEGER,
	user_id INTEGER,
	PRIMARY KEY (id),
	FOREIGN KEY (post_id) REFERENCES posts (id),
	FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE INDEX idx_comments_timestamp ON comments (timestamp);


CREATE TABLE sessions (
	id VARCHAR(32),
	data BYTEA,
	expiry TIMESTAMP NOT NULL,
	PRIMARY KEY (id)
);
