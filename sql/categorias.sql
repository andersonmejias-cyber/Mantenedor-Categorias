CREATE DATABASE IF NOT EXISTS mantenedor_categorias;
USE mantenedor_categorias;

CREATE TABLE IF NOT EXISTS usuarios_sistema (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    activo BOOLEAN DEFAULT 1
);

INSERT IGNORE INTO usuarios_sistema (id, usuario, password)
VALUES (
    1,
    'admin',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
);

INSERT IGNORE INTO categorias (id, nombre, activo) VALUES
(1, 'Ataúdes', 1),
(2, 'Urnas', 1),
(3, 'Arreglos florales', 1),
(4, 'Servicios funerarios', 1),
(5, 'Traslados', 1),
(6, 'Ceremonias', 1),
(7, 'Documentación', 1),
(8, 'Otros servicios', 0);