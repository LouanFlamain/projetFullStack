
CREATE TABLE IF NOT EXISTS User (
  id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  role INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Tenant (
  id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  total_amount INT NOT NULL,
  user_id INT NOT NULL,
  created_at timestamp NOT NULL,
  FOREIGN KEY (user_id) REFERENCES User(id)
);

CREATE TABLE IF NOT EXISTS CostType (
   id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  code VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  created_at timestamp NOT NULL
);

CREATE TABLE IF NOT EXISTS Costs (
   id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  amount INT NOT NULL,
  costs_type_id INT NOT NULL,
  created_at timestamp NOT NULL,
  FOREIGN KEY (costs_type_id) REFERENCES CostType(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS CostTenant (
   id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  costs_type_id INT NOT NULL,
  tenant_id INT NOT NULL,
  created_at timestamp NOT NULL,
  FOREIGN KEY (costs_type_id) REFERENCES CostType(id) ON DELETE CASCADE,
  FOREIGN KEY (tenant_id) REFERENCES Tenant(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Invits (
   id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
  token VARCHAR(255) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  created_at timestamp NOT NULL
);
