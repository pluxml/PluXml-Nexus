CREATE TABLE categories
(
    id   INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL UNIQUE,
    icon TEXT NOT NULL DEFAULT 'icon-leaf'
);

INSERT INTO categories (name, icon)
VALUES ('SEO', 'icon-globe'),
       ('Social', 'icon-chat'),
       ('Security', 'icon-lock');

CREATE TABLE users
(
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    username    TEXT NOT NULL,
    password    TEXT NOT NULL,
    email       TEXT NOT NULL,
    website     TEXT,
    role        TEXT,
    token       TEXT,
    tokenexpire TEXT
);

CREATE TABLE plugins
(
    id            INTEGER PRIMARY KEY AUTOINCREMENT,
    name          TEXT NOT NULL UNIQUE,
    description   TEXT,
    author        INTEGER NOT NULL,
    date          TEXT NOT NULL,
    versionplugin TEXT,
    versionpluxml TEXT,
    file          TEXT NOT NULL,
    link          TEXT,
    category      INTEGER NOT NULL,
    FOREIGN KEY (author) REFERENCES users (id),
    FOREIGN KEY (category) REFERENCES categories (id)
);

CREATE TABLE themes
(
    id            INTEGER PRIMARY KEY AUTOINCREMENT,
    name          TEXT NOT NULL UNIQUE,
    description   TEXT,
    author        INTEGER NOT NULL,
    date          TEXT NOT NULL,
    versiontheme  TEXT,
    versionpluxml TEXT,
    file          TEXT NOT NULL,
    link          TEXT,
    FOREIGN KEY (author) REFERENCES users (id)
);
