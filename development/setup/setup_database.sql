-- ==================== TABELLEN VERWIJDEREN OM DE TESTS UIT TE KUNNEN VOEREN ====================
DROP TABLE softalist_test.requirements;
DROP TABLE softalist_test.requirement_priorities;
DROP TABLE softalist_test.requirement_categories;
DROP TABLE softalist_test.requirement_status;
DROP TABLE softalist_test.projecten;
DROP TABLE softalist_test.users;

-- ==================== TABELLEN AANMAKEN ====================

CREATE TABLE IF NOT EXISTS users (
    user_id             INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_name           VARCHAR(250) NOT NULL UNIQUE,
    password            VARCHAR(250) NOT NULL,
    email               VARCHAR(250) NOT NULL UNIQUE
);
CREATE TABLE IF NOT EXISTS projecten(
    project_id              INTEGER PRIMARY KEY AUTO_INCREMENT,
    project_name            VARCHAR(255),
    project_date_added      DATETIME DEFAULT CURRENT_TIMESTAMP,
    project_date_deadline   DATETIME DEFAULT CURRENT_TIMESTAMP,
    project_manager         INTEGER,
    FOREIGN KEY (project_manager) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS requirement_status(
    status_id               INTEGER PRIMARY KEY AUTO_INCREMENT,
    status_name             VARCHAR(250),
    project_id              INTEGER DEFAULT '0',
    FOREIGN KEY (project_id) REFERENCES projecten(project_id)
);


CREATE TABLE IF NOT EXISTS requirement_priorities(
    priority_id                 INTEGER PRIMARY KEY AUTO_INCREMENT,
    priority_name               VARCHAR(255),
    project_id                  INTEGER DEFAULT '0',
    priority_color              VARCHAR(50) DEFAULT '#000000',
    priority_backgroundcolor          VARCHAR(50) DEFAULT '#CCCCFF',
    FOREIGN KEY (project_id) REFERENCES projecten(project_id)
);


CREATE TABLE IF NOT EXISTS requirement_categories(
    category_id             INTEGER PRIMARY KEY AUTO_INCREMENT,
    category_name           VARCHAR(255),
    project_id              INTEGER DEFAULT '0',
    FOREIGN KEY (project_id) REFERENCES projecten(project_id)
);

CREATE TABLE IF NOT EXISTS requirements(
    requirement_id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    requirement_name        VARCHAR(255),
    project_id              INTEGER NOT NULL,
    priority_id             INTEGER,
    category_id             INTEGER,
    status_id               INTEGER,
    user_id_added           INTEGER,
    user_id_task            INTEGER,
    date_added              DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_deadline           DATETIME,
    FOREIGN KEY (priority_id) REFERENCES requirement_priorities(priority_id),
    FOREIGN KEY (category_id) REFERENCES requirement_categories(category_id),
    FOREIGN KEY (project_id) REFERENCES projecten(project_id),
    FOREIGN KEY (status_id) REFERENCES requirement_status(status_id),
    FOREIGN KEY (user_id_added) REFERENCES users(user_id),
    FOREIGN KEY (user_id_task) REFERENCES users(user_id)
);  

CREATE TABLE IF NOT EXISTS tasks(
    task_id             INTEGER PRIMARY KEY AUTO_INCREMENT,
    name                VARCHAR(255),
    requirement_id      INTEGER,
    FOREIGN KEY (requirement_id) REFERENCES requirements(requirement_id)
);




--  ==================== DEFAULT DATA TER TESTING ====================
INSERT INTO projecten (project_name)
    VALUES 
    ('Project 1'),
    ('Project 2');

INSERT INTO requirement_priorities (priority_name, project_id, priority_color, priority_backgroundcolor)
    VALUES 
    ('Must Have', '1', '#000000', '#C5E0B3'),
    ('Should Have', '1', '#000000', '#BDD6EE'),
    ('Could Have', '1', '#000000', '#FFE599'),
    ('Wont Have', '1', '#000000', '#D9D9D9');

INSERT INTO requirement_categories (category_name, project_id)
    VALUES 
    ('Functional', '1'),
    ('Usability', '1'),
    ('Reliability', '1'),
    ('Performance', '1'),
    ('Supportability', '1')
    ;

INSERT INTO requirement_status (status_name, project_id)
    VALUES
    ('Backlog', '1'),
    ('To Do', '1'),
    ('Bezig', '1'),
    ('Testen / Preview', '1'),
    ('Klaar', '1')
    ;
INSERT INTO users (user_name, password, email)
    VALUES
    ('administrator', 'TestPassword1234321!@#', 'roy.schrauwen+admin@gmail.com'),
    ('royschrauwen', 'TestPassword1234321!@#', 'roy.schrauwen+user@gmail.com')
    ;

INSERT INTO requirements (requirement_name, project_id, priority_id, category_id, status_id, user_id_added)
    VALUES
    ('Een test requirement moet ingevoegd kunnen worden', '1','1','1','1', '2'),
    ('Een test requirement moet een prioriteit hebben', '1','2','1','1', '1'),
    ('Een test requirement moet een categorie hebben', '1','2','1','1', '1'),
    ('Requirements moeten weergegeven worden op het scherm', '1', '1', '2', '1', '2')
    ;

INSERT INTO tasks (name, requirement_id)
    VALUES
    ('Tast Taak 1 van Requirement 1', 1),
    ('Tast Taak 2 van Requirement 1', 1),
    ('Tast Taak 1 van Requirement 2', 2),
    ('Tast Taak 1 van Requirement 3', 3),
    ('Tast Taak 2 van Requirement 3', 3)
    ;