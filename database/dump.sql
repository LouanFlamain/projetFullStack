
CREATE TABLE IF NOT EXISTS User (
  id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  role VARCHAR(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS Rental (
  id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  amount INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  devise VARCHAR(5) NOT NULL,
  description TEXT NOT NULL,
  user_id INT NOT NULL,
  created_at timestamp NOT NULL,
  FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Tenant (
  id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  balance INT NOT NULL,
  user_id INT NOT NULL,
  rental_id INT NOT NULL,
  created_at timestamp NOT NULL,
  FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE,
  FOREIGN KEY (rental_id) REFERENCES Rental(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Costs (
   id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  credit INT NULL,
  debit INT NULL,
  cost_type VARCHAR(50) NOT NULL,
  reference VARCHAR(15) NOT NULL,
  tenant_id INT NOT NULL,
  created_at timestamp NOT NULL,
  FOREIGN KEY (tenant_id) REFERENCES Tenant(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Invitation (
   id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  token VARCHAR(255) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  created_at timestamp NOT NULL
);
