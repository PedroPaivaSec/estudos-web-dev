DROP DATABASE IF EXISTS exercicios;
CREATE DATABASE exercicios CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE exercicios;

CREATE TABLE usuarios (
  id   INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE tarefas (
  id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  titulo         VARCHAR(150) NOT NULL,
  status         ENUM('em_aguardo','em_andamento','concluida') NOT NULL DEFAULT 'em_aguardo',
  responsavel_id INT UNSIGNED NULL,
  concluida_em   DATETIME NULL,
  FOREIGN KEY (responsavel_id) REFERENCES usuarios(id)
) ENGINE=InnoDB;

INSERT INTO usuarios (nome) VALUES ('Ana'), ('Bruno');

INSERT INTO tarefas (titulo, status, responsavel_id, concluida_em) VALUES
('Conferir guias do mês',         'em_aguardo',   NULL, NULL),
('Emitir certidões negativas',    'em_aguardo',   NULL, NULL),
('Organizar pasta de documentos', 'em_andamento', 1,    NULL),
('Enviar relatório ao gestor',    'em_andamento', 1,    NULL),
('Conciliar extrato bancário',    'em_andamento', 2,    NULL),
('Arquivar notas de setembro',    'concluida',    2,    '2026-10-15 16:30:00');